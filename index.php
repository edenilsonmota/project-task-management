<?php

$host = "mysql";
$db = "task";
$user = "admin";
$pass = "admin";

try {

    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    if($pdo) {
        echo "Connected to the $db database successfully!";
    }
} catch( PDOException $e){
    die($e->getMessage());
} finally {
    if($pdo){
        $pdo = null;
    }
}