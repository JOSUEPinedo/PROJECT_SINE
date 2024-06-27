<?php
include '../../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM prestamo  WHERE Identrada = $id");
header("Location: entradas.php");
?>
