<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

//carregar constantes
require __DIR__ . '/App/Config/config.php';

// Iniciar sessão se não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Função para gerar um token CSRF
function generateCsrfToken() {
    return bin2hex(random_bytes(32));
  }
  
  // Verificar se o token CSRF já existe na sessão, senão gerar um novo
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCsrfToken();
  }

/* echo "Index:";
var_dump($_SESSION);die; */



if(empty($_SESSION['user']) && empty($_SESSION['pass']) && $_SESSION['status'] !== 'LOGADO'){
    // Limpar variáveis da sessão antes de redirecionar para a página de login
    session_unset();
    session_destroy();
    header("Location: " . URL . "App/View/login.php");
}else{
    header("Location: " . URL . "App/View/home.php");
}

