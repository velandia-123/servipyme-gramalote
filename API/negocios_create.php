<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once __DIR__ . "/db.php";

// Leer datos JSON enviados desde Postman
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["error" => "No se recibieron datos"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO negocios (nombre, categoria, descripcion, direccion, municipio, telefono, email, web, contrasena, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "ssssssssss",
    $data["nombre"],
    $data["categoria"],
    $data["descripcion"],
    $data["direccion"],
    $data["municipio"],
    $data["telefono"],
    $data["email"],
    $data["web"],
    $data["contrasena"],
    $data["foto"]
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al insertar: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
