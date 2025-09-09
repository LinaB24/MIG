<?php
require_once '../../modelos/modelo_existencias/InventarioModel.php';
$modelo = new InventarioModel();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilosIndexAdmin.css">
</head>
<body class="bg-light">
    <h2>Registrar Nuevo Producto</h2>
<div class="container mt-5">
    
    <form method="POST" action="../../controladores/controlador_existencias/InventarioController.php">
        <input type="hidden" name="registrar_producto" value="1">
        <div class="mb-3">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label>Unidad de Medida:</label>
            <input type="text" name="unidad_base" class="form-control" value="kg" readonly>
        </div>
        <button type="submit" class="btn-success">Registrar</button>
    </form>

    <div class="mt-4">
        <h2>Importar Productos desde CSV</h2>
        <form method="POST" action="../../controladores/controlador_existencias/InventarioController.php" enctype="multipart/form-data">
            <input type="hidden" name="importar_csv" value="1">
            <div class="mb-3">
                <label>Seleccionar archivo CSV:</label>
                <input type="file" name="archivo_csv" class="form-control" accept=".csv" required>
            </div>
            <div class="mb-3">
                <small class="text-muted">
                    * El archivo CSV debe tener las siguientes columnas: Nombre, Descripción, Stock<br>
                    * El archivo debe estar separado por comas (,)<br>
                    * Puede crear el archivo en Excel y guardarlo como CSV
                </small>
            </div>
            <button type="submit" class="btn-success">Importar CSV</button>
            <a href="../../ejemplos/plantilla_productos.csv" class="btn btn-outline-secondary">Descargar Plantilla</a>
        </form>
    </div>
</div>
</body>
</html>
