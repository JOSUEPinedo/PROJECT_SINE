<?php
include '../includes/db.php';

$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $conn->query("UPDATE Categorias SET NombreCategoria = '$nombre' WHERE Idcategoria = $id");
    header("Location: categorias.php");
}

$result = $conn->query("SELECT * FROM Categorias WHERE Idcategoria = $id");
$categoria = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/admin_nav.php'; ?>
<div class="container mt-5">
    <h2>Editar Categoría</h2>
    <form method="post">
        <div class="form-group">
            <label for="nombre">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $categoria['NombreCategoria']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
