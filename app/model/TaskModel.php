<?php
namespace app\model;
use app\model\Database;
use PDO;


class TaskModel extends Database
{
    
    /**
     * Retornar todas as tarefas
     *
     * @return array
     */
    public function getAll()
    {
        //resgatar a conexão
        $conn = $this->getConnection();
        
        //retornar somente as tarefas ativas(status 1);
        $query = "SELECT id, title, description, dateTask, timeTask  FROM task WHERE status = 1";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        //retornar em array associativo;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}