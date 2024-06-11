<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class LoginModel extends Database{
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($email, $pass){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar senha
        if ($user && password_verify($pass, $user['pass'])) {
            return $user;
        } else {
            return false;
        }
    }
}
