<?php

//nome do projeto
define("PROJECT_NAME", "system-task");
//caminho do projeto
define("DOMAIN_PATH", $_SERVER["DOCUMENT_ROOT"] . PROJECT_NAME);
//URL do projeto
if(!defined("URL")) define("URL",(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://'.$_SERVER["HTTP_HOST"] . "/" . PROJECT_NAME . "/" : 'http://'.$_SERVER["HTTP_HOST"]. "/" . PROJECT_NAME . "/");


?>
