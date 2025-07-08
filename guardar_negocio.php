<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "registro_negocios");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];
$municipio = $_POST['municipio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Manejo de la imagen
$foto = "";
if (!empty($_FILES['foto']['name'])) {
    $nombreFoto = uniqid() . "_" . $_FILES['foto']['name'];
    $rutaFoto = "uploads/" . $nombreFoto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto);
    $foto = $rutaFoto;
}

// Insertar en la base de datos
$sql = "INSERT INTO negocios (nombre, categoria, descripcion, direccion, municipio, telefono, email, web, contrasena, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, '', ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssss", $nombre, $categoria, $descripcion, $direccion, $municipio, $telefono, $email, $contrasena, $foto);

if ($stmt->execute()) {
    $_SESSION['nombre'] = $nombre; // Guardar sesión automáticamente
    header("Location: perfil.php"); // Redirigir directo al perfil
    exit();
} else {
    echo "Error al registrar: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
