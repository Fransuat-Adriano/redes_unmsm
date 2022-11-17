<?php
    require_once('coneccion.php');
    $sql='SELECT * FROM libros WHERE titulo LIKE :search';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a href="accesorios_buscador.php" style="color:#FF0000" >Productos</a>
            <a href="insertar.php">insertar</a>
        </b> 
    </nav>
    
    <div class="card-body">
        <form action="" class="formulario1" method="GET">
             
            <input class="form-outline" type="text" placeholder="Buscar.." name="caja" value="<?php echo $caja ?>">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>

            <!--<input type="text" name ="caja" placeholder="Ingrese el titulo" class="Buscador" value="<?php echo $caja ?>">
            <br>
            <input type="submit" valvue="Buscar" class="boton1">-->
        </form>
    </div>
    <div class="container"> 
        <br>
            <div class="row">
            <?php foreach($result as $rs) { ?>

            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $rs['titulo'] ?></h4>
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