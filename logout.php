<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

require 'App/Config/config.php';
session_start();


session_unset();
session_destroy();
header("Location: " . URL . "index.php");
exit();
?>
