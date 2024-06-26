<?php
include '../includes/db.php';

$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idproducto = $_POST["idproducto"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $fechaIngreso = $_POST["fechaIngreso"];
    $cantidad = $_POST["cantidad"];
    $fechaSalida = $_POST["fechaSalida"];
    $conn->query("UPDATE prestamo SET Idproducto = $idproducto, nombre = '$nombre', telefono = $telefono, email = '$email', FechaIngreso = '$fechaIngreso', Cantidad = $cantidad, FechaSalida = '$fechaSalida' WHERE Identrada = $id");
    header("Location: entradas.php");
}

$result = $conn->query("SELECT * FROM prestamo WHERE Identrada = $id");
$entrada = $result->fetch_assoc();

$productos = $conn->query("SELECT * FROM Productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Entrada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Entrada</h2>
    <form method="post">
        <div class="form-group">
            <label for="producto">Producto</label>
            <select class="form-control" id="producto" name="idproducto" required>
                <?php while ($row = $productos->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idproducto']; ?>" <?php if ($row['Idproducto'] == $entrada['Idproducto']) echo 'selected'; ?>><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $entrada['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $entrada['telefono']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $entrada['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fechaIngreso">Fecha Ingreso</label>
            <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" value="<?php echo $entrada['FechaIngreso']; ?>" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $entrada['Cantidad']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fechaSalida">Fecha Salida</label>
            <input type="date" class="form-control" id="fechaSalida" name="fechaSalida" value="<?php echo $entrada['FechaSalida']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
