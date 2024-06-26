<?php
include '../includes/db.php';

$query = "SELECT Usuario.*, Rol.NombreRol FROM Usuario LEFT JOIN Rol ON Usuario.Idrol = Rol.Idrol";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Usuarios Registrados</h2>
        <a href="add_user.php" class="btn btn-primary">Agregar Usuario</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): 
                    $userId = $row['Idusuario'];
                    $permisosQuery = "SELECT Seccion FROM Permisos WHERE Idusuario = $userId";
                    $permisosResult = $conn->query($permisosQuery);
                    $permisos = [];
                    while ($permisoRow = $permisosResult->fetch_assoc()) {
                        $permisos[] = $permisoRow['Seccion'];
                    }
                    $permisosStr = implode(", ", $permisos);
                ?>
                    <tr>
                        <td><?php echo $row['Idusuario']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Usuario']; ?></td>
                        <td><?php echo $row['NombreRol']; ?></td>
                        <td><?php echo htmlspecialchars($permisosStr); ?></td>
                        <td>
                            <a href='edit_user.php?id=<?php echo $row['Idusuario']; ?>' class='btn btn-warning'>Editar</a>
                            <button class="btn btn-danger" onclick="confirmDelete(<?php echo $row['Idusuario']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmación de Eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este usuario?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="deleteButton">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        function confirmDelete(userId) {
            $('#deleteButton').attr('onclick', 'deleteUser(' + userId + ');');
            $('#deleteModal').modal('show');
        }
        
        function deleteUser(userId) {
            window.location.href = 'delete_user.php?id=' + userId;
        }
        </script>
    </div>
</body>
</html>
