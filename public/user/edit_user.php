<?php
include '../../includes/db.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id'])) {
    $idusuario = $_GET['id'];

    // Obtener la información actual del usuario
    $query = "SELECT * FROM Usuario WHERE Idusuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    // Obtener los permisos actuales del usuario
    $query_permisos = "SELECT Seccion FROM Permisos WHERE Idusuario = ?";
    $stmt_permisos = $conn->prepare($query_permisos);
    $stmt_permisos->bind_param("i", $idusuario);
    $stmt_permisos->execute();
    $result_permisos = $stmt_permisos->get_result();
    $permisos_actuales = [];
    while ($row = $result_permisos->fetch_assoc()) {
        $permisos_actuales[] = $row['Seccion'];
    }
} else {
    echo "ID de usuario no proporcionado";
    exit;
}

// Manejar la actualización del usuario y sus permisos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $telefono = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $idrol = $_POST["idrol"];
    $permisos = isset($_POST["permisos"]) ? $_POST["permisos"] : [];

    // Actualizar la información del usuario
    $query_update = "UPDATE Usuario SET Nombre = ?, Email = ?, Usuario = ?, Contrasena = ?, Telefono = ?, Cargo = ?, Idrol = ? WHERE Idusuario = ?";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("ssssssii", $nombre, $email, $usuario, $contrasena, $telefono, $cargo, $idrol, $idusuario);
    $stmt_update->execute();

    // Eliminar los permisos actuales del usuario
    $query_delete_permisos = "DELETE FROM Permisos WHERE Idusuario = ?";
    $stmt_delete_permisos = $conn->prepare($query_delete_permisos);
    $stmt_delete_permisos->bind_param("i", $idusuario);
    $stmt_delete_permisos->execute();

    // Insertar los nuevos permisos
    $query_insert_permiso = "INSERT INTO Permisos (Idusuario, Seccion) VALUES (?, ?)";
    $stmt_insert_permiso = $conn->prepare($query_insert_permiso);
    foreach ($permisos as $permiso) {
        $stmt_insert_permiso->bind_param("is", $idusuario, $permiso);
        $stmt_insert_permiso->execute();
    }

    // Redirigir a la página de usuarios después de actualizar
    header("Location: usuarios.php");
    exit;
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<header class="bg-dark text-white text-center py-3">
    <h1>Editar Usuario</h1>
</header>
<main class="container my-4">
    <form method="POST" action="edit_user.php?id=<?php echo $idusuario; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($usuario['Email']); ?>">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo htmlspecialchars($usuario['Usuario']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($usuario['Telefono']); ?>">
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control" name="cargo" id="cargo" value="<?php echo htmlspecialchars($usuario['Cargo']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" name="idrol" id="rol">
                        <option value="1" <?php if ($usuario['Idrol'] == 1) echo 'selected'; ?>>Administrador</option>
                        <option value="2" <?php if ($usuario['Idrol'] == 2) echo 'selected'; ?>>Jefe de laboratorio</option>
                        <option value="3" <?php if ($usuario['Idrol'] == 3) echo 'selected'; ?>>Trabajador</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Permisos</label><br>
                    <input type="checkbox" name="permisos[]" value="secciones" <?php if (in_array('secciones', $permisos_actuales)) echo 'checked'; ?>> Secciones<br>
                    <input type="checkbox" name="permisos[]" value="categorias" <?php if (in_array('categorias', $permisos_actuales)) echo 'checked'; ?>> Categorías<br>
                    <input type="checkbox" name="permisos[]" value="proveedores" <?php if (in_array('proveedores', $permisos_actuales)) echo 'checked'; ?>> Proveedores<br>
                    <input type="checkbox" name="permisos[]" value="productos" <?php if (in_array('productos', $permisos_actuales)) echo 'checked'; ?>> Productos<br>
                    <input type="checkbox" name="permisos[]" value="entradas" <?php if (in_array('entradas', $permisos_actuales)) echo 'checked'; ?>> Entradas<br>
                    <input type="checkbox" name="permisos[]" value="registro_lab" <?php if (in_array('registro_lab', $permisos_actuales)) echo 'checked'; ?>> Registro Lab<br>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</main>
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 TechSINE. Todos los derechos reservados.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../js/script.js"></script>
</body>
</html>
