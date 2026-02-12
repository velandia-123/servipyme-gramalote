<?php
// conexion.php
// Conexión a MySQL

$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // en XAMPP normalmente es vacío
$db_name = 'registro_negocios'; // asegúrate de usar tu BD

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
