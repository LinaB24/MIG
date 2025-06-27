<?php
class Plato {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    public function obtenerPlatos() {
        $result = $this->conn->query("SELECT * FROM platos");
        $platos = [];
        while ($fila = $result->fetch_assoc()) {
            $platos[] = $fila;
        }
        return $platos;
    }
}
