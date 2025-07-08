<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar Negocio</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"/>
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
      align-items: center;
      justify-content: center;
      animation: fondoSuave 20s infinite alternate;
    }

    @keyframes fondoSuave {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }

    .form-container {
      background-color: white;
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 95%;
      max-width: 650px;
      animation: slideIn 0.8s ease-in-out;
    }

    @keyframes slideIn {
      from { transform: translateY(30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #0d47a1;
      font-weight: 700;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    input, textarea, select {
      padding: 0.9rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    input:focus, textarea:focus, select:focus {
      border-color: #0d6efd;
      outline: none;
    }

    input[type="submit"] {
      background-color: #0d6efd;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #084298;
    }

    .back-button {
      margin-top: 1.2rem;
      text-align: center;
    }

    .back-button a {
      text-decoration: none;
      color: #0d47a1;
      font-weight: 600;
    }

    .logo {
      display: block;
      margin: 0 auto 1rem auto;
      height: 60px;
      border-radius: 10px;
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 1.5rem;
      }

      .logo {
        height: 50px;
      }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <img src="logo_servipyme.jpg" alt="Logo Servipyme" class="logo">
    <h2>Registrar Negocio</h2>

    <form action="guardar_negocio.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="nombre" placeholder="Nombre del negocio" required>

      <select name="categoria" required>
        <option value="" disabled selected>Seleccione una categoría</option>
        <option value="Comida Rápida">Comida Rápida</option>
        <option value="Belleza y Estética">Belleza y Estética</option>
        <option value="Tecnología">Tecnología</option>
        <option value="Ferretería">Ferretería</option>
        <option value="Ropa y Calzado">Ropa y Calzado</option>
        <option value="Servicios Generales">Servicios Generales</option>
        <option value="Educación">Educación</option>
        <option value="Salud">Salud</option>
        <option value="Otro">Otro</option>
      </select>

      <textarea name="descripcion" rows="4" placeholder="Descripción del negocio" required></textarea>

      <input type="text" name="ubicacion" placeholder="Dirección exacta" required>
      <input type="text" name="municipio" placeholder="Municipio" required>
      <input type="text" name="telefono" placeholder="Teléfono" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="text" name="web" placeholder="Página web (opcional)">
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <input type="file" name="foto" accept="image/*">
      <input type="submit" value="Registrar">
    </form>

    <div class="back-button">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
