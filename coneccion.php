<?php

    $dsn = 'mysql:dbname=redes;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $user, $password);
        
    } catch (PDOException $e) {
        echo 'error al conectarnos: '.$e->getMessage();
    }

?>