<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

session_start();

require "../Config/config.php";

//Se user não tiver logado voltar para index/login:
if($_SESSION['status'] !== 'LOGADO'){
    //limpar variaveis da sessao
    session_unset();
    header("Location: " . URL . "index.php");
}

require_once DOMAIN_PATH ."/App/View/includes/header.php";
require_once DOMAIN_PATH ."/App/View/includes/navbar.php";
var_dump($_SESSION);

?>


<?php require_once DOMAIN_PATH ."/App/View/includes/footer.php";?>