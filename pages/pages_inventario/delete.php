<?php $id_producto = $_GET['Id']; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="../../assets/estilos.css">
</head>
<body>
    <h1>Eliminar Producto del Inventario</h1>
    <form method="POST" action="../../controladores/controlador_inventario/delete.php">
        <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
        <p>¿Estás seguro que deseas eliminar este producto del inventario?</p>
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
