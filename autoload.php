<?php
/**
 * AUTOLOAD MODEL
 * @param $classe
 */

function autoload($classe)
{
    $diretorioBase = DIR_APP . DS;

    //Verificar se é um model
    $caminhoModel = $diretorioBase . 'Model' . DS . str_replace('\\', DS, $classe) . '.php';
    if (file_exists($caminhoModel) && !is_dir($caminhoModel)) {  
        include $caminhoModel;
    }

    // Verifica se é um controlador (Controller)
    $caminhoController = $diretorioBase . 'Controller' . DS . str_replace('\\', DS, $classe) . '.php';
    if (file_exists($caminhoController) && !is_dir($caminhoController)) {
        include $caminhoController;
    }

}

spl_autoload_register('autoload');