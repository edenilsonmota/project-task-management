<?php
namespace app\model;
use Doctrine\DBAL\DriverManager;

class Database
{

  private $config = [
      'dbname'   => 'task',
      'user'     => 'admin',
      'password' => 'admin',
      'host'     => 'mysql',
      'driver'   => 'pdo_mysql',
  ];

    /** Connection do QueryBuilder Doctrine
     * @return \Doctrine\DBAL\Connection
     */
  public function getConnection()
  {
     return DriverManager::getConnection($this->config);
  }

}