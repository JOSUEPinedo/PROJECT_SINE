<?php
include '../includes/db.php';

$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $idseccion = $_POST["idseccion"];
    $idproveedor = $_POST["idproveedor"];
    $conn->query("UPDATE Productos SET Nombre = '$nombre', Descripcion = '$descripcion', Idseccion = $idseccion, Idproveedor = $idproveedor WHERE Idproducto = $id");
    header("Location: productos.php");
}

$result = $conn->query("SELECT * FROM Productos WHERE Idproducto = $id");
$producto = $result->fetch_assoc();

$secciones = $conn->query("SELECT * FROM Secciones");
$proveedores = $conn->query("SELECT * FROM Proveedores");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Producto</h2>
    <form method="post">
        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['Nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $producto['Descripcion']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="seccion">Sección</label>
            <select class="form-control" id="seccion" name="idseccion" required>
                <?php while ($row = $secciones->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idseccion']; ?>" <?php if ($row['Idseccion'] == $producto['Idseccion']) echo 'selected'; ?>><?php echo $row['NombreSeccion']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <select class="form-control" id="proveedor" name="idproveedor" required>
                <?php while ($row = $proveedores->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idproveedor']; ?>" <?php if ($row['Idproveedor'] == $producto['Idproveedor']) echo 'selected'; ?>><?php echo $row['NombreProveedor']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
