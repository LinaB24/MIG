<?php
require_once("../../Conexion.php");

class Dashboard {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstancia()->getConexion();
    }

    public function getUsuariosRegistrados() {
        // Cambia a "usuarios" si quieres contar clientes en vez de administradores
        $query = "SELECT COUNT(*) AS total FROM tb_administradores";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getReservasRegistradas() {
        $query = "SELECT COUNT(*) AS total FROM reservas";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getPlatosVendidos() {
        $query = "SELECT SUM(Cantidad) AS total FROM platos_pedido";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
