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

        $results = $this->model->getAll();

        if(!$results){
            return json_encode([
                'message' => 'Nenhum registro encontrado.',
            ]);
        }

        return json_encode($results);
    }

    /**
     * Retornar tarefa por id
     * @return false|string|void
     */
    public function getById()
    {   
        //Cabeçalho json
        header('Content-Type: application/json');

        if(!isset($_GET['id']) || empty($_GET['id'])){
            return json_encode([
                'error' => 'API ERROR',
                'message' => 'Adicione o id da tarefa.',
                'instruction' => 'task?id=1'
            ]);

        }

        if(!is_numeric($_GET['id'])){
            return json_encode([
                'error' => 'API ERROR',
                'message' => 'Adicione um id do tipo inteiro.',
                'instruction' => 'task?id=1'
            ]);
        }

        $result = $this->model->getById($_GET['id']);

        if(!$result){
            return json_encode([
                'message' => 'Nenhum registro encontrado.',
            ]);
        }

        //retornar registro
        return json_encode($result);

    }

    //criar nova tarefa
    public function create()
    {   
        //Obter o conteudo da solicitação
        $json = file_get_contents('php://input');
        return $json;
    }


}