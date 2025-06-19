<?php
require_once("../../modelos/modelo_inventario/Inventario.php");

if ($_POST) {
    $Modelo = new Inventario();

    $id_producto = $_POST["id_producto"];
    $nombre_producto = $_POST["nombre_producto"];
    $existencias = $_POST["existencias"];
    
    $Modelo->update($id_producto, $nombre_producto, $existencias);

    header("Location: ../../pages/pages_inventario/index.php");
} else {
    header("Location: ../../pages/pages_inventario/index.php");
}
?>
