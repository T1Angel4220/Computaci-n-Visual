<?php
// Este archivo contiene la lógica para la autenticación

include 'conexion.php';  // Incluir la clase de conexión a la base de datos

// Función para verificar las credenciales del usuario
function verificarLogin($nombre_usuario, $contrasena) {
    // Conectar a la base de datos
    $conn = new conexion();
    $con = $conn->conectar();

    // Encriptar la contraseña para comparar
    $contrasena_encriptada = md5($contrasena); // Cambiar a password_hash() en producción

    // Consulta SQL para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena_encriptada'";

    // Ejecutar la consulta
    $result = $con->query($sql);

    // Si el usuario existe, devolver true
    if ($result->num_rows > 0) {
        return true;
    } else {
        // Si las credenciales son incorrectas, devolver un mensaje de error
        return "Nombre de usuario o contraseña incorrectos";
    }
}
?>

