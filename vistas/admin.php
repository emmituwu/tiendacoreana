<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit();
}

$productosConImagen = isset($_SESSION['productos']) ? $_SESSION['productos'] : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="title-box">
        <h1>Admin Panel</h1>
        <div style="text-align: center;">
            <a href="../index.php"><button>Volver al Menu</button></a>
            <a href="crear_producto.html"><button>Crear Producto</button></a>
            <a href="modificar_producto.html"><button>Modificar Producto</button></a>
            <a href="eliminar_producto.html"><button>Eliminar Producto</button></a>
            <a href="../controladores/logout.php"><button>Log Out</button></a>
        </div>
    </div>
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?= $_SESSION['mensaje'] ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>
    <div id="product-list">
        <?php if (!empty($productosConImagen)): ?>
            <?php foreach ($productosConImagen as $producto): ?>
                <div class="card">
                    <h1>ID: <?= htmlspecialchars($producto['id']) ?> - <?= htmlspecialchars($producto['nombre']) ?></h1>
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <p class="price">$<?= htmlspecialchars($producto['precio']) ?></p>
                    <p><?= htmlspecialchars($producto['descripcion']) ?></p>
                    <p>Stock: <?= htmlspecialchars($producto['stock']) ?></p>
                    <form method="post" action="../controladores/eliminar_producto.php" onsubmit="return confirm('Seguro desea eliminar este producto?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                    <form method="get" action="modificar_producto.html">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                        <button type="submit">Modificar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
