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
