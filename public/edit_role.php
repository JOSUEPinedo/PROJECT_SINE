<?php
include '../includes/db.php';
include '../includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Rol WHERE Idrol = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $role = $result->fetch_assoc();
    } else {
        echo "Rol no encontrado";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombreRol = $_POST['nombreRol'];

    $query = "UPDATE Rol SET NombreRol='$nombreRol' WHERE Idrol=$id";
    if ($conn->query($query) === TRUE) {
        header("Location: roles.php");
    } else {
        echo "Error al actualizar rol: " . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2>Editar Rol</h2>
    <form action="edit_role.php" method="post">
        <input type="hidden" name="id" value="<?php echo $role['Idrol']; ?>">
        <div class="form-group">
            <label for="nombreRol">Nombre del Rol</label>
            <input type="text" class="form-control" name="nombreRol" id="nombreRol" value="<?php echo $role['NombreRol']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='roles.php'">Cancelar</button>
    </form>
</div>

<?php
include '../includes/footer.php';
?>
