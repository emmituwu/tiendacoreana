<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../vistas/login.html");
    exit();
}

require '../modelos/Producto.php';
require 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $admin_id = $_SESSION['admin'];

    // Manejo de la imagen
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

    // Guardar la ruta de la imagen en la base de datos
    $imagen = basename($_FILES["imagen"]["name"]);

    Producto::crear($conexion, $nombre, $descripcion, $imagen, $precio, $stock, $admin_id);

    header("Location: admin_controlador.php");
    exit();
}
?>
