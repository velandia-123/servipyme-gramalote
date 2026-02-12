<?php
// registro_negocio.php (actualizado)
// Guardar como UTF-8 sin BOM
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
  <meta charset="UTF-8">
  <title>Registro de Negocio</title>
</head>
<body>
  <h2>Registrar tu Negocio</h2>

  <!-- Mostrar errores de sesión si existen -->
  <?php
  if (!empty($_SESSION['register_errors'])) {
      foreach ($_SESSION['register_errors'] as $e) {
          echo '<div style="color:red;">'.htmlspecialchars($e).'</div>';
      }
      unset($_SESSION['register_errors']);
  }
  ?>

  <form action="guardar_negocio.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">

    <label>Nombre del negocio:<br>
      <input type="text" name="nombre" required>
    </label><br><br>

    <label>Categoría:<br>
      <input type="text" name="categoria" required>
    </label><br><br>

    <label>Descripción:<br>
      <textarea name="descripcion" required></textarea>
    </label><br><br>

    <label>Dirección:<br>
      <input type="text" name="direccion" required>
    </label><br><br>

    <label>Municipio:<br>
      <input type="text" name="municipio" required>
    </label><br><br>

    <label>Teléfono:<br>
      <input type="text" name="telefono" required>
    </label><br><br>

    <label>Email:<br>
      <input type="email" name="email" required>
    </label><br><br>

    <label>Contraseña:<br>
      <input type="password" name="contrasena" required minlength="6">
    </label><br><br>

    <label>Confirmar contraseña:<br>
      <input type="password" name="contrasena_confirm" required minlength="6">
    </label><br><br>

    <label>Foto del negocio:<br>
      <input type="file" name="foto" accept="image/*">
    </label><br><br>

    <button type="submit">Registrar Negocio</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</body>
</html>
