<?php
include '../includes/db.php';
include '../includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Permiso WHERE Idpermiso = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $permiso = $result->fetch_assoc();
    } else {
        echo "Permiso no encontrado";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombrePermiso = $_POST['nombrePermiso'];

    $query = "UPDATE Permiso SET NombrePermiso='$nombrePermiso' WHERE Idpermiso=$id";
    if ($conn->query($query) === TRUE) {
        header("Location: permisos.php");
    } else {
        echo "Error al actualizar permiso: " . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2>Editar Permiso</h2>
    <form action="edit_permission.php" method="post">
        <input type="hidden" name="id" value="<?php echo $permiso['Idpermiso']; ?>">
        <div class="form-group">
            <label for="nombrePermiso">Nombre del Permiso</label>
            <input type="text" class="form-control" name="nombrePermiso" id="nombrePermiso" value="<?php echo $permiso['NombrePermiso']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='permisos.php'">Cancelar</button>
    </form>
</div>

<?php
include '../includes/footer.php';
?>
