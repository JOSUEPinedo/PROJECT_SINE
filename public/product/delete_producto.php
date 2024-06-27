<?php
include '../../includes/db.php';

$id = $_GET['id'];

// Primero, eliminar los registros dependientes en la tabla `prestamo`
$conn->query("DELETE FROM prestamo WHERE Idproducto = $id");

// Luego, eliminar el producto
$conn->query("DELETE FROM productos WHERE Idproducto = $id");

header("Location: productos.php");
?>
