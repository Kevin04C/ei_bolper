-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-06-2024 a las 11:27:12
-- Versión del servidor: 10.6.18-MariaDB
-- Versión de PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todoscom_test_bolper`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nom_categoria` varchar(60) NOT NULL,
  `desc_categoria` longtext NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nom_categoria`, `desc_categoria`, `fecha_creacion`, `fecha_actualizacion`, `ruta_imagen`) VALUES
(32, 'Iluminación', 'Productos para la iluminación en el hogar, focos, tubos eléctricos, cables, entre otros.', '2024-06-23 17:29:11', '2024-06-23 22:36:38', 'categoria/6678b1bee3e97.jpg'),
(33, 'Motores y bombas', 'Maquinaria especializada para la industria.', '2024-06-23 17:29:28', '2024-06-23 18:36:27', 'categoria/6678b17b54ccd.jpg'),
(34, 'Cables y alambres', 'Cables para conexiones eléctricas y alambres de cobre para rebobinados.', '2024-06-23 17:29:45', '2024-06-23 18:32:59', 'categoria/6678b0ab7dd31.jpg'),
(35, 'Cintas y aislantes', 'Aislantes para el uso eléctrico e industrial.', '2024-06-23 17:30:14', '2024-06-23 18:41:32', 'categoria/6678b2aca83ed.jpg'),
(36, 'Térmicos', 'Térmicos para controlar la energía en el hogar.', '2024-06-23 18:18:54', '2024-06-23 18:42:02', 'categoria/6678ad5e87718.jpg'),
(37, 'Equipo personal', 'Vestimenta y otros equipos para uso personal para trabajadores eléctricos o industriales.', '2024-06-23 18:21:16', '2024-06-23 18:42:20', 'categoria/6678adecaecd2.jpg'),
(38, 'Ventiladores', 'Ventiladores para motores y máquinas industriales.', '2024-06-23 18:22:54', '2024-06-23 18:42:38', 'categoria/6678ae4e0aec0.jpg'),
(39, 'Sellos', 'Sellos para electrobombas', '2024-06-23 18:29:05', '2024-06-23 18:42:50', 'categoria/6678afc11e495.jpg'),
(40, 'Capacitores', 'Capacitores de trabajo y de arranque para motores industriales y electrobombas.', '2024-06-23 18:34:08', '2024-06-23 18:34:08', 'categoria/6678b0f0100bd.jpg'),
(41, 'Productos de ferretería', 'Utensilios de ferretería, como discos y electrodos.', '2024-06-23 18:44:43', '2024-06-23 18:44:43', 'categoria/6678b36b4cecb.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `varname` varchar(255) DEFAULT '',
  `varvalue` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `varname`, `varvalue`) VALUES
(1, 'fecha_oferta', '2017-02-01 10:32:00'),
(2, 'imagen_promocion', 'img/config/65ae6f1e7c02e.jpg'),
(3, 'whatsapp_soporte', '51948269427'),
(4, 'whatsapp_ventas', '51944195972'),
(5, 'imagen_yape', 'img/config/643dc66293285.png'),
(6, 'imagen_plin', 'img/config/643dc66293f0f.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `pedido_id` int(10) UNSIGNED DEFAULT 0,
  `pedido_cantidad` double UNSIGNED DEFAULT 0,
  `producto_id` bigint(20) UNSIGNED DEFAULT 0,
  `producto_nombre` varchar(45) DEFAULT '',
  `producto_punitarioincigv` double(6,2) DEFAULT NULL,
  `precio_subtotal` double(6,2) DEFAULT NULL,
  `precio_igv` double(6,2) DEFAULT NULL,
  `producto_total` double(6,2) DEFAULT NULL,
  `oferta_activa` varchar(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedido_id`, `pedido_cantidad`, `producto_id`, `producto_nombre`, `producto_punitarioincigv`, `precio_subtotal`, `precio_igv`, `producto_total`, `oferta_activa`, `created`, `modified`) VALUES
