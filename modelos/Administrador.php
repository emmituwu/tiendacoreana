<?php
class Administrador {
    public static function autenticar($conn, $usuario, $contrasena) {
        $stmt = $conn->prepare("SELECT * FROM administrador WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $admin = $result->fetch_assoc();
        $stmt->close();

        if ($admin && password_verify($contrasena, $admin['contrasena'])) {
            return $admin;
        } else {
            return false;
        }
    }
}
?>
