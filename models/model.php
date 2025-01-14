<?php  

class enlacesPaginas{
    public static function enlacesPaginasModel($enlacesModel){
        if($enlacesModel == "nosotros" || $enlacesModel == "servicios" || $enlacesModel == "contactanos" || $enlacesModel == "inicio"||$enlacesModel == "login"){
            $module = "views/" . $enlacesModel . ".php";
        }else{
            $module = "views/inicio.php";
        }
        return $module;
    }
}

?>