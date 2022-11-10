<?php
require_once('coneccion.php');

if($_POST){

    $salt='?%@hdgd283745%';
    $sql='INSERT INTO users (name, pass_md5, pass, status_id) VALUES (?, ?, ?, ?)';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $status_id=isset($_POST['status_id'])?$_POST['status_id']:'';
    $pass=isset($_POST['pass'])?$_POST['pass']:'';
    $pass_md5=md5($salt.$pass);
    $statement=$pdo->prepare($sql);
    $statement->execute(array($name,$pass_md5,$pass,$status_id));

}
header('location:index.html');
?>