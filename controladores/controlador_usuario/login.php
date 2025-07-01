<?php
require_once("../../modelos/modelo_administrador/Administradores.php");
session_start();

if ($_POST) {
    $usuario = $_POST["usuario"] ?? $_POST["Usuario"] ?? '';
    $password = $_POST["password"] ?? $_POST["Password"] ?? '';

    $Modelo = new Administradores();

    if ($Modelo->login($usuario, $password)) {
        header("Location: ../../pages/pages_administrador/index.php");
        exit;
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location='../../pages/pages_login/login.php';
                </script>";
        exit;
    }
} else {
    header("Location: ../../pages/pages_login/login.php");
    exit;
}
?>