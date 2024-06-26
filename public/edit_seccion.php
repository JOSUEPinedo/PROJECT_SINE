<?php
include '../includes/db.php';

$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $conn->query("UPDATE Secciones SET NombreSeccion = '$nombre' WHERE Idseccion = $id");
    header("Location: secciones.php");
}

$result = $conn->query("SELECT * FROM Secciones WHERE Idseccion = $id");
$seccion = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Sección</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Sección</h2>
    <form method="post">
        <div class="form-group">
            <label for="nombre">Nombre de la Sección</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $seccion['NombreSeccion']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
