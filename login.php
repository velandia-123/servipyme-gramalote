<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar Sesión - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e3f2fd);
      background-size: 400% 400%;
      animation: fondoAnimado 20s ease infinite;
    }

    @keyframes fondoAnimado {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      max-width: 420px;
      margin: 80px auto;
      padding: 40px;
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      text-align: center;
      opacity: 0;
      transform: translateY(20px);
      animation: aparecerSuave 1.2s ease-out forwards;
    }

    @keyframes aparecerSuave {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      color: #0d47a1;
      margin-bottom: 25px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #094bcc;
    }

    .volver {
      margin-top: 20px;
    }

    .volver a {
      color: #0d47a1;
      text-decoration: none;
      font-weight: 500;
    }

    .volver a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .container {
        margin: 40px 20px;
        padding: 30px;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <h2>Iniciar Sesión</h2>
    <form action="iniciar_sesion.php" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required />
      <input type="email" name="email" placeholder="Correo electrónico" required />
      <input type="password" name="contrasena" placeholder="Contraseña" required />
      <button type="submit">Ingresar</button>
    </form>

    <div class="volver">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>

</body>
</html>
