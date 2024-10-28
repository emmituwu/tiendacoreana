<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../vistas/login.html");
    exit();
}

require '../modelos/Producto.php';
require 'Conexion.php';

$productos = Producto::obtenerTodos($conexion);

// Preparar la información de los productos para la vista
$productosConImagen = [];
foreach ($productos as $producto) {
    $productosConImagen[] = [
        'id' => $producto->id,
        'nombre' => $producto->nombre,
        'descripcion' => $producto->descripcion,
        'imagen' => "../uploads/" . $producto->imagen,
        'precio' => $producto->precio,
        'stock' => $producto->stock
    ];
}

// Almacenar los productos en la sesión para que puedan ser accedidos en la vista
$_SESSION['productos'] = $productosConImagen;

header("Location: ../vistas/admin.php");
exit();
?>
