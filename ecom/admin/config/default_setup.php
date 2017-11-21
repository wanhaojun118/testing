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
//DEFINE("WEBSITE_TITLE_IMAGE", "<img src='images/logo.png' width='100px'/>");
//DEFINE("WEBSITE_ICON","images/logo_small.png");