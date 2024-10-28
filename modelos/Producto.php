<?php
class Producto {
    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $precio;
    public $stock;

    public function __construct($id, $nombre, $descripcion, $imagen, $precio, $stock) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->precio = $precio;
        $this->stock = $stock;
    }


    
    public static function obtenerTodos($conn) {
        $productos = [];
        $result = $conn->query("SELECT * FROM producto");
        while ($row = $result->fetch_assoc()) {
            $productos[] = new Producto($row['id'], $row['nombre'], $row['descripcion'], $row['imagen'], $row['precio'], $row['stock']);
        }
        return $productos;
    }

    public static function crear($conn, $nombre, $descripcion, $imagen, $precio, $stock, $admin_id) {
        $stmt = $conn->prepare("INSERT INTO producto (nombre, descripcion, imagen, precio, stock, administrador_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdii", $nombre, $descripcion, $imagen, $precio, $stock, $admin_id);
        return $stmt->execute();
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM producto WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function actualizar($conn, $id, $nombre, $descripcion, $imagen, $precio, $stock) {
        $stmt = $conn->prepare("UPDATE producto SET nombre = ?, descripcion = ?, imagen = ?, precio = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("sssdii", $nombre, $descripcion, $imagen, $precio, $stock, $id);
        return $stmt->execute();
    }

    public static function eliminar($conn, $id) {
        // Obtener el producto para obtener el nombre de la imagen
        $producto = self::obtenerPorId($conn, $id);
        if ($producto) {
            $imagen = $producto['imagen'];
            $stmt = $conn->prepare("DELETE FROM producto WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                // Eliminar la imagen del sistema de archivos
                $rutaImagen = "../uploads/" . $imagen;
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
                return true;
            }
        }
        return false;
    }
}
?>
