<?php
require_once("../../controladores/controlador_usuario/validar_sesion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador</title>
    <link rel="stylesheet" href="../../css/formularioAdd.css">
</head>
<body>
    <?php include '../pages_layout/head.php'; ?>
    <h1>Registrar Administrador</h1>
<br><br><br>
    <div class="formularios-contenedor">
        <div class="form-card">
            <h3>Formulario de Registro</h3>
            <form method="POST" action="../../controladores/controlador_administrador/add.php">
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="Nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="Apellido" required>

                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="Usuario" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="Password" required>

                <input type="submit" value="Registrar">
            </form>

            <!-- Botón para volver -->
            <a href="index.php" class="btn-volver">Volver a la lista de administradores</a>
        </div>
    </div>
    <?php include '../pages_layout/footer.php'; ?>

</body>
</html>
