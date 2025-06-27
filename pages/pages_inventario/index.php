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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<body>
    <h1>Bienvenido al inventario</h1>
    <a href="../pages_administrador/index.php">Ir al menú principal</a> <br><br>
    <h2>Inventario</h2>

    <a href="add.php">Agregar nuevo producto</a><br><br>

    <table border="1" id="tabla-inventario">
        <thead>
        <tr>
            <th>ID Producto</th>
            <th>Nombre producto</th>
            <th>Existencias</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-inventario').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                lengthMenu: [ [5, 10, 15, 20], [5, 10, 15, 20] ]
            });
        });
    </script>
</body>
</html>