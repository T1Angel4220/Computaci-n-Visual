# JasperPHP
iReport para PHP : Reportes faciles para PHP

Este proyecto es un fork de JasperPHP debido a unos detalles de carateres de mas que no permitian generar los reportes correctamente. 

La idea radica en apoyarse en la utileria JasperStarter para ejecutar los reportes por linea de comandos, llamando este comando en php.

#Requisitos en el servidor

 - Java 7
 - Php 5
 - Funcion EXEC en php

#Modo de uso

Primero se debe crear el reporte compilado .jasper con ireport una vez que nuestro reporte funciona usamos la libreria.

	require_once "/JasperPHP/JasperPHP.php";

	$pdf=new JasperPHP();

	$pdf->process(
    	"reporte.jasper", 
    	$ruta_nombre, 
    	array("pdf"), 
		)->execute();
		
		
Esto generará un archivo pdf en la ubicacion $ruta_nombre; se pueden generar los reportes en todos los formatos soportados por ireport.


