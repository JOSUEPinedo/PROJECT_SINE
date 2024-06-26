<?php
include '../includes/db.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];

$query = $conn->prepare("UPDATE Secciones SET NombreSeccion = ? WHERE Idseccion = ?");
$query->bind_param("si", $nombre, $id);
if ($query->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
