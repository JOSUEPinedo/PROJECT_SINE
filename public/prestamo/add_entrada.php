<?php
include '../../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idproducto = $_POST["idproducto"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $fechaIngreso = $_POST["fechaIngreso"];
    $cantidad = $_POST["cantidad"];
    $fechaSalida = $_POST["fechaSalida"];
    $conn->query("INSERT INTO prestamo (Idproducto, nombre, telefono, email, FechaIngreso, Cantidad, FechaSalida) VALUES ($idproducto, '$nombre', $telefono, '$email', '$fechaIngreso', $cantidad, '$fechaSalida')");
    header("Location: add_entrada.php");
}

$productos = $conn->query("SELECT * FROM Productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Prestamo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Agregar Prestamo</h2>
    <form method="post">
        <div class="form-group">
            <label for="producto">Producto</label>
            <select class="form-control" id="producto" name="idproducto" required>
                <?php while ($row = $productos->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idproducto']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="fechaIngreso">Fecha de Salida</label>
            <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="fechaSalida">Fecha de Ingreso </label>
            <input type="date" class="form-control" id="fechaSalida" name="fechaSalida">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
