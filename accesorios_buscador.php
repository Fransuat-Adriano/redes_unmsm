<?php
    require_once('coneccion.php');
    $sql='SELECT * FROM productos WHERE nombre LIKE :search';
    $caja= isset($_GET['caja']) ? $_GET['caja'] : '';
    $array[':search']='%' . $caja . '%';
    $statement = $pdo->prepare($sql);
    $statement->execute($array);
    $result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & SQL</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">
<body class="main-bg">

    <header>
        <figure>
            <h1>Redes, Arquitectura y comunicaciones</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Ruby-Diamond-88757.gif" alt="Rubi imagen" style="max-width:100px">
        </figure>
    </header>
    <nav>
        <b>
            <a href="index.html">Inicio</a>
            <a href="#" style="color:#FF0000" >Buscador de productos</a>
            <a href="cerrar.php">Cerrar</a>
        </b> 
    </nav>
    
    <div class="card-body">
        <form action="" class="formulario1" method="GET">
            <input type="text" name ="caja" placeholder="Ingrese el titulo" class="Buscador" value="<?php echo $caja ?>">
            <br>
            <input type="submit" valvue="Buscar" class="boton1">
        </form>
    </div>
    <div class="container"> 
        <br>
            <div class="row">
            <?php foreach($result as $rs) { ?>

            <div class="col-md-2">
                <div class="card">
                    <img class="card-img-top" src="./img/<?php echo $rs['imagen'] ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $rs['nombre'] ?></h4>
                        <a name="accion" id="" class="btn btn-primary" href="detalles_accesorio.php?id=<?php echo $rs['id'] ?>" role="button">ver mas</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <tfoot>
        <tr>
            <td colspan="4">
                <a class ="boton3" href="#">Atrás</a>
            </td>
        </tr>
    </tfoot>
</body>
</html>