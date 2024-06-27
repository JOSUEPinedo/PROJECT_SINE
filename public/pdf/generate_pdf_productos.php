<?php
require_once('../../libs/tcpdf-main/tcpdf.php');// Ajusta el path según la ubicación de TCPDF
include '../../includes/db.php';

// Crear nuevo documento PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Productos');
$pdf->SetHeaderData('../../img/logo.png', 30, 'Listado de Productos', 'SINE Technology');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT); // Ajusta el margen superior para el logo
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 12);

// Añadir una página
$pdf->AddPage();

// Contenido del PDF
$html = '
<style>
    h1 {
        color: #333;
        font-family: helvetica;
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }
    td, th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    img {
        width: 50px;
        height: auto;
    }
</style>
<h1>Listado de Productos</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Sección</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Proveedor</th>
        </tr>
    </thead>
    <tbody>';

// Consulta a la base de datos
$result = $conn->query("SELECT p.Idproducto, p.Nombre, p.Descripcion, s.NombreSeccion, p.cantidad, p.imagen, pr.NombreProveedor 
                        FROM Productos p
                        JOIN Secciones s ON p.Idseccion = s.Idseccion
                        JOIN Proveedores pr ON p.Idproveedor = pr.Idproveedor");

// Rellenar la tabla con los datos de la consulta
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['Idproducto'] . '</td>
                <td>' . $row['Nombre'] . '</td>
                <td>' . $row['Descripcion'] . '</td>
                <td>' . $row['NombreSeccion'] . '</td>
                <td>' . $row['cantidad'] . '</td>
                <td><img src="../../uploads/' . $row['imagen'] . '" alt="Imagen del producto"></td>
                <td>' . $row['NombreProveedor'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Output PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('productos.pdf', 'I');
?>
