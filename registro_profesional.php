<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Servicio Profesional</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      background-size: 300% 300%;
      animation: fondo 20s ease infinite;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      color: #fff;
    }

    @keyframes fondo {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .form-container {
      background: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      width: 90%;
      max-width: 500px;
      margin-top: 30px;
      animation: slideIn 0.8s ease;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #90e0ef;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background: #2c3e50;
      color: #fff;
      font-size: 15px;
    }

    input[type="submit"] {
      background: #00b894;
      cursor: pointer;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background: #009172;
    }

    .nota {
      font-size: 13px;
      color: #ccc;
      text-align: center;
      margin-top: 10px;
    }

    .login-link {
      text-align: center;
      margin-top: 12px;
    }

    .login-link a {
      color: #81ecec;
      font-size: 14px;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="form-container">
    <h2>Publica tu Servicio o Habilidad</h2>
    <form action="guardar_servicio.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="nombre" placeholder="Tu nombre completo" required>
      <input type="password" name="contrasena" placeholder="Crea una contraseña" required>
      <input type="text" name="categoria" placeholder="Tipo de servicio que ofreces" required>
      <textarea name="descripcion" rows="3" placeholder="Describe brevemente tu servicio" required></textarea>
      <input type="text" name="direccion" placeholder="Dirección (opcional)">
      <input type="text" name="municipio" placeholder="Ciudad o municipio" required>
      <input type="tel" name="telefono" placeholder="Teléfono (10 dígitos)" pattern="[0-9]{10}" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="text" name="web" placeholder="Página web (opcional)">
      <input type="file" name="foto" accept="image/*">
      <input type="submit" value="Publicar servicio">
      <p class="nota">Puedes ofrecer cualquier tipo de servicio o habilidad útil para otros.</p>
    </form>
    <div class="login-link">
      ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
    </div>
  </div>

</body>
</html>
