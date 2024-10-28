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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_FILES['imagen']['name'];

    if ($imagen) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($imagen);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);
    } else {
        $producto = Producto::obtenerPorId($conexion, $id);
        $imagen = $producto['imagen'];
    }

    Producto::actualizar($conexion, $id, $nombre, $descripcion, $imagen, $precio, $stock);

    header("Location: admin_controlador.php");
    exit();
}
?>
