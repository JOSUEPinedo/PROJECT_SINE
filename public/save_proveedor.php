<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    if ($id) {
        $conn->query("UPDATE Proveedores SET NombreProveedor = '$nombre', Telefono = '$telefono', Email = '$email' WHERE Idproveedor = $id");
    } else {
        $conn->query("INSERT INTO Proveedores (NombreProveedor, Telefono, Email) VALUES ('$nombre', '$telefono', '$email')");
    }

    echo "Proveedor guardado";
}
?>
