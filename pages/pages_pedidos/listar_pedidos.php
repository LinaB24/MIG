<?php

$titulo = "Lista de Pedidos";
include __DIR__ . '/../pages_layout/head.php';

require_once '../../Conexion.php';
$conn = Conexion::getInstancia()->getConexion();

$pedidos = $conn->query("SELECT * FROM pedidos ORDER BY PedidoID DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/listar_pedidos.css">
</head>

<body class="bg-light">
    <div class="container pedidos-contenedor mt-5">
        <h2>Lista de Pedidos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Mesa</th>
                    <th>Fecha y hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = $pedidos->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $pedido['PedidoID'] ?></td>
                        <td><?= htmlspecialchars($pedido['Cliente']) ?></td>
                        <td><?= $pedido['Mesa'] ?></td>
                        <td><?= $pedido['FechaHora'] ?></td>
                        <td>
                            <a href="ticket.php?id=<?= $pedido['PedidoID'] ?>" class="btn btn-sm btn-primary">Ver ticket</a>
                            <a href="../../controladores/controlador_pedidos/pedidosControllers.php?accion=editar&id=<?= $pedido['PedidoID'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="../../controladores/controlador_pedidos/pedidosControllers.php?accion=eliminar&id=<?= $pedido['PedidoID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás segura de eliminar este pedido?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-success mt-3">Crear nuevo pedido</a>
    </div>
</body>
</html>