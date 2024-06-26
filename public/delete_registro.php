<?php
include '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM Registro_Lab WHERE Idregistro = $id");
header("Location: registro_lab.php");
?>
