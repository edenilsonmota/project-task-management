<?php

namespace Task;

require("../../config.php");


use DB\Conn;
use PDOException;


class TaskController
{   

    /**
     * Método para exibir todos as task
     *
     * @return array
     */
    public function index()
    {
        try{
            $tasks = (new Conn())->getAll();
            var_dump($tasks);
        }catch(PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }


    /**
     * Método para adicionar uma nova task
     *
     * @param string $titulo
     * @param string $descricao
     * 
     */
    public function create(string $titulo, string $descricao) 
    {
        try{
            (new Conn())->insert($titulo, $descricao);
            echo json_encode(['success' => true, 'message' => 'Tarefa adicionada com sucesso.']);
        }catch(PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * Método para atualizar uma task existente
     *
     * @param integer $id
     * @param string $titulo
     * @param string $descricao
     */
    public function update(int $id, string $titulo,string $descricao) 
    {
        try{
            (new Conn())->update($id, $titulo, $descricao);
            return "Tarefa atualizada com sucesso!";
        }catch(PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * Método para excluir um Tarefa
     *
     * @param integer $id
     * 
     */
    public function delete(int $id) 
    {
        try{
            (new Conn())->delete($id);
            return "Tarefa deletada com sucesso!";
        }catch(PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }
}


// Lógica para roteamento
$action = $_GET['action'] ?? '';

$taskController = new TaskController();

switch ($action) {
    case 'index':
        $taskController->index();
        break;
    case 'create':
        // Verifica se os parâmetros necessários foram fornecidos
        if(isset($_POST['task_name']) && isset($_POST['task_description'])) {
            // Chama a função addTask com os parâmetros fornecidos
            $taskController->create($_POST['task_name'], $_POST['task_description']);
        }else{
            // Se os parâmetros estão faltando, retorna uma mensagem de erro
            echo json_encode(['success' => false, 'message' => 'Parâmetros ausentes.']);
        }
        break;
    default:
        echo 'erro';
        break;
}