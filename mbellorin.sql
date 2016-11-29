-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2016 at 11:58 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbellorin`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulo`
--

CREATE TABLE `articulo` (
  `codigoart` int(11) NOT NULL,
  `ultim_mod` datetime DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL,
  `existencia` int(11) NOT NULL,
  `stockmin` int(11) DEFAULT NULL,
  `tipo_unidad` varchar(50) DEFAULT NULL,
  `costo_unidad` double DEFAULT NULL,
  `costo_adicional` double DEFAULT NULL,
  `precio_compra` double NOT NULL,
  `margen_ganancia` double DEFAULT NULL,
  `base_imponible` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `precio_venta` double NOT NULL,
  `codigo_proveedor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articulo`
--

INSERT INTO `articulo` (`codigoart`, `ultim_mod`, `descripcion`, `existencia`, `stockmin`, `tipo_unidad`, `costo_unidad`, `costo_adicional`, `precio_compra`, `margen_ganancia`, `base_imponible`, `iva`, `precio_venta`, `codigo_proveedor`) VALUES
(1000, '2016-04-16 11:27:19', 'Base comedor marmol marfil tipo "Y" cuadrada', 5, 2, 'UND', 90000, 0, 90000, 30, 117000, 0, 90000, 'J303731201'),
(1001, '2016-04-16 11:28:39', 'Cofre material granito vaciado', 11, 2, 'UND', 26000, 0, 26000, 30, 33800, 12, 37856, 'J300069761'),
(1002, '2016-04-16 11:29:04', 'Cofre material variado', 16, 2, 'UND', 45000, 0, 45000, 30, 58500, 12, 65520, 'J070152710'),
(1003, '2016-04-16 11:30:13', 'Granito rojo brasil', 10, 2, 'M2', 72549, 0, 72549, 30, 94313.7, 12, 105631.344, 'J300069761'),
(1004, '2016-04-16 11:30:56', 'Granito rojo guajaro', 15, 2, 'M2', 54000, 0, 54000, 30, 70200, 12, 78624, 'J303731201'),
(1005, '2016-04-16 11:31:26', 'Granito rojo guamire', 44, 2, 'M2', 59660, 0, 59660, 20, 71592, 12, 80183.04, 'J303731201'),
(1006, '2016-04-16 11:31:57', 'Granito verde ubatua', 12, 2, 'M2', 82734, 0, 82734, 30, 107554.2, 12, 120460.704, 'J300069761'),
(1007, '2016-04-16 11:32:27', 'Lapida granito negro', 12, 2, 'UND', 70000, 0, 70000, 30, 91000, 12, 101920, 'J300069761'),
(1008, '2016-04-16 11:32:59', 'Marmol blanco celeste', 9, 2, 'M2', 44445, 0, 44445, 30, 57778.5, 12, 64711.92, 'J303731201'),
(1009, '2016-04-16 11:33:35', 'Marmol crema galala', -18, 2, 'M2', 53698, 0, 53698, 30, 69807.4, 12, 78184.288, 'J300069761'),
(1010, '2016-04-16 11:34:04', 'Marmol marron emperador', 8, 2, 'M2', 45395, 0, 45395, 30, 59013.5, 12, 66095.12, 'J070152710'),
(1011, '2016-04-16 11:34:34', 'Marmol negro B', 12, 2, 'M2', 24000, 0, 24000, 30, 31200, 12, 34944, 'J070152710');

--
-- Triggers `articulo`
--
DELIMITER $$
CREATE TRIGGER `sadasd` AFTER INSERT ON `articulo` FOR EACH ROW BEGIN
INSERT INTO operacion  values (null, NEW.codigoart, NEW.existencia, 1, null, now(), null);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` varchar(10) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `apellido_cliente` varchar(50) NOT NULL,
  `tlfcelular_cliente` varchar(50) DEFAULT NULL,
  `tlf_2` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `direccion_cliente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre_cliente`, `apellido_cliente`, `tlfcelular_cliente`, `tlf_2`, `email`, `direccion_cliente`) VALUES
('', '', '', '', '', '', ''),
('V22047895', 'Javier', 'Medina', '04147874563', '', '', 'MCBO'),
('V23601323', 'Jose', 'Castillo', '04247424555', '', '', 'MCBO'),
('V23616178', 'Andrea', 'Lopez', '132105414', '', '', 'MCBO');

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `text` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `idcliente` varchar(10) DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `impuesto` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `ingreso` double DEFAULT NULL,
  `restante` double DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ifanulada_motivo` longtext,
  `forma_pago` varchar(20) DEFAULT NULL,
  `descuento_adicional` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idfactura`, `fecha`, `idcliente`, `importe`, `impuesto`, `total`, `ingreso`, `restante`, `status`, `ifanulada_motivo`, `forma_pago`, `descuento_adicional`) VALUES
(4, '2016-04-16 11:41:01', 'V23601323', 75712, 9085.44, 84797.44, 84797.44, 0, 'APROBADA', NULL, 'EFECTIVO', 0),
(5, '2016-04-16 11:46:43', 'V22047895', 1218782.208, 146253.86496, 1365036.07296, 1365036.072, 0.00096000009216368, 'PENDIENTE', NULL, 'EFECTIVO', 0),
(152, '2016-04-16 11:49:21', 'V23616178', 1720054.336, 206406.52032, 385292.17, 385292.17, 0, 'APROBADA', NULL, 'EFECTIVO', 80);

-- --------------------------------------------------------

--
-- Table structure for table `factura_auxiliar`
--

CREATE TABLE `factura_auxiliar` (
  `codigoarticulo` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `punit` double DEFAULT NULL,
  `unidad_tipo` varchar(50) DEFAULT NULL,
  `importe` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `iddetalle` int(11) NOT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `unidad_tipo` varchar(20) DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura_detalle`
--

INSERT INTO `factura_detalle` (`iddetalle`, `idarticulo`, `descripcion`, `cantidad`, `precio`, `unidad_tipo`, `importe`, `idfactura`) VALUES
(4, 1001, 'Cofre material granito vaciado', 2, 37856, 'UND', 75712, 4),
(5, 1005, 'Granito rojo guamire', 15, 80183.04, 'M2', 1218782.208, 5),
(6, 1009, 'Marmol crema galala', 22, 78184.288, 'M2', 1720054.336, 152);

--
-- Triggers `factura_detalle`
--
DELIMITER $$
CREATE TRIGGER `afins` AFTER INSERT ON `factura_detalle` FOR EACH ROW BEGIN
INSERT INTO operacion  values (null, NEW.idarticulo, NEW.cantidad, 2, null, now(),null);
UPDATE articulo SET existencia = existencia - NEW.cantidad WHERE codigoart = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `operacion`
--

CREATE TABLE `operacion` (
  `id` int(11) NOT NULL,
  `codigoart` int(11) NOT NULL DEFAULT '0',
  `cantidad` float NOT NULL DEFAULT '0',
  `tipo_operacion` int(11) NOT NULL DEFAULT '0',
  `idfactura` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `observacion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operacion`
--

INSERT INTO `operacion` (`id`, `codigoart`, `cantidad`, `tipo_operacion`, `idfactura`, `fecha`, `observacion`) VALUES
(14, 1000, 5, 1, NULL, '2016-04-16 04:57:19', NULL),
(15, 1001, 13, 1, NULL, '2016-04-16 04:58:39', NULL),
(16, 1002, 16, 1, NULL, '2016-04-16 04:59:04', NULL),
(17, 1003, 10, 1, NULL, '2016-04-16 05:00:13', NULL),
(18, 1004, 15, 1, NULL, '2016-04-16 05:00:56', NULL),
(19, 1005, 59, 1, NULL, '2016-04-16 05:01:26', NULL),
(20, 1006, 12, 1, NULL, '2016-04-16 05:01:57', NULL),
(21, 1007, 12, 1, NULL, '2016-04-16 05:02:27', NULL),
(22, 1008, 9, 1, NULL, '2016-04-16 05:02:59', NULL),
(23, 1009, 4, 1, NULL, '2016-04-16 05:03:36', NULL),
(24, 1010, 8, 1, NULL, '2016-04-16 05:04:04', NULL),
(25, 1011, 12, 1, NULL, '2016-04-16 05:04:34', NULL),
(26, 1001, 2, 2, NULL, '2016-04-16 05:11:02', NULL),
(27, 1005, 15, 2, NULL, '2016-04-16 05:16:43', NULL),
(28, 1009, 22, 2, NULL, '2016-04-16 05:19:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `codigo_proveedor` varchar(10) NOT NULL,
  `nombre_proveedor` varchar(50) NOT NULL,
  `tlf_proveedor` varchar(50) NOT NULL,
  `telf_2` varchar(20) DEFAULT NULL,
  `email_proveedor` varchar(50) NOT NULL,
  `direccion_proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`codigo_proveedor`, `nombre_proveedor`, `tlf_proveedor`, `telf_2`, `email_proveedor`, `direccion_proveedor`) VALUES
('J070152710', 'Marmoca C.A', '02617835011', '02617363912', 'info@marmoca.com.ve', 'Zulia, Maracaibo, Av. 28-B, Edificio Marmoca, Piso'),
('J300069761', 'Gramoca C.A', '02617560156', '02617560434', 'inf@gramoca.com.ve', 'Zulia, Maracaibo, Av. 46, Edificio Gramoca, Nivel '),
('J303731201', 'Catema C.A', '02617363480', '02617363480', 'info@catemar.com.ve', 'Zulia, Maracaibo, Cl. 150, cruce con, Esq. Av.67a,');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idrol` int(1) NOT NULL,
  `descripcion_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idrol`, `descripcion_rol`) VALUES
(1, 'Administrador'),
(2, 'Caja');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_operacion`
--

CREATE TABLE `tipo_operacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_operacion`
--

INSERT INTO `tipo_operacion` (`id`, `nombre`) VALUES
(1, 'Entrada'),
(2, 'Salida'),
(3, 'Defecto'),
(4, 'Perdida');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `username`, `password`, `rol`) VALUES
(1, 'adm', '123', 1),
(2, 'caja', 'caja', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`codigoart`),
  ADD KEY `FK_articulo_proveedor` (`codigo_proveedor`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `FK_factura_cliente` (`idcliente`);

--
-- Indexes for table `factura_auxiliar`
--
ALTER TABLE `factura_auxiliar`
  ADD PRIMARY KEY (`codigoarticulo`);

--
-- Indexes for table `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `FK_factura_detalle_factura` (`idfactura`);

--
-- Indexes for table `operacion`
--
ALTER TABLE `operacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigoart` (`codigoart`),
  ADD KEY `tipo_operacion` (`tipo_operacion`),
  ADD KEY `idfactura` (`idfactura`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codigo_proveedor`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indexes for table `tipo_operacion`
--
ALTER TABLE `tipo_operacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `FK_usuario_roles` (`rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `operacion`
--
ALTER TABLE `operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tipo_operacion`
--
ALTER TABLE `tipo_operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `FK_articulo_proveedor` FOREIGN KEY (`codigo_proveedor`) REFERENCES `proveedor` (`codigo_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `FK_factura_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD CONSTRAINT `FK_factura_detalle_factura` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
