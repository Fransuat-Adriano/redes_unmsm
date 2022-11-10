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
<body>

    <header>
        <figure>
            <h1>Fantasia a tu alcance</h1>
            <img src="https://c.tenor.com/E63zF4sdKuMAAAAM/ruby-rubies.gif" alt="Rubi imagen" style="max-width:100px" >
        </figure>
    </header>
    <nav>
        <b>
            <a href="index.html">Inicio</a>
            <a href="accesorios_buscador.php" >Buscar</a>
            <a href="cerrar.php">Cerrar</a>
        </b> 
    </nav>

    <div class="container">  
        <br>
            <div class="row">
            <?php foreach($listaJoyas as $joya) { ?>

            <div class="col-md-2">
                <div class="card">
                    <img class="card-img-top" src="./img/<?php echo $joya['imagen'] ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $joya['nombre'] ?></h4>
                        <a name="" id="" class="btn btn-primary" href="#" role="button">ver mas</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>