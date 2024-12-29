<?php
require_once __DIR__ . '/vendor/autoload.php';

use JasperPHP\JasperPHP;

// Configuración del archivo .jasper
$jasper = __DIR__ . '/reports/reporteEstudiantes.jasper';

// Configuración de la base de datos
$db_host = "localhost";
$db_port = "3307"; // Cambia esto si usas un puerto diferente
$db_name = "cuarto1";
$db_user = "root";
$db_password = "";

// Ruta para el archivo de salida
$output = __DIR__ . '/output/Reporte_Todos_Estudiantes';

try {
    // Instancia de JasperPHP
    $jasperPHP = new JasperPHP();

    // Generar el reporte
    $jasperPHP->process(
        $jasper,
        $output,
        ['pdf'], // Generar salida en formato PDF
        [], // Sin parámetros, ya que quieres todos los datos
        [
            'driver'   => 'mysql',
            'host'     => $db_host,
            'database' => $db_name,
            'username' => $db_user,
            'password' => $db_password,
            'port'     => $db_port,
            'jdbc_url' => "jdbc:mysql://$db_host:$db_port/$db_name?useSSL=false" // Desactivar SSL si aplica
        ]
    )->execute();

    // Descargar el archivo generado
    $file = $output . '.pdf';
    if (file_exists($file)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        readfile($file);
    } else {
        echo "Error: No se generó el archivo PDF.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
