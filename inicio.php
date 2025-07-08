<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inicio - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #e3f2fd, #ffffff);
      color: #002244;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      font-size: 3rem;
      margin: 40px 0 10px;
      color: #0d47a1;
      font-weight: 800;
      animation: fadeIn 1.2s ease-in-out;
    }

    .container {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 40px 5% 20px;
      gap: 40px;
      flex-wrap: wrap;
      flex: 1;
    }

    .left-buttons {
      flex: 1;
      min-width: 250px;
      max-width: 280px;
      display: flex;
      flex-direction: column;
      gap: 18px;
      animation: slideInLeft 1s ease-out;
    }

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .left-buttons a {
      text-decoration: none;
    }

    .left-buttons button {
      width: 100%;
      padding: 12px 18px;
      font-size: 1rem;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .left-buttons button:hover {
      background-color: #094bcc;
      transform: scale(1.03);
    }

    .right-image {
      flex: 1;
      min-width: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: slideInRight 1s ease-out;
    }

    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .right-image img {
      max-width: 100%;
      width: 360px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      transition: transform 0.4s ease;
    }

    .right-image img:hover {
      transform: scale(1.02);
    }

    footer {
      text-align: center;
      padding: 15px;
      font-size: 0.9rem;
      color: #555;
      background-color: #f8f8f8;
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        text-align: center;
      }

      .right-image {
        margin-top: 30px;
      }

      .left-buttons {
        width: 100%;
        align-items: center;
      }

      .left-buttons button {
        width: 100%;
        max-width: 260px;
      }
    }
  </style>
</head>
<body>

  <h1>Servipyme Gramalote</h1>

  <div class="container">
    <div class="left-buttons">
      <a href="registro_negocio.php"><button>Registrar Negocio</button></a>
      <a href="registro_servicio.php"><button>Registrar Servicio Profesional</button></a>
      <a href="login.php"><button>Iniciar Sesión</button></a>
      <a href="explorar.php"><button>Explorar Perfiles</button></a>
      <a href="politica-de-privacidad.php"><button>Política de Privacidad</button></a>
    </div>

    <div class="right-image">
      <img src="bienvenida.jpg" alt="Imagen de bienvenida">
    </div>
  </div>

  <footer>
    &copy; 2025 Servipyme Gramalote | Desarrollado por Daniel Antonio Velandia - Ficha 2977518 | contacto: velandiadanie9@gmail.com
  </footer>

</body>
</html>
