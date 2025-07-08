<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Servicios Profesionales</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(to right, #eaf4ff, #d1e0ff);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-container {
      background-color: white;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 600px;
      margin-top: 2rem;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: #0d47a1;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    input, textarea, select {
      padding: 0.8rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    input[type="submit"] {
      background-color: #0d6efd;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #084298;
    }

    .back-button {
      margin-top: 1rem;
      text-align: center;
    }

    .back-button a {
      text-decoration: none;
      color: #0d47a1;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="form-container">
    <h2>Publicar Servicio Profesional</h2>
    <form action="guardar_servicio.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="nombre" placeholder="Nombre completo" required>

      <select name="habilidad" required>
        <option value="" disabled selected>Tipo de servicio que ofrece</option>
        <option value="Electricista">Electricista</option>
        <option value="Plomería">Plomería</option>
        <option value="Aseo">Aseo</option>
        <option value="Cuidado de niños">Cuidado de niños</option>
        <option value="Clases particulares">Clases particulares</option>
        <option value="Costura">Costura</option>
        <option value="Diseño gráfico">Diseño gráfico</option>
        <option value="Otro">Otro</option>
      </select>

      <textarea name="descripcion" rows="4" placeholder="Descripción del servicio" required></textarea>
      <input type="text" name="municipio" placeholder="Ciudad o municipio" required>
      <input type="text" name="telefono" placeholder="Teléfono" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <input type="file" name="foto" accept="image/*">
      <input type="submit" value="Publicar Servicio">
    </form>
    <div class="back-button">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>

</body>
</html>
