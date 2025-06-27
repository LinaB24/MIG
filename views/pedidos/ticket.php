<?php
$titulo = "Ticket del Pedido";
include __DIR__ . '/../layout/head.php';
require_once '../../config/db.php';

if (!isset($_GET['id'])) {
    echo "No se proporcionó un ID de pedido.";
    exit;
}

//pedido especifico
$pedidoId = $_GET['id'];

// Obtener información del pedido
$stmt = $conn->prepare("SELECT * FROM pedidos WHERE PedidoID = ?");
$stmt->bind_param("i", $pedidoId);
$stmt->execute();
$pedido = $stmt->get_result()->fetch_assoc();

if (!$pedido) {
    echo "Pedido no encontrado.";
    exit;
}

// Obtener los platos del pedido
$stmt = $conn->prepare("
    SELECT p.nombre, p.precio, pp.Cantidad
    FROM platos_pedido pp
    INNER JOIN platos p ON pp.PlatoID = p.PlatoID
    WHERE pp.PedidoID = ?
");
$stmt->bind_param("i", $pedidoId);
$stmt->execute();
$platos = $stmt->get_result();
?>

<div class="container mt-5 ticket-container">
    <h2 class="mb-4">Ticket del Pedido</h2>
    <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['Cliente']) ?></p>
    <p><strong>Mesa:</strong> <?= htmlspecialchars($pedido['Mesa']) ?></p>
    <p><strong>Fecha y hora:</strong> <?= $pedido['FechaHora'] ?></p>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Plato</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($plato = $platos->fetch_assoc()):
                $subtotal = $plato['precio'] * $plato['Cantidad'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($plato['nombre']) ?></td>
                    <td><?= $plato['Cantidad'] ?></td>
                    <td>$<?= number_format($plato['precio'], 0, ',', '.') ?> COP</td>
                    <td>$<?= number_format($subtotal, 0, ',', '.') ?> COP</td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total del pedido</th>
                <th class="text-success fw-bold">$<?= number_format($total, 0, ',', '.') ?> COP</th>
            </tr>
        </tfoot>
    </table>
    
    <div class="d-flex gap-3 mt-4">
        <a href="/aaaaa/controllers/pedidosControllers.php?accion=crear" class="btn btn-primary">Crear otro pedido</a>
        <a href="/aaaaa/views/pedidos/listar_pedidos.php" class="btn btn-secondary">Ver Pedidos</a>
        <a href="/aaaaa/controllers/pedidosControllers.php?accion=editar&id=<?= $pedidoId ?>" class="btn btn-warning">Editar Pedido</a>
    </div>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>