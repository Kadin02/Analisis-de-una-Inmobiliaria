-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `CEDULA` varchar(20) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDO` varchar(50) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `NUMERO_T` varchar(15) DEFAULT NULL,
  `CORREO` varchar(50) DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`CEDULA`, `NOMBRE`, `APELLIDO`, `DIRECCION`, `NUMERO_T`, `CORREO`, `FECHA_NACIMIENTO`) VALUES
('144', 'evelio', 'quirozz', 'villa lucre', '60661544', 'Quiroz45@yahoo.com', '1988-05-22'),
('c419352', 'cesar', 'aguilar', 'penonome', '63331096', 'cesarA@gmail.com', '1969-12-05'),
('ec-47-14816', 'Axl', 'Aguilar', 'Panama', '62333394', 'yanirik95@gmail.com', '1995-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_credenciales`
--

CREATE TABLE `cliente_credenciales` (
  `ID_C` int(11) NOT NULL,
  `CEDULA_C` varchar(20) DEFAULT NULL,
  `CONTRASEÑA` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente_credenciales`
--

INSERT INTO `cliente_credenciales` (`ID_C`, `CEDULA_C`, `CONTRASEÑA`) VALUES
(1, 'ec-47-14816', 'conker95'),
(3, 'c419352', 'cesart'),
(4, '144', 'quiroz10');

-- --------------------------------------------------------

--
-- Table structure for table `contratos`
--

CREATE TABLE `contratos` (
  `ID_CONTRATO` int(11) NOT NULL,
  `CEDULA_C` varchar(20) DEFAULT NULL,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `TIPO_CONTRATO` varchar(50) DEFAULT NULL,
  `FECHA_INICIO` date DEFAULT NULL,
  `FECHA_FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `ID_COTIZACION` int(11) NOT NULL,
  `CEDULA_C` varchar(20) DEFAULT NULL,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `MONTO_ESTIMADO` decimal(10,2) DEFAULT NULL,
  `FECHA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `ID_MANTENIMIENTO` int(11) NOT NULL,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `TIPO_TRABAJO` varchar(100) DEFAULT NULL,
  `NOMBRE_C` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `DIRECCION_C` varchar(100) DEFAULT NULL,
  `FECHA_INICIO` date DEFAULT NULL,
  `FECHA_FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `ID_PAGO` int(11) NOT NULL,
  `ID_CONTRATO` int(11) DEFAULT NULL,
  `MONTO` decimal(10,2) DEFAULT NULL,
  `FECHA_PAGO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotora`
--

CREATE TABLE `promotora` (
  `ID_PROMOTORA` int(11) NOT NULL,
  `NOMBRE_P` varchar(100) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `TIPO_PROYECTO` varchar(50) DEFAULT NULL,
  `IMAGEN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotora`
--

INSERT INTO `promotora` (`ID_PROMOTORA`, `NOMBRE_P`, `DIRECCION`, `TELEFONO`, `TIPO_PROYECTO`, `IMAGEN`) VALUES
(1, 'Arboleda Garden', 'Punta Pacifica', '2361111', 'Residencial', '674d3aa776196_ARBOLEDA_GARDEN.png'),
(2, 'La Comarca', 'Darien, Panama', '2147555', 'Residencial', '674e45477eddb_la comarca.webp');

-- --------------------------------------------------------

--
-- Table structure for table `propiedades`
--

CREATE TABLE `propiedades` (
  `ID_PROPIEDAD` int(11) NOT NULL,
  `TIPO` varchar(50) DEFAULT NULL,
  `UBICACION` varchar(100) DEFAULT NULL,
  `ESTADO` varchar(50) DEFAULT NULL,
  `CONTACTO` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `METROS_CUADRADOS` decimal(10,2) DEFAULT NULL,
  `PISOS` int(11) DEFAULT NULL,
  `HABITACIONES` int(11) DEFAULT NULL,
  `BAÑOS` int(11) DEFAULT NULL,
  `PRECIO` int(11) NOT NULL,
  `IMAGEN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propiedades`
--

INSERT INTO `propiedades` (`ID_PROPIEDAD`, `TIPO`, `UBICACION`, `ESTADO`, `CONTACTO`, `TELEFONO`, `METROS_CUADRADOS`, `PISOS`, `HABITACIONES`, `BAÑOS`, `PRECIO`, `IMAGEN`) VALUES
(1, 'CASA', 'CHORRERA, LA ESPIGA', 'USADA', 'EVELIO QUIROZ', '60661544', 200.00, 1, 2, 1, 20000, '');

-- --------------------------------------------------------

--
-- Table structure for table `propiedades_clientes`
--

CREATE TABLE `propiedades_clientes` (
  `CEDULA_C` varchar(20) NOT NULL,
  `ID_PROPIEDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propiedades_clientes`
--

INSERT INTO `propiedades_clientes` (`CEDULA_C`, `ID_PROPIEDAD`) VALUES
('144', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proyectos`
--

CREATE TABLE `proyectos` (
  `NOMBRE_PROYECTO` varchar(100) NOT NULL,
  `ID_PROMOTORA` int(11) DEFAULT NULL,
  `UBICACION` varchar(50) NOT NULL,
  `METROS CUADRADOS` int(5) NOT NULL,
  `TIPO PROYECTO` varchar(50) NOT NULL,
  `PISOS` int(2) NOT NULL,
  `CUARTOS` int(2) NOT NULL,
  `BAÑOS` int(2) NOT NULL,
  `PRECIO DE VENTA` int(9) NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `IMAGEN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proyectos`
--

INSERT INTO `proyectos` (`NOMBRE_PROYECTO`, `ID_PROMOTORA`, `UBICACION`, `METROS CUADRADOS`, `TIPO PROYECTO`, `PISOS`, `CUARTOS`, `BAÑOS`, `PRECIO DE VENTA`, `DESCRIPCION`, `IMAGEN`) VALUES
('Alturas Park', 2, 'Tanara, Chepo', 150, 'residencial', 1, 3, 2, 20000, 'Cada vez mas cerca de ti', '674e4dd77ec63_Casa Eco.png'),
('Residencia Destiny', 1, 'San Francisco, Panama', 200, 'Residencial', 2, 3, 2, 40000, 'a', '674d65c414ce3_PROYECTO 1.avif');

-- --------------------------------------------------------

--
-- Table structure for table `reclamaciones`
--

CREATE TABLE `reclamaciones` (
  `ID_RECLAMO` int(11) NOT NULL,
  `CEDULA_C` varchar(20) DEFAULT NULL,
  `ID_CONTRATO` int(11) DEFAULT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `ESTADO` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles_usuarios`
--

CREATE TABLE `roles_usuarios` (
  `CEDULA_US` varchar(20) DEFAULT NULL,
  `ROL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles_usuarios`
--

INSERT INTO `roles_usuarios` (`CEDULA_US`, `ROL`) VALUES
('9999', 'GERENTE'),
('6666', 'SUPERVISOR');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_backoffice`
--

CREATE TABLE `usuario_backoffice` (
  `CEDULA_U` varchar(20) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDO` varchar(50) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  `DIRECCION` varchar(50) NOT NULL,
  `N_TELEFONO` int(30) NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario_backoffice`
--

INSERT INTO `usuario_backoffice` (`CEDULA_U`, `NOMBRE`, `APELLIDO`, `CORREO`, `DIRECCION`, `N_TELEFONO`, `FECHA_NACIMIENTO`) VALUES
('6666', 'zaida', 'morales', 'zaida14@hotmail.com', 'penonome', 444444, '1987-11-05'),
('9999', 'ezequiell', 'fernandez', 'ezequiel18@gmail.com', 'florida, caimitillo', 2147555, '2010-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_credenciales`
--

CREATE TABLE `usuario_credenciales` (
  `ID_U` int(11) NOT NULL,
  `CEDULA_US` varchar(20) DEFAULT NULL,
  `CONTRASEÑA` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario_credenciales`
--

INSERT INTO `usuario_credenciales` (`ID_U`, `CEDULA_US`, `CONTRASEÑA`) VALUES
(4, '9999', 'ezeq14'),
(5, '6666', 'zaida14');

-- --------------------------------------------------------

--
-- Table structure for table `visitas`
--

CREATE TABLE `visitas` (
  `ID_VISITA` int(11) NOT NULL,
  `CEDULA_C` varchar(20) DEFAULT NULL,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `FECHA_VISITA` date DEFAULT NULL,
  `HORA` time DEFAULT NULL,
  `MOTIVO_VISITA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitas`
--

INSERT INTO `visitas` (`ID_VISITA`, `CEDULA_C`, `ID_PROPIEDAD`, `FECHA_VISITA`, `HORA`, `MOTIVO_VISITA`) VALUES
(1, '144', 1, '2024-12-10', '15:48:00', 'INSPECCION');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`CEDULA`);

--
-- Indexes for table `cliente_credenciales`
--
ALTER TABLE `cliente_credenciales`
  ADD PRIMARY KEY (`ID_C`),
  ADD KEY `CEDULA_C` (`CEDULA_C`);

--
-- Indexes for table `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`ID_CONTRATO`),
  ADD KEY `CEDULA_C` (`CEDULA_C`),
  ADD KEY `ID_PROPIEDAD` (`ID_PROPIEDAD`);

--
-- Indexes for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`ID_COTIZACION`),
  ADD KEY `CEDULA_C` (`CEDULA_C`),
  ADD KEY `ID_PROPIEDAD` (`ID_PROPIEDAD`);

--
-- Indexes for table `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`ID_MANTENIMIENTO`),
  ADD KEY `ID_PROPIEDAD` (`ID_PROPIEDAD`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`ID_PAGO`),
  ADD KEY `ID_CONTRATO` (`ID_CONTRATO`);

--
-- Indexes for table `promotora`
--
ALTER TABLE `promotora`
  ADD PRIMARY KEY (`ID_PROMOTORA`);

--
-- Indexes for table `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`ID_PROPIEDAD`);

--
-- Indexes for table `propiedades_clientes`
--
ALTER TABLE `propiedades_clientes`
  ADD PRIMARY KEY (`CEDULA_C`,`ID_PROPIEDAD`),
  ADD KEY `FK_ID_PROPIEDAD` (`ID_PROPIEDAD`);

--
-- Indexes for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`NOMBRE_PROYECTO`),
  ADD KEY `ID_PROMOTORA` (`ID_PROMOTORA`);

--
-- Indexes for table `reclamaciones`
--
ALTER TABLE `reclamaciones`
  ADD PRIMARY KEY (`ID_RECLAMO`),
  ADD KEY `CEDULA_C` (`CEDULA_C`),
  ADD KEY `ID_CONTRATO` (`ID_CONTRATO`);

--
-- Indexes for table `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD KEY `CEDULA_US` (`CEDULA_US`);

--
-- Indexes for table `usuario_backoffice`
--
ALTER TABLE `usuario_backoffice`
  ADD PRIMARY KEY (`CEDULA_U`);

--
-- Indexes for table `usuario_credenciales`
--
ALTER TABLE `usuario_credenciales`
  ADD PRIMARY KEY (`ID_U`),
  ADD KEY `CEDULA_US` (`CEDULA_US`);

--
-- Indexes for table `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`ID_VISITA`),
  ADD KEY `CEDULA_C` (`CEDULA_C`),
  ADD KEY `ID_PROPIEDAD` (`ID_PROPIEDAD`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente_credenciales`
--
ALTER TABLE `cliente_credenciales`
  MODIFY `ID_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contratos`
--
ALTER TABLE `contratos`
  MODIFY `ID_CONTRATO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `ID_COTIZACION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `ID_MANTENIMIENTO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `ID_PAGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotora`
--
ALTER TABLE `promotora`
  MODIFY `ID_PROMOTORA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `ID_PROPIEDAD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reclamaciones`
--
ALTER TABLE `reclamaciones`
  MODIFY `ID_RECLAMO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario_credenciales`
--
ALTER TABLE `usuario_credenciales`
  MODIFY `ID_U` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `ID_VISITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente_credenciales`
--
ALTER TABLE `cliente_credenciales`
  ADD CONSTRAINT `cliente_credenciales_ibfk_1` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`);

--
-- Constraints for table `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`),
  ADD CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`ID_PROPIEDAD`) REFERENCES `propiedades` (`ID_PROPIEDAD`);

