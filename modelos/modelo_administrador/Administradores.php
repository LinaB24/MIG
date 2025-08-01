<?php
require_once("../../Conexion.php");

class Administradores {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstancia()->getConexion();
    }

    public function add($nombre, $apellido, $usuario, $password) {
        $sql = "INSERT INTO tb_administradores (NOMBRE, APELLIDO, USUARIO, PASSWORD) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $apellido, $usuario, $password]);
    }

    public function get() {
        $sql = "SELECT * FROM tb_administradores";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM tb_administradores WHERE ID_USUARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nombre, $apellido, $usuario, $password, $estado) {
        $sql = "UPDATE tb_administradores SET NOMBRE=?, APELLIDO=?, USUARIO=?, PASSWORD=?, ESTADO=? WHERE ID_USUARIO=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $apellido, $usuario, $password, $estado, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM tb_administradores WHERE ID_USUARIO = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
