<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../App/Config/config.php";
require DOMAIN_PATH . '/vendor/autoload.php';

use App\Model\Login;

$checkLogin = new Login();
$result = $checkLogin->checkLogin($_POST['email'], $_POST['pass']);

/* echo "<pre>";
var_dump($result); */

session_start();
if($result){

    $_SESSION['idUser'] = $result['id'];
    $_SESSION['user'] = $result['name'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['status'] = 'LOGADO';
        
    header("Location: " . URL . "App/View/index.php");
}else{
    $_SESSION["msg_error"] = "Credenciais incorretas. Por favor, verifique-as e tente novamente.";
    header("Location: " . URL . "index.php");
}