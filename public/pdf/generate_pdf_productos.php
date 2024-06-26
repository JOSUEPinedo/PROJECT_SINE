<?php
require_once('../libs/tcpdf-main/tcpdf.php');// Ajusta el path según la ubicación de TCPDF
include '../includes/db.php';

// Crear nuevo documento PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Productos');
$pdf->SetHeaderData('', 0, 'Listado de Productos', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 12);

// Añadir una página
$pdf->AddPage();

// Contenido del PDF
$html = '<h1>Listado de Productos</h1>';
$html .= '<table border="1" cellpadding="5">';
$html .= '<thead>
           <tr>
             <th>ID</th>
             <th>Nombre</th>
             <th>Descripción</th>
             <th>Sección</th>
             <th>Cantidad</th>
             <th>Imagen</th>
             <th>Proveedor</th>
           </tr>
         </thead>';
$html .= '<tbody>';

$result = $conn->query("SELECT p.Idproducto, p.Nombre, p.Descripcion, s.NombreSeccion, p.cantidad, p.imagen, pr.NombreProveedor 
                        FROM Productos p
                        JOIN Secciones s ON p.Idseccion = s.Idseccion
                        JOIN Proveedores pr ON p.Idproveedor = pr.Idproveedor");
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['Idproducto'] . '</td>
                <td>' . $row['Nombre'] . '</td>
                <td>' . $row['Descripcion'] . '</td>
                <td>' . $row['NombreSeccion'] . '</td>
                <td>' . $row['cantidad'] . '</td>
                <td><img src="../uploads/' . $row['imagen'] . '" width="50"></td>
                <td>' . $row['NombreProveedor'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Output PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('productos.pdf', 'I');
?>
