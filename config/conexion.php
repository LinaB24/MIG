<?php
class Conexion {
    public static function conectar() {
        try {
            return new PDO("mysql:host=localhost;dbname=reservas_admin", "root", "");
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
