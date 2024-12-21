<?php  

class enlacesPaginas{
    public static function enlacesPaginasModel($enlacesModel){
        if($enlacesModel == "nosotros" || $enlacesModel == "servicios" || $enlacesModel == "contactanos" || $enlacesModel == "inicio"||$enlacesModel == "login"){
            $module = "Views/" . $enlacesModel . ".php";
        }else{
            $module = "Views/inicio.php";
        }
        return $module;
    }
}



//include_once 'conexion.php';
//$conn = new Conexion();
//$conn->conectar()
?>