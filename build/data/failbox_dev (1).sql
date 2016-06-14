-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-06-2016 a las 18:34:59
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `failbox_dev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminuser`
--

CREATE TABLE `adminuser` (
  `idAdmin` int(11) NOT NULL,
  `adminName` char(64) NOT NULL,
  `adminPassword` char(64) NOT NULL,
  `adminLastConnection` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adminuser`
--

INSERT INTO `adminuser` (`idAdmin`, `adminName`, `adminPassword`, `adminLastConnection`) VALUES
(3, 'admin', '$2y$10$SWMoKfH4qv5.5vTOvds4j.0t3LQx6oKj919EmDWuRzGRVdCPUZiOa', '2016-05-23 12:06:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Caracteristicas`
--

CREATE TABLE `Caracteristicas` (
  `IdCaracteristica` int(11) NOT NULL,
  `NombreCaracteristica` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Caracteristicas`
--

INSERT INTO `Caracteristicas` (`IdCaracteristica`, `NombreCaracteristica`) VALUES
(1, 'Color'),
(2, 'Tamaño'),
(3, 'Peso'),
(4, 'Ancho'),
(5, 'Altura'),
(6, 'Test'),
(7, 'Tecnologia'),
(8, 'Ram'),
(9, 'Disco Duro'),
(10, 'Pantalla'),
(11, 'Longitud'),
(12, 'Frecuencia'),
(13, 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`IdCategoria`, `Categoria`) VALUES
(6, 'Bocinas'),
(7, 'Proyectores'),
(8, 'Monitores'),
(9, 'Teclados'),
(13, 'Mouse'),
(15, 'Celulares'),
(21, 'Computadoras'),
(22, 'Hd Externo'),
(23, 'Video Juegos '),
(24, 'Audifonos'),
(25, 'Test'),
(26, 'Prueba'),
(27, 'Bebe'),
(28, 'Sadasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `Ciudades` (
  `IdCiudad` int(11) NOT NULL,
  `Ciudad` varchar(45) DEFAULT NULL,
  `IdEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Contactos`
--

CREATE TABLE `Contactos` (
  `IdContacto` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Asunto` varchar(45) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Mensaje` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosEnvios`
--

CREATE TABLE `DatosEnvios` (
  `IdDatosEnvios` int(11) NOT NULL,
  `TipoDireccion` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Ciudad` varchar(45) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Colonia` varchar(45) DEFAULT NULL,
  `CP` int(11) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Celular` int(11) DEFAULT NULL,
  `IdPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estados`
--

CREATE TABLE `Estados` (
  `IdEstado` int(11) NOT NULL,
  `Estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas`
--

CREATE TABLE `Marcas` (
  `IdMarca` int(11) NOT NULL,
  `Marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Marcas`
--

INSERT INTO `Marcas` (`IdMarca`, `Marca`) VALUES
(6, 'Panasonic'),
(7, 'Pioneer'),
(8, 'Sony'),
(9, 'Philips'),
(13, 'Toshiba'),
(14, 'Otra'),
(15, 'Test'),
(16, 'Hola'),
(17, 'Sdfsdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedidos`
--

CREATE TABLE `Pedidos` (
  `IdPedido` int(11) NOT NULL,
  `FechaPedido` datetime DEFAULT NULL,
  `Estatus` varchar(45) DEFAULT NULL,
  `Usuarios_IdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `IdProducto` int(11) NOT NULL,
  `NombreProd` varchar(45) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `Stock` int(11) NOT NULL,
  `PrecioLista` float NOT NULL,
  `PrecioFailbox` float NOT NULL,
  `Modelo` varchar(45) NOT NULL,
  `SKU` varchar(50) NOT NULL,
  `Estatus` varchar(45) NOT NULL,
  `Image` varchar(5000) NOT NULL,
  `urlPaypal` varchar(2000) NOT NULL,
  `Destacado` varchar(45) NOT NULL,
  `FechaAlta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`IdProducto`, `NombreProd`, `Descripcion`, `Stock`, `PrecioLista`, `PrecioFailbox`, `Modelo`, `SKU`, `Estatus`, `Image`, `urlPaypal`, `Destacado`, `FechaAlta`) VALUES
(10, 'Producto de prueba', 'DSFASDFG', 32, 232432, 21, 'PROY-32423S', '2147483647', 'Activo', 'imagen4.png,imagen3.png,imagen2.jpg,imagen1.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-06-13 16:36:52'),
(11, 'dsfsdf', 'asdffasdf', 21, 5, 4, 'DSFAFSFdsfadf', '324', 'Inactivo', 'imagen4.png,imagen3.png,imagen1.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-05-23 15:50:20'),
(14, 'Laptop Toshiba Satellite', '5.6 Amd A8 4gb Ram 1tb Hdd', 10, 7500, 5, 'TOFSADDA-324', '2147483647', 'Activo', '20160510212650toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(22, 'XXXX', 'xxxxxx', 22, 22, 4, 'PROY-32423S', '2147483647', 'Activo', '20160513003808toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(33, 'Imagen', 'dsafds', 123, 21, 2, 'IMG', '433535', 'Activo', '20160512221846ucl_omb_1516_pr_05.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(36, 'dsa', '213', 123, 2900, 1500, '21', '1000188883', 'Activo', 'imagen3.png,imagen2.jpg,imagen1.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-05-23 15:41:43'),
(37, 'dsa', '213', 123, 3000, 2800, '21', '1000188883', 'Activo', '20160513010734toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-05-20 11:58:09'),
(39, 'INSIGNIA PANTALLA DE 40', 'dfgsd', 23, 232432, 32, 'SDFASDF-DASF', '2147483647', 'Activo', '20160512221846ucl_omb_1516_pr_05.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(40, 'dsfsdf', 'fasdfadfdas', 32, 342, 23, 'SDFASDF-DASF', '324234234', 'Activo', 'toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(41, 'Prueba Producto', 'Prueba Producto', 3, 765, 2, 'Prueba Producto', 'arser322342', 'Inactivo', 'toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(42, 'Xxxxx', 'xxxxxx', 1, 11, 11, '11111', '11111', 'Inactivo', 'imagen4.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(43, 'prueba con paginacion', 'dfsgdfg', 231, 20, 12, 'SDFASDF-DASF', '1000188883213', 'Activo', 'imagen4.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '0000-00-00 00:00:00'),
(44, 'XXXxxxxxxxxxxxx', 'dasdasd', 2, 2, 3, 'ddddd', '33333', 'Activo', 'imagen4.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '0000-00-00 00:00:00'),
(45, 'Toshiba xxxx', 'ksdlkgskglkdjfh', 44, 5000, 4800, 'dsadasfjalkj', 'sdfs878345', 'Activo', 'toshiba.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-05-20 10:57:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_has_Caracteristicas`
--

CREATE TABLE `Productos_has_Caracteristicas` (
  `Productos_IdProducto` int(11) NOT NULL,
  `Caracteristicas_IdCaracteristica` int(11) NOT NULL,
  `DetalleCaracteristica` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos_has_Caracteristicas`
--

INSERT INTO `Productos_has_Caracteristicas` (`Productos_IdProducto`, `Caracteristicas_IdCaracteristica`, `DetalleCaracteristica`) VALUES
(10, 1, 'Verde'),
(10, 4, 'Verde'),
(10, 13, 'Bebe'),
(11, 1, 'Verde, Blanco, Rojo, Azul, Negro'),
(11, 8, '4343'),
(11, 9, '500GB'),
(14, 1, 'Negra'),
(14, 8, '4gb'),
(14, 10, '20"'),
(22, 1, 'Amarillo'),
(33, 1, 'Azul'),
(33, 3, '1.5Kg'),
(36, 1, 'Negro'),
(36, 2, '55cm'),
(36, 3, '23 GR'),
(36, 7, 'LED'),
(36, 10, 'LED'),
(37, 1, 'Verde'),
(39, 1, 'Negro, Blanco, Azul, Verde'),
(40, 1, 'Rojo'),
(41, 1, 'Verde'),
(41, 4, '55cm'),
(42, 1, 'Verde'),
(42, 4, 'Verde'),
(43, 1, 'Negro'),
(43, 7, 'LED'),
(44, 3, 'Verde'),
(45, 1, 'Negro'),
(45, 8, '4 GB'),
(45, 9, '500 GB'),
(45, 10, '14"');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_has_Categorias`
--

CREATE TABLE `Productos_has_Categorias` (
  `Productos_IdProducto` int(11) NOT NULL,
  `Categorias_IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos_has_Categorias`
--

INSERT INTO `Productos_has_Categorias` (`Productos_IdProducto`, `Categorias_IdCategoria`) VALUES
(10, 15),
(10, 21),
(10, 24),
(11, 6),
(11, 7),
(11, 8),
(14, 21),
(14, 23),
(22, 13),
(22, 22),
(33, 15),
(33, 22),
(36, 9),
(36, 15),
(36, 24),
(37, 22),
(37, 24),
(39, 15),
(39, 22),
(40, 13),
(40, 21),
(41, 7),
(41, 13),
(41, 21),
(41, 23),
(42, 13),
(42, 22),
(42, 24),
(43, 6),
(43, 9),
(43, 21),
(43, 23),
(44, 6),
(44, 8),
(44, 13),
(45, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_has_Imagenes`
--

CREATE TABLE `Productos_has_Imagenes` (
  `Productos_IdProducto` int(11) NOT NULL,
  `IdImagen` int(11) NOT NULL,
  `NombreImagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos_has_Imagenes`
--

INSERT INTO `Productos_has_Imagenes` (`Productos_IdProducto`, `IdImagen`, `NombreImagen`) VALUES
(40, 1, 'imagen1.png'),
(40, 2, 'imagen2.jpg'),
(40, 3, 'imagen4.png'),
(40, 4, 'imagen3.png'),
(10, 5, 'imagen3.png'),
(10, 6, 'imagen4.png'),
(11, 7, 'imagen2.jpg'),
(22, 9, 'imagen1.png'),
(22, 10, 'imagen3.png'),
(22, 11, 'toshiba.jpg'),
(14, 12, 'imagen1.png'),
(14, 13, 'imagen2.jpg'),
(14, 14, 'imagen3.png'),
(14, 15, 'imagen4.png'),
(14, 16, 'toshiba.jpg'),
(33, 17, 'imagen3.png'),
(37, 18, 'imagen2.jpg'),
(36, 19, 'imagen4.png'),
(39, 20, 'imagen4.png'),
(40, 21, 'toshiba.jpg'),
(41, 26, 'imagen1.png'),
(41, 27, 'imagen2.jpg'),
(41, 28, 'imagen3.png'),
(41, 29, 'imagen4.png'),
(41, 30, 'toshiba.jpg'),
(42, 31, 'imagen2.jpg'),
(42, 32, 'imagen3.png'),
(42, 33, 'imagen4.png'),
(43, 34, 'imagen1.png'),
(43, 35, 'imagen2.jpg'),
(43, 36, 'imagen3.png'),
(43, 37, 'imagen4.png'),
(44, 38, 'imagen3.png'),
(44, 39, 'imagen4.png'),
(45, 40, 'imagen2.jpg'),
(45, 41, 'imagen3.png'),
(45, 42, 'imagen4.png'),
(45, 43, 'toshiba.jpg'),
(10, 44, 'imagen2.jpg'),
(10, 45, 'imagen1.png'),
(36, 46, 'imagen3.png'),
(36, 47, 'imagen2.jpg'),
(36, 48, 'imagen1.png'),
(11, 49, 'imagen4.png'),
(11, 50, 'imagen3.png'),
(11, 51, 'imagen1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_has_Marcas`
--

CREATE TABLE `Productos_has_Marcas` (
  `Productos_IdProducto` int(11) NOT NULL,
  `Marcas_IdMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos_has_Marcas`
--

INSERT INTO `Productos_has_Marcas` (`Productos_IdProducto`, `Marcas_IdMarca`) VALUES
(10, 6),
(22, 6),
(40, 7),
(36, 8),
(37, 8),
(39, 8),
(42, 8),
(33, 9),
(11, 13),
(14, 13),
(41, 13),
(43, 13),
(45, 13),
(44, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_has_Pedidos`
--

CREATE TABLE `Productos_has_Pedidos` (
  `Productos_IdProducto` int(11) NOT NULL,
  `Pedidos_IdPedido` int(11) NOT NULL,
  `Cantidad` decimal(18,2) DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `CostoEnvio` float DEFAULT NULL,
  `Total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(400) NOT NULL,
  `TipoPerfil` varchar(45) NOT NULL,
  `FechaAlta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`IdUsuario`, `Nombre`, `Apellido`, `Email`, `Password`, `TipoPerfil`, `FechaAlta`) VALUES
(1, 'Admin01', 'Admin', 'admin@gmail.com', '1qaz2wsx', 'Administrador', '2016-05-05'),
(2, 'Admin', 'Administrador', 'ad@gmail.com', '$2y$10$5wLiIV3lePXN/OqR/fr1W.F/g/yqA.aMWW1gQnUjSg3fsXZOzLGE6', 'Administrador', '2016-05-20'),
(3, 'Admin', 'Administrador', 'ad@gmail.com', '$2y$10$dr1Y10JwyEL1wLXzJyeEM.pzRGtlV.5PQCQXapU6rkqBwp9qPKT5W', 'Administrador', '2016-05-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Caracteristicas`
--
ALTER TABLE `Caracteristicas`
  ADD PRIMARY KEY (`IdCaracteristica`);

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD PRIMARY KEY (`IdCiudad`),
  ADD KEY `FK_EstadoCiudad_idx` (`IdEstado`);

--
-- Indices de la tabla `Contactos`
--
ALTER TABLE `Contactos`
  ADD PRIMARY KEY (`IdContacto`);

--
-- Indices de la tabla `DatosEnvios`
--
ALTER TABLE `DatosEnvios`
  ADD PRIMARY KEY (`IdDatosEnvios`),
  ADD KEY `FK_DatosPed_idx` (`IdPedido`);

--
-- Indices de la tabla `Estados`
--
ALTER TABLE `Estados`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  ADD PRIMARY KEY (`IdMarca`);

--
-- Indices de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD PRIMARY KEY (`IdPedido`),
  ADD KEY `FK_PedProdu_idx` (`IdPedido`),
  ADD KEY `fk_Pedidos_Usuarios1` (`Usuarios_IdUsuario`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `Productos_has_Caracteristicas`
--
ALTER TABLE `Productos_has_Caracteristicas`
  ADD PRIMARY KEY (`Productos_IdProducto`,`Caracteristicas_IdCaracteristica`),
  ADD KEY `fk_Productos_has_Caracteristicas_Caracteristicas1_idx` (`Caracteristicas_IdCaracteristica`),
  ADD KEY `fk_Productos_has_Caracteristicas_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Categorias`
--
ALTER TABLE `Productos_has_Categorias`
  ADD PRIMARY KEY (`Productos_IdProducto`,`Categorias_IdCategoria`),
  ADD KEY `fk_Productos_has_Categorias_Categorias1_idx` (`Categorias_IdCategoria`),
  ADD KEY `fk_Productos_has_Categorias_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  ADD PRIMARY KEY (`IdImagen`,`Productos_IdProducto`),
  ADD KEY `fk_Productos_has_Imagenes_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Marcas`
--
ALTER TABLE `Productos_has_Marcas`
  ADD PRIMARY KEY (`Marcas_IdMarca`,`Productos_IdProducto`),
  ADD KEY `fk_Productos_has_Marcas_Marcas1_idx` (`Marcas_IdMarca`),
  ADD KEY `fk_Productos_has_Marcas_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Pedidos`
--
ALTER TABLE `Productos_has_Pedidos`
  ADD PRIMARY KEY (`Productos_IdProducto`,`Pedidos_IdPedido`),
  ADD KEY `fk_Productos_has_Pedidos_Pedidos1_idx` (`Pedidos_IdPedido`),
  ADD KEY `fk_Productos_has_Pedidos_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Caracteristicas`
--
ALTER TABLE `Caracteristicas`
  MODIFY `IdCaracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  MODIFY `IdCiudad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Contactos`
--
ALTER TABLE `Contactos`
  MODIFY `IdContacto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `DatosEnvios`
--
ALTER TABLE `DatosEnvios`
  MODIFY `IdDatosEnvios` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Estados`
--
ALTER TABLE `Estados`
  MODIFY `IdEstado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD CONSTRAINT `FK_EstadoCiudad` FOREIGN KEY (`IdEstado`) REFERENCES `Estados` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `DatosEnvios`
--
ALTER TABLE `DatosEnvios`
  ADD CONSTRAINT `FK_DatosPed` FOREIGN KEY (`IdPedido`) REFERENCES `Pedidos` (`IdPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `fk_Pedidos_Usuarios1` FOREIGN KEY (`Usuarios_IdUsuario`) REFERENCES `Usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Caracteristicas`
--
ALTER TABLE `Productos_has_Caracteristicas`
  ADD CONSTRAINT `fk_Productos_has_Caracteristicas_Caracteristicas1` FOREIGN KEY (`Caracteristicas_IdCaracteristica`) REFERENCES `Caracteristicas` (`IdCaracteristica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Caracteristicas_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Categorias`
--
ALTER TABLE `Productos_has_Categorias`
  ADD CONSTRAINT `fk_Productos_has_Categorias_Categorias1` FOREIGN KEY (`Categorias_IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Categorias_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  ADD CONSTRAINT `fk_Productos_has_Imagenes_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Marcas`
--
ALTER TABLE `Productos_has_Marcas`
  ADD CONSTRAINT `fk_Productos_has_Marcas_Marcas1` FOREIGN KEY (`Marcas_IdMarca`) REFERENCES `Marcas` (`IdMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Marcas_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Pedidos`
--
ALTER TABLE `Productos_has_Pedidos`
  ADD CONSTRAINT `fk_Productos_has_Pedidos_Pedidos1` FOREIGN KEY (`Pedidos_IdPedido`) REFERENCES `Pedidos` (`IdPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Pedidos_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
