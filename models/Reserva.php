<?php
class Reserva
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=reservas_admin", "root", "");
    }

    public function obtenerTodas($busqueda = '') 
    {
    if (!empty($busqueda)) {
        $stmt = $this->db->prepare("SELECT * FROM reservas WHERE nombre LIKE ? ORDER BY fecha, hora");
        $stmt->execute(["%$busqueda%"]);
    } else {
        $stmt = $this->db->query("SELECT * FROM reservas ORDER BY fecha, hora");
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function guardar($data)
    {
        $stmt = $this->db->prepare("INSERT INTO reservas (nombre, fecha, hora, personas, mesa_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['nombre'],
            $data['fecha'],
            $data['hora'],
            $data['personas'],
            $data['mesa_id']
        ]);
    }



    public function eliminar($id)
    {
        // Primero obtener la reserva para saber qué mesa liberar
        $stmt = $this->db->prepare("SELECT mesa_id FROM reservas WHERE id = ?");
        $stmt->execute([$id]);
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reserva && isset($reserva['mesa_id'])) {
            $this->liberarMesa($reserva['mesa_id']);
        }

        // Luego eliminar la reserva
        $stmt = $this->db->prepare("DELETE FROM reservas WHERE id = ?");
        $stmt->execute([$id]);
    }


    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM reservas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($datos)
    {
        $stmt = $this->db->prepare("UPDATE reservas SET nombre = ?, fecha = ?, hora = ?, personas = ? WHERE id = ?");
        $stmt->execute([
            $datos['nombre'],
            $datos['fecha'],
            $datos['hora'],
            $datos['personas'],
            $datos['id']
        ]);
    }

    public function obtenerMesasDisponibles()
    {
        $stmt = $this->db->query("SELECT * FROM mesas WHERE Estado = 'Disponible'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstadoMesa($mesa_id, $estado)
    {
        $stmt = $this->db->prepare("UPDATE mesas SET Estado = ? WHERE MesaID = ?");
        $stmt->execute([$estado, $mesa_id]);
    }

    public function liberarMesa($mesa_id)
    {
        $stmt = $this->db->prepare("UPDATE mesas SET Estado = 'Disponible' WHERE MesaID = ?");
        $stmt->execute([$mesa_id]);
    }

    public function contarReservasDeHoy()
{
    $hoy = date('Y-m-d');
    $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM reservas WHERE fecha = ?");
    $stmt->execute([$hoy]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function obtenerReservasDeHoy()
{
    $hoy = date('Y-m-d');
    $stmt = $this->db->prepare("SELECT * FROM reservas WHERE fecha = ? ORDER BY hora ASC");
    $stmt->execute([$hoy]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function contarMesasDisponibles()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM mesas WHERE Estado = 'Disponible'");
        return $stmt->fetchColumn();
    }

    public function contarTodasLasMesas()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM mesas");
        return $stmt->fetchColumn();
    }

    public function obtenerProximasReservas()
    {
        $stmt = $this->db->prepare("SELECT * FROM reservas WHERE fecha >= CURDATE() ORDER BY fecha ASC, hora ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerReservasPorMes($mes, $año)
    {
    $stmt = $this->db->prepare("SELECT * FROM reservas WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? ORDER BY fecha, hora");
    $stmt->execute([$mes, $año]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
