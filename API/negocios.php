<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . "/db.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT id, nombre, categoria, descripcion, direccion, municipio, telefono, email, web, foto, fecha_registro FROM negocios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Negocio no encontrado"]);
    }
    $stmt->close();
} else {
    $sql = "SELECT id, nombre, categoria, descripcion, direccion, municipio, telefono, email, web, foto, fecha_registro FROM negocios ORDER BY id DESC";
    $res = $conn->query($sql);
    $data = [];
    while ($row = $res->fetch_assoc()) { $data[] = $row; }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
$conn->close();
?>
