<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'conexion.php';

$conn = new conexion();
$con = $conn->conectar();
$con->set_charset("utf8");

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sqlVerificar = "SELECT * FROM estudiantes WHERE CED_EST = '$cedula'";
$resultado = $con->query($sqlVerificar);

if ($resultado->num_rows > 0) {
    echo json_encode(array("errorMsg" => "La cédula ya está registrada."));
} else {
$sqlGuardar = "INSERT INTO estudiantes (CED_EST, NOM_EST, APE_EST, TEL_EST, DIR_EST) 
               VALUES ('$cedula', '$nombre', '$apellido', '$telefono', '$direccion')";
    
    if ($con->query($sqlGuardar) === TRUE) {
        echo json_encode(array("message" => "Se ha agregado el estudiante con éxito"));
    } else {
        echo json_encode(array("errorMsg" => "Error al guardar el estudiante."));
    }
}
