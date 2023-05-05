<?php 
    $host = "localhost";
    $database = "users";
    $user = "root";
    $pass = "root";

    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        $error = $e->getMessage(); 

        echo "Houve um erro ao se conectar com o banco de dados $error";
    }