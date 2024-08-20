<?php
namespace app\model;
use PDO;
use PDOException;

class Database
{
  private $host = 'mysql';
  private $dbname = 'task';
  private $user = 'admin';
  private $pass = 'admin';

  public function getConnection()
  {
      try {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

        $pdo = new PDO($dsn, $this->user, $this->pass);

        return $pdo;
        
      } catch (PDOException $e) {

        echo "Erro de conexão: " . $e->getMessage();
      }
  }

}