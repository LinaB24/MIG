<?php
require_once("../../Conexion.php");

class Usuarios {
    private $db;

    public function __construct() {
        session_start(); // importante
        $this->db = Conexion::getInstancia()->getConexion();
    }

    public function login($usuario, $password) {
        $sql = "SELECT * FROM tb_administradores WHERE USUARIO = ? AND PASSWORD = ? AND ESTADO = 'Activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario, $password]);
        $result = $stmt->fetch();

        if ($result) {
            $_SESSION["ID"] = $result["ID_USUARIO"];
            $_SESSION["NOMBRE"] = $result["NOMBRE"];
            $_SESSION["PERFIL"] = $result["PERFIL"];
            return true;
        }

        return false;
    }

    public function validateSession() {
        if (!isset($_SESSION["ID"])) {
            header("Location: ../../login.php");
            exit();
        }
    }

    public function getNombre() {
        return $_SESSION["NOMBRE"];
    }

    public function getPerfil() {
        return $_SESSION["PERFIL"];
    }

    public function salir() {
        $_SESSION = [];
        session_destroy();
        header("Location: ../../login.php");
    }
}
?>
