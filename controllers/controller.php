<?php
class mvcController {
    public function template(){
        include "views/template.php";
    }

    public function enlacesPaginasController(){
        if (isset($_GET["action"])){
            $enlacesController = $_GET["action"];
        }else{
            $enlacesController = "inicio.php";
        }
        //$modelo = new enlacesPaginas();
        //$respuesta = $modelo -> enlacesPaginasModel($enlacesController);
        $respuesta = enlacesPaginas::enlacesPaginasModel($enlacesController);
        include $respuesta;
    }
}
?>