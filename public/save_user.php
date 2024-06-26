<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    $telefono = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $idrol = $_POST["idrol"];
    $permisos = isset($_POST["permisos"]) ? $_POST["permisos"] : [];

    $query = "INSERT INTO Usuario (Nombre, Email, Usuario, Contrasena, Telefono, Cargo, Idrol) VALUES ('$nombre', '$email', '$usuario', '$contrasena', '$telefono', '$cargo', $idrol)";
    if ($conn->query($query) === TRUE) {
        $idusuario = $conn->insert_id;

        foreach ($permisos as $permiso) {
            $permisoQuery = "INSERT INTO Permisos (Idusuario, Seccion) VALUES ($idusuario, '$permiso')";
            $conn->query($permisoQuery);
        }

        echo "Usuario agregado correctamente";
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }
} else {
    die('Solicitud no válida');
}
?>

<a href="admin_dashboard.php">Volver a la lista de usuarios</a>
