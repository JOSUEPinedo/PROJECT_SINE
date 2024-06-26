<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $seccion = $_POST['seccion'];
    $proveedor = $_POST['proveedor'];

    // Ruta del directorio de imágenes
    $target_dir = "../uploads/";

    // Crear el directorio si no existe
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen = basename($_FILES["imagen"]["name"]);
            $stmt = $conn->prepare("INSERT INTO productos (Nombre, Descripcion, cantidad, imagen, Idseccion, Idproveedor) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissi", $nombre, $descripcion, $cantidad, $imagen, $seccion, $proveedor);

            if ($stmt->execute()) {
                header("Location: productos.php?success=1");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error subiendo la imagen.";
        }
    } else {
        echo "El archivo no es una imagen.";
    }

    $conn->close();
}
?>
