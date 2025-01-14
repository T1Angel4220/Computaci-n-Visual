<?php

include 'conexion.php'; 

function verificarLogin($nombre_usuario, $contrasena) {
    $conn = new conexion();
    $con = $conn->conectar();

    $contrasena_encriptada = md5($contrasena);

    // Consulta SQL para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena_encriptada'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        return true;
    } else {
        return "Nombre de usuario o contraseña incorrectos";
    }
}
?>

