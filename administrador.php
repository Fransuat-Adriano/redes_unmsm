<?php
    require_once('coneccion.php');
    
    $sql = 'SELECT users.*, status.estado 
    FROM users
    INNER JOIN status
    ON users.status_id = status.id
    WHERE users.id = ?';
    $statement = $pdo->prepare($sql);
    $statement -> execute(array($_GET['id']));
    $result = $statement->fetchAll();
    $rs = $result[0];
    //var_dump($rs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">
</head>
<body class="main-bg">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <header>
            <figure>
            <h1>Fantasia a tu alcance</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Ruby-Diamond-88757.gif" alt="Rubi imagen" style="max-width:100px">
            </figure>
        </header>

        <?php 
            $url="http://".$_SERVER['HTTP_HOST']."/paginaweb" ///rederireccionar a http , la variable me va a dar informacion del host donde estoy
        ?>

        <nav>   
            <b>
                <a href="index.html">Inicio</a>
                <a href="insertar.php">Administrar productos</a> 
                <a href="usuario_logeado.php">Usuarios Registrados</a>
                <a href="cerrar.php">Cerrar Sesion</a>
</b>
        </nav>


     
        <h1><br><br>Comencemos a administrar <br>nuestros acceserios<br> <?php echo $rs['name']?> </h1>
            <p><br><br><br>Administra tus accesorios </p>
            <hr class="my-1">
            <p>Comencemos </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="insertar.php" role="button">Administra tus accesorios</a>
            </p>
        </div>
</body>
</html>