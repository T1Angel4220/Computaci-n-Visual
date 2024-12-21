<?php
include 'conexion.php';
$conn= new conexion ();
$con = $conn -> conectar();
$cedula=$_POST['cedula'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$telefono=$_POST['telefono'];
$direccion=$_POST['direccion'];


$sqlGuardar = "insert into estudiantes values('$cedula', '$nombre', '$apellido', '$telefono', '$direccion')";

if($con -> query($sqlGuardar)==TRUE){
    echo json_encode("Se ha agregado el estudiante con exito");
} else{
    echo json_encode( "Error al agregar el estudiante");
}


?>