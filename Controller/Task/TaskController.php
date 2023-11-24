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
    public function index() : void
    {
        try{
            $tasks = (new Conn())->getAll();
                echo json_encode($tasks);
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
        if(isset($_POST['titulo']) && isset($_POST['descricao'])) {
            // Chama a função create com os parâmetros fornecidos
            $taskController->create($_POST['titulo'], $_POST['descricao']);
        }else{
            // Se os parâmetros estão faltando, retorna uma mensagem de erro
            echo json_encode(['success' => false, 'message' => 'Parâmetros ausentes.']);
        }
        break;
        case 'update':
            // Verifica se os parâmetros necessários foram fornecidos
            if(isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['descricao'])) {
                // Chama a função update com os parâmetros fornecidos
                $taskController->update($_POST['id'], $_POST['titulo'], $_POST['descricao']);
            } else {
                // Se os parâmetros estão faltando, retorna uma mensagem de erro
                echo json_encode(['success' => false, 'message' => 'Parâmetros ausentes para a atualização.']);
            }
            break;
        case 'delete':
            if(isset($_POST['id'])){
                $taskController->delete($_POST['id']);
            }else{
                echo json_encode(['success' => false, 'message' => 'Falha ao deletar tarefa.']);
            }
    default:
        echo 'erro';
        break;
}