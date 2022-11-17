<?php 
    require_once('coneccion.php');

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
    $txtAutor=(isset($_POST['txtAutor']))?$_POST['txtAutor']:"";
    $txtPaginas=(isset($_POST['txtPaginas']))?$_POST['txtPaginas']:"";
    $txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
    $txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";


    switch($accion){
        case "Agregar":

            //INSERT INTO `joyas` (`id`, `nombre`, `descripcion`, `imagen`) VALUES (NULL, 'collar 1', 'un hermoso collar para lucirlo en tu cuello', 'imagen.jpg'); 
            $statement=$pdo->prepare("INSERT INTO libros (titulo, autor, paginas, descripcion, precio) VALUES (:titulo, :autor, :paginas, :descripcion, :precio;");
            $statement->bindParam(':titulo',$txtTitulo);
            $statement->bindParam(':autor',$txtAutor);
            $statement->bindParam(':paginas',$txtPaginas);
            $statement->bindParam(':descripcion',$txtDescripcion);
            $statement->bindParam(':precio',$txtPrecio);
            
            $statement->execute();
            header("Location:insertar.php");
            break;

        case "Modificar":
            $statement=$pdo->prepare("UPDATE libros SET titulo=:titulo, autor=:autor, paginas=:paginas, descripcion=:descripcion, precio=:precio WHERE id=:id");
            $statement->bindParam(':titulo',$txtTitulo);
            $statement->bindParam(':autor',$txtAutor);
            $statement->bindParam(':paginas',$txtPaginas);
            $statement->bindParam(':descripcion',$txtDescripcion);
            $statement->bindParam(':precio',$txtPrecio);
        
            $statement->bindParam(':id',$txtID);
            $statement->execute();

            header("Location:insertar.php");
            break;

        case "Cancelar":
                header("Location:insertar.php");
                break;

        case "Seleccionar":
            $statement=$pdo->prepare("SELECT * FROM libros WHERE id=:id");
            $statement->bindParam(':id',$txtID);
            $statement->execute();
            $joya=$statement->fetch();

            $txtTitulo=$joya['titulo'];
            $txtAutor=$joya['autor'];
            $txtPaginas=$joya['paginas'];
            $txtDescripcion=$joya['descripcion'];
            $txtPrecio=$joya['precio'];

            break;

        case "Borrar":
            $statement=$pdo->prepare("DELETE FROM  libros WHERE id=:id");
            $statement->bindParam(':id',$txtID);
            $statement->execute();

            header("Location:insertar.php");

            break;
    }

    $statement=$pdo->prepare("SELECT * FROM libros");
    $statement->execute();
    $listaJoyas=$statement->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redes,Arquitectura y comunicaciones</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">

</head>
<body class=".main-bg">

    <nav>   
        <div>
            <a href="index.html">Inicio</a>
            <a href="accesorios_buscador.php">Productos</a> 
            <a href="insertar.php" style="color:#FF0000" >insertar</a>
            
        </div>
    </nav>
    
    <div class="col-md-8">

    
    <div class="contenedor2">
        <div>
            Datos de los accesorios
        </div>

        <div class="card-body" >
            
            <form method="POST" enctype="multipart/form-data" > <!-- acepta fotogracias, archivos imagenes-->

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php  echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div>
            <label for="txtTitulo">Titulo:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtTitulo; ?>" name="txtTitulo" id="txtTitulo" placeholder="Titulo del libro">
            </div>

            <div>
            <label for="txtAutor">Autor:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtAutor; ?>" name="txtAutor" id="txtAutor" placeholder="Nombre del autor">
            </div>
            <br>

            <div>
            <label for="txtPaginas">Numero de Paginas:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtPaginas; ?>" name="txtPaginas" id="txtPaginas" placeholder="Numero de paginas que tiene el libro">
            </div>
            <br>

            <div class = "form-group">
            <label for="txtDescripcion">Descripcion:</label>
            <input type="text" required class="form-control"  value="<?php  echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion del libro">
            </div>

            <div>
            <label for="txtPrecio">Precio:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Indicar el precio del libro">
            </div>
            <br>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php  echo ($accion=="Seleccionar")?"disabled":""; ?>  value="Agregar" class="btn btn-outline-success" style="margin: 10px">Agregar</button>
                <button type="submit" name="accion" <?php  echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-outline-warning" style="margin: 10px">Modificar</button>
                <button type="submit" name="accion" <?php  echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-outline-info" style="margin: 10px">Cancelar</button>
             </div>
            </form>

        </div>

    </div>


    </div>
    <br>
    <br>
    <div class='contenedor2'>

    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Paginas</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($listaJoyas as $joyas) { ?>
            <tr>
               
                <td><?php  echo $joyas['titulo'] ?></td>
                <td><?php  echo $joyas['autor'] ?></td>
                <td><?php  echo $joyas['paginas'] ?></td>
                <td><?php  echo $joyas['descripcion'] ?></td>
                <td>S./<?php  echo $joyas['precio'] ?></td>
                <td>
                    <form  method="post">
                        
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $joyas['id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

</body>
</html>