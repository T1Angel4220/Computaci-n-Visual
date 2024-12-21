<?php
include 'conexion.php';
$conn = new conexion();
$con = $conn->conectar();

$sqlSelect = "SELECT CED_EST, NOM_EST, APE_EST, TEL_EST, DIR_EST FROM estudiantes";
$respuesta = $con->query($sqlSelect);

$resultado = array();

if ($respuesta->num_rows > 0) {
    while ($fila = $respuesta->fetch_assoc()) { // fetch_assoc devuelve solo claves asociativas
        array_push($resultado, $fila);
    }
} else {
    $resultado = ['error' => 'No hay estudiantes'];
}

echo json_encode($resultado);
?>
