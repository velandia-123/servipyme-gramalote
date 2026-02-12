<?php
require_once 'helpers.php';
require_once 'conexion.php';

secure_session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST['tipo']) || !in_array($_POST['tipo'], ['negocio', 'servicio'])) {
        die("Tipo de cuenta inválido.");
    }

    $tipo       = $_POST['tipo'];
    $nombre     = trim($_POST['nombre']);
    $email      = trim($_POST['email']);
    $telefono   = preg_replace('/\D/', '', $_POST['telefono']);
    $ubicacion  = trim($_POST['ubicacion']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {

        $extPermitidas = ['jpg','jpeg','png'];
        $extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (in_array($extension, $extPermitidas) && $_FILES['foto']['size'] <= 2 * 1024 * 1024) {

            if (!is_dir("uploads")) {
                mkdir("uploads", 0755, true);
            }

            $nuevoNombre = uniqid("img_", true) . "." . $extension;
            $ruta = "uploads/" . $nuevoNombre;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta)) {
                $foto = $ruta;
            }
        }
    }

    if ($tipo === "negocio") {

        $categoria   = trim($_POST['categoria'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        $sql = "INSERT INTO negocios 
                (nombre, categoria, descripcion, ubicacion, telefono, email, contrasena, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssss",
            $nombre,
            $categoria,
            $descripcion,
            $ubicacion,
            $telefono,
            $email,
            $contrasena,
            $foto
        );

    } else {

        $servicio    = trim($_POST['servicio'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        $sql = "INSERT INTO servicios 
                (nombre, servicio, descripcion, ubicacion, telefono, email, contrasena, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssss",
            $nombre,
            $servicio,
            $descripcion,
            $ubicacion,
            $telefono,
            $email,
            $contrasena,
            $foto
        );
    }

    if ($stmt && $stmt->execute()) {

        $_SESSION['id']     = $stmt->insert_id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['tabla']  = ($tipo === 'negocio') ? 'negocios' : 'servicios';

        header("Location: perfil.php");
        exit();

    } else {
        die("Error al guardar el registro.");
    }

    if ($stmt) $stmt->close();
    $conn->close();

} else {
    die("Acceso no permitido.");
}
