<?php
namespace app\model;
use app\model\Database;
use PDO;


class TaskModel extends Database
{
    private $connection;
    private $qb;


    public function __construct(){
        //Regastando conexão do Doctrine Query Builder da class pai
        $this->connection = $this->getConnection();
        $this->qb = $this->connection->createQueryBuilder();
    }
    
    /**
     * Retornar todas as tarefas concluidas ou não
     *
     * @return array
     */
    public function getAll()
    {

        $this->qb->select('idTask', 'title', 'description', 'status', 'type', 'dateTimeCreate')
            ->from('task');

        return $this->qb->executeQuery()->fetchAllAssociative();
    }

    public function getById($id){
        $this->qb->select('idTask', 'title', 'description', 'status', 'type', 'dateTimeCreate')
            ->from('task')
            ->where('idTask = :id')
            ->setParameter('id', $id);

        return $this->qb->executeQuery()->fetchAllAssociative();
    }
}