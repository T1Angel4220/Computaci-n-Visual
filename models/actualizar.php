<?php
include 'conexion.php';
$conn = new conexion();
$con = $conn->conectar();

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Actualización de múltiples campos
$sqlActualizar = "UPDATE estudiantes 
                  SET NOM_EST = '$nombre', 
                      APE_EST = '$apellido', 
                      TEL_EST = '$telefono', 
                      DIR_EST = '$direccion' 
                  WHERE CED_EST = '$cedula'";

if ($con->query($sqlActualizar) === TRUE) {
    echo json_encode("Se ha modificado el estudiante con éxito");
} else {
    echo json_encode("Error al actualizar el estudiante: " . $con->error);
}
?>
