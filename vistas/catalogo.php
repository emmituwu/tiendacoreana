<?php
session_start();

if (!isset($_SESSION['productos_catalogo'])) {
    header("Location: ../controladores/catalogo_controlador.php");
    exit();
}

$productosConImagen = $_SESSION['productos_catalogo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catalogo</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="title-box">
        <h1>Catálogo</h1>
        <a href="../index.php"><button>Volver al Inicio</button></a>
    </div>
    <div id="product-list">
        <?php if (!empty($productosConImagen)): ?>
            <?php foreach ($productosConImagen as $producto): ?>
                <div class="card">
                    <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <p class="price">$<?= htmlspecialchars($producto['precio']) ?></p>
                    <p><?= htmlspecialchars($producto['descripcion']) ?></p>
                    <p>Stock: <?= htmlspecialchars($producto['stock']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
