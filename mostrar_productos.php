<?php 
    require_once('coneccion.php');
    $statement=$pdo->prepare("SELECT * FROM productos");
    $statement->execute();
    $listaJoyas=$statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joyeria a tu alcance</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">
</head>
<body class="main-bg">

    <header>
        <figure>
            <h1>Fantasia a tu alcance</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Ruby-Diamond-88757.gif" alt="Rubi imagen" style="max-width:100px">
        </figure>
    </header>
    <nav>
        <b>
            <a href="index.html">Inicio</a>
            <a href="mostrar_productos.php" style="color:#FF0000" >Productos</a>
            <a href="login_md5.php">Ingresar</a>
            <a href="sing_up_md5.php">Registrarse</a>
        </b> 
    </nav>

    <div class="container"> 
        <br>
            <div class="row">
            <?php foreach($listaJoyas as $joya) { ?>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="./img/<?php echo $joya['imagen'] ?>" alt="" >
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $joya['nombre'] ?></h4>
                        <a name="" id="" class="btn btn-primary" href="sing_up_md5.php" role="button">ver mas</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>