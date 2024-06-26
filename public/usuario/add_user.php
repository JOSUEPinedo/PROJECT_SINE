<?php
include '../includes/db.php';

// Obtener los roles y permisos
$roles = $conn->query("SELECT * FROM Rol");
$permisos = $conn->query("SELECT * FROM Permiso");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $telefono = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $idrol = $_POST["idrol"];
    $permisosSeleccionados = isset($_POST["permisos"]) ? $_POST["permisos"] : [];

    // Insertar usuario
    $query = "INSERT INTO Usuario (Nombre, Email, Usuario, Contrasena, Telefono, Cargo, Idrol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $nombre, $email, $usuario, $contrasena, $telefono, $cargo, $idrol);
    if ($stmt->execute()) {
        $usuarioId = $conn->insert_id;

        // Insertar permisos
        foreach ($permisosSeleccionados as $permiso) {
            $query = "INSERT INTO UsuarioPermiso (Idusuario, Idpermiso) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $usuarioId, $permiso);
            $stmt->execute();
        }

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $mensaje = "Error al agregar usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>


<header class="bg-dark text-white text-center py-3">
    <h1>Agregar Usuario</h1>
</header>
<main class="container my-4">
    <section>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="POST" action="add_user.php">
            <div class="container mt-5">
                <h2>Agregar Usuario</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre(*)</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario(*)</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña(*)</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" name="cargo" id="cargo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control" name="idrol" id="rol">
                                <?php while($rol = $roles->fetch_assoc()): ?>
                                    <option value="<?php echo $rol['Idrol']; ?>"><?php echo $rol['NombreRol']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Permisos</label><br>
                            <?php while($permiso = $permisos->fetch_assoc()): ?>
                                <input type="checkbox" name="permisos[]" value="<?php echo $permiso['Idpermiso']; ?>"> <?php echo $permiso['NombrePermiso']; ?><br>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </section>
</main>
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 TechSINE. Todos los derechos reservados.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
