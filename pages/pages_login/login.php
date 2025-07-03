<?php
session_start();
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión MIG</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <style>
        .error { color: red; }
        .login-container { max-width: 400px; margin: 60px auto; padding: 2em; border-radius: 8px; background: #fff; box-shadow: 0 0 10px #ccc; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bienvenido a MIG</h1>
        <p>Por favor, inicia sesión para continuar</p>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="../../controladores/controlador_login/login.php?accion=login" method="POST" id="loginForm" autocomplete="off">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required placeholder="Ingresa tu usuario"><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña"><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p><a href="../pages_reservas/recuperar.php">¿Olvidaste tu contraseña?</a></p>
    </div>
    <script>
    document.getElementById('loginForm').onsubmit = function() {
        const usuario = document.getElementById('usuario').value.trim();
        const pass = document.getElementById('password').value.trim();
        if (usuario.length < 3) {
            alert('El usuario debe tener al menos 3 caracteres.');
            return false;
        }
        if (pass.length < 4) {
            alert('La contraseña debe tener al menos 5 caracteres.');
            return false;
        }
        return true;
    }
    </script>
</body>
</html>