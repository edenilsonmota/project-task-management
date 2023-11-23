<?php

//DB credentials
define("HOST", 'localhost');
define("DB", 'crud');
define("USER", 'esm');
define("PASS", 'teste123');

define("DS", DIRECTORY_SEPARATOR); //separador
define("DIR_APP", __DIR__); //raiz
define("DIR_PROJECT", 'crud-tarefas');  //pasta do projeto


//carregar autoload
if(file_exists('../../autoload.php')){
    require('../../autoload.php');
}else{
    throw new Exception('Erro: O arquivo "autoload.php" não foi encontrado.');
}

?>
