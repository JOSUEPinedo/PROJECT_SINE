<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
   
<div class="container mt-5">
    <h2>Agregar Producto</h2>
    <form id="addProductForm" action="save_producto.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" required>
        </div>
        <div class="form-group">
            <label for="seccion">Sección:</label>
            <select class="form-control" id="seccion" name="seccion" required>
                <?php
                $result = $conn->query("SELECT Idseccion, NombreSeccion FROM Secciones");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['Idseccion']}'>{$row['NombreSeccion']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="proveedor">Proveedor:</label>
            <select class="form-control" id="proveedor" name="proveedor" required>
                <?php
                $result = $conn->query("SELECT Idproveedor, NombreProveedor FROM Proveedores");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['Idproveedor']}'>{$row['NombreProveedor']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
