<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inicio - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: #ffffff;
      color: #002244;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .main {
      display: flex;
      flex: 1;
      flex-direction: row;
      padding: 2rem;
      justify-content: space-between;
      align-items: center;
      animation: fadeIn 1.5s ease;
    }

    .left-buttons {
      display: flex;
      flex-direction: column;
      gap: 20px;
      max-width: 50%;
    }

    .left-buttons a {
      text-decoration: none;
      background-color: #0059b3;
      color: #fff;
      padding: 12px 20px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .left-buttons a:hover {
      background-color: #003f7d;
      transform: translateY(-2px);
    }

    .image-box {
      width: 40%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    footer {
      background-color: #f0f0f0;
      text-align: center;
      padding: 10px 20px;
      font-size: 0.9rem;
      color: #333;
      border-top: 1px solid #ccc;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    @media (max-width: 768px) {
      .main {
        flex-direction: column;
        text-align: center;
      }

      .image-box {
        display: none;
      }

      .left-buttons {
        width: 100%;
        align-items: center;
      }

      .left-buttons a {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="main">
    <div class="left-buttons">
      <a href="registro_negocio.php">Registrar Negocio</a>
      <a href="registro_servicio.php">Ofrecer Servicio Profesional</a>
      <a href="login.php">Iniciar Sesión</a>
      <a href="politica-de-privacidad.php">Políticas de Privacidad</a>
      <a href="explorar.php">Ver Perfiles</a>
    </div>
    <div class="image-box">
      <!-- Imagen decorativa si deseas añadir una adicional -->
    </div>
  </div>

  <footer>
    &copy; 2025 Servipyme Gramalote | Desarrollado por Daniel Antonio Velandia - Ficha 2977518<br>
    contacto: velandiadanie9@gmail.com
  </footer>

</body>
</html>
