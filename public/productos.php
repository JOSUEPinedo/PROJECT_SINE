<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Administrar Productos</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        
    <?php endif; ?>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Sección</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT p.Idproducto, p.Nombre, p.Descripcion, p.cantidad, p.imagen, s.NombreSeccion, pr.NombreProveedor 
                                    FROM Productos p
                                    JOIN Secciones s ON p.Idseccion = s.Idseccion
                                    JOIN Proveedores pr ON p.Idproveedor = pr.Idproveedor");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Idproducto']}</td>
                        <td>{$row['Nombre']}</td>
                        <td>{$row['Descripcion']}</td>
                        <td>{$row['NombreSeccion']}</td>
                        <td>{$row['cantidad']}</td>
                        <td><img src='../uploads/{$row['imagen']}' alt='{$row['Nombre']}' width='50'></td>
                        <td>{$row['NombreProveedor']}</td>
                        <td>
                            <a href='edit_producto.php?id={$row['Idproducto']}' class='btn btn-warning'>Editar</a>
                            <a href='delete_producto.php?id={$row['Idproducto']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
