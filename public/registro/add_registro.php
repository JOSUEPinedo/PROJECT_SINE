<?php
include '../includes/db.php';

$secciones = $conn->query("SELECT * FROM Secciones");
$usuarios = $conn->query("SELECT * FROM Usuario");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Agregar Registro</h2>
    <form id="addRegistroForm" action="save_registro.php" method="post">
        <div class="form-group">
            <label for="seccion">Sección</label>
            <select class="form-control" id="seccion" name="seccion" required>
                <?php while ($row = $secciones->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idseccion']; ?>"><?php echo $row['NombreSeccion']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="usuario">Usuario</label>
            <select class="form-control" id="usuario" name="usuario" required>
                <?php while ($row = $usuarios->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idusuario']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fechainicio">Fecha de Contrato</label>
            <input type="date" class="form-control" id="fechainicio" name="fechainicio" required>
        </div>
        <div class="form-group">
            <label for="fechafin">Fecha fin de Contrato</label>
            <input type="date" class="form-control" id="fechafin" name="fechafin">
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
