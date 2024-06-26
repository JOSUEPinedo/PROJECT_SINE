<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Proveedores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Administrar Proveedores</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Agregar Proveedor</button>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="proveedoresTable">
            <?php
            $result = $conn->query("SELECT * FROM Proveedores");
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-id='{$row['Idproveedor']}'>
                        <td>{$row['Idproveedor']}</td>
                        <td>{$row['NombreProveedor']}</td>
                        <td>{$row['Telefono']}</td>
                        <td>{$row['Email']}</td>
                        <td>
                            <button class='btn btn-warning btn-edit' data-id='{$row['Idproveedor']}'>Editar</button>
                            <button class='btn btn-danger btn-delete' data-id='{$row['Idproveedor']}'>Eliminar</button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar/editar -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="proveedorForm">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Eliminar proveedor
    $('#proveedoresTable').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
            $.ajax({
                url: 'delete_proveedor.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    $('tr[data-id="' + id + '"]').remove();
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error al eliminar el proveedor.');
                }
            });
        }
    });

    // Editar proveedor
    $('#proveedoresTable').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'get_proveedor.php',
            type: 'GET',
            data: { id: id },
            success: function(data) {
                var proveedor = JSON.parse(data);
                $('#id').val(proveedor.Idproveedor);
                $('#nombre').val(proveedor.NombreProveedor);
                $('#telefono').val(proveedor.Telefono);
                $('#email').val(proveedor.Email);
                $('#addModalLabel').text('Editar Proveedor');
                $('#addModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert('Ocurrió un error al obtener los detalles del proveedor.');
            }
        });
    });

    // Manejar el formulario de agregar/editar
    $('#proveedorForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'save_proveedor.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Ocurrió un error al guardar el proveedor.');
            }
        });
    });
});
</script>

</body>
</html>
