<?php

namespace Task;
use DB\Conn;
use PDO;
use PDOException;

class TaskController
{   

    /**
     * Método para exibir todos as task
     *
     * @return array
     */
    public function index() : array
    {
        try{
            $tasks = (new Conn())->getAll();
            return $tasks;
        }catch(PDOException $exception){
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * Método para exibir uma task específico pelo ID
     *
     * @param int $id
     * @return array
     */
    public function one (int $id): array
    {
        try{
            $task = (new Conn())->getOneByKey($id);
        return $task;
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
            return "Inserção de tarefa feita com sucesso!";
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