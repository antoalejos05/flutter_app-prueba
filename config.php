<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$bd = "vbtecnologi";

//creamos la conexion
$con = new mysqli($servidor,$usuario,$contraseña,$bd);

//verificamos la conexion
if ($con->connect_error) {
    die("Conexion Fallida: " . $con->connect_error);
}
?>