<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Políticas de Privacidad - Servipyme Gramalote</title>
  <link rel="icon" href="logo_servipyme.jpg" type="image/jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(120deg, #ffffff, #e3f2fd, #ffffff);
      background-size: 400% 400%;
      animation: fondoAnimado 25s ease infinite;
      color: #002244;
      line-height: 1.7;
    }

    @keyframes fondoAnimado {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      max-width: 900px;
      margin: 60px auto;
      padding: 40px;
      background-color: #ffffffee;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    h1 {
      text-align: center;
      color: #0d47a1;
      margin-bottom: 30px;
    }

    h2 {
      color: #1976d2;
      margin-top: 30px;
    }

    p, li {
      color: #333;
    }

    ul {
      padding-left: 20px;
    }

    a {
      color: #1565c0;
      text-decoration: underline;
    }

    a:hover {
      color: #0d47a1;
    }

    .volver {
      margin-top: 50px;
      text-align: center;
    }

    .volver a {
      background-color: #0d6efd;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .volver a:hover {
      background-color: #084298;
    }

    footer {
      background-color: #0d47a1;
      color: white;
      padding: 20px 0;
      margin-top: 60px;
      text-align: center;
      font-size: 14px;
    }

    footer p {
      margin: 5px 0;
    }

    @media (max-width: 768px) {
      .container {
        margin: 20px;
        padding: 20px;
      }

      .volver a {
        width: 100%;
        display: block;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <h1>Políticas de Privacidad</h1>

    <p>En <strong>Servipyme Gramalote</strong>, nos tomamos en serio tu privacidad y queremos que entiendas cómo manejamos tus datos personales. Al usar nuestra plataforma, aceptas estas políticas.</p>

    <h2>1. Recopilación de información</h2>
    <p>Recopilamos información como: nombre, correo electrónico, número de teléfono, dirección, municipio, y otros datos que ingresas al registrar tu negocio o servicio profesional.</p>

    <h2>2. Uso de la información</h2>
    <p>Usamos tus datos para:</p>
    <ul>
      <li>Mostrar tu negocio o servicio en nuestra plataforma.</li>
      <li>Facilitar el contacto con potenciales clientes.</li>
      <li>Enviarte notificaciones sobre tu cuenta o actividad.</li>
    </ul>

    <h2>3. Protección de tus datos</h2>
    <p>Implementamos medidas de seguridad como almacenamiento seguro y cifrado de contraseñas para proteger tu información.</p>

    <h2>4. Compartir datos</h2>
    <p>No compartimos tus datos personales con terceros sin tu consentimiento, salvo requerimientos legales.</p>

    <h2>5. Uso de imágenes</h2>
    <p>Las fotos que subes pueden mostrarse públicamente en la plataforma para promover tu actividad o servicio.</p>

    <h2>6. Derechos del usuario</h2>
    <p>Podrás:</p>
    <ul>
      <li>Acceder, actualizar o eliminar tu información personal.</li>
      <li>Solicitar la eliminación completa de tu cuenta.</li>
    </ul>

    <h2>7. Cambios a esta política</h2>
    <p>Podemos actualizar esta política cuando sea necesario. Te notificaremos en la plataforma si hay cambios importantes.</p>

    <h2>8. Contacto</h2>
    <p>Para dudas o solicitudes, escríbenos a: <a href="mailto:servipyme@gramalote.gov.co">servipyme@gramalote.gov.co</a></p>

    <div class="volver">
      <a href="inicio.php">← Volver al inicio</a>
    </div>
  </div>

  <footer>
    <p><strong>Proyecto:</strong> SERVIPYMES Gramalote</p>
    <p><strong>Desarrollador:</strong> Daniel Antonio Velandia</p>
    <p><strong>Contacto:</strong> servipyme@gramalote.gov.co</p>
    <p><strong>Ubicación:</strong> Gramalote, Norte de Santander - Colombia</p>
    <p>© 2025 Todos los derechos reservados</p>
  </footer>

</body>
</html>
