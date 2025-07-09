<?php
require_once '../../modelos/modelo_plato/modelo_plato.php';
session_start();

class PlatoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Plato();
    }

    public function index() {
        $platos = $this->modelo->getAll();
        include '../../pages/pages_platos/index.php';
    }

    public function crear() {
        include '../../pages/pages_platos/crear.php';
    }

    public function guardar() {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $this->modelo->add($nombre, $descripcion, $precio, $cantidad);
        header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
        exit;
    }

    public function editar() {
        $id = $_GET['id'];
        $plato = $this->modelo->getById($id);
        include '../../pages/pages_platos/editar.php';
    }

    public function actualizar() {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $this->modelo->update($id, $nombre, $descripcion, $precio, $cantidad);
        header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
        exit;
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->modelo->delete($id);
        header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
        exit;
    }
}

// Dispatcher
$accion = $_GET['accion'] ?? 'index';
$controller = new PlatoController();
if (method_exists($controller, $accion)) {
    $controller->$accion();
} else {
    $controller->index();
}