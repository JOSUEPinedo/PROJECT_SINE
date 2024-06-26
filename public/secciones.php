<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Secciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Administrar Secciones</h2>
    <a href="add_seccion.php" class="btn btn-primary">Agregar Sección</a>
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
            $result = $conn->query("SELECT * FROM Secciones");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Idseccion']}</td>
                        <td>{$row['NombreSeccion']}</td>
                        <td>
                            <button class='btn btn-info' onclick=\"openActionModal({$row['Idseccion']}, 'productos')\"><i class='fas fa-box'></i></button>
                            <button class='btn btn-info' onclick=\"openActionModal({$row['Idseccion']}, 'registro_lab')\"><i class='fas fa-flask'></i></button>
                            <a href='delete_seccion.php?id={$row['Idseccion']}' class='btn btn-danger'>
                                <i class='fas fa-trash'></i>
                            </a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Seleccionar Acción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- El contenido del formulario se cargará aquí -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function openActionModal(sectionId, actionType) {
        $('#sectionId').val(sectionId);
        $('#actionType').val(actionType);

        if (actionType === 'productos') {
            $.ajax({
                url: 'add_producto.php', // URL del archivo que quieres cargar
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data); // Cargar el contenido del archivo en el modal
                    $('#actionModal').modal('show'); // Mostrar el modal
                }
            });
        } else if (actionType === 'registro_lab') {
            $.ajax({
                url: 'add_registro.php', // URL del archivo que quieres cargar
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data); // Cargar el contenido del archivo en el modal
                    $('#actionModal').modal('show'); // Mostrar el modal
                }
            });
        } else {
            $('#modalContent').html('<div id="form-error" class="error">Por favor, seleccione una acción.</div><button type="button" class="btn btn-secondary" onclick="submitForm()">Guardar</button>');
            $('#actionModal').modal('show');
        }
    }

    function submitForm() {
        var formData = $('#actionForm').serialize();

        $.post('perform_action.php', formData, function(response) {
            // Manejar la respuesta
            alert(response.message);
            if (response.status === 'success') {
                // Realizar cualquier acción adicional en caso de éxito
                $('#actionModal').modal('hide');
                window.location.href = 'productos.php'; // Redirigir a productos.php
            }
        }, 'json');
    }
</script>
</body>
</html>
