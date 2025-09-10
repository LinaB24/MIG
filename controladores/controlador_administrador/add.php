<?php
require_once("../../modelos/modelo_administrador/Administradores.php"); 

if ($_POST) {
    $Modelo = new Administradores();

    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Usuario = $_POST["Usuario"];
    $Password = $_POST["Password"];
    $Rol = $_POST["Rol"];

    // Validar que el usuario no contenga espacios
    if (strpos($Usuario, ' ') !== false) {
        echo "<script>
                alert('El nombre de usuario no puede contener espacios');
                window.location='../../pages/pages_administrador/add.php';
              </script>";
        exit();
    }

    // Encriptar la contraseña 
    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);

    $Modelo->add($Nombre, $Apellido, $Usuario, $PasswordHash, $Rol);

    header("Location: ../../pages/pages_administrador/index.php");
} else {
    header("Location: ../../pages/pages_administrador/index.php");
}