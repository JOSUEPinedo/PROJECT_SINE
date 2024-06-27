<?php
include '../../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar prestamo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Administrar prestamo</h2>
    <a href="add_entrada.php" class="btn btn-primary">Agregar Prestamo</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha de Salida</th>
                <th>Cantidad</th>
                <th>Fecha de Ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT e.Identrada, p.Nombre AS ProductoNombre, e.nombre, e.telefono, e.email, e.FechaIngreso, e.Cantidad, e.FechaSalida 
                                    FROM prestamo e
                                    JOIN Productos p ON e.Idproducto = p.Idproducto");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Identrada']}</td>
                        <td>{$row['ProductoNombre']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['FechaIngreso']}</td>
                        <td>{$row['Cantidad']}</td>
                        <td>{$row['FechaSalida']}</td>
                        <td>
                            <a href='edit_entrada.php?id={$row['Identrada']}' class='btn btn-warning'>Editar</a>
                            <a href='delete_entrada.php?id={$row['Identrada']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