(232, 247, 1, 194, 'Taladro CROWM 600W - 13mm', 500.00, NULL, NULL, 500.00, '0', '2024-06-23 17:42:08', '2024-06-23 17:42:08'),
(233, 248, 1, 195, 'Motor WEG 10 HP', 900.00, NULL, NULL, 900.00, '0', '2024-06-23 17:46:23', '2024-06-23 17:46:23'),
(234, 249, 1, 194, 'Taladro CROWM 600W - 13mm', 500.00, NULL, NULL, 500.00, '0', '2024-06-23 17:55:49', '2024-06-23 17:55:49'),
(236, 251, 1, 205, 'Cable vulcanizado 2l | Nº14 INDECO', 5.00, NULL, NULL, 5.00, '0', '2024-06-23 20:43:02', '2024-06-23 20:43:02'),
(237, 251, 1, 206, 'Spaguetty Nº 1', 1.00, NULL, NULL, 1.00, '0', '2024-06-23 20:43:03', '2024-06-23 20:43:03'),
(238, 252, 1, 196, 'Foco led 9 W', 7.00, NULL, NULL, 7.00, '0', '2024-06-23 20:58:26', '2024-06-23 20:58:26'),
(239, 252, 1, 203, 'Alambre 15', 78.00, NULL, NULL, 78.00, '0', '2024-06-23 20:59:10', '2024-06-23 20:59:10'),
(240, 253, 1, 211, 'Guantes TANQUE cuero', 12.00, NULL, NULL, 12.00, '0', '2024-06-23 21:07:32', '2024-06-23 21:07:32'),
(241, 253, 1, 212, 'Lentes GCL transparente  ', 6.00, NULL, NULL, 6.00, '0', '2024-06-23 21:07:34', '2024-06-23 21:07:34'),
(242, 250, 3, 210, 'Térmicos STRONG 2V 20 A ', 45.00, NULL, NULL, 135.00, '0', '2024-06-23 21:16:43', '2024-06-23 21:17:30'),
(243, 254, 1, 214, ' Sello-Retén bomba eléc. 12 - 301', 25.00, NULL, NULL, 25.00, '0', '2024-06-23 21:20:20', '2024-06-23 21:20:20'),
(244, 255, 1, 210, 'Térmicos STRONG 2V 20 A ', 45.00, NULL, NULL, 45.00, '0', '2024-06-23 22:39:46', '2024-06-23 22:39:46'),
(245, 255, 1, 211, 'Guantes TANQUE cuero', 12.00, NULL, NULL, 12.00, '0', '2024-06-23 22:40:33', '2024-06-23 22:40:33'),
(246, 256, 1, 219, 'Electrodo TRUPPER E-6011 T', 18.00, NULL, NULL, 18.00, '0', '2024-06-23 23:20:29', '2024-06-23 23:20:29'),
(247, 257, 1, 219, 'Electrodo TRUPPER E-6011 T', 18.00, NULL, NULL, 18.00, '0', '2024-06-23 23:32:55', '2024-06-23 23:32:55'),
(248, 258, 2, 218, 'Disco corte 4 1/2 TOTAL amoladora', 3.00, NULL, NULL, 6.00, '0', '2024-06-24 00:14:16', '2024-06-24 00:14:20'),
(249, 258, 1, 217, 'Cap. trabajo GLOBAL CAP 20 uf 450 v', 48.00, NULL, NULL, 48.00, '0', '2024-06-24 00:14:21', '2024-06-24 00:14:21'),
(250, 258, 1, 219, 'Electrodo TRUPPER E-6011 T', 18.00, NULL, NULL, 18.00, '0', '2024-06-24 00:14:23', '2024-06-24 00:14:23'),
(251, 258, 1, 216, 'Capacitor arranque DUCATTI 200-240 uf', 50.00, NULL, NULL, 50.00, '0', '2024-06-24 00:14:27', '2024-06-24 00:14:27'),
(252, 258, 1, 215, 'Sello-Retén bomba eléc. 15 - cónico', 28.00, NULL, NULL, 28.00, '0', '2024-06-24 00:14:31', '2024-06-24 00:14:31'),
(253, 257, 1, 203, 'Alambre 15', 78.00, NULL, NULL, 78.00, '0', '2024-06-24 08:12:54', '2024-06-24 08:12:54'),
(254, 259, 1, 211, 'Guantes TANQUE cuero', 12.00, NULL, NULL, 12.00, '0', '2024-06-24 08:21:10', '2024-06-24 08:21:10'),
(255, 259, 1, 212, 'Lentes GCL transparente  ', 6.00, NULL, NULL, 6.00, '0', '2024-06-24 08:21:11', '2024-06-24 08:21:11'),
(256, 259, 1, 213, 'Ventiladores 14 * 162', 28.50, NULL, NULL, 28.50, '0', '2024-06-24 08:21:15', '2024-06-24 08:21:15'),
(257, 260, 1, 214, ' Sello-Retén bomba eléc. 12 - 301', 25.00, NULL, NULL, 25.00, '0', '2024-06-24 10:14:28', '2024-06-24 10:14:28'),
(258, 260, 1, 215, 'Sello-Retén bomba eléc. 15 - cónico', 28.00, NULL, NULL, 28.00, '0', '2024-06-24 10:14:32', '2024-06-24 10:14:32'),
(259, 261, 1, 208, 'Cinta aislante 3M 155 3/4*60*0.005 IN', 5.00, NULL, NULL, 5.00, '0', '2024-06-24 10:17:30', '2024-06-24 10:17:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `id_favorito` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_orden` datetime NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` varchar(60) NOT NULL,
  `estado_orden` varchar(60) DEFAULT 'NUEVO',
  `subtotal` decimal(10,2) DEFAULT 0.00,
  `igv` decimal(10,0) DEFAULT 0,
  `total` decimal(10,2) DEFAULT 0.00,
  `ruta_pago_adjunto` varchar(255) DEFAULT '',
  `ruta_adjunto` varchar(255) DEFAULT '',
  `notas_adicionales` text DEFAULT NULL,
  `metodo_entrega` varchar(32) DEFAULT '',
  `cliente_nombre` varchar(255) DEFAULT '',
  `cliente_correo` varchar(255) DEFAULT '',
  `cliente_direccion` text DEFAULT NULL,
  `cliente_telefono` varchar(32) DEFAULT '',
  `cliente_departamento` varchar(64) DEFAULT '',
  `cliente_codigo_postal` varchar(5) DEFAULT '',
  `mpago_collection_id` varchar(255) NOT NULL DEFAULT '',
  `mpago_collection_status` varchar(16) NOT NULL DEFAULT '',
  `mpago_status` varchar(16) NOT NULL DEFAULT '',
  `mpago_payment_id` varchar(255) NOT NULL DEFAULT '',
  `mpago_payment_type` varchar(32) NOT NULL DEFAULT '',
  `mpago_merchant_order_id` varchar(255) NOT NULL DEFAULT '',
  `mpago_preference_id` varchar(255) NOT NULL DEFAULT '',
  `mpago_site_id` varchar(64) NOT NULL DEFAULT '',
  `mpago_merchant_account_id` varchar(64) NOT NULL DEFAULT '',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `usuario_id`, `producto_id`, `cantidad`, `fecha_orden`, `metodo_pago`, `estado_orden`, `subtotal`, `igv`, `total`, `ruta_pago_adjunto`, `ruta_adjunto`, `notas_adicionales`, `metodo_entrega`, `cliente_nombre`, `cliente_correo`, `cliente_direccion`, `cliente_telefono`, `cliente_departamento`, `cliente_codigo_postal`, `mpago_collection_id`, `mpago_collection_status`, `mpago_status`, `mpago_payment_id`, `mpago_payment_type`, `mpago_merchant_order_id`, `mpago_preference_id`, `mpago_site_id`, `mpago_merchant_account_id`, `created`, `modified`) VALUES
