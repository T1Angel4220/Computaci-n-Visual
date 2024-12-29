<?php

class Conexion{

    public function conectar(){

        $serverName = "localhost:3307";
        $userName = "root";
        $password = "";
        $db = "cuarto1";
        $conn = mysqli_connect($serverName, $userName, $password, $db);

        if (!$conn){
            echo("Error de Conexión." . mysqli_connect_error());
        }else{
            return $conn;
}
}
}



?>