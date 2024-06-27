<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Productos WHERE Idproducto = $id");
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
?>
