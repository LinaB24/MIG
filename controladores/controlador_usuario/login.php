<?php
require_once("../Modelo/Usuarios.php");

$Modelo = new Usuarios();

if ($_POST) {
    $Usuario = $_POST["Usuario"];
    $Password = $_POST["Password"];

    if ($Modelo->login($Usuario, $Password)) {
        // Éxito: redirigir al módulo principal
        header("Location: ../../Administradores/Pages/index.php");
    } else {
        // Fallo: mensaje y volver al login
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location='../../login.php';
                </script>";
    }
} else {
    header("Location: ../../login.php");
}
?>
