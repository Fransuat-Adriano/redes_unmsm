<?php
$dsn = 'mysql:dbname=proyectohorario;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn,
                    $user,
                    $password);
    //echo 'conexion correcta';
} catch ( PDOException $e) {
    echo 'Error al conectarnos:' . $e->getMessage();
}
?>