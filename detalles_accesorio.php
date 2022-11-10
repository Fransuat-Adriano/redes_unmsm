<?php
    require_once('coneccion.php');
    $sql = 'SELECT * FROM productos WHERE productos.id = ?'; 
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
    <title>PHP & SQL</title>
    
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
            <a href="accesorios_buscador.php">Buscador</a>
            <a href="cerrar.php">Cerrar</a>
        </b> 
    </nav>

    <div class="card-body">
        <table class="table table-bordered" style="text-align:center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Agregar carrito</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $rs['nombre']?></td>
                    <td><?php echo $rs['descripcion']?></td>
                    <td><?php echo $rs['precio']?></td>
                    <td><img src="img/<?php echo $rs['imagen'] ?>" alt="Foto del usuario" width="100px" height="100px"></td>
                    <td><button type="submit" name="<?php echo $rs['id'] ?>" value="Agregar" class="btn btn-success">Agregar</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <tfoot>
        <tr>
            <td colspan="1">
                <a class ="boton" href="#">Atrás</a>
            </td>
        </tr>
    </tfoot>
</body>
</html>