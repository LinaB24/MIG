
<?php
require_once("../../modelos/modelo_administrador/Administradores.php");
$Modelo = new Administradores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administradores</title>
    <link rel="stylesheet" href="../../assets/estilos.css">
    <link rel="stylesheet" href="../../assets/estilos.css">

</head>
<body>
    <h1>Administradores</h1>
    <a href="add.php">Registrar Administrador</a><br><br>
    <a href="../pages_empleado/index.php">Ver empleados</a><br><br>
    <a href="../pages_inventario/index.php">Ir a inventario</a>
    <table border="1">
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
                <a href="edit.php?Id=<?php echo $Admin['ID_USUARIO']; ?>">Editar</a> |
                <a href="delete.php?Id=<?php echo $Admin['ID_USUARIO']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php }} ?>
    </table>
</body>
</html>
