<?php
$a=38;
$b=5;
echo gettype($a);
echo("<br>");
echo gettype($b);
$colores = array("rojo", "amarillo", "azul");
echo("<br>");
echo ($colores[0]);
echo("<br>");
$frutas = (object)["fruta1"=>"sandia", "fruta2"=>"pera"];
echo ($frutas->fruta1);
echo("<br>");
$verduras = array("verdura1"=>"tomate", "verdura2"=>"pimiento");
echo ($verduras["verdura1"]);

function saludo(){
    echo("<br>");
    echo "Hola como estas?";
}

saludo();

function despedida($mensaje){
    echo("<br>");
    echo ($mensaje);
}

despedida("Hasta luego");

function mensaje($despedida){
    echo("<br>");
    return $despedida;
}

echo mensaje("Good bye");

if($a>$b){
    echo("<br>");
    echo("A es mayor");
} else {
    echo("<br>");
    echo("B es mayor");
}

for($i=1; $i<=10; $i++){
    echo("<br>");
    echo($i);
}

$dia = "Miercoles";

switch($dia){
    case "Lunes":
        echo("<br>");
        echo("Hoy estudio");
        break;

    case "Martes":
        echo("<br>");
        echo("Hoy voy al cine");
        break;
    
    case "Viernes":
        echo("<br>");
        echo("Hoy cervezas");
        break;

    default:
        echo("<br>");
        echo("Se duerme");
}

?>