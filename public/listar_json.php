<?php
// Establecer encabezados para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Incluir el SDK de Firebase y configuración
require 'vendor/autoload.php';
require 'config.php';

// Obtener una instancia de Firestore
$firestore = $firebas->getFirestore();

// Referencia a la colección "productos" en Firestore
$collection = $firestore->collection('productos');

// Consultar todos los documentos en la colección
$documents = $collection->documents();

// Inicializar un array para almacenar los productos
$productos = array();

// Recorrer los documentos y agregar cada producto al array
foreach ($documents as $document) {
    $producto = $document->data();
    $producto['id'] = $document->id();
    // Agregar el producto al array de productos
    $productos[] = $producto;
}

// Imprimir el array de productos como JSON
echo json_encode($productos);
?>
