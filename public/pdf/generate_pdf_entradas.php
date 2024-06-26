<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaSalida = $_POST["fecha_salida"];
    $fechaIngreso = $_POST["fecha_ingreso"];

    // Query para obtener los datos filtrados por las fechas seleccionadas
    $query = "SELECT e.Identrada, p.Nombre as Producto, e.nombre as Usuario, e.telefono, e.email, e.FechaSalida, e.Cantidad, e.FechaIngreso
              FROM prestamo e
              JOIN productos p ON e.Idproducto = p.Idproducto
              WHERE e.FechaSalida BETWEEN '$fechaIngreso' AND '$fechaSalida'";

    $result = $conn->query($query);

    if (!$result) {
        die('Query Error: ' . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar PDF Entradas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Reporte de Entradas</h2>
    <form method="post" action="generate_pdf_entradas.php">
        <div class="form-group">
            <label for="fecha_ingreso">Fecha de Salida:</label>
            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>
        <div class="form-group">
            <label for="fecha_salida">Fecha de Ingreso:</label>
            <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>


    <?php if (isset($result)): ?>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha de Salida</th>
                    <th>Cantidad</th>
                    <th>Fecha de Ingreso</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Identrada']; ?></td>
                        <td><?php echo $row['Producto']; ?></td>
                        <td><?php echo $row['Usuario']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['FechaIngreso']; ?></td>
                        <td><?php echo $row['Cantidad']; ?></td>
                        <td><?php echo $row['FechaSalida']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form method="post" action="export_pdf_entradas.php">
            <input type="hidden" name="fecha_salida" value="<?php echo $fechaSalida; ?>">
            <input type="hidden" name="fecha_ingreso" value="<?php echo $fechaIngreso; ?>">
            <button type="submit" class="btn btn-danger">Exportar a PDF</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
