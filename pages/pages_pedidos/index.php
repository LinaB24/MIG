<?php
$titulo = "Nuevo Pedido";

require_once __DIR__ . '/../../Conexion.php';
include __DIR__ . '/../../pages/pages_layout/menu_admin.php';
include __DIR__ . '/../pages_layout/head.php';

$conn = Conexion::getInstancia()->getConexion();
?>
<link rel="stylesheet" href="../../css/estilosIndexAdmin.css">

<!-- CONTENEDOR PARA MOVER A LA DERECHA -->
<div class="contenido-ajustado">

<h2 class="mb-4">Nuevo Pedido</h2>

<form action="../../controladores/controlador_pedidos/pedidosControllers.php?accion=guardar" method="POST">

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Nombre del Cliente</label>
            <input type="text" name="cliente" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Número de Mesa</label>
            <input type="number" name="mesa" class="form-control" required>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Platos</label>
        <div class="border rounded p-3 bg-white shadow-sm">
            <?php
            $platos = $conn->query("SELECT * FROM platos");
            while ($plato = $platos->fetch(PDO::FETCH_ASSOC)):
            ?>
                <div class="row align-items-center mb-2">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="platos[]" value="<?= $plato['PlatoID'] ?>" id="plato<?= $plato['PlatoID'] ?>">
                            <label class="form-check-label" for="plato<?= $plato['PlatoID'] ?>">
                                <?= $plato['nombre'] ?> <span class="text-muted">($<?= number_format($plato['precio'], 0, ',', '.') ?>)</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="cantidades[<?= $plato['PlatoID'] ?>]" class="form-control cantidad-input" placeholder="Cantidad" min="1" disabled>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="botonera">
        <button type="submit" class="custom-btn">Guardar Pedido</button>
        <a href="../pages_pedidos/listar_pedidos.php" class="custom-btn">Ver Pedidos</a>
    </div>

</form>

</div> <!-- Cierre del contenido-ajustado -->

<script>
    document.querySelectorAll('input[type="checkbox"][name="platos[]"]').forEach(cb => {
        const cantidadInput = cb.closest('.row').querySelector('.cantidad-input');
        cb.addEventListener('change', () => {
            cantidadInput.disabled = !cb.checked;
            if (!cb.checked) cantidadInput.value = '';
        });
    });
</script>

<?php include __DIR__ . '/../pages_layout/footer.php'; ?>
