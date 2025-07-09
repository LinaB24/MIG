<?php
require_once '../../modelos/modelo_existencias/InventarioModel.php';

if (isset($_POST['registrar'])) {
    $producto_id = $_POST['producto_id'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    $modelo = new InventarioModel();
    $modelo->registrarMovimiento($producto_id, $tipo, $cantidad, $observaciones);
    header("Location: index.php?mensaje=registrado");
    exit;
}
