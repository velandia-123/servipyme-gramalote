<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "registro_negocios");

$mensajeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (!empty($nombre) && !empty($contrasena)) {
        // Buscar en negocios
        $stmt = $conexion->prepare("SELECT * FROM negocios WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        // Si no lo encontró en negocios, buscar en servicios
        if (!$usuario) {
            $stmt = $conexion->prepare("SELECT * FROM servicios WHERE nombre = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();
        }

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['nombre'] = $usuario['nombre'];
            header("Location: perfil.php");
            exit();
        } else {
            $mensajeError = "⚠️ Nombre o contraseña incorrectos. Inténtalo nuevamente.";
        }
    } else {
        $mensajeError = "⚠️ Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar Sesión</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(120deg, #e3f2fd, #ffffff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      color: #0d47a1;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    input[type="submit"] {
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    input[type="submit"]:hover {
      background-color: #094bcc;
    }

    .mensaje-error {
      color: red;
      margin-top: 15px;
      font-weight: bold;
    }

    .volver {
      margin-top: 20px;
    }

    .volver a {
      color: #0d47a1;
      text-decoration: none;
      font-weight: bold;
    }

    .volver a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
      <input type="text" name="nombre" placeholder="Nombre de usuario" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <input type="submit" value="Ingresar">
    </form>

    <?php if (!empty($mensajeError)): ?>
      <div class="mensaje-error"><?php echo $mensajeError; ?></div>
    <?php endif; ?>

    <div class="volver">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>

</body>
</html>
