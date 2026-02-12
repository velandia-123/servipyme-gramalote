<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(120deg, #e3f2fd, #ffffff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .form-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 500px;
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      color: #0d47a1;
      text-align: center;
      margin-bottom: 20px;
    }
    label { font-weight: bold; display: block; margin-top: 10px; color:#333; }
    input, select, textarea {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    textarea { resize: vertical; }
    button {
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
      margin-top: 20px;
    }
    button:hover { background-color: #094bcc; }
    .volver { text-align:center; margin-top:15px; }
    .volver a { color:#0d47a1; text-decoration:none; font-weight:bold; }
    .volver a:hover { text-decoration: underline; }
    .hidden { display:none; }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Registro en Servipymes</h2>

  <form action="guardar_registro.php" method="POST" enctype="multipart/form-data">

    <label>Registrar como:</label>
    <select name="tipo" id="tipo" required onchange="mostrarCampos()">
      <option value="">-- Selecciona --</option>
      <option value="negocio">Negocio / Emprendimiento</option>
      <option value="servicio">Perfil Profesional</option>
    </select>

    <!-- Campos comunes -->
    <div id="campos-comunes" class="hidden">
      <label>Nombre completo / Empresa:</label>
      <input type="text" name="nombre" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Teléfono:</label>
      <input type="text" name="telefono" required>

      <label>Ubicación:</label>
      <input type="text" name="ubicacion" required>

      <label>Contraseña:</label>
      <input type="password" name="contrasena" required minlength="6">

      <label>Foto (opcional):</label>
      <input type="file" name="foto" accept="image/*">
    </div>

    <!-- Campos para Negocio -->
    <div id="campos-negocio" class="hidden">
      <label>Categoría del negocio:</label>
      <select name="categoria">
        <option value="">-- Selecciona una categoría --</option>
        <option value="Restaurantes">Restaurantes</option>
        <option value="Salud">Salud</option>
        <option value="Educación">Educación</option>
        <option value="Tecnología">Tecnología</option>
        <option value="Construcción">Construcción</option>
        <option value="Turismo">Turismo</option>
        <option value="Comercio">Comercio</option>
        <option value="Transporte">Transporte</option>
      </select>

      <label>Descripción:</label>
      <textarea name="descripcion" rows="3"></textarea>
    </div>

    <!-- Campos para Servicio -->
    <div id="campos-servicio" class="hidden">
      <label>Categoría del servicio:</label>
      <select name="servicio">
        <option value="">-- Selecciona una categoría --</option>
        <option value="Médicos">Médicos</option>
        <option value="Ingenieros">Ingenieros</option>
        <option value="Diseñadores">Diseñadores</option>
        <option value="Profesores">Profesores</option>
        <option value="Abogados">Abogados</option>
        <option value="Plomeros">Plomeros</option>
        <option value="Electricistas">Electricistas</option>
        <option value="Otros">Otros</option>
      </select>

      <label>Descripción:</label>
      <textarea name="descripcion" rows="3"></textarea>
    </div>

    <button type="submit">Registrar</button>
  </form>

  <div class="volver">
    <a href="index.php">← Volver al inicio</a>
  </div>
</div>

<script>
function mostrarCampos(){
  const tipo = document.getElementById('tipo').value;
  document.getElementById('campos-comunes').classList.toggle('hidden', !tipo);
  document.getElementById('campos-negocio').classList.toggle('hidden', tipo !== 'negocio');
  document.getElementById('campos-servicio').classList.toggle('hidden', tipo !== 'servicio');
}
</script>

</body>
</html>
