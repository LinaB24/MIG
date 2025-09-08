<?php
// modelos/modelo_plato/modelo_plato.php
require_once '../../Conexion.php';

class Plato {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstancia()->getConexion();
    }

    // Obtener todos los platos
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM platos ORDER BY PlatoID DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener plato por id
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM platos WHERE PlatoID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function unidadTipo($u) {
        $u = strtolower($u);
        if (in_array($u, ['g','kg','lb','oz'])) return 'mass';
        if (in_array($u, ['ml','l'])) return 'volume';
        if ($u === 'unidad') return 'unidad';
        return null;
    }

    private function factorToBase($u) {
        $u = strtolower($u);
        $mass = ['g' => 1, 'kg' => 1000, 'lb' => 453.59237, 'oz' => 28.349523125];
        $vol  = ['ml' => 1, 'l' => 1000];
        if (isset($mass[$u])) return $mass[$u];
        if (isset($vol[$u])) return $vol[$u];
        return null;
    }

    private function convertir($cantidad, $fromUnit, $toUnit) {
        $fromUnit = strtolower($fromUnit);
        $toUnit = strtolower($toUnit);
        $tipoFrom = $this->unidadTipo($fromUnit);
        $tipoTo = $this->unidadTipo($toUnit);

        if ($tipoFrom === null || $tipoTo === null) return null;
        if ($tipoFrom === 'unidad' || $tipoTo === 'unidad') return null;

        $fFrom = $this->factorToBase($fromUnit);
        $fTo = $this->factorToBase($toUnit);
        return ($cantidad * $fFrom) / $fTo;
    }

    private function obtenerUnidadBaseProducto($productoId) {
        $stmt = $this->db->prepare("SELECT stock, unidad_base, descripcion FROM productos WHERE id = ?");
        $stmt->execute([$productoId]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) return null;
        $unidadBase = !empty($fila['unidad_base']) ? strtolower($fila['unidad_base']) : null;
        if (!$unidadBase) {
            $desc = strtolower($fila['descripcion'] ?? '');
            if (strpos($desc, 'libra') !== false || strpos($desc, 'lb') !== false) $unidadBase = 'lb';
            elseif (strpos($desc, 'kilo') !== false || strpos($desc, 'kg') !== false) $unidadBase = 'kg';
            elseif (strpos($desc, 'litro') !== false || strpos($desc, 'l') !== false) $unidadBase = 'l';
        }
        return $unidadBase;
    }

    public function verificarStockIngredientes($ingredientes) {
        $errores = [];
        foreach ($ingredientes as $ing) {
            $productoId = $ing['ProductoID'];
            $cantidadTotal = $ing['cantidad_total'];
            $unidad = $ing['unidad_medida'] ?? 'unidad';

            $stmt = $this->db->prepare("SELECT stock, unidad_base, descripcion FROM productos WHERE id = ?");
            $stmt->execute([$productoId]);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$fila) {
                $errores[] = "Producto ID {$productoId} no encontrado.";
                continue;
            }
            $stock = (float)$fila['stock'];
            $unidadBase = !empty($fila['unidad_base']) ? strtolower($fila['unidad_base']) : null;

            $convertido = $this->convertir($cantidadTotal, $unidad, $unidadBase);
            if ($convertido === null) {
                if ($unidad === 'unidad') {
                    $convertido = $cantidadTotal;
                } else {
                    continue;
                }
            }

            if ($convertido > $stock) {
                $errores[] = "Stock insuficiente para producto {$productoId} (necesario {$convertido} {$unidadBase}, disponible {$stock} {$unidadBase}).";
            }
        }
        return $errores;
    }

    // Agregar plato y descontar stock
    public function add($nombre, $descripcion, $precio, $ingredientes, $cantidad = 0) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO platos (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $descripcion, $precio, $cantidad]);
            $platoId = $this->db->lastInsertId();

            $stmtIng = $this->db->prepare("INSERT INTO platos_productos (PlatoID, ProductoID, cantidad, unidad_medida) VALUES (?, ?, ?, ?)");
            $stmtStock = $this->db->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");

            foreach ($ingredientes as $ingrediente) {
                $productoId = $ingrediente['ProductoID'];
                $cantidadPorPlato = $ingrediente['cantidad_por_plato'];
                $unidadIngred = $ingrediente['unidad_medida'];
                $cantidadTotal = $ingrediente['cantidad_total'];

                $stmtIng->execute([$platoId, $productoId, $cantidadPorPlato, $unidadIngred]);

                $unidadBase = $this->obtenerUnidadBaseProducto($productoId);
                $convertido = $this->convertir($cantidadTotal, $unidadIngred, $unidadBase);
                if ($convertido === null) continue;

                $stmtStock->execute([$convertido, $productoId]);
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function update($id, $nombre, $descripcion, $precio, $cantidad) {
        $stmt = $this->db->prepare("UPDATE platos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE PlatoID = ?");
        $stmt->execute([$nombre, $descripcion, $precio, $cantidad, $id]);
        return true;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM platos_productos WHERE PlatoID = ?");
        $stmt->execute([$id]);
        $stmt2 = $this->db->prepare("DELETE FROM platos WHERE PlatoID = ?");
        $stmt2->execute([$id]);
        return true;
    }
}
