<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../../assets/estilos.css">
</head>
<body>
    <h1>Registrar Producto en Inventario</h1>
    
    <form method="POST" action="../../controladores/controlador_inventario/add.php">
    Nombre del producto: <input type="text" name="nombre_producto" required><br><br>
    Existencias: <input type="number" name="existencias" required><br><br>
    <input type="submit" value="Guardar">
    </form>

</body>
</html>
