<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

require "../../App/Config/config.php";
require DOMAIN_PATH . '/vendor/autoload.php';

use App\Model\LoginModel;

// Iniciar sessão
session_start();

// Função para validar o token CSRF
function validateCsrfToken($token) {
    return $token === $_SESSION['csrf_token'];
}

// Verificar o token CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        die('Token CSRF inválido');
    }
}

// Processar o login
$checkLogin = new LoginModel();
$result = $checkLogin->checkLogin($_POST['email'], $_POST['pass']);

/* echo "<pre>";
var_dump($result); */

if($result) {
    $_SESSION['idUser'] = $result['id'];
    $_SESSION['user'] = $result['name'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['status'] = 'LOGADO';
    $_SESSION['msg_error'] = '';
        
    header("Location: " . URL . "App/View/home.php");
} else {
    $_SESSION["msg_error"] = "Credenciais incorretas. Por favor, verifique-as e tente novamente.";
    header("Location: " . URL . "App/View/login.php");
}
?>
