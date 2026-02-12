<?php
// registro_servicio.php
require_once __DIR__ . '/helpers.php';
secure_session_start();

// Generar token CSRF
$csrf = generate_csrf_token();
if (empty($csrf)) {
    die('Error: no se pudo generar token CSRF.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Servicios Profesionales</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
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
    .back-button { margin-top: 1rem; text-align: center; }
    .back-button a { text-decoration: none; color: #0d47a1; font-weight: bold; }
    #map {
      height: 300px;
      border-radius: 10px;
      margin-top: 1rem;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="form-container">
    <h2>Publicar Servicio Profesional</h2>

    <!-- Mostrar errores de sesión si existen -->
    <?php
    if (!empty($_SESSION['register_errors'])) {
        foreach ($_SESSION['register_errors'] as $e) {
            echo '<div style="color:red;">'.htmlspecialchars($e).'</div>';
        }
        unset($_SESSION['register_errors']);
    }
    ?>

    <form action="guardar_servicio.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">

      <input type="text" name="nombre" placeholder="Nombre completo" required>

      <select name="servicio" required>
        <option value="" disabled selected>Seleccione el tipo de servicio</option>
        <option value="Construcción y Reparaciones">🏗️ Construcción y Reparaciones</option>
        <option value="Servicios para el Hogar">🏠 Servicios para el Hogar</option>
        <option value="Agro y Campo">🌾 Agro y Campo</option>
        <option value="Transporte y Domicilios">🚖 Transporte y Domicilios</option>
        <option value="Cuidado Personal y Belleza">💅 Cuidado Personal y Belleza</option>
        <option value="Salud y Bienestar">🏥 Salud y Bienestar</option>
        <option value="Educación y Clases">📚 Educación y Clases</option>
        <option value="Tecnología y Oficios Modernos">💻 Tecnología y Oficios Modernos</option>
        <option value="Arte y Cultura">🎨 Arte y Cultura</option>
        <option value="Otros Servicios">🔹 Otros Servicios</option>
      </select>

      <input type="text" name="ubicacion" id="direccion" placeholder="Barrio, vereda o dirección exacta" required>
      <textarea name="descripcion" rows="4" placeholder="Descripción del servicio" required></textarea>
      <input type="text" name="telefono" placeholder="Teléfono" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <input type="file" name="foto" accept="image/*">

      <label for="map"><b>Seleccione su ubicación en el mapa:</b></label>
      <div id="map"></div>

      <input type="submit" value="Publicar Servicio">
    </form>
    <div class="back-button">
      <a href="/mi_negocio/index.php">← Volver al inicio</a>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const gramalote = [7.9168363, -72.7866729];
    const map = L.map('map').setView(gramalote, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 19
    }).addTo(map);

    let marker = L.marker(gramalote).addTo(map)
      .bindPopup("Seleccione su ubicación").openPopup();

    map.on('click', function(e) {
      const { lat, lng } = e.latlng;
      marker.setLatLng(e.latlng);
      document.getElementById('direccion').value =
        "Ubicación seleccionada: " + lat.toFixed(5) + ", " + lng.toFixed(5);
    });
  </script>

</body>
</html>
