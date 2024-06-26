<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePermiso = $_POST['nombrePermiso'];

    $query = "INSERT INTO Permiso (NombrePermiso) VALUES ('$nombrePermiso')";
    if ($conn->query($query) === TRUE) {
        header("Location: permisos.php");
    } else {
        echo "Error al agregar permiso: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2>Agregar Permiso</h2>
    <form action="add_permission.php" method="post">
        <div class="form-group">
            <label for="nombrePermiso">Nombre del Permiso</label>
            <input type="text" class="form-control" name="nombrePermiso" id="nombrePermiso" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='permisos.php'">Cancelar</button>
    </form>
</div>

<?php
include '../includes/footer.php';
?>
