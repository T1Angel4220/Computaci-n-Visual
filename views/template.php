<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<meta charset="UTF-8">
    	<link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
    	<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
    	<link rel="stylesheet" type="text/css" href="jquery/themes/color.css">
    	<script type="text/javascript" src="jquery/jquery.min.js"></script>
    	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
	
	</head>

	<body>


	<br>
	<header>
		<img src="images/logo.jpg" width="100%" ></img>
	</header>
	<nav>
		<ul>
		<li><a href="index.php?action=inicio">Inicio</a></li>
		<li><a href="index.php?action=nosotros">Nosotros</a></li>
		<li><a href="index.php?action=servicios">Servicios</a></li>
		<li><a href="index.php?action=contactanos">Contactanos</a></li>
		</ul>
	</nav>
	<section>
		<?php
		require_once "controllers/controller.php";
		require_once "models/model.php";
		
		$mvc = new mvcController();
		$mvc->enlacesPaginasController();
		?>
	</section>
	
	<footer>
		Derechos Reservados @cuartoSoftware
	</footer>
	</body>
</html>