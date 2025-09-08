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
    
    <form method="POST" action="../../controladores/controlador_existencias/InventarioController.php" enctype="multipart/form-data">
    
    <input type="hidden" name="registrar_producto" value="1">

    <div class="mb-3">
        <label>Código del Producto:</label>
        <input type="text" name="codigo" class="form-control" required>
    </div>

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

    <button type="submit" class="btn btn-success">Registrar</button>
</form>

<hr>

<!-- 🚀 Nuevo: Botón para cargar CSV -->
<h5>Carga masiva de productos (CSV)</h5>
<form method="POST" action="../../controladores/controlador_existencias/InventarioController.php" enctype="multipart/form-data">
    <input type="hidden" name="cargar_csv" value="1">

    <div class="mb-3">
        <input type="file" name="archivo" class="form-control" accept=".csv" required>
    </div>

    <button type="submit" class="btn btn-primary">Subir CSV</button>
</form>

</div>
</body>
</html>
