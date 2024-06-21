<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$firebase = (new Factory)
    ->withServiceAccount(__DIR__.'C:\Users\Usuario\Desktop\VII CICLO\PROGRAMACION DE APLICACIONES MOVILES\clave privada firebase\flutter-app-vbtecnologi-firebase-adminsdk-2v7oc-b2ab6fa1c8.json');

$database = $firebase->createDatabase();
?>