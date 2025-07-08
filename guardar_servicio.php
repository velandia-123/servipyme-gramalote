<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "registro_negocios");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$habilidad = $_POST['habilidad'];
$descripcion = $_POST['descripcion'];
$municipio = $_POST['municipio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

// Procesar la foto (opcional)
$foto = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $fotoNombre = uniqid() . "_" . $_FILES['foto']['name'];
    $fotoRuta = "uploads/" . $fotoNombre;

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoRuta)) {
        $foto = $fotoRuta;
    }
}

// Insertar en la base de datos
$stmt = $conexion->prepare("INSERT INTO servicios (nombre, contrasena, habilidad, descripcion, municipio, telefono, email, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nombre, $contrasena, $habilidad, $descripcion, $municipio, $telefono, $email, $foto);

if ($stmt->execute()) {
    // Iniciar sesión automáticamente
    $_SESSION['nombre'] = $nombre;
    header("Location: perfil.php");
    exit();
} else {
    echo "Error al guardar el servicio: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
