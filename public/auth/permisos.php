<?php
include '../../includes/db.php';
include '../../includes/header.php';

// Consultar la lista de permisos
$query = "SELECT * FROM Permiso";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <h2>Permisos Registrados</h2>
    <a href="../permission/add_permission.php" class="btn btn-primary mb-3">Agregar Permiso</a>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Permiso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Idpermiso']; ?></td>
                        <td><?php echo $row['NombrePermiso']; ?></td>
                        <td>
                            <a href="edit_permission.php?id=<?php echo $row['Idpermiso']; ?>" class="btn btn-warning">Editar</a>
                            <a href="delete_permission.php?id=<?php echo $row['Idpermiso']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay permisos registrados.</p>
    <?php endif; ?>
</div>

<?php
include '../../includes/footer.php';
?>
