<h2>Registrar Movimiento</h2>

<form action="../../controladores/controlador_existencias/InventarioController.php" method="post">
    <label>Producto:</label>
    <select name="producto_id" required>
        <option value="">Seleccione un producto</option>
        <?php foreach ($productos as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tipo:</label>
    <select name="tipo">
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
    </select>

    <label>Cantidad:</label>
    <input type="number" name="cantidad" required min="1">

    <label>Observaciones:</label>
    <textarea name="observaciones"></textarea>

    <button type="submit" name="registrar" class="btn-success">Registrar Movimiento</button>
</form>
