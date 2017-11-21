<?php

error_reporting(0);
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("Asia/Kuala_Lumpur");  

DEFINE("DATABASE_IP", "localhost");
DEFINE("DATABASE_USER", "wtech_ecom");
DEFINE("DATABASE_PASSWORD", "WTechdb123");
DEFINE("DATABASE_NAME", "wtech_ecom");
DEFINE("DATABASE_CHARSET", "utf-8");
DEFINE("COPYRIGHT", "Copyright&copy;".date("Y"));

DEFINE("WEBSITE_TITLE", "Ecommerce");
/*
DEFINE("WEBSITE_TITLE_IMAGE", "<img src='images/logo-1.png' width='100px'/>");
DEFINE("WEBSITE_TITLE_IMAGE2", "<img src='images/logo.jpg' width='100px'/>");
DEFINE("WEBSITE_HOME_IMAGE", "<img src='images/jg.jpg' width='100%'  />");
DEFINE("WEBSITE_PRO_IMAGE", "<img src='images/pro1.jpg' class=\"img-responsive center-block\"/>");
DEFINE("WEBSITE_PRO_IMAGE_1", "<img src='images/pro.jpg' class=\"img-responsive center-block\"/>");
DEFINE("WEBSITE_ICON","images/logo_small.png");
*/
?>
