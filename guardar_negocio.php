<?php
session_start(); // Iniciar sesión

// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "servipyme";

// Conexión con MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recoger y limpiar los datos del formulario
$nombre = trim($_POST['nombre']);
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];
$municipio = $_POST['municipio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$web = isset($_POST['web']) ? $_POST['web'] : "";

// Procesar imagen
$foto_nombre = $_FILES['foto']['name'];
$foto_tmp = $_FILES['foto']['tmp_name'];
$foto_ruta = "uploads/" . time() . "_" . basename($foto_nombre); // nombre único

// Verificar si se subió la imagen
if (!move_uploaded_file($foto_tmp, $foto_ruta)) {
    die("Error al subir la imagen.");
}

// Insertar datos en la base de datos
$sql = "INSERT INTO negocios (nombre, contrasena, categoria, descripcion, direccion, municipio, telefono, email, web, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $nombre, $contrasena, $categoria, $descripcion, $direccion, $municipio, $telefono, $email, $web, $foto_ruta);

if ($stmt->execute()) {
    // Guardar ID en sesión para uso posterior
    $_SESSION['negocio_id'] = $stmt->insert_id;

    // Redirigir al perfil
    header("Location: perfiles.php");
    exit();
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
