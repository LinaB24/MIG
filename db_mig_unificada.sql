-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2025 a las 04:08:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_mig_unificada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionesmesas`
--

CREATE TABLE `asignacionesmesas` (
  `AsignacionID` int(11) NOT NULL,
  `ReservaID` int(11) DEFAULT NULL,
  `MesaID` int(11) DEFAULT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `PagoID` int(11) NOT NULL,
  `TransaccionID` int(11) NOT NULL,
  `MetodoPago` enum('Efectivo','Tarjeta','Transferencia') NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ClienteID` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlexistencias`
--

CREATE TABLE `controlexistencias` (
  `ProductoID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creacionmenu`
--

CREATE TABLE `creacionmenu` (
  `MenuID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `FechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `productos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalletransacciones`
--

CREATE TABLE `detalletransacciones` (
  `DetalleID` int(11) NOT NULL,
  `TransaccionID` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `EmpleadoID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `FechaContratacion` date DEFAULT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventospromociones`
--

CREATE TABLE `eventospromociones` (
  `EventoID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `ImpuestoID` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `TipoImpuesto` varchar(50) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_movimientos`
--

CREATE TABLE `inventario_movimientos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `tipo` enum('entrada','salida') DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_movimientos`
--

INSERT INTO `inventario_movimientos` (`id`, `producto_id`, `tipo`, `cantidad`, `fecha`, `observaciones`) VALUES
(5, 1, 'entrada', 12, '2025-06-26 19:40:00', 'nuevos rollos'),
(6, 1, 'salida', 2, '2025-06-26 19:40:28', 'se vendieron'),
(7, 1, 'entrada', 20, '2025-06-26 19:51:03', 'dura como minimo 20 dias '),
(8, 1, 'salida', 20, '2025-06-26 19:51:37', 'llovio y la gente gasto mucho papel'),
(9, 1, 'salida', 5, '2025-06-26 19:52:52', 'arroba'),
(10, 1, 'salida', 4, '2025-06-26 19:53:08', ''),
(11, 1, 'salida', 1, '2025-06-28 20:58:31', ''),
(12, 1, 'entrada', 56, '2025-06-28 20:58:45', 'pedido nuevo'),
(0, 1, 'salida', 12, '2025-06-30 18:53:45', 'llovio'),
(0, 1, 'entrada', 2, '2025-06-30 18:53:53', ''),
(0, 1, 'entrada', 6, '2025-07-01 21:08:16', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `MesaID` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `Estado` enum('Disponible','Ocupada','Reservada') DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`MesaID`, `Numero`, `Capacidad`, `Estado`) VALUES
(1, 1, 4, 'Disponible'),
(2, 2, 2, 'Disponible'),
(3, 3, 6, 'Disponible'),
(4, 4, 4, 'Disponible'),
(5, 5, 8, 'Disponible'),
(6, 6, 4, 'Disponible'),
(7, 7, 5, 'Disponible'),
(8, 8, 2, 'Disponible'),
(9, 9, 5, 'Disponible'),
(10, 10, 0, 'Disponible'),
(11, 11, 0, 'Disponible'),
(12, 12, 0, 'Disponible'),
(13, 13, 0, 'Disponible'),
(14, 14, 0, 'Disponible'),
(15, 15, 0, 'Disponible'),
(16, 16, 0, 'Disponible'),
(17, 17, 0, 'Disponible'),
(18, 18, 0, 'Disponible'),
(19, 19, 0, 'Disponible'),
(20, 20, 0, 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `NotificacionID` int(11) NOT NULL,
  `Mensaje` text NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `UsuarioID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_pendientes`
--

CREATE TABLE `pagos_pendientes` (
  `pagospendientes_id` int(11) NOT NULL,
  `ImpuestoID` int(11) NOT NULL,
  `tipo_pago` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `PedidoID` int(11) NOT NULL,
  `Cliente` varchar(100) NOT NULL,
  `Mesa` int(11) NOT NULL,
  `FechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`PedidoID`, `Cliente`, `Mesa`, `FechaHora`) VALUES
