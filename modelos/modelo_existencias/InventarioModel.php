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
        // Validar existencia del producto
        if (!$this->productoExiste($producto_id)) {
            throw new Exception("❌ El producto con ID $producto_id no existe en la base de datos.");
        }

        // Validar tipo de movimiento
        if ($tipo !== 'entrada' && $tipo !== 'salida') {
            throw new Exception("❌ Tipo de movimiento inválido.");
        }

        // Validar cantidad
        if ($cantidad <= 0) {
            throw new Exception("❌ La cantidad debe ser mayor a 0.");
        }

        // Si es salida, validar stock suficiente
        if ($tipo === 'salida') {
            $stock_actual = $this->obtenerStockProducto($producto_id);
            if ($cantidad > $stock_actual) {
                throw new Exception("❌ No hay suficiente stock para realizar la salida.");
            }
        }

        // Registrar movimiento
        $stmt = $this->db->prepare("INSERT INTO inventario_movimientos 
            (producto_id, tipo, cantidad, observaciones) VALUES (?, ?, ?, ?)");
        $stmt->execute([$producto_id, $tipo, $cantidad, $observaciones]);

        // Actualizar stock
        $signo = $tipo === 'entrada' ? '+' : '-';
        $stmt = $this->db->prepare("UPDATE productos SET stock = stock $signo ? WHERE id = ?");
        $stmt->execute([$cantidad, $producto_id]);
    }

    public function obtenerInventario() {
        $stmt = $this->db->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMovimientos() {
        $stmt = $this->db->query("SELECT m.*, p.nombre FROM inventario_movimientos m 
                                  JOIN productos p ON m.producto_id = p.id 
                                  ORDER BY m.fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function obtenerStockProducto($producto_id) {
        $stmt = $this->db->prepare("SELECT stock FROM productos WHERE id = ?");
        $stmt->execute([$producto_id]);
        return (int) $stmt->fetchColumn();
    }
}
