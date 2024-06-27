<?php
include '../../includes/db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idseccion = $_POST["idseccion"];
    $idusuario = $_POST["idusuario"];
    $fechainicio = $_POST["fechainicio"];
    $fechafin = $_POST["fechafin"];
    $hora = $_POST["hora"];
    
    $stmt = $conn->prepare("UPDATE registro_lab SET Idseccion = ?, Idusuario = ?, fechainicio = ?, fechafin = ?, Hora = ? WHERE Idregistro = ?");
    $stmt->bind_param("iisssi", $idseccion, $idusuario, $fechainicio, $fechafin, $hora, $id);
    
    if ($stmt->execute()) {
        header("Location: registro_lab.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM registro_lab WHERE Idregistro = $id");
$registro = $result->fetch_assoc();

$secciones = $conn->query("SELECT * FROM Secciones");
$usuarios = $conn->query("SELECT * FROM Usuario");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Registro</h2>
    <form method="post">
        <div class="form-group">
            <label for="seccion">Sección</label>
            <select class="form-control" id="seccion" name="idseccion" required>
                <?php while ($row = $secciones->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idseccion']; ?>" <?php if ($row['Idseccion'] == $registro['Idseccion']) echo 'selected'; ?>><?php echo $row['NombreSeccion']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="usuario">Usuario</label>
            <select class="form-control" id="usuario" name="idusuario" required>
                <?php while ($row = $usuarios->fetch_assoc()): ?>
                    <option value="<?php echo $row['Idusuario']; ?>" <?php if ($row['Idusuario'] == $registro['Idusuario']) echo 'selected'; ?>><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fechainicio">Fecha de Contrato</label>
            <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="<?php echo isset($registro['fechainicio']) ? $registro['fechainicio'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="fechafin">Fecha fin de Contrato</label>
            <input type="date" class="form-control" id="fechafin" name="fechafin" value="<?php echo isset($registro['fechafin']) ? $registro['fechafin'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $registro['Hora']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
