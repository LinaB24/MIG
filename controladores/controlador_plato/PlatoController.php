<?php
// controladores/controlador_plato/PlatoController.php
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
        try {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = $_POST['precio'] ?? 0;

            if (empty($nombre) || !is_numeric($precio)) {
                throw new Exception("Nombre y precio son requeridos y deben ser válidos.");
            }

            $productos = $_POST['productos'] ?? [];
            $cantidades = $_POST['cantidades'] ?? [];
            $unidades = $_POST['unidades'] ?? [];
            $cantidadPlatos = isset($_POST['cantidad_platos']) ? (int)$_POST['cantidad_platos'] : 1;
            if ($cantidadPlatos < 1) $cantidadPlatos = 1;

            if (empty($productos)) {
                throw new Exception("Debe especificar al menos un ingrediente.");
            }

            // Preparar array de ingredientes
            $ingredientes = [];
            foreach ($productos as $key => $productoId) {
                $cant = floatval($cantidades[$key] ?? 0);
                $unidad = $unidades[$key] ?? 'unidad';
                if ($cant <= 0) {
                    throw new Exception("Cantidad inválida para uno de los ingredientes.");
                }

                $cantidadTotal = $cant * $cantidadPlatos;

                $ingredientes[] = [
                    'ProductoID' => (int)$productoId,
                    'cantidad_por_plato' => $cant,
                    'unidad_medida' => $unidad,
                    'cantidad_total' => $cantidadTotal
                ];
            }

            // Verificamos stock en el modelo
            $errores = $this->modelo->verificarStockIngredientes($ingredientes);
            if (!empty($errores)) {
                throw new Exception(implode(" / ", $errores));
            }

            // Guardar plato
            $this->modelo->add($nombre, $descripcion, (float)$precio, $ingredientes, $cantidadPlatos);

            $_SESSION['exito'] = "Plato registrado correctamente.";
            header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            include '../../pages/pages_platos/crear.php';
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->delete($id);
        }
        header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
        exit;
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "ID de plato inválido.";
            header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
            exit;
        }
        $plato = $this->modelo->getById($id);
        if (!$plato) {
            $_SESSION['error'] = "Plato no encontrado.";
            header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
            exit;
        }
        include '../../pages/pages_platos/editar.php';
    }

    public function actualizar() {
        try {
            $id = $_POST['id'] ?? null;
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = $_POST['precio'] ?? 0;
            $cantidad = $_POST['cantidad'] ?? 0;

            if (!$id || empty($nombre) || !is_numeric($precio)) {
                throw new Exception("Datos inválidos para actualizar el plato.");
            }

            $this->modelo->update($id, $nombre, $descripcion, (float)$precio, (int)$cantidad);

            $_SESSION['exito'] = "Plato actualizado correctamente.";
            header('Location: ../../controladores/controlador_plato/PlatoController.php?accion=index');
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $plato = $this->modelo->getById($id ?? 0);
            include '../../pages/pages_platos/editar.php';
        }
    }
}

// Dispatcher
$accion = $_GET['accion'] ?? 'index';
$controller = new PlatoController();

switch ($accion) {
    case 'index':
        $controller->index();
        break;
    case 'crear':
        $controller->crear();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    default:
        $controller->index();
        break;
}
