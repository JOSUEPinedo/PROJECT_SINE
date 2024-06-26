<?php
session_start();
include '../includes/db.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$result = $conn->query("SELECT * FROM Usuario WHERE Usuario = '$usuario'");
$user = $result->fetch_assoc();

if ($user && password_verify($contrasena, $user['Contrasena'])) {
    $_SESSION['usuario'] = $user['Usuario'];
    $_SESSION['idusuario'] = $user['Idusuario'];
    $_SESSION['rol'] = $user['Idrol'];

    if ($user['Idrol'] == 1) {
        header("Location: admin_dashboard.php");
    } elseif ($user['Idrol'] == 2) {
        header("Location: dashboard_jefe_lab.php");
    } elseif ($user['Idrol'] == 3) {
        header("Location: dashboard_trabajador.php");
    }
} else {
    echo "Usuario o contraseña incorrectos.";
}
?>
