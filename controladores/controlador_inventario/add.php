<?php
require_once("../../modelos/modelo_inventario/Inventario.php");

if (isset($_POST['nombre_producto']) && isset($_POST['existencias'])) {

    $nombre = $_POST['nombre_producto'];
    $existencias = $_POST['existencias'];

    $modelo = new Inventario();
    $modelo->insertar($nombre, $existencias);

    header("Location: ../../pages/pages_inventario/index.php"); // redirige después de guardar
    exit();

} else {
    echo "Faltan datos del formulario.";
}
