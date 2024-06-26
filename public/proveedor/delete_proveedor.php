<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM Proveedores WHERE Idproveedor = $id");
    echo "Proveedor eliminado";
}
?>
