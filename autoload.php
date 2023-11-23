<?php
/**
 * AUTOLOAD MODEL
 * @param $classe
 */

function autoload($classe)
{
    
    $diretorioBase = DIR_APP . DS;
    $classe = $diretorioBase . 'Model' . DS . str_replace('\\', DS, $classe) . '.php';
    var_dump($diretorioBase);
    if (file_exists($classe) && !is_dir($classe)) {
        
        include $classe;
        
    }
}

spl_autoload_register('autoload');