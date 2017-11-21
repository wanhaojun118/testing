<?php
if (isset($papp)) {
    if (file_exists('public_app/' . $papp . '.php')) {

        include_once 'public_app/' . $papp . '.php';
    } else {

        include_once 'public_app/error.php';
    }
} else {
    include_once 'public_app/home.php';
}
?>