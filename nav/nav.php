<?php
require('./controlador/session_start.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Cover</title>
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<?php if ($_SESSION['role_id'] === '1') { ?>
	<nav class="navbar navbar-dark bg-dark  navbar-expand-md navbar-light bg-light fixed-top">
		<div class="text-white bg-success p-2">
			<?php
			echo "Administrador: ".$_SESSION["first_name"]." ". $_SESSION["last_name"];
			?>
		</div>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<div class="navbar-nav mr-auto">
				<div class="offset-md-1 mr-auto text-center"></div>
				<a class="nav-item nav-link text-justify active ml-3 hover-primary" href="#">Inicio</a>
				<a class="nav-item nav-link text-justify ml-3 hover-primary" href="#">Nosotros</a>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-justify ml-3" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Servicios
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="./users/form_categories.php">Agregar Categoria</a>
					</div>
				</li>
				<a class="nav-item nav-link text-justify ml-3 hover-primary" href="controlador/logout.php">Salir</a>
			</div>
		</div>
	</nav>
	<?php 
	include('users\show_categories.php');?>
    <?php }else if($_SESSION['role_id'] === '2'){ ?>
        <nav class="navbar navbar-dark bg-dark  navbar-expand-md navbar-light bg-light fixed-top">
		<div class="text-white bg-success p-2">
			<?php
			echo $_SESSION["first_name"]." ". $_SESSION["last_name"];
			?>
		</div>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<div class="navbar-nav mr-auto">
				<div class="offset-md-1 mr-auto text-center"></div>
				<a class="nav-item nav-link text-justify active ml-3 hover-primary" href="#">Inicio</a>
				<a class="nav-item nav-link text-justify ml-3 hover-primary" href="#">Nosotros</a>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-justify ml-3" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Servicios
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Preguntas Frecuentes</a>
						<a class="dropdown-item" href="#">Compras</a>
						<a class="dropdown-item" href="servicios.html">Otros</a>
					</div>
				</li>
				<a class="nav-item nav-link text-justify ml-3 hover-primary" href="controlador/logout.php">Salir</a>
			</div>
		</div>
	</nav>
    <?php } else { ?>
    <!-- cierra sesion para los inactivos -->
    <?php include('./controlador/logout.php');?>
    <?php } ?>


	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>