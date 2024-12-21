<?php
$automovil1 = (object)["marca"=>"toyota", "modelo"=>"RAV", "color"=>"negro"];
$automovil2 = (object)["marca"=>"ford", "modelo"=>"F150", "color"=>"azul"];

function mostrar($automovil){
    echo "El auto: $automovil->marca, de modelo $automovil->modelo, y es de color $automovil->color";
}

mostrar($automovil1);
?>