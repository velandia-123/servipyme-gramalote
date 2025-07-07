<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "registro_negocios";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recoger datos del formulario
$nombre     = $_POST['nombre'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$habilidad  = $_POST['servicio'];
$descripcion = $_POST['descripcion'];
$municipio   = $_POST['ubicacion'];
$telefono    = $_POST['telefono'];
$email       = $_POST['email'];

// Procesar imagen si fue cargada
$foto_ruta = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto_nombre = uniqid() . "_" . basename($_FILES['foto']['name']);
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_ruta = "uploads/" . $foto_nombre;

    if (!move_uploaded_file($foto_tmp, $foto_ruta)) {
        die("Error al subir la imagen.");
    }
}

// Insertar en la base de datos
$sql = "INSERT INTO servicios (nombre, contrasena, habilidad, descripcion, municipio, telefono, email, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nombre, $contrasena, $habilidad, $descripcion, $municipio, $telefono, $email, $foto_ruta);

if ($stmt->execute()) {
    header("Location: perfil.php?nombre=" . urlencode($nombre));
    exit();
} else {
    echo "Error al registrar el servicio: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
