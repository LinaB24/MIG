<?php
require_once '../../controladores/controlador_existencias/InventarioController.php';
require_once '../../modelos/modelo_existencias/InventarioModel.php';

$modelo = new InventarioModel();
$productos = $modelo->obtenerInventario();
$movimientos = $modelo->obtenerMovimientos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { margin-top: 40px; }
    </style>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>

    <h1>Registro de Existencias</h1>

    <?php include 'formulario.php'; ?>

    <h2>Existencias actuales</h2>
    <table>
        <tr><th>Producto</th><th>Stock</th></tr>
        <?php foreach ($productos as $p): ?>
            <tr><td><?= $p['nombre'] ?></td><td><?= $p['stock'] ?></td></tr>
        <?php endforeach; ?>
    </table>

    <h2>Movimientos recientes</h2>
    <table id="tabla-movimientos">
        <thead>
            <tr><th>Producto</th><th>Tipo</th><th>Cantidad</th><th>Fecha</th><th>Obs</th></tr>
        </thead>
        <tbody>
        <?php foreach ($movimientos as $m): ?>
            <tr>
                <td><?= $m['nombre'] ?></td>
                <td><?= ucfirst($m['tipo']) ?></td>
                <td><?= $m['cantidad'] ?></td>
                <td><?= $m['fecha'] ?></td>
                <td><?= $m['observaciones'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button>
        <a href="../pages_administrador/index.php">Volver al inicio</a>
    </button>

    <script>
    $(document).ready(function() {
        $('#tabla-movimientos').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            lengthMenu: [ [5, 10, 15, 20, -1], [5, 10, 15, 20, "Todos"] ]
        });
    });
</script>

</body>
</html>