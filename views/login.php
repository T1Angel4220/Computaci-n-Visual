<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'models/loginModel.php'; 

    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $resultado = verificarLogin($nombre_usuario, $contrasena);

    if ($resultado === true) {
        $_SESSION['usuario'] = $nombre_usuario; 
        header('Location: index.php');
        exit;
    } else {
        $error = $resultado;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="Css/estiloLogin.css">
    <link rel="stylesheet" type="text/css" href="Css/estilo.css">
    <link rel="icon" href="images/logo-uta-png.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Iniciar sesión</h2>

        <?php if ($error): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="input-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="submit-btn">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
