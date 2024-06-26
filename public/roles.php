<?php
include '../includes/db.php';
include '../includes/header.php';

// Consultar la lista de roles
$query = "SELECT * FROM Rol";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <h2>Roles Registrados</h2>
    <a href="add_role.php" class="btn btn-primary mb-3">Agregar Rol</a>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Idrol']; ?></td>
                        <td><?php echo $row['NombreRol']; ?></td>
                        <td>
                            <a href="edit_role.php?id=<?php echo $row['Idrol']; ?>" class="btn btn-warning">Editar</a>
                            <a href="delete_role.php?id=<?php echo $row['Idrol']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay roles registrados.</p>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>