(15, 'Alastors', 6, '2025-06-30 13:52:03'),
(16, 'Alastor', 6, '2025-06-30 13:52:25'),
(17, 'Alastor', 6, '2025-06-30 13:57:20'),
(18, 'Alastor', 6, '2025-06-30 13:57:36'),
(19, 'dsfads', 2, '2025-06-30 13:59:12'),
(20, 'werw', 23, '2025-06-30 14:01:41'),
(21, 'werw', 23, '2025-06-30 14:06:37'),
(22, 'werw', 23, '2025-06-30 14:07:03'),
(23, 'werw', 23, '2025-06-30 14:09:22'),
(24, 'werw', 2, '2025-06-30 14:09:32'),
(25, 'werw', 2, '2025-06-30 14:09:56'),
(28, 'werw', 23, '2025-06-30 14:13:06'),
(29, 'werw', 23, '2025-06-30 14:25:09'),
(34, 'nadie', 2, '2025-06-30 15:13:34'),
(36, 'nadie', 6, '2025-06-30 15:21:20'),
(37, 'pepe', 4, '2025-06-30 19:33:46'),
(38, 'pepe', 4, '2025-07-01 21:07:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosdomicilio`
--

CREATE TABLE `pedidosdomicilio` (
  `PedidoID` int(11) NOT NULL,
  `ClienteID` int(11) NOT NULL,
  `DireccionEntrega` text NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Estado` enum('Pendiente','Enviado','Entregado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `PlatoID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`PlatoID`, `nombre`, `descripcion`, `precio`, `cantidad`) VALUES
(1, 'Hamburguesa Clásica', 'Carne de res, lechuga, tomate, queso y salsa especial.', 18000.00, 20),
(2, 'Pizza Margarita', 'Queso mozzarella, tomate y albahaca fresca.', 22000.00, 15),
(3, 'Ensalada César', 'Lechuga, pollo a la plancha, crutones y aderezo César.', 15000.00, 10),
(4, 'Pasta Alfredo', 'Fettuccine con salsa Alfredo cremosa y pollo.', 20000.00, 12),
(5, 'Sándwich de Pollo', 'Pollo a la plancha, lechuga, tomate y mayonesa.', 16000.00, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos_pedido`
--

CREATE TABLE `platos_pedido` (
  `PedidoID` int(11) NOT NULL,
  `PlatoID` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos_pedido`
--

INSERT INTO `platos_pedido` (`PedidoID`, `PlatoID`, `Cantidad`) VALUES
(15, 2, 56),
(15, 3, 7),
(16, 2, 56),
(16, 3, 7),
(17, 2, 5),
(18, 1, 7),
(19, 2, 5),
(19, 3, 6),
(20, 1, 78),
(21, 1, 78),
(22, 1, 78),
(23, 1, 5),
(24, 1, 5),
(25, 1, 5),
(28, 1, 1),
(29, 1, 8),
(34, 5, 2),
(36, 4, 1),
(37, 2, 2),
(37, 3, 1),
(37, 4, 1),
(38, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `stock`) VALUES
(1, '01', 'Papel Higiénico', 'Rollo jumbo', 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosproveedores`
--

CREATE TABLE `productosproveedores` (
  `ProductoID` int(11) NOT NULL,
  `ProveedorID` int(11) NOT NULL,
  `FechaSuministro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ProveedorID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Direccion` text DEFAULT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacioncontraseña`
--

CREATE TABLE `recuperacioncontraseña` (
  `RecuperacionID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `FechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personas` int(11) NOT NULL,
  `mesa_id` int(11) DEFAULT NULL,
  `Estado` enum('Pendiente','Activa','Finalizada') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `fecha`, `hora`, `personas`, `mesa_id`, `Estado`) VALUES
(36, 'Camila Lopez', '2025-06-27', '14:27:00', 5, 7, 'Activa'),
(37, 'carolina gutierrez', '2025-06-27', '16:28:00', 2, 2, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_simple`
--

CREATE TABLE `reservas_simple` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_simple`
--

INSERT INTO `reservas_simple` (`id`, `nombre`, `fecha`, `hora`, `personas`) VALUES
(2, 'laura', '2025-06-25', '23:03:00', 3),
(3, 'dayana', '2025-06-18', '12:40:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_administradores`
--

CREATE TABLE `tb_administradores` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `USUARIO` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `PERFIL` varchar(50) DEFAULT 'Administrador',
  `ESTADO` varchar(50) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_administradores`
--

INSERT INTO `tb_administradores` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`, `USUARIO`, `PASSWORD`, `PERFIL`, `ESTADO`) VALUES
(12, 'nadie', 'nadie', 'Admin don nadie', '$2y$10$DUD4Wbx3Pj1rlCrBcec5IeqIoj/BR8BhDRSnABjR8FZf5.lI8jYCu', 'Administrador', 'Activo'),
(13, 'lina', 'maria', 'Admin lina', '$2y$10$5QtPDz4FQdEXnGnjP7BuzOguEtSnRyAzmQ4F/bsMIQ8.1/TpYln66', 'Administrador', 'Activo'),
(14, 'dayis', 'dayis', 'Admin dayis', '$2y$10$xyi7x1GuJUWqVUYedXGe8usBEktrtV7/Jm0Fc8Oox7nX0Vo8v9z/i', 'Administrador', 'Activo'),
(15, 'diego', 'juandigu', 'Admin diego', '$2y$10$QZQvy7f4tS9Zd/oNQ3sRheFdrsnIQKCK.45voyGwgSLwm2Q4V63w6', 'Administrador', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleados`
--

CREATE TABLE `tb_empleados` (
  `ID_EMPLEADO` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `DOCUMENTO` varchar(100) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  `CARGO` varchar(100) DEFAULT NULL,
  `FECHA_REGISTRO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_empleados`
--

INSERT INTO `tb_empleados` (`ID_EMPLEADO`, `NOMBRE`, `APELLIDO`, `DOCUMENTO`, `CORREO`, `CARGO`, `FECHA_REGISTRO`) VALUES
(1, 'Michael', 'Culma betan', '123456', 'yo@gmail.com', 'Admin', '2025-04-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_inventario`
--

CREATE TABLE `tb_inventario` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `existencias` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_inventario`
--

INSERT INTO `tb_inventario` (`id_producto`, `nombre_producto`, `existencias`) VALUES
(8, 'arroz', 4),
(9, 'dh', 678),
(10, 'papas', 2),
(11, 'pollo', 123),
(12, 'gallina', 4),
(13, 'tomate', 5),
(14, 'cebolla', 8),
(15, 'cilantro', 8),
(16, 'limon', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `TransaccionID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id`, `usuario`, `clave`) VALUES
(4, 'admin', '$2y$10$7Xicoe8hURf9pVWxnpJSpuWBXyGc9T6HAp2kNLAV2zMABNxQhyVOO'),
(5, 'lizeth', '$2y$10$jhIOI9qpyaEFTImhTW/lZ.nNJvOVpvXtCm/iNjklvcNlNRxJIWh.2'),
(6, 'alberto', '$2y$10$5y8y69X56i7RnEdnwl/5SO82ejX0IdpTyGR/wNl5QNi305tYprtBq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_sistema`
--

CREATE TABLE `usuarios_sistema` (
  `UsuarioID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `ContraseñaHash` varchar(255) NOT NULL,
  `Rol` enum('Administrador','Cajero','Cocinero','Empleado') NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacionesmesas`
--
ALTER TABLE `asignacionesmesas`
  ADD PRIMARY KEY (`AsignacionID`),
  ADD KEY `ReservaID` (`ReservaID`),
  ADD KEY `MesaID` (`MesaID`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`PagoID`),
  ADD KEY `TransaccionID` (`TransaccionID`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ClienteID`);

--
-- Indices de la tabla `controlexistencias`
--
ALTER TABLE `controlexistencias`
  ADD PRIMARY KEY (`ProductoID`);

--
-- Indices de la tabla `creacionmenu`
--
ALTER TABLE `creacionmenu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indices de la tabla `detalletransacciones`
--
ALTER TABLE `detalletransacciones`
  ADD PRIMARY KEY (`DetalleID`),
  ADD KEY `TransaccionID` (`TransaccionID`),
  ADD KEY `ProductoID` (`id_producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EmpleadoID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `eventospromociones`
--
ALTER TABLE `eventospromociones`
  ADD PRIMARY KEY (`EventoID`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`ImpuestoID`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`MesaID`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`NotificacionID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `pagos_pendientes`
--
ALTER TABLE `pagos_pendientes`
  ADD PRIMARY KEY (`pagospendientes_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`PedidoID`);

--
-- Indices de la tabla `pedidosdomicilio`
--
ALTER TABLE `pedidosdomicilio`
  ADD PRIMARY KEY (`PedidoID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`PlatoID`);

--
-- Indices de la tabla `platos_pedido`
--
ALTER TABLE `platos_pedido`
  ADD PRIMARY KEY (`PedidoID`,`PlatoID`),
  ADD KEY `PlatoID` (`PlatoID`);

--
-- Indices de la tabla `productosproveedores`
--
ALTER TABLE `productosproveedores`
  ADD PRIMARY KEY (`ProductoID`,`ProveedorID`),
  ADD KEY `ProveedorID` (`ProveedorID`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ProveedorID`);

--
-- Indices de la tabla `recuperacioncontraseña`
--
ALTER TABLE `recuperacioncontraseña`
  ADD PRIMARY KEY (`RecuperacionID`),
  ADD UNIQUE KEY `Token` (`Token`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `reservas_simple`
--
ALTER TABLE `reservas_simple`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_administradores`
--
ALTER TABLE `tb_administradores`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  ADD PRIMARY KEY (`ID_EMPLEADO`),
  ADD UNIQUE KEY `DOCUMENTO` (`DOCUMENTO`);

--
-- Indices de la tabla `tb_inventario`
--
ALTER TABLE `tb_inventario`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`TransaccionID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_sistema`
--
ALTER TABLE `usuarios_sistema`
  ADD PRIMARY KEY (`UsuarioID`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacionesmesas`
--
ALTER TABLE `asignacionesmesas`
  MODIFY `AsignacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `PagoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ClienteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `controlexistencias`
--
ALTER TABLE `controlexistencias`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creacionmenu`
--
ALTER TABLE `creacionmenu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalletransacciones`
--
ALTER TABLE `detalletransacciones`
  MODIFY `DetalleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `EmpleadoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventospromociones`
--
ALTER TABLE `eventospromociones`
  MODIFY `EventoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `ImpuestoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `MesaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `NotificacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_pendientes`
--
ALTER TABLE `pagos_pendientes`
  MODIFY `pagospendientes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `PedidoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `pedidosdomicilio`
--
ALTER TABLE `pedidosdomicilio`
  MODIFY `PedidoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `PlatoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ProveedorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recuperacioncontraseña`
--
ALTER TABLE `recuperacioncontraseña`
  MODIFY `RecuperacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas_simple`
--
ALTER TABLE `reservas_simple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_administradores`
--
ALTER TABLE `tb_administradores`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_inventario`
--
ALTER TABLE `tb_inventario`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `TransaccionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios_sistema`
--
ALTER TABLE `usuarios_sistema`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`TransaccionID`) REFERENCES `transacciones` (`TransaccionID`);

--
-- Filtros para la tabla `platos_pedido`
--
ALTER TABLE `platos_pedido`
  ADD CONSTRAINT `platos_pedido_ibfk_1` FOREIGN KEY (`PedidoID`) REFERENCES `pedidos` (`PedidoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `platos_pedido_ibfk_2` FOREIGN KEY (`PlatoID`) REFERENCES `platos` (`PlatoID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
