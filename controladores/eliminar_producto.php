<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../vistas/login.html");
    exit();
}

require '../modelos/Producto.php';
require 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    Producto::eliminar($conexion, $id);
    
    // Redirigir a admin_controlador.php después de eliminar el producto
    header("Location: admin_controlador.php");
    exit();
}
?>
