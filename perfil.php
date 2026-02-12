<?php
require_once 'helpers.php';
secure_session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = $_SESSION['id'];
$usuario_tabla = $_SESSION['tabla'] ?? '';

// Obtener negocios
$sql_negocios = "SELECT id, nombre, categoria, descripcion, ubicacion, telefono, foto 
                 FROM negocios ORDER BY fecha_registro DESC";
$result_negocios = $conn->query($sql_negocios);
$negocios = $result_negocios ? $result_negocios->fetch_all(MYSQLI_ASSOC) : [];

// Obtener servicios
$sql_servicios = "SELECT id, nombre, servicio, descripcion, ubicacion, telefono, foto 
                  FROM servicios ORDER BY fecha_registro DESC";
$result_servicios = $conn->query($sql_servicios);
$servicios = $result_servicios ? $result_servicios->fetch_all(MYSQLI_ASSOC) : [];

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Servipymes Gramalote</title>
<link rel="icon" href="logo_servipyme.png">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
font-family:'Segoe UI',sans-serif;
background:#f0f2f5;
color:#1c1e21;        
overflow-x:hidden;
}


header{
position:sticky;
top:0;
background:rgba(80, 80, 80, 0.6);
backdrop-filter:blur(15px);
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
z-index:1000;
}

header h1{
font-size:1.8rem;
letter-spacing:1px;
}

.nav-right a{
margin-left:15px;
text-decoration:none;
color:#fff;
font-weight:bold;
padding:8px 15px;
border-radius:20px;
transition:0.3s;
}

.nav-right a:hover{
background:#1877f2;
}

main{
max-width:1300px;
margin:auto;
padding:40px 20px;
}

.section-title{
font-size:1.8rem;
margin-bottom:20px;
position:relative;
}

.feed{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
gap:25px;
}

.card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
border-radius:20px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
transition:0.4s ease;
position:relative;
animation:fadeUp 0.8s ease forwards;
}

.card:hover{
transform:translateY(-10px) scale(1.02);
box-shadow:0 20px 40px rgba(0,0,0,0.5);
}

.banner{
height:180px;
background:linear-gradient(45deg,#1877f2,#00c6ff);
display:flex;
align-items:center;
justify-content:center;
font-size:1.3rem;
font-weight:bold;
}

.card img{
width:100%;
height:180px;
object-fit:cover;
}

.card-content{
padding:20px;
}

.card-content h3{
margin-bottom:10px;
}

.whatsapp-btn{
display:inline-block;
margin-top:15px;
padding:10px 15px;
background:#25d366;
color:white;
border-radius:30px;
text-decoration:none;
font-weight:bold;
transition:0.3s;
}

.whatsapp-btn:hover{
background:#1ebe5d;
}

.edit-btn{
position:absolute;
top:15px;
right:15px;
background:#ff9800;
padding:8px 12px;
border-radius:20px;
font-size:0.8rem;
text-decoration:none;
color:#fff;
font-weight:bold;
}

.map-btn{
margin:60px auto;
display:block;
padding:15px 30px;
background:#ff4b5c;
color:white;
border:none;
border-radius:40px;
font-size:1rem;
cursor:pointer;
transition:0.3s;
}

.map-btn:hover{
background:#e33b4c;
}

.notification{
position:fixed;
bottom:30px;
right:30px;
background:#ff4b5c;
padding:15px 25px;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,0.4);
display:none;
animation:slideIn 0.5s ease;
}

@keyframes fadeUp{
from{opacity:0;transform:translateY(40px);}
to{opacity:1;transform:translateY(0);}
}

@keyframes slideIn{
from{transform:translateX(100%);}
to{transform:translateX(0);}
}
</style>
</head>
<body>

<header>
<h1>Servipymes Gramalote</h1>
<div class="nav-right">
<a href="cerrar_sesion.php">Cerrar sesión</a>
</div>
</header>

<main>

<h2 class="section-title">🏢 Negocios</h2>
<div class="feed">
<?php foreach ($negocios as $row): ?>
<div class="card">
<div class="banner">
<?php echo htmlspecialchars($row['categoria']); ?>
</div>

<?php if (!empty($row['foto'])): ?>
<img src="<?php echo htmlspecialchars($row['foto']); ?>">
<?php endif; ?>

<div class="card-content">
<h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
<p><strong>Ubicación:</strong> <?php echo htmlspecialchars($row['ubicacion']); ?></p>
<p><?php echo htmlspecialchars($row['descripcion']); ?></p>

<a class="whatsapp-btn" target="_blank"
href="https://wa.me/<?php echo htmlspecialchars($row['telefono']); ?>">WhatsApp</a>

<?php if ($usuario_tabla === 'negocios' && $usuario_id == $row['id']): ?>
<a class="edit-btn" href="editar_perfil.php">Editar perfil</a>
<?php endif; ?>
</div>
</div>
<?php endforeach; ?>
</div>

<h2 class="section-title" style="margin-top:60px;">👨‍🔧 Servicios</h2>
<div class="feed">
<?php foreach ($servicios as $row): ?>
<div class="card">
<div class="banner">
<?php echo htmlspecialchars($row['servicio']); ?>
</div>

<?php if (!empty($row['foto'])): ?>
<img src="<?php echo htmlspecialchars($row['foto']); ?>">
<?php endif; ?>

<div class="card-content">
<h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
<p><strong>Ubicación:</strong> <?php echo htmlspecialchars($row['ubicacion']); ?></p>
<p><?php echo htmlspecialchars($row['descripcion']); ?></p>

<a class="whatsapp-btn" target="_blank"
href="https://wa.me/<?php echo htmlspecialchars($row['telefono']); ?>">WhatsApp</a>

<?php if ($usuario_tabla === 'servicios' && $usuario_id == $row['id']): ?>
<a class="edit-btn" href="editar_perfil.php">Editar perfil</a>
<?php endif; ?>
</div>
</div>
<?php endforeach; ?>
</div>

<button class="map-btn" onclick="mostrarNotificacion()">📍 Ver mapa</button>

</main>

<div class="notification" id="notif">
⚠ El mapa no está disponible por ahora.
</div>

<script>
function mostrarNotificacion(){
const notif = document.getElementById('notif');
notif.style.display='block';
setTimeout(()=>{notif.style.display='none';},3000);
}
</script>

</body>
</html>
