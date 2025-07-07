<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar Negocio - Servipyme Gramalote</title>
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
      margin: 2rem 0;
      animation: slideIn 0.7s ease-in-out;
    }

    @keyframes slideIn {
      from {
        transform: translateY(20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
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
      <input type="text" name="direccion" placeholder="Dirección" required>
      <input type="text" name="municipio" placeholder="Municipio" required>
      <input type="text" name="telefono" placeholder="Teléfono" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
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
