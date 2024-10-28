<?php
session_start();
require '../modelos/Administrador.php';
require 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $admin = Administrador::autenticar($conexion, $usuario, $contrasena);
    if ($admin) {
        $_SESSION['admin'] = $admin['id'];
        header("Location: admin_controlador.php");
        exit();
    } else {
        //$_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
        header("Location: ../vistas/login.html");
        exit();
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
