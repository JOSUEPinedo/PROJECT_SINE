<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idusuario = $_POST["idusuario"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    $telefono = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $idrol = $_POST["idrol"];
    $permisos = isset($_POST["permisos"]) ? $_POST["permisos"] : [];

    $query = "UPDATE Usuario SET Nombre='$nombre', Email='$email', Usuario='$usuario', Contrasena='$contrasena', Telefono='$telefono', Cargo='$cargo', Idrol=$idrol WHERE Idusuario=$idusuario";
    if ($conn->query($query) === TRUE) {
        // Eliminar permisos existentes
        $conn->query("DELETE FROM Permisos WHERE Idusuario=$idusuario");

        // Insertar nuevos permisos
        foreach ($permisos as $permiso) {
            $permisoQuery = "INSERT INTO Permisos (Idusuario, Seccion) VALUES ($idusuario, '$permiso')";
            $conn->query($permisoQuery);
        }

        echo "Usuario actualizado correctamente";
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
} else {
    die('Solicitud no válida');
}
?>

<a href="usuarios.php">Volver a la lista de usuarios</a>
