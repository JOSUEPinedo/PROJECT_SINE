<?php
include '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM Categorias WHERE Idcategoria = $id");
header("Location: categorias.php");
?>
