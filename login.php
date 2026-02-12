<?php
// login.php - versión unificada (formulario + lógica + estilo moderno)
require_once 'helpers.php';    // contiene secure_session_start()
require_once 'conexion.php';   // define $conn (mysqli)

secure_session_start();

// Si ya está logueado, redirigir a perfil
if (!empty($_SESSION['id'])) {
    header('Location: perfil.php');
    exit();
}

// --- Procesar login si viene por POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(trim($_POST['username'] ?? $_POST['email'] ?? ''), FILTER_SANITIZE_STRING);
    $password = $_POST['contrasena'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Por favor complete todos los campos.";
    } else {
        // Buscar usuario en tablas 'negocios' y 'servicios'
        function find_user($conn, $username) {
            $tables = ['negocios', 'servicios'];
            foreach ($tables as $table) {
                $sql = "SELECT id, nombre, contrasena, email, telefono 
                        FROM `$table` 
                        WHERE email = ? OR telefono = ? 
                        LIMIT 1";
                $stmt = $conn->prepare($sql);
                if (!$stmt) continue;
                $stmt->bind_param('ss', $username, $username);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res && $row = $res->fetch_assoc()) {
                    $row['tabla'] = $table;
                    $stmt->close();
                    return $row;
                }
                $stmt->close();
            }
            return null;
        }

        $user = find_user($conn, $username);

        if ($user) {
            $stored_hash = $user['contrasena'] ?? '';
            if (password_verify($password, $stored_hash) || $stored_hash === $password) {
                // Si estaba en texto plano, actualizar a hash
                if ($stored_hash === $password) {
                    $new_hash = password_hash($password, PASSWORD_DEFAULT);
                    $table = $user['tabla'];
                    $upd = $conn->prepare("UPDATE `$table` SET contrasena = ? WHERE id = ?");
                    if ($upd) {
                        $upd->bind_param('si', $new_hash, $user['id']);
                        $upd->execute();
                        $upd->close();
                    }
                }

                // Iniciar sesión
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['tabla'] = $user['tabla'];
                $conn->close();
                header('Location: perfil.php');
                exit();
            } else {
                $error = "Credenciales incorrectas.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Servipymes Gramalote</title>
  <link rel="icon" href="logo_servipyme.png" type="image/png">
  <style>
    body { 
      font-family: Arial, sans-serif; 
      background: #f0f2f5; 
      margin: 0; 
      padding: 0; 
      display:flex; 
      flex-direction:column; 
      height:100vh; 
    }
    header { 
      background: #1877f2; 
      color: white; 
      padding: 15px; 
      text-align: center; 
      box-shadow:0 2px 5px rgba(0,0,0,0.1);
    }
    header h1 { margin:0; font-size:1.8rem; font-weight:bold; }
    .login-container {
      flex:1; 
      display:flex; 
      justify-content:center; 
      align-items:center;
    }
    .login-box {
      background:white; 
      padding:30px; 
      border-radius:15px; 
      box-shadow:0 4px 8px rgba(0,0,0,0.1); 
      width:100%; 
      max-width:400px; 
      animation: fadeIn 0.6s ease-in-out;
    }
    .login-box h2 {
      text-align:center; 
      margin-bottom:20px; 
      color:#1877f2;
    }
    .login-box input {
      width:100%; 
      padding:12px; 
      margin:10px 0; 
      border-radius:10px; 
      border:1px solid #ccc; 
      font-size:1rem;
    }
    .btn-login {
      background:#1877f2; 
      color:white; 
      border:none; 
      padding:12px; 
      width:100%; 
      border-radius:30px; 
      font-size:1rem; 
      font-weight:bold; 
      cursor:pointer; 
      transition:background 0.3s;
    }
    .btn-login:hover { background:#0f5bcc; }
    .error { 
      background:#ff4b5c; 
      color:white; 
      padding:10px; 
      border-radius:8px; 
      margin-bottom:15px; 
      text-align:center; 
      font-weight:bold;
    }
    .register-link {
      text-align:center; 
      margin-top:15px;
    }
    .register-link a { 
      color:#1877f2; 
      text-decoration:none; 
      font-weight:bold; 
    }
    .register-link a:hover { text-decoration:underline; }
    @keyframes fadeIn {
      from {opacity:0; transform: translateY(-20px);}
      to {opacity:1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <header>
    <h1>Servipymes Gramalote</h1>
  </header>
  <div class="login-container">
    <div class="login-box">
      <h2>Iniciar Sesión</h2>
      <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Correo o Teléfono" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit" class="btn-login">Ingresar</button>
      </form>
      <div class="register-link">
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
      </div>
    </div>
  </div>
</body>
</html>
