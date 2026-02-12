<?php
require_once 'helpers.php';
secure_session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$id = $_SESSION['id'];
$tabla = $_SESSION['tabla'] ?? '';

if ($tabla !== 'negocios' && $tabla !== 'servicios') {
    die("Acceso no permitido");
}

$mensaje = "";
$error = "";

// Obtener datos actuales
$sql = "SELECT * FROM $tabla WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$datos = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $telefono = $_POST['telefono'];

    if (empty($nombre) || empty($descripcion) || empty($ubicacion) || empty($telefono)) {
        $error = "Todos los campos son obligatorios.";
    } else {

        if ($tabla == "negocios") {
            $categoria = $_POST['categoria'];
            $sql_update = "UPDATE negocios SET nombre=?, categoria=?, descripcion=?, ubicacion=?, telefono=? WHERE id=?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("sssssi", $nombre, $categoria, $descripcion, $ubicacion, $telefono, $id);
        } else {
            $servicio = $_POST['servicio'];
            $sql_update = "UPDATE servicios SET nombre=?, servicio=?, descripcion=?, ubicacion=?, telefono=? WHERE id=?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("sssssi", $nombre, $servicio, $descripcion, $ubicacion, $telefono, $id);
        }

        if ($stmt->execute()) {
            $mensaje = "Perfil actualizado correctamente.";
            header("Refresh:2; url=perfil.php");
        } else {
            $error = "Error al actualizar.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Perfil</title>

<style>
body{
font-family:'Segoe UI',sans-serif;
background:#f0f2f5;
margin:0;
}

.container{
max-width:700px;
margin:50px auto;
background:#fff;
padding:40px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
animation:fadeIn 0.5s ease;
}

h2{
margin-bottom:25px;
color:#1877f2;
}

label{
font-weight:600;
display:block;
margin-top:15px;
margin-bottom:5px;
}

input, textarea{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:8px;
transition:0.3s;
font-size:14px;
}

input:focus, textarea:focus{
border-color:#1877f2;
box-shadow:0 0 5px rgba(24,119,242,0.3);
outline:none;
}

textarea{
resize:none;
height:100px;
}

button{
margin-top:20px;
padding:12px 20px;
background:#1877f2;
color:white;
border:none;
border-radius:25px;
cursor:pointer;
font-weight:bold;
transition:0.3s;
}

button:hover{
background:#0f5dc1;
}

.message{
margin-top:20px;
padding:12px;
border-radius:8px;
animation:slideDown 0.4s ease;
}

.success{
background:#d4edda;
color:#155724;
}

.error{
background:#f8d7da;
color:#721c24;
}

.back{
display:inline-block;
margin-top:20px;
text-decoration:none;
color:#1877f2;
font-weight:bold;
}

@keyframes fadeIn{
from{opacity:0; transform:translateY(20px);}
to{opacity:1; transform:translateY(0);}
}

@keyframes slideDown{
from{opacity:0; transform:translateY(-10px);}
to{opacity:1; transform:translateY(0);}
}
</style>
</head>
<body>

<div class="container">
<h2>Editar Perfil</h2>

<form method="POST">

<label>Nombre</label>
<input type="text" name="nombre" value="<?php echo htmlspecialchars($datos['nombre']); ?>">

<?php if ($tabla == "negocios"): ?>
<label>Categoría</label>
<input type="text" name="categoria" value="<?php echo htmlspecialchars($datos['categoria']); ?>">
<?php else: ?>
<label>Servicio</label>
<input type="text" name="servicio" value="<?php echo htmlspecialchars($datos['servicio']); ?>">
<?php endif; ?>

<label>Descripción</label>
<textarea name="descripcion"><?php echo htmlspecialchars($datos['descripcion']); ?></textarea>

<label>Ubicación</label>
<input type="text" name="ubicacion" value="<?php echo htmlspecialchars($datos['ubicacion']); ?>">

<label>Teléfono</label>
<input type="text" name="telefono" value="<?php echo htmlspecialchars($datos['telefono']); ?>">

<button type="submit">Guardar Cambios</button>

</form>

<?php if ($mensaje): ?>
<div class="message success"><?php echo $mensaje; ?></div>
<?php endif; ?>

<?php if ($error): ?>
<div class="message error"><?php echo $error; ?></div>
<?php endif; ?>

<a class="back" href="perfil.php">← Volver al perfil</a>

</div>

</body>
</html>
