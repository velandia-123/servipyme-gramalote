<?php
// Iniciar la sesión (por si no está iniciada aún)
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];
session_destroy();

// Redirigir al inicio de sesión
header("Location: login.html");
exit();
?>
