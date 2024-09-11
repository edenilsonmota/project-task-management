<?php

require "vendor/autoload.php";

use app\router\Router;
use app\view\Home;



$uri = parse_url($_SERVER['REQUEST_URI']);


if($uri['path'] !== "/"){
    //chamar rota
   return Router::execute();
}


/**
 *  uri igual a / significa acessar o template index
 */
$home = new Home();
$home->index();


