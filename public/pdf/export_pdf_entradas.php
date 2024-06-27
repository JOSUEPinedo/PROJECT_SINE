<?php
require_once('../../libs/tcpdf-main/tcpdf.php');
include '../../includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaSalida = $_POST["fecha_salida"];
    $fechaIngreso = $_POST["fecha_ingreso"];

    $query = "SELECT e.Identrada, p.Nombre as Producto, e.nombre as Usuario, e.telefono, e.email, e.FechaSalida, e.Cantidad, e.FechaIngreso
              FROM prestamo e
              JOIN productos p ON e.Idproducto = p.Idproducto
              WHERE e.FechaSalida BETWEEN '$fechaIngreso' AND '$fechaSalida'";

    $result = $conn->query($query);

    if (!$result) {
        die('Query Error: ' . $conn->error);
    }

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tu Nombre');
    $pdf->SetTitle('Entradas');
    $pdf->SetHeaderData('', 0, 'Reporte de Prestamos', '');
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage();

    $html = '<h1>Reporte de Prestamos</h1>';
    $html .= '<table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Usuario</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Fecha de Salida</th>
                        <th>Cantidad</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                </thead>
                <tbody>';

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row['Identrada'] . '</td>
                    <td>' . $row['Producto'] . '</td>
                    <td>' . $row['Usuario'] . '</td>
                    <td>' . $row['telefono'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['FechaSalida'] . '</td>
                    <td>' . $row['Cantidad'] . '</td>
                    <td>' . $row['FechaIngreso'] . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('Reporte de Prestamos.pdf', 'D');
}
?>
