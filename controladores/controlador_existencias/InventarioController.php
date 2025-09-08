<?php
require_once '../../modelos/modelo_existencias/InventarioModel.php';

if (isset($_POST['registrar_producto'])) {
    try {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $stock = $_POST['stock'];

        $modelo = new InventarioModel();
        $modelo->registrarProducto($codigo, $nombre, $descripcion, $stock);
        
        header("Location: ../../pages/pages_existencias/index.php?mensaje=producto_registrado");
        exit;
    } catch (Exception $e) {
        header("Location: formulario_registro.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}

if (isset($_POST['registrar'])) {
    $producto_id = $_POST['producto_id'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    $modelo = new InventarioModel();
    $modelo->registrarMovimiento($producto_id, $tipo, $cantidad, $observaciones);
    header("Location: ../../pages/pages_existencias/index.php?mensaje=movimiento_registrado");
    exit;
}

// Opción para eliminar producto
if (isset($_POST['eliminar_producto'])) {
    try {
        $producto_id = $_POST['producto_id'];
        $modelo = new InventarioModel();
        $modelo->eliminarProducto($producto_id);
        header("Location: ../../pages/pages_existencias/index.php?mensaje=producto_eliminado");
        exit;
    } catch (Exception $e) {
        header("Location: ../../pages/pages_existencias/index.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}

// 🚀 Carga masiva CSV
if (isset($_POST['cargar_csv'])) {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $ruta = $_FILES['archivo']['tmp_name'];
        
        if (($gestor = fopen($ruta, "r")) !== false) {
            $modelo = new InventarioModel();

            // Leer primera fila (encabezados) y descartarla
            fgetcsv($gestor, 1000, ",");

            while (($datos = fgetcsv($gestor, 1000, ",")) !== false) {
                if (count($datos) < 4) continue; // prevenir errores

                $codigo = trim($datos[0]);
                $nombre = trim($datos[1]);
                $descripcion = trim($datos[2]);
                $stock = (int) $datos[3];

                if (!empty($codigo) && !empty($nombre)) {
                    $modelo->registrarProducto($codigo, $nombre, $descripcion, $stock);
                }
            }
            fclose($gestor);
        }
    }
    header("Location: ../../pages/pages_existencias/index.php?msg=ok");
    exit;
}