--
-- Constraints for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`),
  ADD CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`ID_PROPIEDAD`) REFERENCES `propiedades` (`ID_PROPIEDAD`);

--
-- Constraints for table `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`ID_PROPIEDAD`) REFERENCES `propiedades` (`ID_PROPIEDAD`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`ID_CONTRATO`) REFERENCES `contratos` (`ID_CONTRATO`);

--
-- Constraints for table `propiedades_clientes`
--
ALTER TABLE `propiedades_clientes`
  ADD CONSTRAINT `FK_CEDULA_CLIENTE` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_PROPIEDAD` FOREIGN KEY (`ID_PROPIEDAD`) REFERENCES `propiedades` (`ID_PROPIEDAD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`ID_PROMOTORA`) REFERENCES `promotora` (`ID_PROMOTORA`);

--
-- Constraints for table `reclamaciones`
--
ALTER TABLE `reclamaciones`
  ADD CONSTRAINT `reclamaciones_ibfk_1` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`),
  ADD CONSTRAINT `reclamaciones_ibfk_2` FOREIGN KEY (`ID_CONTRATO`) REFERENCES `contratos` (`ID_CONTRATO`);

--
-- Constraints for table `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD CONSTRAINT `roles_usuarios_ibfk_1` FOREIGN KEY (`CEDULA_US`) REFERENCES `usuario_backoffice` (`CEDULA_U`);

--
-- Constraints for table `usuario_credenciales`
--
ALTER TABLE `usuario_credenciales`
  ADD CONSTRAINT `usuario_credenciales_ibfk_1` FOREIGN KEY (`CEDULA_US`) REFERENCES `usuario_backoffice` (`CEDULA_U`);

--
-- Constraints for table `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`CEDULA_C`) REFERENCES `clientes` (`CEDULA`),
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`ID_PROPIEDAD`) REFERENCES `propiedades` (`ID_PROPIEDAD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
