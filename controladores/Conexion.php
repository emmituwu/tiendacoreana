<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$BD = "ticore";

// Creando la conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $BD);

// Verificando la conexión
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
?>
