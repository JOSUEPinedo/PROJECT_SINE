<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero, elimina los registros en usuariopermiso que referencian al permiso
    $deleteUserPermissionQuery = "DELETE FROM usuariopermiso WHERE Idpermiso = $id";
    if ($conn->query($deleteUserPermissionQuery) === TRUE) {
        // Luego, elimina el permiso
        $deletePermissionQuery = "DELETE FROM Permiso WHERE Idpermiso = $id";
        if ($conn->query($deletePermissionQuery) === TRUE) {
            header("Location: permisos.php");
        } else {
            echo "Error al eliminar permiso: " . $conn->error;
        }
    } else {
        echo "Error al eliminar registros de usuariopermiso: " . $conn->error;
    }
} else {
    echo "ID de permiso no especificado";
}
?>
