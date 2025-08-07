<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificación de sesión
if (!isset($_SESSION['ID']) || $_SESSION['ID'] !== true) {
    header("Location: ../../pages/pages_login/login.php");
    exit();
}

// Capturamos el nombre del admin desde la sesión
$nombreAdmin = isset($_SESSION['NOMBRE']) ? $_SESSION['NOMBRE'] : 'Invitado';


require_once("../../modelos/modelo_administrador/Administradores.php");
include '../../pages/pages_layout/menu_admin.php';
include '../pages_layout/head.php';

$Modelo = new Administradores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administradores</title>
    <link rel="stylesheet" href="../../css/estilosIndexAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 

<div class="container mt-4">
    <div class="text-center p-3" style="background-color: #4b2c0a; color: white; border-radius: 8px;">
    Bienvenido administrador <strong><?php echo htmlspecialchars($nombreAdmin); ?></strong>
</div>

</div>

<div id="tituloAdmin">
    <h1>Administradores</h1>
</div>


<table border="1" style="width: 60%; margin: 20px auto 0 auto;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Usuario</th>
        <th>Perfil</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    <?php
    $Lista = $Modelo->get();
    if ($Lista !== null) {
        foreach ($Lista as $Admin) {
    ?>
    <tr>
        <td><?php echo $Admin['ID_USUARIO']; ?></td>
        <td><?php echo $Admin['NOMBRE']; ?></td>
        <td><?php echo $Admin['APELLIDO']; ?></td>
        <td><?php echo $Admin['USUARIO']; ?></td>
        <td><?php echo $Admin['PERFIL']; ?></td>
        <td><?php echo $Admin['ESTADO']; ?></td>
        <td>
            <div class="d-flex gap-3">
                <a href="edit.php?Id=<?php echo $Admin['ID_USUARIO']; ?>">Editar</a> |
                <a href="delete.php?Id=<?php echo $Admin['ID_USUARIO']; ?>">Eliminar</a>
            </div>
        </td>
    </tr>
    <?php }} ?>
</table>

<div class="btn-registrarAdministrador">
    <a href="add.php" class="btn-registro">Registrar Administrador</a>
    <a href="../../controladores/controlador_usuario/Salir.php" class="btn-registro">Cerrar sesión</a>
</div>

<?php include '../pages_layout/footer.php'; ?>
</body>
</html>
