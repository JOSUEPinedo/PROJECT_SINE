<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seccion = $_POST['seccion'];
    $usuario = $_POST['usuario'];
    $fechainicio = $_POST['fechainicio'];
    $fechafin = $_POST['fechafin'] ?? null; // Puede ser null si no se proporciona
    $hora = $_POST['hora'];

    // Depuración: Imprimir los datos recibidos
    echo "Sección: $seccion<br>";
    echo "Usuario: $usuario<br>";
    echo "Fecha de Contrato: $fechainicio<br>";
    echo "Fecha fin de Contrato: $fechafin<br>";
    echo "Hora: $hora<br>";

    $stmt = $conn->prepare("INSERT INTO registro_lab (Idseccion, Idusuario, fechainicio, fechafin, Hora) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $seccion, $usuario, $fechainicio, $fechafin, $hora);

    if ($stmt->execute()) {
        header("Location: registro_lab.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
