<?php
require_once("../../modelos/modelo_administrador/Administradores.php");

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_POST) {
    $usuario = $_POST["usuario"] ?? '';
    $password = $_POST["password"] ?? '';
    
    // Validar que el usuario no contenga espacios
    if (strpos($usuario, ' ') !== false) {
        header("Location: ../../pages/pages_login/login.php?error=El nombre de usuario no puede contener espacios");
        exit();
    }

    $Modelo = new Administradores();
    $resultado = $Modelo->login($usuario, $password);

    if ($resultado) {
        // Establecer variables de sesión
        $_SESSION['ID'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tiempo'] = time();
        
        // Redirigir al panel de administración
        header("Location: ../../pages/pages_administrador/index.php");
        exit();
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location='../../pages/pages_login/login.php';
              </script>";
        exit();
    }
}