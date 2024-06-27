<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreRol = $_POST['nombreRol'];

    $query = "INSERT INTO Rol (NombreRol) VALUES ('$nombreRol')";
    if ($conn->query($query) === TRUE) {
        header("Location: roles.php");
    } else {
        echo "Error al agregar rol: " . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2>Agregar Rol</h2>
    <form action="add_role.php" method="post">
        <div class="form-group">
            <label for="nombreRol">Nombre del Rol</label>
            <input type="text" class="form-control" name="nombreRol" id="nombreRol" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='roles.php'">Cancelar</button>
    </form>
</div>

<?php
include '../includes/footer.php';
?>
