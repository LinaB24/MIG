<?php
require_once '../../modelos/modelo_existencias/InventarioModel.php';

if (isset($_POST['registrar_producto'])) {
    try {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $stock = $_POST['stock'];

        $modelo = new InventarioModel();
        $modelo->registrarProducto($nombre, $descripcion, $stock);
        
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

// Manejo de importación de CSV
if (isset($_POST['importar_csv'])) {
    try {
        if (!isset($_FILES['archivo_csv']) || $_FILES['archivo_csv']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("❌ Error al subir el archivo.");
        }

        $archivo = $_FILES['archivo_csv']['tmp_name'];
        $handle = fopen($archivo, "r");
        
        if ($handle === false) {
            throw new Exception("❌ No se pudo abrir el archivo.");
        }

        $modelo = new InventarioModel();
        $productos_importados = 0;
        $primera_fila = true;

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Saltamos la primera fila (encabezados)
            if ($primera_fila) {
                $primera_fila = false;
                continue;
            }

            if (count($data) >= 3) {
                $nombre = trim($data[0]);
                $descripcion = trim($data[1]);
                $stock = (float)trim($data[2]);

                if (!empty($nombre)) {
                    $modelo->registrarProducto($nombre, $descripcion, $stock);
                    $productos_importados++;
                }
            }
        }

        fclose($handle);

        header("Location: ../../pages/pages_existencias/index.php?mensaje=importacion_exitosa&cantidad=" . $productos_importados);
        exit;
    } catch (Exception $e) {
        header("Location: ../../pages/pages_existencias/index.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}