<?php
require_once("../../modelos/modelo_inventario/Inventario.php");
$Modelo = new Inventario();

$Id = $_GET['Id'];
$Producto = $Modelo->getById($Id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../assets/estilos.css">
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="POST" action="../../controladores/controlador_inventario/edit.php">   

        <input type="hidden" name="id_producto" value="<?php echo $Id; ?>">

        <?php if ($Producto) { ?>
            Nombre del producto: <br>
            <input type="text" name="nombre_producto" value="<?php echo $Producto['nombre_producto']; ?>" required><br><br>

            Existencias: <br>
            <input type="number" name="existencias" value="<?php echo $Producto['existencias']; ?>" required><br><br>
        <?php } else { echo "<p>Producto no encontrado.</p>"; } ?>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
