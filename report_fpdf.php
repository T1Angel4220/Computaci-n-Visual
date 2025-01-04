<?php
require('fpdf186/fpdf.php');

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->Image('Img/logo.png', 10, 10, 30);
        $this->Image('Img/logfisei.png', 160, 10, 40);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('REPORTE DE ESTUDIANTE 2025'), 0, 1, 'C');
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_GET['cedula']) && !empty($_GET['cedula'])) {
    $cedula = htmlspecialchars($_GET['cedula']);
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $servername = "localhost:3309";
    $username = "root";
    $password = "";
    $dbname = "cuarto";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM estudiantes WHERE CED_EST = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Configurar idioma para la fecha
        setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish'); // Agregar más variantes si es necesario
        date_default_timezone_set('America/Guayaquil');

        // Obtener fecha traducida manualmente si falla setlocale()
        $dias = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado'];
        $meses = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

        $fechaActual = strftime('%A %d de %B del %Y');
        // Traducción manual
        $fechaActual = str_replace(array_keys($dias), $dias, $fechaActual);
        $fechaActual = str_replace(array_keys($meses), $meses, $fechaActual);

        $hora = date('h:i A');

        $pdf->Cell(0, 10, utf8_decode("Fecha: $fechaActual   Hora: $hora"), 0, 1, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Cell(40, 10, 'CEDULA', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'NOMBRE', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'APELLIDO', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'TELEFONO', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'DIRECCION', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, $row['CED_EST'], 1, 0, 'C');
        $pdf->Cell(40, 10, utf8_decode($row['NOM_EST']), 1, 0, 'C');
        $pdf->Cell(40, 10, utf8_decode($row['APE_EST']), 1, 0, 'C');
        $pdf->Cell(30, 10, $row['TEL_EST'], 1, 0, 'C');
        $pdf->Cell(40, 10, utf8_decode($row['DIR_EST']), 1, 1, 'C');
    } else {
        $pdf->Cell(0, 10, 'No se encontraron datos para la cédula: ' . $cedula, 1, 1, 'C');
    }

    $stmt->close();
    $conn->close();

    $pdf->Output('D', 'Reporte_Estudiante_' . $cedula . '.pdf');
} else {
    echo "No se proporcionó una cédula válida.";
}
?>
