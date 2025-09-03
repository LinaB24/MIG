<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? $pageTitle . ' | GRUPO MIG' : 'GRUPO MIG - Sistema' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" href="/assets/logo-negro.png" type="image/png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS global -->
    <link rel="stylesheet" href="/Public/css/global.css">

    <!-- CSS específico de la página -->
    <?php if (isset($customCss)) : ?>
        <link rel="stylesheet" href="/Public/css/<?= $customCss ?>">
    <?php endif; ?>

    <style>
        /* Sidebar oculto inicialmente */
        .sidebar-menu {
            position: fixed;
            top: 0;
            left: -250px; /* oculto */
            width: 250px;
            height: 100%;
            background-color: #4b2c0a;
            padding: 20px;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar-menu h2 {
            color: white;
            margin-bottom: 20px;
        }

        .sidebar-menu a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin: 15px 0;
        }

        .sidebar-menu a:hover {
            color: #ddd;
        }

        /* Contenido */
        .contenido-ajustado {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ======== Navbar / Encabezado ========== -->
<header class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b2c0a; z-index: 1100;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo y título -->
        <div class="d-flex align-items-center">
            <button id="menuToggle" class="btn btn-link text-white me-3" style="font-size: 24px;">
                <i class="fas fa-bars"></i>
            </button>
            <img src="../../assets/logo-negro.png" alt="Logo" width="50" height="50" class="me-2">
            <strong style="color: #ffffff;">Grupo MIG</strong>
        </div>

        <!-- Botón Cerrar sesión -->
        <div class="d-flex align-items-center ms-auto">
            <a href="../../controladores/controlador_usuario/Salir.php" class="btn-registro">Cerrar sesión</a>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebarMenu = document.querySelector('.sidebar-menu');
    const contenido = document.querySelector('.contenido-ajustado');
    let isHidden = true; 

    menuToggle.addEventListener('click', function() {
        if (isHidden) {
            sidebarMenu.style.left = '0';
            if (contenido) contenido.style.marginLeft = '250px';
        } else {
            sidebarMenu.style.left = '-250px';
            if (contenido) contenido.style.marginLeft = '0';
        }
        isHidden = !isHidden;
    });
});
</script>
