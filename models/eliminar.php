<?php
include 'conexion.php';
$conn= new conexion ();
$con = $conn -> conectar();
$cedula=$_GET['cedula'];


$sqlEliminar = "delete from estudiantes where CED_EST ='$cedula'";

if($con -> query($sqlEliminar)==TRUE){
    echo json_encode("Se elimino con exito");
} else{
    echo json_encode( "Error al eliminar el estudiante");
}





?>