<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM Rol WHERE Idrol = $id";

    if ($conn->query($query) === TRUE) {
        header("Location: roles.php");
    } else {
        echo "Error al eliminar rol: " . $conn->error;
    }
} else {
    echo "ID de rol no especificado";
}
?>
