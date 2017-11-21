<?php
require_once("config/default_setup.php");
require_once("config/db_conn.php");
require_once("function/function.php");
require_once('class/admin.php'); 

// Language
session_start();

$INPUT_GET_LANG = filter_input(INPUT_GET, 'LANG');
$INPUT_SESSION_LANG = filter_input(INPUT_SESSION, 'LANG');
$INPUT_COOKIE_LANG = filter_input(INPUT_COOKIE, 'LANG');
if (isset($INPUT_GET_LANG)) {
    $language = $INPUT_GET_LANG;
    $_SESSION['LANG'] = $INPUT_GET_LANG;
    setcookie('LANG', $INPUT_GET_LANG, time() + (3600 * 24 * 30));
} else if (isset($INPUT_SESSION_LANG)) {
    $language = $INPUT_SESSION_LANG;
} else if (isset($INPUT_COOKIE_LANG)) {
    $language = $INPUT_COOKIE_LANG;
} else {
    $language = 'en';
}

switch ($language) {
    case 'en':
        $lang_file = 'language/en/default.php';
        $lang_folder = 'language/en/';
        break;

    case 'cn':
        $lang_file = 'language/cn/default.php'; 
        $lang_folder = 'language/cn/';
        break;

    default:
        $lang_file = 'language/en/default.php';
        $lang_folder = 'language/en/';
        break;
}
include_once $lang_file;
//End Language

//Public Action Page Access
$pact = filter_input(INPUT_GET, 'pact');
$papp = filter_input(INPUT_GET, 'papp');
//$f:action page
//$loc:view page(need login)
$f = filter_input(INPUT_GET, 'f');
$loc = filter_input(INPUT_GET, 'loc');
$admin_bm360_id = filter_input(INPUT_COOKIE, "admin_360_id");
$admin_bm360_auth = filter_input(INPUT_COOKIE, "admin_360_auth");


if (isset($pact)) {
    if (file_exists($lang_folder . $pact . '.php')) {
        include_once $lang_folder . $pact . '.php';
    }

    if (file_exists('public_act/' . $pact . '.php')) {
        include 'public_act/' . $pact . '.php';
    } else {
        echo "Action file not found";
    }
}
//Public Application Page Access
else if (isset($papp)) { 
    if (file_exists($lang_folder . $papp . '.php')) {
        include_once $lang_folder . $papp . '.php';
    }
    include 'public_app/main.php';
}//Dashboard
else if (isset($admin_bm360_id) && isset($admin_bm360_auth)) {  
    $stmt = $mysqli->prepare("SELECT admin_id,admin_name,admin_phone,admin_email,admin_username"
            . " FROM admin WHERE admin_auth=? AND admin_auth_md5=?"); 
    $stmt->bind_param("ss", $admin_bm360_auth, $admin_bm360_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($admin_id, $admin_name, $admin_phone, $admin_email, $admin_username);
    $stmt->fetch();
    if ($stmt->num_rows === 1) {
        //Set Cookies and expire in half hours inactive 
		update_cookies();  
        $admin = new admin($admin_id, $admin_name, $admin_phone, $admin_email, $admin_username);
        if (isset($loc)) {
            if (file_exists($lang_folder . $loc . '.php')) {
                include_once $lang_folder . $loc . '.php';
            }
            include 'app/main.php';
        } else if (isset($f)) {
			if (file_exists($lang_folder . $f . '.php')) {
                include_once $lang_folder . $f . '.php';
            }
            if (file_exists('act/' . $f . '.php')) {
                include 'act/' . $f . '.php';
            } else {
                include 'app/main.php';
            }
        } else {
            header('Location: ?loc=dashboard');
        }
    } else { 
        header('Location: ?papp=login');
    }
}
//Default Pages(Without login)
else {
    if (isset($f) || isset($loc)) {
        ?> 
        <script>
            alert('Please sign in again.');
            window.location = '?papp=login';</script>
        <?php

    } else {
        ?> 
			<script>
				
                    window.location = '?papp=login';</script>
        <?php

    }
}
?>