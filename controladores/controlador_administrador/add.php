
<?php

require_once("../../modelos/modelo_administrador/Administradores.php"); 

if ($_POST) {
    $Modelo = new Administradores();

    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Usuario = $_POST["Usuario"];
    $Password = $_POST["Password"];

    $Modelo->add($Nombre, $Apellido, $Usuario, $Password);

    header("Location: ../../pages/pages_administrador/index.php");
} else {
    header("Location: ../../pages/pages_administrador/index.php");
}

?>