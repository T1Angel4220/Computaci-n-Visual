<?php
require_once __DIR__ . '/JasperPHP-master/JasperPHP/JasperPHP.php';
require_once __DIR__ . '/vendor/autoload.php';


use JasperPHP\JasperPHP;

// Ruta al archivo .jasper
$jasper = __DIR__ . '/reports/reporteEstudiantes.jasper'; // Cambia a tu archivo .jasper correspondiente

// Configuración de la base de datos
$db_host = "localhost:3307";
$db_name = 'cuarto'; // Cambia esto por tu base de datos
$db_user = 'root';
$db_password = '';

// Parámetros vacíos porque queremos todos los registros
$parameters = []; // No se pasa ningún filtro aquí
// Ruta para el archivo de salida
$output = __DIR__ . '/reports_output/Reporte_Todos_Estudiantes';

try {
    $jasperPHP = new JasperPHP();

    // Generar el comando para depuración
    $command = $jasperPHP->process(
        $jasper,
        $output,
        ['pdf'], // Formatos de salida
        $parameters,
        [
            'driver'   => 'mysql',
            'host'     => $db_host,
            'database' => $db_name,
            'username' => $db_user,
            'password' => $db_password,
            'jdbc_url' => 'jdbc:mysql://localhost:3309/cuarto?useSSL=false', // Desactiva SSL
        ]
    )->output(); // Captura el comando generado

    echo "<pre>$command</pre>"; // Muestra el comando en el navegador

    $jasperPHP->execute(); // Ejecuta el comando
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


?>