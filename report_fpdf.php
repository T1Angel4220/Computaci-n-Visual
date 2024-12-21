<?php
require('fpdf186/fpdf.php');

// Verificar si la cédula fue pasada como parámetro
if (isset($_GET['cedula']) && !empty($_GET['cedula'])) {
    $cedula = htmlspecialchars($_GET['cedula']);

    // Configuración de la base de datos
    $servername = "localhost:3309";
    $username = "root";
    $password = "";
    $dbname = "cuarto"; // Cambia esto por el nombre de tu base de datos

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Consulta para obtener los datos del estudiante
    $sql = "SELECT * FROM estudiantes WHERE CED_EST = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Crear PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);

        // Título
        $pdf->Cell(0, 10, 'Estudiantes Cuarto', 0, 1, 'C');
        $pdf->Ln(10);

        // Encabezado de la tabla
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Cedula', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Apellido', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Telefono', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Direccion', 1, 1, 'C');

        // Datos del estudiante
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, $row['CED_EST'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['NOM_EST'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['APE_EST'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['TEL_EST'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['DIR_EST'], 1, 1, 'C');

        // Salida del PDF
        $pdf->Output('D', 'Reporte_Estudiante_' . $cedula . '.pdf');
    } else {
        echo "No se encontraron datos para la cédula: $cedula";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No se proporcionó una cédula válida.";
}
?>
