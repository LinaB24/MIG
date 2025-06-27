<?php

class Inventario {

    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "db_mig_unificada");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function get() {
        $sql = "SELECT * FROM tb_inventario";
        $resultado = $this->conexion->query($sql);
        $datos = [];
    
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $datos[] = $fila;
            }
        }
    
        return $datos;
    }

    public function insertar($nombre_producto, $existencias) {
        $sql = "INSERT INTO tb_inventario (nombre_producto, existencias) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
    
        if (!$stmt) {
            die("Error en prepare(): " . $this->conexion->error);
        }
    
        $stmt->bind_param("si", $nombre_producto, $existencias);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminar($id_producto) {
        $stmt = $this->conexion->prepare("DELETE FROM tb_inventario WHERE id_producto = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error en la preparación: " . $this->conexion->error;
        }
    }

    public function getById($id_producto) {
        $stmt = $this->conexion->prepare("SELECT * FROM tb_inventario WHERE id_producto = ?");
        if (!$stmt) {
            die("Error en prepare(): " . $this->conexion->error);
        }

        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();
        $stmt->close();
        return $producto;
    }



    public function update($id_producto, $nombre_producto, $existencias) {
        $stmt = $this->conexion->prepare("UPDATE tb_inventario SET nombre_producto = ?, existencias = ? WHERE id_producto = ?");
        if (!$stmt) {
            die("Error en prepare(): " . $this->conexion->error);
        }

        $stmt->bind_param("sii", $nombre_producto, $existencias, $id_producto);
        $stmt->execute();
        $stmt->close();
    }
}

