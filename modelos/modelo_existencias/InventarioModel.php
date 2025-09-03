<?php
require_once '../../Conexion.php';

class InventarioModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstancia()->getConexion();
    }
    
    // Verificar que el producto exista antes de registrar movimiento
    private function productoExiste($producto_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM productos WHERE id = ?");
        $stmt->execute([$producto_id]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function registrarMovimiento($producto_id, $tipo, $cantidad, $observaciones) {
        if (!$this->productoExiste($producto_id)) {
            throw new Exception("❌ El producto con ID $producto_id no existe en la base de datos.");
        }

        if ($tipo !== 'entrada' && $tipo !== 'salida') {
            throw new Exception("❌ Tipo de movimiento inválido.");
        }

        if ($cantidad <= 0) {
            throw new Exception("❌ La cantidad debe ser mayor a 0.");
        }

        if ($tipo === 'salida') {
            $stock_actual = $this->obtenerStockProducto($producto_id);
            if ($cantidad > $stock_actual) {
                throw new Exception("❌ No hay suficiente stock para realizar la salida.");
            }
        }

        $stmt = $this->db->prepare("INSERT INTO inventario_movimientos 
            (producto_id, tipo, cantidad, observaciones) VALUES (?, ?, ?, ?)");
        $stmt->execute([$producto_id, $tipo, $cantidad, $observaciones]);
    }

    // 🚫 Eliminamos obtenerUnidadesMedida porque ya no hay tabla
    // public function obtenerUnidadesMedida() { ... }

    public function obtenerInventario() {
        $stmt = $this->db->query("
            SELECT p.id, p.nombre, p.descripcion, p.stock, p.codigo
            FROM productos p
            ORDER BY p.nombre
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMovimientos() {
        $stmt = $this->db->query("SELECT m.*, p.nombre 
                                  FROM inventario_movimientos m 
                                  JOIN productos p ON m.producto_id = p.id 
                                  ORDER BY m.fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function obtenerStockProducto($producto_id) {
        $stmt = $this->db->prepare("SELECT stock FROM productos WHERE id = ?");
        $stmt->execute([$producto_id]);
        return (int) $stmt->fetchColumn();
    }

    public function registrarProducto($codigo, $nombre, $descripcion, $stock) {
        if (empty($codigo)) {
            throw new Exception("❌ El código del producto es requerido.");
        }
        
        if (empty($nombre)) {
            throw new Exception("❌ El nombre del producto es requerido.");
        }
        
        if ($stock < 0) {
            throw new Exception("❌ El stock inicial no puede ser negativo.");
        }

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM productos WHERE codigo = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("❌ Ya existe un producto con este código.");
        }

        $stmt = $this->db->prepare("INSERT INTO productos 
            (codigo, nombre, descripcion, stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$codigo, $nombre, $descripcion, $stock]);
    }

    public function eliminarProducto($producto_id) {
        if (!$this->productoExiste($producto_id)) {
            throw new Exception("❌ El producto no existe.");
        }
        $stmt = $this->db->prepare("DELETE FROM inventario_movimientos WHERE producto_id = ?");
        $stmt->execute([$producto_id]);

        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->execute([$producto_id]);
    }

    // 🚫 Eliminamos conversión de unidades y verificación de stock con unidad
}
