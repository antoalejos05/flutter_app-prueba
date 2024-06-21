<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');

include 'config.php'; 

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nomprodu']) && isset($data['descripcion']) && isset($data['precio']) && isset($data['stock'])) {
    $nomprodu = $data['nomprodu'];
    $descripcion = $data['descripcion'];
    $precio = $data['precio'];
    $stock = $data['stock'];

    $sql = "INSERT INTO Productos (nomprodu, descripcion, precio, stock) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssdi", $nomprodu, $descripcion, $precio, $stock);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Producto creado exitosamente"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error al crear el producto: " . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos"
    ]);
}

$con->close();
?>
