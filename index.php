<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto MIG</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">

  <!-- Scroll suave -->
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky">
    <div class="container d-flex justify-content-between align-items-center">

      <!-- Logo y nombre del grupo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
  <img src="assets/logo-negro.png" alt="Logo" width="40" height="40" class="me-2 logo-svg">
  <strong>GRUPO MIG</strong>
</a>

      <!-- Botón colapsable para pantallas pequeñas -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menú de navegación y buscador -->
      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#servicios">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="views/sobre-nosotros.html">Sobre nosotros</a>
          </li>
        </ul>

        <!-- Barra de búsqueda -->
        <form class="d-flex" role="search" onsubmit="redireccionarBusqueda(); return false;">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" id="buscador">
          <button class="nav-link btn p-0" type="submit" style="background: none; border: none;">Buscar</button>
        </form>

        <!-- Botón separado -->
        <a class="nav-link" href="views/login.html">Iniciar sesión</a>
      </div>

    </div>
  </nav>

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/imagen1.jpg" class="d-block w-100" height="750px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Bienvenidos a GRUPO MIG</h5>
          <p>Proveemos soluciones tecnológicas innovadoras.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/imagen2.jpg" class="d-block w-100" height="750px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Transforma tu negocio</h5>
          <p>Con nuestras herramientas tecnológicas de vanguardia.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/imagen3.jpg" class="d-block w-100" height="750px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Tu socio estratégico</h5>
          <p>En el camino hacia el éxito.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Servicios -->
  <section id="servicios" class="container my-5">
    <h2 class="text-center mb-4">Nuestros Servicios</h2>
    <div class="row g-4 justify-content-center text-center">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm servicio-card">
          <div class="card-body">
            <h5 class="card-title">Gestión de Productos y Menú</h5>
            <p class="card-text">Administra fácilmente los platos, bebidas o productos del restaurante...</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm servicio-card">
          <div class="card-body">
            <h5 class="card-title">Control de Inventario</h5>
            <p class="card-text">Lleva un control preciso del inventario...</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm servicio-card">
          <div class="card-body">
            <h5 class="card-title">Administración de Empleados</h5>
            <p class="card-text">Gestiona la información de tu equipo de trabajo...</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Accordion (Productos) -->
  <section id="productos" class="container mt-5">
    <h2 class="faq-title">Preguntas Frecuentes</h2>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            ¿Qué servicios ofrecemos?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Ofrecemos soluciones tecnológicas, desarrollo web y consultoría IT.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            ¿Cómo podemos ayudarte?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Ayudamos a las empresas a mejorar sus procesos a través de la automatización y optimización de recursos.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="container mt-5">
    <h2 class="faq-title">Contacto</h2>
    <form>
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" placeholder="Tu nombre">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" placeholder="Tu correo">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Mensaje</label>
        <textarea class="form-control" id="message" rows="4" placeholder="Tu mensaje"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </section>

  <footer class="text-center mt-5 py-3 bg-light">
    Pie de página © MIG Solutions 2025
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

  <!-- Script del buscador -->
  <script>
    function redireccionarBusqueda() {
      const termino = document.getElementById("buscador").value.toLowerCase().trim();

      if (termino.includes("servicio")) {
        location.href = "#servicios";
      } else if (termino.includes("contacto")) {
        location.href = "#contacto";
      } else if (termino.includes("inicio")) {
        location.href = "#";
      } else if (termino.includes("sobre nosotros") || termino.includes("nosotros")) {
        location.href = "views/sobre-nosotros.html";
      } else {
        alert("No se encontró ningún resultado relacionado.");
      }
    }
  </script>
</body>

</html>