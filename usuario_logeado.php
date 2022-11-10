<?php
    require_once('coneccion.php');
    $sql = 'SELECT * FROM status, users WHERE users.status_id=status.id';
    $statement = $pdo->prepare($sql);
    $statement -> execute(array());
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
    <title>Usuarios </title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">
</head>
<body class="main-bg">
        <figure>
            <h1>Fantasia a tu alcance</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Ruby-Diamond-88757.gif" alt="Rubi imagen" style="max-width:100px">
        </figure>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        </head>
        <?php 
            $url="http://".$_SERVER['HTTP_HOST']."/paginaweb" ///rederireccionar a http , la variable me va a dar informacion del host donde estoy
        ?>
<nav>   
            <b>
                <a href="javascript:history.go(-1)">Inicio</a>
                <a href="insertar.php">Administrar productos</a> 
                <a href="usuario_logeado.php">Usuarios Registrados</a>
                <a href="cerrar.php">Cerrar Sesion</a>
</b>
        </nav>

    <br>
    <div class="col-md-10">
        <table class="table table-bordered" style="text-align:center;" >
            <thead>
                <tr>
       
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Contraseña encriptada</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($result as $rs)
                { ?>
                <tr>
                    
                    <td><?php echo $rs['name'] ?></td>
                    <td><?php echo $rs['pass'] ?></td>
                    <td><?php echo $rs['pass_md5'] ?></td>
                    <td><?php echo $rs['estado']?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>