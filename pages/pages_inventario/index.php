<?php
require_once("../../modelos/modelo_inventario/Inventario.php");
$Modelo = new Inventario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../assets/estilos.css">
</head>
<body>
    <h1>Bienvenido al inventario</h1>
    <a href="../pages_administrador/index.php">Ir al menú principal</a> <br><br>
    <h2>Inventario</h2>

    <a href="add.php">Agregar nuevo producto</a><br><br>

    <table border="1">
        <tr>
            <th>ID Producto</th>
            <th>Nombre producto</th>
            <th>Existencias</th>
            <th>Acciones</th>
        </tr>

        <?php
        $Lista = $Modelo->get();
        if ($Lista !== null) {
            foreach ($Lista as $Item) {
        ?>
        <tr>
            <td><?php echo $Item['id_producto']; ?></td>
            <td><?php echo $Item['nombre_producto']; ?></td>
            <td><?php echo $Item['existencias']; ?></td>
            <td>
                <a href="edit.php?Id=<?php echo $Item['id_producto']; ?>">Editar</a> |
                <a href="delete.php?Id=<?php echo $Item['id_producto']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php }} ?>
    </table>
</body>
</html>
