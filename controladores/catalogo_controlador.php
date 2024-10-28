<?php
session_start();

require '../modelos/Producto.php';
require 'Conexion.php';

$productos = Producto::obtenerTodos($conexion);

$productosConImagen = [];
foreach ($productos as $producto) {
    $productosConImagen[] = [
        'nombre' => $producto->nombre,
        'descripcion' => $producto->descripcion,
        'imagen' => "../uploads/" . htmlspecialchars($producto->imagen),
        'precio' => $producto->precio,
        'stock' => $producto->stock
    ];
}

$_SESSION['productos_catalogo'] = $productosConImagen;

header("Location: ../vistas/catalogo.php");
exit();
?>
