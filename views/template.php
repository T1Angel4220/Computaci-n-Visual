<?php
session_start(); // Inicia la sesión

// Verificar si se ha solicitado cerrar sesión
if (isset($_GET['logout'])) {
    // Eliminar todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página principal o donde desees
    header("Location: index.php"); 
    exit();
}
?>


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
    <!-- Header con información del usuario o botón de login -->
    <header>
        <div class="header-container">
            <!-- Si el usuario está logueado -->
            <?php if (isset($_SESSION['usuario'])): ?>
                <div class="user-info">
                    <span>Bienvenido, <?php echo $_SESSION['usuario']; ?> </span>
					<a href="?logout=true">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <!-- Si el usuario NO está logueado -->
                <a href="index.php?action=login" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn-login">Iniciar sesión</a>
            <?php endif; ?>
        </div>
        <img src="images/logo.jpg" width="100%" alt="Logo">
    </header>

    <!-- Navegación -->
    <nav>
        <ul>
            <li><a href="index.php?action=inicio">Inicio</a></li>
            <li><a href="index.php?action=nosotros">Nosotros</a></li>
            <li><a href="index.php?action=servicios">Servicios</a></li>
            <li><a href="index.php?action=contactanos">Contactanos</a></li>
        </ul>
    </nav>

    <!-- Sección de contenido -->
    <section>
        <?php
        require_once "controllers/controller.php";
        require_once "models/model.php";
        
        $mvc = new mvcController();
        $mvc->enlacesPaginasController();
        ?>
    </section>

    <!-- Footer -->
    <footer>
        Derechos Reservados @cuartoSoftware
    </footer>
</body>
</html>
