<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "servipyme");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Verificar primero en negocios
    $sql = "SELECT * FROM negocios WHERE nombre = ? AND email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_tipo'] = 'negocio';
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: perfil.php");
            exit();
        }
    }

    // Si no está en negocios, buscar en servicios
    $sql2 = "SELECT * FROM servicios WHERE nombre = ? AND email = ?";
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bind_param("ss", $nombre, $email);
    $stmt2->execute();
    $resultado2 = $stmt2->get_result();

    if ($resultado2->num_rows === 1) {
        $usuario2 = $resultado2->fetch_assoc();
        if (password_verify($contrasena, $usuario2['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario2['id'];
            $_SESSION['usuario_tipo'] = 'servicio';
            $_SESSION['usuario_nombre'] = $usuario2['nombre'];
            header("Location: perfil.php");
            exit();
        }
    }

    echo "❌ Usuario o contraseña incorrectos.";
    $stmt->close();
    $stmt2->close();
    $conexion->close();
}
?>
