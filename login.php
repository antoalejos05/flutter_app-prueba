<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');

include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$usuario = $data['usuario'];
$contraseña = $data['contraseña'];

$sql = "SELECT * FROM Usuarios WHERE usuario = '$usuario'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($contraseña == $row['contraseña']) {
        echo json_encode([
            "status" => "success",
            "message" => "Inicio de sesión exitoso",
            ]
        );
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Contraseña incorrecta"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Usuario no encontrado"
    ]);
}

$con->close();
?>
