<?php
include '../../includes/db.php';

$nombre = $_POST['nombre'];

$query = $conn->prepare("INSERT INTO Secciones (NombreSeccion) VALUES (?)");
$query->bind_param("s", $nombre);
if ($query->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
