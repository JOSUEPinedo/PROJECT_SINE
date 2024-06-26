<?php
include '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM Secciones WHERE Idseccion = $id");
header("Location: secciones.php");
?>
