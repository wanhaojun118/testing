<?php 

require_once("config/default_setup.php");
require_once("../front_end/config/db_conn.php");
require_once("../front_end/function/function.php");
 

$pact = filter_input(INPUT_POST,"pact");
$INPUT_GET_LANG = filter_input(INPUT_POST,"lang");

 if (isset($INPUT_GET_LANG)) {
    $language = $INPUT_GET_LANG;
    //$_SESSION['LANG'] = $INPUT_GET_LANG;
   // setcookie('LANG', $INPUT_GET_LANG, time() + (3600 * 24 * 30));
}
 // else if (isset($INPUT_SESSION_LANG)) {
    // $language = $INPUT_SESSION_LANG;
// } else if (isset($INPUT_COOKIE_LANG)) {
    // $language = $INPUT_COOKIE_LANG;
// }
 else {
    $language = 'en';
}

switch ($language) {
    case 'en':
        $lang_file = '../front_end/language/en/default.php';
        $lang_folder = '../front_end/language/en/';
        break;

    case 'zh':
        $lang_file = '../front_end/language/cn/default.php'; 
        $lang_folder = '../front_end/language/cn/';
        break;
		
	case 'en_US':
        $lang_file = '../front_end/language/en/default.php';
        $lang_folder = '../front_end/language/en/';
        break;
		
    default:
        $lang_file = '../front_end/language/en/default.php';
        $lang_folder = '../front_end/language/en/';
        break;
} 
include_once $lang_file;

if ($pact) {
	
	if (file_exists($lang_folder . $pact . '.php')) 
	{
        include_once $lang_folder . $pact . '.php';
    }
	 
    if (file_exists('public_act/' . $pact . '.php')) {
        include 'public_act/' . $pact . '.php';
    } else {
        echo "Action file not found";
    }
	
}

?>