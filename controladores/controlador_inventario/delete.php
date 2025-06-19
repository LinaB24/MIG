<?php
require_once("../../modelos/modelo_inventario/Inventario.php");

$Modelo = new Inventario();

if (isset($_POST['id_producto'])) {
    $Modelo->eliminar($_POST['id_producto']);
    header("Location: ../../pages/pages_inventario/index.php");
}
