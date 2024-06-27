<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Proveedores WHERE Idproveedor = $id");
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
?>
