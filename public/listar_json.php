<?php
// Establecer encabezados para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Incluir archivo de configuración de la base de datos
include 'config.php';

// Consulta SQL para seleccionar todos los productos
$sql = "SELECT * FROM productos";
$result = $con->query($sql);

// Verificar si se encontraron productos
if ($result) {
    // Inicializar un array para almacenar los productos
    $productos = array();

    // Recorrer los resultados de la consulta y agregar cada producto al array
    while($row = $result->fetch_assoc()) {
        $producto = array(
            "id" => $row["id_producto"],
            "nombre" => $row["nomprodu"],
            "descripcion" => $row["descripcion"],
            "precio" => $row["precio"],
            "stock" => $row["stock"]
        );
        // Agregar el producto al array de productos
        $productos[] = $producto;
    }

    // Imprimir el array de productos como JSON
    echo json_encode($productos);
} else {
    // Si no se encontraron productos, imprimir un mensaje de error como JSON
    echo json_encode(array("message" => "No se encontraron productos"));
}

// Cerrar la conexión a la base de datos
$con->close();
?>
