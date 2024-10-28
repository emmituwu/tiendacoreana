<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header-box">
        <img src="stamp.jpg" alt="Imagen Lado Izquierdo" class="side-image left">
        <h1 id="name">모던 필</h1>
        <img src="corazoncor.png" alt="Imagen Lado Derecho" class="side-image right">
        <h2>Bienvenido a Modern Feel</h2>
        <h3 id="impor">Productos originales importados de Corea</h3>
        <div style="text-align: center;">
        <a href="controladores/catalogo_controlador.php"><button>Ver Catálogo</button></a>
        <?php if (isset($_SESSION['admin'])): ?>
            <a href="controladores/admin_controlador.php"><button>Panel de Administración</button></a>
        <?php else: ?>
            <a href="controladores/admin_controlador.php"><button>Iniciar Sesión como Administrador</button></a>
        <?php endif; ?>
    </div>
        <h3 id="contactTitle">Contacto:</h3>
        <div class="contact">
            <p>Dirección: Calle Falsa 123</p>
            <p>Teléfono: +1 234 567 890</p>
            <p>Email: contacto@tienda.com</p>
        </div>
    </div>
    
</body>
</html>
