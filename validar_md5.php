<?php
    
    require_once('coneccion.php'); 
    
    
    if(isset($_POST)){
        
        session_start();

        $name = $_POST['name'];
        $pass = $_POST['pass'];

        $salt='?%@hdgd283745%';
        $passfuerte=md5($salt.$pass);
        //$passend=$_POST['passfuerte'];
        //$rs['passend'];

        $contador = 0;
        $sql = "SELECT * FROM users";
        $statement = $pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();

        foreach($result as $rs){
            if($rs['name']==$name && $rs['pass_md5']==$passfuerte){
                $contador++;
                $status_id=$rs['status_id'];
                $id1 = $rs['id'];
                $id2 = $rs['id'];
            }
        }
    }else{
        header("location:login_md5.php");
    }
    if($contador == 1){
        //$_SESSION['name']=$name;
        if($status_id=='3'){
            header("location:administrador.php?id=$id2");
        }else{
            header("location:usuario.php?id=$id2");
        }
        
    }else{
        header("location:login_md5.php");
    }

?>