<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $id = $data->id;

    // Verificar si el ID del producto es válido
    if (!is_numeric($id) || $id <= 0) {
        http_response_code(400); // Solicitud incorrecta
        $response = array("error" => "ID de producto no válido");
        echo json_encode($response);
        exit;
    }

    // Eliminar el producto
    $delete = "DELETE FROM Productos WHERE id_producto='$id'";
    if ($con->query($delete) === TRUE) {
        $response = array("message" => "Producto eliminado");
        echo json_encode($response);
    } else {
        $response = array("error" => "Error al eliminar el producto: " . $con->error);
        echo json_encode($response);
    }

    $con->close();
} else {
    // Si la solicitud no es de tipo DELETE, devolver un error
    http_response_code(405); // Método no permitido
    $response = array("error" => "Método no permitido");
    echo json_encode($response);
}
?>
