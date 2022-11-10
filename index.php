<?php
require_once('coneccion.php');
$id=isset($_GET['id']) ? $_GET['id']:0;

$sql = 'SELECT profesor.*
FROM profesor
WHERE profesor.id=?';
$statement=$pdo->prepare($sql);
$statement->execute(array($_GET['id']));
$result=$statement->fetchAll();
$rs=$result[0];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistema Horarios CC</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/diseños.css" type="text/css">
</head>

<body class="cuerpoadmin" style="background-image: url('Images/fondo1.'); background-repeat: no-repeat; background-size: cover;">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background:rgb(124, 87, 87)">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand" href="#">Sistema de Horario</a><span>|</span>
                <a class="navbar-brand" href="regishora.php?id=<?php echo $id?>">Registro de Horario</a><span>|</span>
                <a class="navbar-brand" href="reporte.php?id=<?php echo $id?>">Ver Horario</a><span>|</span>
            </div>
            <div>
                <h4 class="sombra">
                    <a href="#" class="text-decoration-none fw-bold link-success">Bienvenido <?php echo $rs['nombre']?></a>
                    <span>|</span>
                    <a href="login.php" class="text-decoration-none fw-bold link-danger">Cerrar sesión</a>
                </h4>
            </div>
        </div>
    </nav>
	<div class="table-responsive" id="page">
		<div id="header">
			
			
			<div id="adbox">
				<img src="images/horario.jpg" class="img-fluid" alt="Img" height="100%"" width="100%">
				<div class="details">
					<h1>Sistema de Horarios</h1>
					<p>
						Escuela Profesional de Computacion Cientifica.
					</p>
				</div>
			</div>
		</div>
		<br><br><br><br>
		<div id="contents">
			<div>
				<div id="headline">
					<div class="body">
						<h2>Descripcion</h2>
						<p>
							Este sitio web sirve para la creacion y optimizacion de horarios para la escuela profesional de Computacion Cientifica.
						</p>
					</div>
				</div>
				<div id="main">
					<h2>Pasos a seguir</h2>
					<h3>
						Por favor seguir las instrucciones indicadas en la parte inferior de la pagina, para el correcto funcionamiento de esta y asi hacer el proceso mas rapido a la hora de la seleccion.
					</h3>
					<ul>
						<li>
							<a href="Manual.php?id=<?php echo $id?>">1. Ver Manual</a>
						</li>
						<li>
							<a href="regishora.php?id=<?php echo $id?>">2. Registrar Disponibilidad</a>
						</li>
						<li>
							<a href="reporte.php?id=<?php echo $id?>">3. Ver Horario</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</body>
</html>