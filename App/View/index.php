<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

//Se user não tiver logado voltar para index/login:
if($_SESSION['status'] !== 'LOGADO'){
    //limpar variaveis da sessao
    session_unset();
    header("Location: " . URL . "index.php");
}
require_once "App/Config/config.php";
require_once "App/View/includes/header.php";
var_dump($_SESSION);

?>


<?php require_once "App/View/includes/footer.php";?>