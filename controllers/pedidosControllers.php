<?php

ob_start(); // Inicia el búfer de salida

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/db.php';
require_once '../models/pedido.php';

$pedidoModel = new Pedido($conn);

$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'editar':
        if (!isset($_GET['id'])) {
            echo "ID de pedido no proporcionado.";
            exit;
        }

        $pedidoId = $_GET['id'];

        // Obtener datos del pedido
        $stmt = $conn->prepare("SELECT * FROM pedidos WHERE PedidoID = ?");
        $stmt->bind_param("i", $pedidoId);
        $stmt->execute();
        $pedido = $stmt->get_result()->fetch_assoc();

        // Obtener los platos del pedido
        $stmt = $conn->prepare("SELECT * FROM platos_pedido WHERE PedidoID = ?");
        $stmt->bind_param("i", $pedidoId);
        $stmt->execute();
        $platosPedido = [];
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $platosPedido[$row['PlatoID']] = $row['Cantidad'];
        }

        // Obtener todos los platos disponibles
        $platos = $conn->query("SELECT * FROM platos");

        include '../views/pedidos/editar_pedido.php';
        break;


    case 'actualizar':
        $pedidoId = $_POST['pedido_id'];
        $cliente = $_POST['cliente'];
        $mesa = $_POST['mesa'];
        $platos = $_POST['platos'] ?? [];
        $cantidades = $_POST['cantidades'] ?? [];

        // Actualizar datos del pedido
        $stmt = $conn->prepare("UPDATE pedidos SET Cliente = ?, Mesa = ? WHERE PedidoID = ?");
        $stmt->bind_param("sii", $cliente, $mesa, $pedidoId);
        $stmt->execute();

        // Eliminar platos actuales
        $stmt = $conn->prepare("DELETE FROM platos_pedido WHERE PedidoID = ?");
        $stmt->bind_param("i", $pedidoId);
        $stmt->execute();

        // Insertar nuevos platos
        foreach ($platos as $platoId) {
            $cantidad = (int)$cantidades[$platoId];
            $stmt = $conn->prepare("INSERT INTO platos_pedido (PedidoID, PlatoID, Cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $pedidoId, $platoId, $cantidad);
            $stmt->execute();
        }

        // Redirigir
        header("Location: ../views/pedidos/ticket.php?id=" . $pedidoId);

        exit;

case 'guardar':
        $cliente = $_POST['cliente'];
        $mesa = $_POST['mesa'];
        $platos = $_POST['platos'] ?? [];
        $cantidades = $_POST['cantidades'] ?? [];

        // Insertar pedido
        $stmt = $conn->prepare("INSERT INTO pedidos (Cliente, Mesa, FechaHora) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $cliente, $mesa);
        $stmt->execute();
        $pedidoId = $stmt->insert_id;

        // Insertar cada plato
        foreach ($platos as $platoId) {
            $cantidad = (int)$cantidades[$platoId];
            $stmt = $conn->prepare("INSERT INTO platos_pedido (PedidoID, PlatoID, Cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $pedidoId, $platoId, $cantidad);
            $stmt->execute();
        }

        header("Location: ../views/pedidos/ticket.php?id=" . $pedidoId);
        exit;

    case 'eliminar':
        $pedidoId = $_GET['id'];

        $conn->query("DELETE FROM platos_pedido WHERE PedidoID = $pedidoId");
        $conn->query("DELETE FROM pedidos WHERE PedidoID = $pedidoId");

        header("Location: ../views/pedidos/listar_pedidos.php");
        exit;

    default:
        $pedidos = [];
        include '../views/pedidos/index.php';
        break;
}

ob_end_flush();
