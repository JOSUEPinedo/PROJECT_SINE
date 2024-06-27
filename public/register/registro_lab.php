<?php
include '../../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Laboratorio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
   
<div class="container mt-5">
    <h2>Registro de Laboratorio</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        
    <?php endif; ?>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sección</th>7
                <th>Usuario</th>
                <th>Fecha de Contrato</th>
                <th>Fecha fin Contrato</th>
                <th>Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT r.Idregistro, s.NombreSeccion, u.Nombre, r.fechainicio, r.fechafin, r.Hora 
                                    FROM registro_lab r
                                    JOIN Secciones s ON r.Idseccion = s.Idseccion
                                    JOIN Usuario u ON r.Idusuario = u.Idusuario");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Idregistro']}</td>
                        <td>{$row['NombreSeccion']}</td>
                        <td>{$row['Nombre']}</td>
                        <td>{$row['fechainicio']}</td>
                        <td>{$row['fechafin']}</td>
                        <td>{$row['Hora']}</td>
                        <td>
                            <a href='edit_registro.php?id={$row['Idregistro']}' class='btn btn-warning'>Editar</a>
                            <a href='delete_registro.php?id={$row['Idregistro']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
