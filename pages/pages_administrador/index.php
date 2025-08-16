<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificación de sesión
if (!isset($_SESSION['ID']) || $_SESSION['ID'] !== true) {
    header("Location: ../../pages/pages_login/login.php");
    exit();
}

// Capturamos el nombre del admin desde la sesión
$nombreAdmin = isset($_SESSION['NOMBRE']) ? $_SESSION['NOMBRE'] : 'Invitado';

require_once("../../modelos/modelo_administrador/Administradores.php");
require_once("../../modelos/modelo_dashboard/Dashboard.php"); // ← Aquí agregamos el dashboard

include '../../pages/pages_layout/menu_admin.php';
include '../pages_layout/head.php';

// Instancias de las clases
$Modelo = new Administradores();
$dashboard = new Dashboard();

// Obtenemos datos
$totalUsuarios = $dashboard->getUsuariosRegistrados();
$totalReservas = $dashboard->getReservasRegistradas();
$totalPlatos = $dashboard->getPlatosVendidos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administradores</title>
    <link rel="stylesheet" href="../../css/estilosIndexAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 

<div class="container mt-4">
    <div class="text-center p-3" style="background-color: #4b2c0a; color: white; border-radius: 8px;">
        Bienvenido administrador <strong><?php echo htmlspecialchars($nombreAdmin); ?></strong>
    </div>
</div>

<!-- <div id="tituloAdmin">
    <h1>Administradores</h1>
</div> -->

<!-- Intento 1 de dashboard-->
 <div class="container mt-5">
    <h2 class="mb-4">Panel de Administración</h2>

    <div class="row">
        <!-- Total de reservas de hoy -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:rgb(80, 48, 27);">
                <div class="card-body">
                    <h5 class="card-title">Usuarios Registrados</h5>
                    <p class="card-text display-5"><?= $totalUsuarios ?></p>
                </div>
            </div>
        </div>

        <!-- Mesas disponibles -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color:rgb(171, 96, 46);">
                <div class="card-body">
                    <h5 class="card-title">Reservas Registradas</h5>
                    <p class="card-text display-5"><?= $totalReservas ?></p>
                </div>
            </div>
        </div>

        
        <!-- Total de mesas -->
        <div class="col-md-4">
            <div  class="card text-white mb-3" style="background-color: #6e4b34;">
                <div  class="card-body">
                    <h5 class="card-title">Platos vendidos</h5>
                    <p class="card-text display-5"><?= $totalPlatos ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="btn-registrarAdministrador">
    <a href="add.php" class="btn-registro">Lista y Registro de Usuarios</a>
</div>
<?php include '../pages_layout/footer.php'; ?>

</body>
</html>