(247, 152, 0, 0, '2024-06-23 17:42:08', '', 'NUEVO', 0.00, 0, 500.00, '', '', NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2024-06-23 17:42:08', '2024-06-23 17:42:08'),
(250, 1, 0, 1, '2024-06-23 19:15:02', '', 'ENTREGADO', 0.00, 0, 135.00, '', 'img/pedidos/250-6678d8724c209.pdf', NULL, 'DELIVERY', 'Nick Depaz', 'admin@admin.com', 'Jr. Sebastián de Aliste', '944195972', 'Ancash', '2002', '', '', '', '', '', '', '', '', '', '2024-06-23 19:15:02', '2024-06-23 21:22:42'),
(251, 168, 0, 2, '2024-06-23 20:43:01', '', 'PROCESO', 0.00, 0, 6.00, '', '', NULL, 'DELIVERY', 'Anel Cordova Zurita', 'anelenmita@gmail.com', 'Castilla', '918848872', 'Los pinos Mz A Lt14', '20001', '', '', '', '', '', '', '', '', '', '2024-06-23 20:43:01', '2024-06-23 20:45:37'),
(252, 172, 0, 2, '2024-06-23 20:58:26', 'yape', 'ENTREGADO', 0.00, 0, 85.00, 'img/pedidos/252-6678d45ebb338.jpeg', 'img/pedidos/252-6678d505365da.pdf', NULL, 'LOCAL', 'Elizabeth', 'elizabethbancesvidaurre@gmail.com', 'Mórrope', '910593510', '', '', '', '', '', '', '', '', '', '', '', '2024-06-23 20:58:26', '2024-06-23 21:08:05'),
(255, 1, 0, 2, '2024-06-23 22:39:46', 'yape', 'ENTREGADO', 0.00, 0, 57.00, 'img/pedidos/255-6679012063a47.pdf', 'img/pedidos/255-6679019de7fe4.pdf', NULL, 'LOCAL', 'Kent Rumiche', 'admin@admin.com', 'Sechura', '944195972', 'Piura', '2002', '', '', '', '', '', '', '', '', '', '2024-06-23 22:39:46', '2024-06-24 00:18:21'),
(256, 1, 0, 0, '2024-06-23 23:20:29', '', 'NUEVO', 0.00, 0, 18.00, '', '', NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2024-06-23 23:20:29', '2024-06-24 10:10:57'),
(257, 158, 0, 2, '2024-06-23 23:32:55', 'yape', 'NUEVO', 0.00, 0, 96.00, '', '', NULL, 'LOCAL', 'ggg', 'ggg@gmail.com', 'ggg', '3354', 'fff', '344', '', '', '', '', '', '', '', '', '', '2024-06-23 23:32:55', '2024-06-24 08:14:05'),
(258, 168, 0, 5, '2024-06-24 00:14:16', '', 'PROCESO', 0.00, 0, 150.00, '', '', NULL, 'DELIVERY', 'Anel Cordova Zurita', 'anelenmita@gmail.com', 'Castilla', '918848874', '', '', '', '', '', '', '', '', '', '', '', '2024-06-24 00:14:16', '2024-06-24 00:14:47'),
(259, 168, 0, 3, '2024-06-24 08:21:10', 'yape', 'PAGADO', 0.00, 0, 46.50, 'img/pedidos/259-66797391e9fc9.png', '', NULL, 'LOCAL', 'Anel Cordova Zurita', 'anelenmita@gmail.com', 'Castilla', '918848874', '', '', '', '', '', '', '', '', '', '', '', '2024-06-24 08:21:10', '2024-06-24 08:24:33'),
(260, 168, 0, 2, '2024-06-24 10:14:28', 'yape', 'NUEVO', 0.00, 0, 53.00, '', '', NULL, 'LOCAL', 'Anel Cordova Zurita', 'anelenmita@gmail.com', 'Castilla', '918848874', '', '', '', '', '', '', '', '', '', '', '', '2024-06-24 10:14:28', '2024-06-24 10:22:39'),
(261, 175, 0, 1, '2024-06-24 10:17:30', 'yape', 'PAGADO', 0.00, 0, 5.00, 'img/pedidos/261-66798ed158ac2.png', '', NULL, 'LOCAL', 'gerber', 'elprofecode@gmail.com', 'aaaaaaa', '950527734', 'aaaa', '04008', '', '', '', '', '', '', '', '', '', '2024-06-24 10:17:30', '2024-06-24 10:20:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  `nom_producto` varchar(60) NOT NULL,
  `marca_producto` varchar(65) NOT NULL,
  `precio_producto` decimal(10,2) DEFAULT 0.00,
  `desc_producto` decimal(10,2) DEFAULT 0.00,
  `principal` text NOT NULL,
  `general` text NOT NULL,
  `imagen1` varchar(150) NOT NULL,
  `imagen2` varchar(150) NOT NULL,
  `imagen3` varchar(150) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock` varchar(1) DEFAULT '0',
  `proveedor_id` bigint(20) UNSIGNED DEFAULT 0,
  `fecha_publicacion` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `subcategoria_id`, `nom_producto`, `marca_producto`, `precio_producto`, `desc_producto`, `principal`, `general`, `imagen1`, `imagen2`, `imagen3`, `cantidad`, `stock`, `proveedor_id`, `fecha_publicacion`, `fecha_actualizacion`) VALUES
(196, 32, 0, 'Foco led 9 W', 'LINUX ', 7.00, 0.00, 'FOCO BOLA LED 9W LINUX', 's', 'img/6678bb2791295.jpg', '', '', 9, '1', 8, '2024-06-24 00:14:00', '2024-06-23 21:05:18'),
(197, 32, 0, 'Curva-codo de tubo PVC luz 5/8', 'PVC', 5.00, 0.00, 'Curva-codo de tubo PVC luz 5/8', 's', 'img/6678c1e441fc6.png', '', '', 2, '1', 6, '2024-06-24 00:46:28', '2024-06-23 19:46:28'),
(198, 32, 0, 'Foco led LINUX 12 W', 'LINUX', 8.00, 0.00, 'Foco led LINUX 12 W', 's', 'img/6678c2555e3ea.jpg', '', '', 5, '1', 6, '2024-06-24 00:48:21', '2024-06-23 19:48:21'),
(199, 32, 0, 'Tubos luz PVC sel 5/8 plástica', 'Tubos luz PVC sel 5/8 plástica', 4.50, 0.00, 'Tubos luz PVC sel 5/8 plástica', 's', 'img/6678c2772a27a.jpg', '', '', 100, '1', 6, '2024-06-24 00:48:55', '2024-06-23 19:48:55'),
(200, 33, 0, 'Taladro CROWM 600W - 13mm', 'CROWM', 190.00, 0.00, 'Taladro CROWM 600W - 13mm', 'S', 'img/6678c2c443b92.jfif', 'img/6678c2c443cc0.jpg', '', 3, '1', 7, '2024-06-24 00:50:12', '2024-06-23 19:50:12'),
(201, 33, 0, 'Motor WEG 10 HP', 'WEG', 1200.00, 0.00, 'Motor WEG 10 HP', 'S', 'img/6678c2f6b51b2.png', '', '', 8, '1', 8, '2024-06-24 00:51:02', '2024-06-23 19:51:02'),
(202, 33, 0, 'Bomba Meba ', 'Meba', 630.00, 0.00, 'Bomba Meba ', 's', 'img/6678c35f85d02.jfif', 'img/6678c35f85e41.jfif', '', 4, '1', 9, '2024-06-24 00:52:47', '2024-06-23 19:52:47'),
(203, 34, 0, 'Alambre 15', 'Indeco', 78.00, 0.00, 'Alambre 15', 's', 'img/6678c3cc148a0.jfif', '', '', 12, '1', 6, '2024-06-24 00:54:36', '2024-06-23 21:05:18'),
(204, 34, 0, 'Cable flexible INDECO Nº14 rollo ', 'Indeco', 2.50, 0.00, 'Cable flexible INDECO Nº14 rollo ', 's', 'img/6678c44c63a2e.png', 'img/6678c44c64127.png', 'img/6678c44c642aa.png', 300, '1', 0, '2024-06-24 00:56:44', '2024-06-23 19:56:44'),
(205, 34, 0, 'Cable vulcanizado 2l | Nº14 INDECO', 'Indeco', 5.00, 0.00, 'Cable vulcanizado 2l | Nº14 INDECO', 's', 'img/6678c4bd01fde.jfif', '', '', 80, '1', 10, '2024-06-24 00:58:37', '2024-06-23 19:58:37'),
(206, 35, 0, 'Spaguetty Nº 1', 'Indeco', 1.00, 0.00, 'Spaguetty Nº 1', 's', 'img/6678c514c8362.jfif', '', '', 800, '1', 7, '2024-06-24 01:00:04', '2024-06-23 20:00:04'),
(207, 35, 0, 'Spaguetty termocontraíble Nº 3', 'Indeco', 1.50, 0.00, 'Spaguetty termocontraíble Nº 3', 's', 'img/6678c5b309c83.jpg', '', '', 750, '1', 9, '2024-06-24 01:02:43', '2024-06-23 20:02:43'),
(208, 35, 0, 'Cinta aislante 3M 155 3/4*60*0.005 IN', '3M', 5.00, 0.00, 'Cinta aislante 3M 155 3/4*60*0.005 IN', 's', 'img/6678c64103842.jfif', 'img/6678c6410395a.jpg', '', 84, '0', 7, '2024-06-24 01:05:05', '2024-06-24 10:20:49'),
(209, 36, 0, 'Térmicos B-TICINO 2V 16 A ', 'B-TICINO', 35.00, 0.00, 'Térmicos B-TICINO 2V 16 A ', 's', 'img/6678c6bd59bdb.jpg', '', '', 80, '0', 8, '2024-06-24 01:07:09', '2024-06-23 20:07:09'),
(210, 36, 0, 'Térmicos STRONG 2V 20 A ', 'STRONG', 45.00, 0.00, 'Térmicos STRONG 2V 20 A ', 's', 'img/6678c74621186.jpg', '', '', 2, '1', 6, '2024-06-24 01:09:26', '2024-06-24 00:16:16'),
(211, 37, 0, 'Guantes TANQUE cuero', 'TANQUE', 12.00, 0.00, 'Guantes TANQUE cuero', 'S', 'img/6679903bea108.jfif', '', '', 4, '0', 9, '2024-06-24 01:10:40', '2024-06-24 10:26:51'),
(212, 37, 0, 'Lentes GCL transparente  ', 'GCL', 6.00, 0.00, 'Lentes GCL transparente  \r\n', 's', 'img/6678c7cf3f0f0.jpg', '', '', 24, '1', 8, '2024-06-24 01:11:43', '2024-06-24 08:24:33'),
(213, 38, 0, 'Ventiladores 14 * 162', 'PVC', 28.50, 0.00, 'Ventiladores 14 * 162', 's', 'img/6678c8515e0ad.jpg', '', '', 12, '1', 7, '2024-06-24 01:13:53', '2024-06-24 08:24:33'),
(214, 39, 0, ' Sello-Retén bomba eléc. 12 - 301', 'LINUX', 25.00, 0.00, ' Sello-Retén bomba eléc. 12 - 301', 's', 'img/6678d102b7f03.jfif', '', '', 8, '0', 9, '2024-06-24 01:50:58', '2024-06-23 20:50:58'),
(215, 39, 0, 'Sello-Retén bomba eléc. 15 - cónico', 'LINUX', 28.00, 0.00, 'Sello-Retén bomba eléc. 15 - cónico', 's', 'img/6678d1631640c.jfif', '', '', 9, '1', 0, '2024-06-24 01:52:35', '2024-06-23 20:52:35'),
(216, 40, 0, 'Capacitor arranque DUCATTI 200-240 uf', 'DUCATTI', 50.00, 0.00, 'Capacitor arranque DUCATTI 200-240 uf', 's', 'img/6678e71259937.jpg', '', '', 8, '1', 9, '2024-06-24 03:25:06', '2024-06-23 22:25:06'),
(217, 40, 0, 'Cap. trabajo GLOBAL CAP 20 uf 450 v', 'GLOBAL CAP', 48.00, 0.00, 'Cap. trabajo GLOBAL CAP 20 uf 450 v', 'S', 'img/6678e75f330ba.jpg', '', '', 23, '1', 7, '2024-06-24 03:26:23', '2024-06-23 22:26:23'),
(218, 41, 0, 'Disco corte 4 1/2 TOTAL amoladora', 'TOTAL', 3.00, 0.00, 'Disco corte 4 1/2 TOTAL amoladora', 'S', 'img/66798f1ed14a0.jpg', '', '', 31, '1', 6, '2024-06-24 03:29:13', '2024-06-24 10:22:06'),
(219, 41, 0, 'Electrodo TRUPPER E-6011 T', 'TRUPPER', 18.00, 0.00, 'Electrodo TRUPPER E-6011 T', 'S', 'img/6678e850d0f62.jpg', '', '', 5, '1', 6, '2024-06-24 03:30:24', '2024-06-23 22:30:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT 0,
  `ruc` varchar(11) DEFAULT '',
  `razon_social` varchar(255) DEFAULT '',
  `nombre_comercial` varchar(255) DEFAULT '',
  `descripcion` text DEFAULT NULL,
  `telefono` varchar(16) DEFAULT '',
  `correo` varchar(128) DEFAULT '',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `usuario_id`, `ruc`, `razon_social`, `nombre_comercial`, `descripcion`, `telefono`, `correo`, `created`, `modified`) VALUES
(6, 160, '10164121611', 'Ecca', 'Ecca', 'Ecca', '935670255', 'pacherrez08@gmail.com', '2024-06-23 19:03:19', '2024-06-23 19:03:19'),
(7, 162, '10164121611', 'Industrias eléctricas MyK', 'Industrias eléctricas MyK', 'Industrias eléctricas MyK', '917199888', 'korinakrist@gmail.com', '2024-06-23 19:04:45', '2024-06-23 19:04:45'),
(8, 163, '10164181826', 'Electrogis', 'Electrogis', 'Electrogis', '917230054', 'susana555@gmail.com', '2024-06-23 19:05:42', '2024-06-23 19:05:42'),
(9, 164, '10164181826', 'Servicios Merino', 'Servicios Merino', 'Servicios Merino', '930616582', 'miguelito.f@gmail.com', '2024-06-23 19:06:47', '2024-06-23 19:08:13'),
(10, 165, '10277293086', 'Constructor', 'Constructor', 'Constructor', '975214587', 'olgaj77@gmail.com', '2024-06-23 19:07:27', '2024-06-23 19:07:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena`
--

CREATE TABLE `resena` (
  `id_resena` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `calidad` varchar(32) DEFAULT '',
  `valor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(255) DEFAULT '',
  `resumen` varchar(100) NOT NULL,
  `revision` longtext NOT NULL,
  `fecha_revision` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_id` bigint(20) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nom_subcategoria` varchar(60) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `dni` varchar(8) DEFAULT '',
  `nom_usuario` varchar(60) NOT NULL,
  `correo_usuario` varchar(255) NOT NULL,
  `telef_usuario` varchar(32) DEFAULT '',
  `contrasena` varchar(255) DEFAULT '',
  `direccion` longtext NOT NULL,
  `departamento` text NOT NULL,
  `codigo_postal` varchar(5) DEFAULT '',
  `tipo` varchar(16) NOT NULL DEFAULT 'CLIENTE',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT current_timestamp(),
  `cod_recuperacion` varchar(128) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `dni`, `nom_usuario`, `correo_usuario`, `telef_usuario`, `contrasena`, `direccion`, `departamento`, `codigo_postal`, `tipo`, `fecha_creacion`, `fecha_actualizacion`, `cod_recuperacion`) VALUES
(1, '05678903', 'Kent Rumiche', 'admin@admin.com', '944195972', '$2y$10$CxMFnDRzE6j8P1vW57o25ODREzrDp.igv/gMLVhJFJOVBwptolaty', 'Sechura', 'Piura', '2002', 'ADM', '2023-02-10 22:23:24', '2024-06-24 10:21:46', 'recuperacion66798f0a92044'),
(156, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 17:46:18', '2024-06-23 17:46:18', ''),
(157, '', 'Gerber', 'elprofecode@gmail.com', '950527734', '$2y$10$WKI3w5Mu4C/O0.wn.Nq63OtyvWhksqMp3IeZC2MH9vAET3r1TXdV.', 'casa de gerber', 'arequipa', '04008', 'CLIENTE', '2024-06-23 17:47:49', '2024-06-23 17:47:49', ''),
(158, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 17:59:30', '2024-06-23 17:59:30', ''),
(159, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 18:05:29', '2024-06-23 18:05:29', ''),
(160, '03256788', 'Juan Pacherrez', 'pacherrez08@gmail.com', '932567830', '$2y$10$6GC7LvwtDmUs2DwUWe5RGOLa3gXy/AOJrPc6RESmLoH.xw3YDSVYG', 'Lima', 'San Borja', '2006', 'PROVEEDOR', '2024-06-23 19:03:19', '2024-06-23 22:39:06', ''),
(161, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 19:04:11', '2024-06-23 19:04:11', ''),
(162, '', 'Krist Korina', 'korinakrist@gmail.com', '', '$2y$10$nuHPqeiUY9N8oxIbau7pI.l8S7JQnwCyqlP9CMFOCOu3smkDBiSmq', '', '', '', 'PROVEEDOR', '2024-06-23 19:04:45', '2024-06-23 19:04:45', ''),
(163, '', 'Susana Delgado', 'susana555@gmail.com', '', '$2y$10$9ZGH.yS8VPjKGEhn1JYVy.Qj96orpB6WAFYDVjHRgmUXtVLxoEgyq', '', '', '', 'PROVEEDOR', '2024-06-23 19:05:42', '2024-06-23 22:21:48', 'recuperacion6678e64ceb5cf'),
(164, '', 'Miguel Fiestas', 'miguelito.f@gmail.com', '', '$2y$10$ab5Uv.ftDJsXZaPmI3OiN.unLDUKSKjhPJ3ZhYH38meyt0h9x/J.a', '', '', '', 'PROVEEDOR', '2024-06-23 19:06:47', '2024-06-23 19:08:33', ''),
(165, '', 'Olga Jacinto', 'olgaj77@gmail.com', '', '$2y$10$TFhYvhlfw6sR.3AHqnNgU.SW0tE3j.OR9Bn39BH2/AbQzqqAcjsN.', '', '', '', 'PROVEEDOR', '2024-06-23 19:07:27', '2024-06-23 19:07:27', ''),
(166, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 20:12:40', '2024-06-23 20:12:40', ''),
(167, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 20:13:00', '2024-06-23 20:13:00', ''),
(168, '74706178', 'Anel Cordova Zurita', 'anelenmita@gmail.com', '918848874', '$2y$10$0Sty7g2YWw73kZVaZ9K1HORtSVTqUQxcNye9QvX/GnPPLwnLuyAnC', 'Castilla', '', '', 'CLIENTE', '2024-06-23 20:33:44', '2024-06-23 20:33:44', ''),
(169, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 20:39:40', '2024-06-23 20:39:40', ''),
(170, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 20:40:45', '2024-06-23 20:40:45', ''),
(171, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 20:41:34', '2024-06-23 20:41:34', ''),
(172, '76022010', 'Elizabeth', 'elizabethbancesvidaurre@gmail.com', '910593510', '$2y$10$ZxE46ssuun3i8YKTBoUADOZh66wI4fknD719nWyNsAyW9A88Wj/3q', 'Mórrope', '', '', 'CLIENTE', '2024-06-23 20:45:02', '2024-06-23 20:45:02', ''),
(173, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 22:02:49', '2024-06-23 22:02:49', ''),
(174, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 23:13:19', '2024-06-23 23:13:19', ''),
(175, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-23 23:20:20', '2024-06-23 23:20:20', ''),
(176, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 08:22:03', '2024-06-24 08:22:03', ''),
(177, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 08:22:03', '2024-06-24 08:22:03', ''),
(178, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 10:16:11', '2024-06-24 10:16:11', ''),
(179, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 10:19:15', '2024-06-24 10:19:15', ''),
(180, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 10:19:15', '2024-06-24 10:19:15', ''),
(181, '', 'Desconocido', '', '', '', '', '', '', 'DESCONOCIDO', '2024-06-24 10:23:05', '2024-06-24 10:23:05', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`categoria_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resena`
--
ALTER TABLE `resena`
  ADD PRIMARY KEY (`id_resena`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `resena`
--
ALTER TABLE `resena`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resena`
--
ALTER TABLE `resena`
  ADD CONSTRAINT `resena_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
