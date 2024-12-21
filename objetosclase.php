<?php
class automovil{
    public $marca;
    public $modelo;
    public $color;

    public function mostrar(){
        echo "El auto: $this->marca, de modelo $this->modelo, y es de color $this->color <br>";
    }

}

$a1 = new automovil();
$a1->marca="Ford";
$a1->modelo="F151";
$a1->color="rojo";

$a1->mostrar();

$a2 = new automovil();
$a2->marca="Hyundai";
$a2->modelo="Creta";
$a2->color="azul";

$a2->mostrar();
?>