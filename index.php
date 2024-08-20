<?php

require "vendor/autoload.php";

use app\router\Router;
use app\view\TaskView;



$uri = parse_url($_SERVER['REQUEST_URI']);


if($uri['path'] !== "/"){
    //chamar rota
   Router::execute();
}else{
    //TaskView::index();
}