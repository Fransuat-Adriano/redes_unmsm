<?php 
    require_once('coneccion.php');

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
    $txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";


    switch($accion){
        case "Agregar":

            //INSERT INTO `joyas` (`id`, `nombre`, `descripcion`, `imagen`) VALUES (NULL, 'collar 1', 'un hermoso collar para lucirlo en tu cuello', 'imagen.jpg'); 
            $statement=$pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen);");
            $statement->bindParam(':nombre',$txtNombre);
            $statement->bindParam(':descripcion',$txtDescripcion);
            $statement->bindParam(':precio',$txtPrecio);
           

            $fecha=new DateTime();
            $nombreArchivo=($txtImagen !=" ")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if($tmpImagen !=" "){
                move_uploaded_file($tmpImagen,"img/".$nombreArchivo);
            }

            $statement->bindParam(':imagen',$nombreArchivo);
            $statement->execute();

            header("Location:insertar.php");
            break;

        case "Modificar":
            $statement=$pdo->prepare("UPDATE productos SET nombre=:nombre, descripcion=:descripcion, precio=:precio WHERE id=:id");
            $statement->bindParam(':nombre',$txtNombre);
            $statement->bindParam(':descripcion',$txtDescripcion);
            $statement->bindParam(':precio',$txtPrecio);
        
            $statement->bindParam(':id',$txtID);
            $statement->execute();

            if($txtImagen !=" "){

                $fecha=new DateTime();
                $nombreArchivo=($txtImagen !=" ") ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

                move_uploaded_file($tmpImagen,"img/".$nombreArchivo);

                $statement=$pdo->prepare("SELECT imagen FROM productos WHERE id=:id");
                $statement->bindParam(':id',$txtID);
                $statement->execute();
                $joya=$statement->fetch();

                if(isset($joya["imagen"]) && ($joya["imagen"] !="imagen.jpg")){

                    if(file_exists("img/".$joya["imagen"])){

                        unlink("img/".$joya["imagen"]);
                    
                    }

                }

                $statement=$pdo->prepare("UPDATE productos SET imagen=:imagen WHERE id=:id");
                $statement->bindParam(':imagen',$nombreArchivo);
                $statement->bindParam(':id',$txtID);
                $statement->execute();
            }

            header("Location:insertar.php");
            break;

        case "Cancelar":
                header("Location:insertar.php");
                break;

        case "Seleccionar":
            $statement=$pdo->prepare("SELECT * FROM productos WHERE id=:id");
            $statement->bindParam(':id',$txtID);
            $statement->execute();
            $joya=$statement->fetch();

            $txtNombre=$joya['nombre'];
            $txtImagen=$joya['imagen'];
            $txtDescripcion=$joya['descripcion'];
            $txtPrecio=$joya['precio'];

            break;

        case "Borrar":

            $statement=$pdo->prepare("SELECT imagen FROM productos WHERE id=:id");
            $statement->bindParam(':id',$txtID);
            $statement->execute();
            $joya=$statement->fetch();

            if(isset($joya["imagen"]) &&($joya["imagen"] !="imagen.jpg")){

                if(file_exists("img/".$joya["imagen"])){

                    unlink("img/".$joya["imagen"]);
                }

            }

            $statement=$pdo->prepare("DELETE FROM  productos WHERE id=:id");
            $statement->bindParam(':id',$txtID);
            $statement->execute();

            header("Location:insertar.php");

            break;
    }

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
    <title>PHP & SQL</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">

</head>
<body class=".main-bg">

    <nav>   
        <div>
            <a href="javascript:history.go(-1)"> Administrador</a>
            <a href="insertar.php" style="color:#FF0000" >Administrar productos</a>
            <a href="mostrar_productos.php">Ver sitio web</a> 
            <a href="cerrar.php">Cerrar</a>
            
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

            <div class = "form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre de la joya">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Descripcion:</label>
            <input type="text" required class="form-control"  value="<?php  echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion de la joya">
            </div>

            

            <div class = "form-group">
            <label for="txtNombre">Imagen:</label>

            <br>

            <?php  if($txtImagen !=" "){  ?>

                <img class="img-thumbnail rounded" src="img/<?php  echo $txtImagen;?>" width="200" alt="">
            
            <?php } ?>

            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre">
            </div>

            <div>
            <label for="txtPrecio">Precio:</label>
            <input type="text" required class="form-control" value="<?php  echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Indicar el precio del producto">
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
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Imagenes</th>
                <th>Acciones</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($listaJoyas as $joyas) { ?>
            <tr>
               
                <td><?php  echo $joyas['nombre'] ?></td>
                <td><?php  echo $joyas['descripcion'] ?></td>
                <td>
                    
                    <img class="img-thumbnail rounded" src="img/<?php  echo $joyas['imagen'] ?>" width="150" alt="">
                    
                </td>
                <td>
                    <form  method="post">
                        
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $joyas['id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    
                    </form>
                </td>
                <td>S./<?php  echo $joyas['precio'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

</body>
</html>