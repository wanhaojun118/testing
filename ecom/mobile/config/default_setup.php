<?php
 
error_reporting(0);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: application/json; charset=UTF-8');
date_default_timezone_set("Asia/Kuala_Lumpur");  

DEFINE("DATABASE_IP", "localhost");
DEFINE("DATABASE_USER", "icre8tech_letpay");
DEFINE("DATABASE_PASSWORD", "M@tetechdb123");
DEFINE("DATABASE_NAME", "icre8tech_letpay");
DEFINE("DATABASE_CHARSET", "UTF-8");
DEFINE("COPYRIGHT", "Copyright&copy;".date("Y"));

DEFINE("WEBSITE_TITLE", "Letzpay");

?>
