<?php
include 'config.php';

//obtenemos todos los productos
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "Select * from productos";
    $result = $con->query($sql);
    $productos = array();

    while($row = $results->fetch_assoc()) {
        array_push($productos, $row);
    }
    echo json_encode($productos);
}

// Añadir un nuevo producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nomprodu'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO Productos (nomprodu, descripcion, precio, stock) VALUES ('$nombre', '$descripcion', $precio, $stock)";
    
    if ($con->query($sql) === TRUE) {
        echo json_encode(["message" => "Producto añadido con éxito"]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $con->error]);
    }
}
?>