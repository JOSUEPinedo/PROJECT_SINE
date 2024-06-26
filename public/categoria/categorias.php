<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Categorías</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Administrar Categorías</h2>
    <a href="add_categoria.php" class="btn btn-primary">Agregar Categoría</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM Categorias");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Idcategoria']}</td>
                        <td>{$row['NombreCategoria']}</td>
                        <td>
                            <a href='edit_categoria.php?id={$row['Idcategoria']}' class='btn btn-warning'>Editar</a>
                            <a href='delete_categoria.php?id={$row['Idcategoria']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
