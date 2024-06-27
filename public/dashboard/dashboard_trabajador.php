<?php
session_start();
include '../../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_SESSION['idusuario'])) {
    die('ID de usuario no definido.');
}

// Get user permissions
$idusuario = $_SESSION['idusuario'];
$result = $conn->query("SELECT * FROM permisos WHERE Idusuario = $idusuario");

if (!$result) {
    die('Error al obtener permisos: ' . $conn->error);
}

$permisos = [];
while ($row = $result->fetch_assoc()) {
    $permisos[] = $row['Seccion'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Trabajador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styletra.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="wrapper">
        <?php include '../../includes/trabajador_nav.php'; ?>
        <div class="main-content">
            <div id="content-container">
                <?php if (in_array('secciones', $permisos)): ?>
                    <!-- Add content related to sections if the user has permissions -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
