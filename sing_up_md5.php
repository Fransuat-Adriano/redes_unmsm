<?php
    require_once('coneccion.php');
    $sql = 'SELECT * FROM status';
    $statement = $pdo->prepare($sql);
    $statement -> execute(array());
    $result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasia a tu alcance</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Tangerine&display=swap" rel="stylesheet">

</head>
<body class="main-bg">
<nav>
        <b>
           
            <a href="index.html">Inicio</a>
            <a href="mostrar_productos.php">Productos</a>
            <a href="login_md5.php" >Ingresar</a>
            <a href="sing_up_md5.php"  style="color:#FF0000" >Registrarse</a>
        </b> 
    </nav>
    <main>
        <form action="proceso_md5.php" class="formulario" method ="POST" enctype="multipart/form-data">
            <div class="login-container text-c animated flipInX">
                    <div>
                        <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                    </div>
                    <h1>Fantasia a tu alcance</h1>
                    <img src="https://img1.picmix.com/output/stamp/normal/1/6/9/9/1839961_6d3cb.gif" alt="Rubi imagen" style="max-width:150px">
                        <h2><br><br>Ahora si nos entenderemos :3</h2>
                    <div class="container-content">
                        <form class="margin-t">
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Escriba su usuario " required="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input name="pass" type="password" class="form-control" placeholder="Escriba su contraseña" required=""autocomplete="off">
                            </div>

                            <div class="form-control">
                                <select name="status_id" required>
                                    <option value=""selected>Elige un tipo</option>
                                    <?php
                                        foreach($result as $rs){ 
                                    ?>
                                    <option value="<?php echo $rs['id']?>"><?php echo $rs['estado']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br>

                            <input name="login" type="submit"value="Confirmar registro" class="figureindex">
                            

                            <p class="text-whitesmoke text-center"><small>¿YA TIENES CUENTA?</small></p>
                            <a class="text-darkyellow" href="login_md5.php"><small>Inicie sesión aqui</small></a>
                            
                        </form>
                        <p class="margin-t text-whitesmoke"><small> Fantasia a tu alcance &copy; 2021</small> </p>
                    </div>
                </div>
        </form>
    </main>
</body>
</html>

