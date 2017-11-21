<?php

require_once("config/default_setup.php");
require_once("config/db_conn.php");
require_once("function/function.php");
require_once("class/member.php"); 

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
        $lang_file = $folder_path.'language/en/default.php';
        $lang_folder = $folder_path.'language/en/';
        break;

    case 'cn':
        $lang_file = $folder_path.'language/cn/default.php'; 
        $lang_folder = $folder_path.'language/cn/';
        break;

    default:
        $lang_file = $folder_path.'language/en/default.php';
        $lang_folder = $folder_path.'language/en/';
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
$bm360_id = filter_input(INPUT_COOKIE, "360_id"); //member_auth_md5
$bm360_auth = filter_input(INPUT_COOKIE, "360_auth");

//echo '<script type="text/javascript">alert("'.$bm360_auth.'")</script>';
if (isset($bm360_id) && isset($bm360_auth)) {
    $stmt = $mysqli->prepare("select member_id, member_name, member_email, member_birthday, member_gender, member_address, member_postcode, member_city, member_province, member_country, member_phone from member WHERE member_auth=? AND member_auth_md5=?");
    $stmt->bind_param("ss", $bm360_auth, $bm360_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($member_id, $member_name, $member_email, $member_birthday, $member_gender, $member_address, $member_postcode, $member_city, $member_province, $member_country, $member_phone);
    $stmt->fetch();
    if ($stmt->num_rows === 1) {
        //Set Cookies and expire in half hours inactive 
        update_cookies();
        $member = new member($member_id, $member_name, $member_email, $member_birthday, $member_gender, $member_address, $member_postcode, $member_city, $member_province, $member_country, $member_phone);
    }
}
if (isset($pact)) {
	
    if (file_exists($folder_path . $lang_folder . $pact . '.php')) {
        include_once $folder_path . $lang_folder . $pact . '.php';
    }
	 
	 
    if (file_exists($folder_path . 'public_act/' . $pact . '.php')) {
        include $folder_path . 'public_act/' . $pact . '.php';
    } else {
        echo "Action file not found";
    }
	
}
//Public Application Page Access
else if (isset($papp)) { 
		
    if (file_exists($folder_path . $lang_folder . $papp . '.php')) {
        include_once $folder_path . $lang_folder . $papp . '.php';
    }
	
    include $folder_path . 'public_app/main.php'; //2
}//Dashboard
// else if (isset($bm360_id) && isset($bm360_auth)) { 
	// $stmt = $mysqli->prepare("select member_id,member_username from member WHERE member_auth=? AND member_auth_md5=?");		
    // $stmt->bind_param("ss", $bm360_auth, $bm360_id);
    // $stmt->execute();
    // $stmt->store_result();
	// $stmt->bind_result($member_id,$member_username);
    // $stmt->fetch();
    // if ($stmt->num_rows === 1) { 
        // //Set Cookies and expire in half hours inactive 
		// update_cookies(); 
        // $member = new member($member_id,$member_username);
     
	  // if (isset($loc)) {
		 
            // if (file_exists($folder_path . $lang_folder . $loc . '.php')) {
                // include_once $folder_path . $lang_folder . $loc . '.php';
            // }
            // include $folder_path.'app/main.php';
        // } else if (isset($f)) { 
            // if (file_exists($folder_path . $lang_folder . $f . '.php')) {
                // include_once $folder_path . $lang_folder . $f . '.php';
            // } 
            // if (file_exists($folder_path . 'act/' . $f . '.php')) {
				// include $folder_path . 'act/' . $f . '.php';
            // } else {
                // include $folder_path . 'app/main.php';
            // }
        // } else {
            // header('Location: ?loc=main');
        // }
    // } else { 
	
        // header('Location: ?papp=login');
    // }
// }
else {
    //Default Pages(Without login)
    if (isset($f) || isset($loc)) {
        ?> 
        <script>
            alert('Please sign in again.');
            window.location = '?papp=login';
		</script>
        <?php

    } else {
        include 'public_app/main.php';
    }
}
?>