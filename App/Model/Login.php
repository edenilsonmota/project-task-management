<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class Login extends Database{
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($email, $pass){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND pass = :pass";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
