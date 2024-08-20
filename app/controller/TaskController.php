<?php

namespace app\controller;

use app\model\TaskModel;
use app\view\TaskView;


class TaskController
{
    private $model;


    function __construct()
    {
        //instanciar o model da Task
        $this->model = new TaskModel();
    }

    /**
     * Retornar todas as tarefas ativas
     *
     * @return json
     */
    public function getAll()
    {   
        //Cabeçalho json
        header('Content-Type: application/json');

        $result = $this->model->getAll();

        if(!$result){
            $result = "Sem tarefas ativas no banco de dados";
        }

        return json_encode($result);
    }

    //Retornar tarefa por id
    public function getById()
    {   
        //Cabeçalho json
        header('Content-Type: application/json');
        
        return json_encode($_GET['id']);
    }

    //criar nova tarefa
    public function create()
    {   
        //Obter o conteudo da solicitação
        $json = file_get_contents('php://input');
        return $json;
    }


}