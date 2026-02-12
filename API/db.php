<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "registro_negocios"; // cambia si tu BD tiene otro nombre

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}
?>
