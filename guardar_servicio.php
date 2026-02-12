<?php
require_once __DIR__ . '/helpers.php';
secure_session_start();
require_once 'conexion.php'; // conexión centralizada

// Verificar token CSRF
if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
    die("Error: token CSRF inválido.");
}

// Validar datos obligatorios
$errores = [];
if (empty($_POST['nombre'])) $errores[] = "El nombre es obligatorio.";
if (empty($_POST['contrasena'])) $errores[] = "La contraseña es obligatoria.";
if (empty($_POST['servicio'])) $errores[] = "Debe seleccionar un tipo de servicio.";
if (empty($_POST['descripcion'])) $errores[] = "La descripción es obligatoria.";
if (empty($_POST['ubicacion'])) $errores[] = "La ubicación es obligatoria.";
if (empty($_POST['telefono'])) $errores[] = "El teléfono es obligatorio.";
if (empty($_POST['email'])) $errores[] = "El correo es obligatorio.";

if (!empty($errores)) {
    $_SESSION['register_errors'] = $errores;
    header("Location: registro_servicio.php");
    exit();
}

// Sanitizar y procesar datos
$nombre = trim($_POST['nombre']);
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$servicio = trim($_POST['servicio']);
$descripcion = trim($_POST['descripcion']);
$ubicacion = trim($_POST['ubicacion']);
$telefono = trim($_POST['telefono']);
$email = trim($_POST['email']);

// Manejo de imagen
$foto = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $extensionesPermitidas = ['jpg', 'jpeg', 'png'];
    $extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (in_array($extension, $extensionesPermitidas)) {
        $fotoNombre = uniqid("img_", true) . "." . $extension;
        $fotoRuta = "uploads/" . $fotoNombre;

        if (!is_dir("uploads")) {
            mkdir("uploads", 0755, true);
        }

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoRuta)) {
            $foto = $fotoRuta;
        }
    }
}

// Insertar en BD
$stmt = $conn->prepare(
    "INSERT INTO servicios (nombre, contrasena, servicio, descripcion, ubicacion, telefono, email, foto) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param("ssssssss", $nombre, $contrasena, $servicio, $descripcion, $ubicacion, $telefono, $email, $foto);

if ($stmt->execute()) {
    $_SESSION['nombre'] = $nombre;
    header("Location: perfil.php");
    exit();
} else {
    echo "Error al guardar el servicio: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
