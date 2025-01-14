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
    <link rel="stylesheet" type="text/css" href="Css/estilo.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="jquery/themes/color.css">
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
</head>

<body>

    <!-- Navegación -->
    <nav>
    <ul class="nav-items">
        <li><a href="index.php?action=inicio">Inicio</a></li>
        <li><a href="index.php?action=nosotros">Nosotros</a></li>
        <li><a href="index.php?action=servicios">Servicios</a></li>
        <li><a href="index.php?action=contactanos">Contáctanos</a></li>
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="user-welcome">
                <span>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></span>
            </div>
            <li class="nav-login"><a href="?logout=true">Cerrar sesión</a></li>
        <?php else: ?>
            <li class="nav-login"><a href="index.php?action=login">Iniciar sesión</a></li>
        <?php endif; ?>
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
        <p>Derechos Reservados @Cuarto Software</p>
    </footer>
</body>
</html>
