<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

//carregar constantes
require __DIR__ . '/App/Config/config.php';

//Iniciar sessao:
session_start();
//session_unset();

if(empty($_SESSION['user']) && empty($_SESSION['pass']) && $_SESSION['status'] !== 'LOGADO'){
    require DOMAIN_PATH . '/App/View/login.php';
    //limpar variaveis da sessao
    session_unset();
}else{
    require DOMAIN_PATH . '/App/View/index.php';
}

