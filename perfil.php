<?php
session_start();

// Proteger el acceso
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "registro_negocios");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombreUsuario = $_SESSION['nombre'];

$consulta_negocios = "SELECT * FROM negocios ORDER BY fecha_registro DESC";
$resultado_negocios = $conexion->query($consulta_negocios);

$consulta_servicios = "SELECT * FROM servicios ORDER BY fecha_registro DESC";
$resultado_servicios = $conexion->query($consulta_servicios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perfiles - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(-45deg, #ffffff, #e6f0ff, #cce0ff, #ffffff);
      background-size: 400% 400%;
      animation: animarFondo 25s ease infinite;
      color: #002244;
      min-height: 100vh;
    }
    @keyframes animarFondo {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    header {
      background-color: #f8f8f8;
      text-align: center;
      padding: 20px;
      border-bottom: 1px solid #ccc;
      position: relative;
    }

    header img {
      max-height: 80px;
    }

    .cerrar-sesion {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .cerrar-sesion a {
      text-decoration: none;
      color: #fff;
      background-color: #0059b3;
      padding: 8px 15px;
      border-radius: 8px;
      font-weight: bold;
    }

    .cerrar-sesion a:hover {
      background-color: #003f80;
    }

    h1 {
      text-align: center;
      color: #003366;
      margin: 20px 0;
    }

    .contenedor {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    .perfil {
      background-color: rgba(255,255,255,0.95);
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 40px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    .perfil h2 {
      color: #0059b3;
      border-bottom: 2px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .item {
      background-color: #f0f8ff;
      border-radius: 10px;
      margin: 15px 0;
      padding: 15px;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .item img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
      border: 2px solid #0059b3;
    }

    .item-info {
      flex: 1;
      color: #003366;
    }

    .item-info h3 {
      margin: 0;
      color: #002244;
    }

    .botones-contacto {
      margin-top: 10px;
    }

    .botones-contacto button {
      padding: 8px 14px;
      margin-right: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .correo-btn {
      background-color: #0077cc;
      color: white;
    }

    .correo-btn:hover {
      background-color: #005fa3;
    }

    .whatsapp-btn {
      background-color: #25D366;
      color: white;
    }

    .whatsapp-btn:hover {
      background-color: #1ebe5d;
    }

    .volver {
      text-align: center;
      margin: 40px 0 20px;
    }

    .volver a {
      background-color: #0059b3;
      color: #fff;
      padding: 12px 30px;
      text-decoration: none;
      border-radius: 10px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .volver a:hover {
      background-color: #003f80;
    }

    footer {
      background-color: #f0f0f0;
      text-align: center;
      padding: 12px;
      font-size: 0.9rem;
      color: #333;
      border-top: 1px solid #ccc;
    }

    @media (max-width: 768px) {
      .item { flex-direction: column; align-items: flex-start; }
      header img { max-height: 60px; }
      .item img { margin: auto; }
      .volver a { width: 90%; }
    }
  </style>
</head>
<body>
  <header>
    <img src="logo_servipyme.jpg" alt="Logo Servipyme">
    <div class="cerrar-sesion">
      <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>
  </header>

  <h1>Bienvenido<?php echo $nombreUsuario ? ", $nombreUsuario" : ""; ?> a Servipyme Gramalote</h1>

  <div class="contenedor">
    <div class="perfil">
      <h2>Negocios registrados</h2>
      <?php while ($negocio = $resultado_negocios->fetch_assoc()) : ?>
        <div class="item">
          <?php if (!empty($negocio['foto'])) : ?>
            <img src="<?php echo htmlspecialchars($negocio['foto']); ?>" alt="Foto del negocio">
          <?php endif; ?>
          <div class="item-info">
            <h3><?php echo htmlspecialchars($negocio['nombre']); ?></h3>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($negocio['categoria']); ?></p>
            <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($negocio['direccion'] . ', ' . $negocio['municipio']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($negocio['telefono']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($negocio['email']); ?></p>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($negocio['descripcion']); ?></p>
            <div class="botones-contacto">
              <a href="mailto:<?php echo htmlspecialchars($negocio['email']); ?>">
                <button class="correo-btn">📧 Correo</button>
              </a>
              <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $negocio['telefono']); ?>" target="_blank">
                <button class="whatsapp-btn">💬 WhatsApp</button>
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="perfil">
      <h2>Servicios registrados</h2>
      <?php while ($servicio = $resultado_servicios->fetch_assoc()) : ?>
        <div class="item">
          <?php if (!empty($servicio['foto'])) : ?>
            <img src="<?php echo htmlspecialchars($servicio['foto']); ?>" alt="Foto del servicio">
          <?php endif; ?>
          <div class="item-info">
            <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
            <p><strong>Habilidad:</strong> <?php echo htmlspecialchars($servicio['habilidad']); ?></p>
            <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($servicio['municipio']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($servicio['telefono']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($servicio['email']); ?></p>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($servicio['descripcion']); ?></p>
            <div class="botones-contacto">
              <a href="mailto:<?php echo htmlspecialchars($servicio['email']); ?>">
                <button class="correo-btn">📧 Correo</button>
              </a>
              <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $servicio['telefono']); ?>?text=<?php echo urlencode('Hola, vi tu perfil en Servipyme y me interesa tu habilidad de ' . $servicio['habilidad'] . '. ¿Podemos hablar?'); ?>" target="_blank">
                <button class="whatsapp-btn">💬 WhatsApp</button>
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="volver">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>

  <footer>
    &copy; 2025 Servipyme Gramalote | Desarrollado por Daniel Antonio Velandia - Ficha 2977518 | contacto: velandiadanie9@gmail.com
  </footer>
</body>
</html>
