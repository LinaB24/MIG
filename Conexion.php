<?php
class Conexion {
    private static $instancia = null;
    private $db;

    private $driver = "mysql";
    private $host = "localhost";
    private $bd = "db_mig_unificada";
    private $usuario = "root";
    private $contrasena = "";

    private function __construct() {
        try {
            $this->db = new PDO("{$this->driver}:host={$this->host};dbname={$this->bd}",
                $this->usuario, $this->contrasena);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function getConexion() {
        return $this->db;
    }
}
?>
