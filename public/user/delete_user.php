<?php
include '../../includes/db.php';

if (isset($_GET['id'])) {
    $idusuario = $_GET['id'];

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Eliminar registros relacionados en la tabla permisos
        $stmt = $conn->prepare("DELETE FROM Permisos WHERE Idusuario = ?");
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();

        // Luego elimina el usuario de la tabla Usuario
        $stmt = $conn->prepare("DELETE FROM Usuario WHERE Idusuario = ?");
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();

        // Si todo va bien, confirmar la transacción
        $conn->commit();
        // Redirigir a la página de lista de usuarios
        header("Location: usuarios.php");
        exit();
    } catch (mysqli_sql_exception $exception) {
        // Si hay un error, revertir todos los cambios
        $conn->rollback();
        echo "Error al eliminar el usuario: " . $exception->getMessage();
        // Opcional: redirigir a una página de error o manejarlo de alguna otra forma
    }
} else {
    // Redirigir si no se proporciona un ID de usuario
    header("Location: usuarios.php");
    exit();
}
?>
