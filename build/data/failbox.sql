-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-06-2016 a las 23:46:30
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `failbox`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BannersHome`
--

CREATE TABLE `BannersHome` (
  `idBannersHome` int(11) NOT NULL,
  `BannersHomeImage` varchar(450) NOT NULL,
  `BannersHomeUrl` varchar(450) NOT NULL,
  `BannersHomeName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `BannersHome`
--

INSERT INTO `BannersHome` (`idBannersHome`, `BannersHomeImage`, `BannersHomeUrl`, `BannersHomeName`) VALUES
(1, 'banne01.png', 'http://localhost/www/FAILBOX/build/', 'Banner 1'),
(2, 'banne01.png', 'http://localhost/www/FAILBOX/build/', 'Banner 2'),
(3, 'banne01.png', 'http://localhost/www/FAILBOX/build/', 'Banner 3');

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
(8, 'Color'),
(9, 'Procesador'),
(10, 'Memoria Ram'),
(11, 'Disco Duro'),
(12, 'Sistema Operativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `RouteCategoria` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`IdCategoria`, `Categoria`, `RouteCategoria`) VALUES
(38, 'Cómputo y Eletrónica', 'computo-y-eletronica'),
(39, 'Telefonía', 'telefonia'),
(40, 'Videojuegos', 'videojuegos'),
(41, 'Línea Blanca', 'linea-blanca'),
(42, 'Hogar', 'hogar');

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
  `Marca` varchar(45) NOT NULL,
  `RouteMarca` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Marcas`
--

INSERT INTO `Marcas` (`IdMarca`, `Marca`, `RouteMarca`) VALUES
(6, 'Osx', 'osx'),
(7, 'Windows', 'windows'),
(8, 'Lg', 'lg'),
(9, 'Samsung', 'samsung'),
(10, 'Motorola', 'motorola'),
(11, 'Iphone', 'iphone'),
(12, 'Xbox 360', 'xbox-360'),
(13, 'Xbox One', 'xbox-one'),
(14, 'Ps4', 'ps4'),
(15, 'Ps3', 'ps3'),
(16, 'Mabe', 'mabe'),
(17, 'Phillips', 'phillips'),
(18, 'Apple', 'apple'),
(19, 'Toshiba', 'toshiba'),
(20, 'Dell', 'dell');

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
  `Descripcion` varchar(2000) NOT NULL,
  `RouteProd` varchar(450) NOT NULL,
  `Stock` int(11) NOT NULL,
  `PrecioLista` float NOT NULL,
  `PrecioFailbox` float NOT NULL,
  `Garantia` varchar(45) NOT NULL,
  `Modelo` varchar(45) NOT NULL,
  `SKU` varchar(50) NOT NULL,
  `Estatus` varchar(45) NOT NULL,
  `Image` varchar(5000) NOT NULL,
  `urlPaypal` varchar(2000) NOT NULL,
  `Destacado` varchar(45) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `IdPrivilegio` int(11) NOT NULL,
  `Marcas_IdMarca` int(11) NOT NULL,
  `Categorias_IdCategoria` int(11) NOT NULL,
  `Subcategoria_IdSubcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`IdProducto`, `NombreProd`, `Descripcion`, `RouteProd`, `Stock`, `PrecioLista`, `PrecioFailbox`, `Garantia`, `Modelo`, `SKU`, `Estatus`, `Image`, `urlPaypal`, `Destacado`, `FechaAlta`, `IdPrivilegio`, `Marcas_IdMarca`, `Categorias_IdCategoria`, `Subcategoria_IdSubcategoria`) VALUES
(9, 'COMPUTADORA DE ESCRITORIO IMAC', 'Apple MK482E/A 27 Pulgadas Computadora de Escritorio iMac', 'computadora-de-escritorio-imac', 5, 49900, 47500, '1', 'MK482E/A', '00001', 'Activo', 'mac_02.jpg,mac_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 12:06:37', 1, 18, 38, 11),
(10, 'DELL INSPIRON ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat suscipit dolor aliquam congue. Aenean posuere, metus non sollicitudin suscipit, ipsum massa egestas sapien, ut sollicitudin dui sem finibus mauris. Proin consequat metus sed urna tempor vestibulum. Sed purus ex, faucibus sed nis', 'dell-inspiron-', 3, 18500, 16649, '3', 'I5559_I781TGSLW10S_1', '00002', 'Activo', 'dell_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 12:06:16', 1, 20, 38, 12),
(11, 'SAMSUNG GALAXY S7 EDGE DORADO ', 'Duis ut leo sapien. Ut eget velit sed eros viverra elementum. Aliquam non erat sed ante facilisis rutrum nec id diam. Sed ac augue semper, porttitor metus et, pharetra mauris. Nulla placerat, sapien vel accumsan hendrerit, ante tellus porta ex, ac sollicitudin eros ex ut purus.', 'samsung-galaxy-s7-edge-dorado-', 5, 17959, 17500, '4', 'SM-G935F', '00003', 'Activo', 'sam_04.jpg,sam_03.jpeg,sam_02.jpg,sam_07.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 14:36:40', 1, 9, 39, 13);

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
(9, 8, 'Plata'),
(9, 9, 'Quad Core de 3.3 GHz'),
(9, 10, '8 GB'),
(9, 11, 'Fusion Drive de 2 TB'),
(10, 8, 'Azul'),
(10, 9, 'Core i7-6500U'),
(10, 10, '8 GB DDR3L 1600 MHz'),
(10, 11, '1 TB 5400 RPM'),
(11, 8, 'Dorado'),
(11, 12, 'Android');

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
(9, 16, 'mac_02.jpg'),
(9, 17, 'mac_01.jpg'),
(10, 18, 'dell_02.jpg'),
(10, 19, 'dell_01.jpg'),
(11, 36, 'sam_04.jpg'),
(11, 42, 'sam_03.jpeg'),
(11, 44, 'sam_02.jpg'),
(11, 45, 'sam_07.png');

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
-- Estructura de tabla para la tabla `Subcategoria`
--

CREATE TABLE `Subcategoria` (
  `IdSubcategoria` int(11) NOT NULL,
  `Subcategoria` varchar(45) NOT NULL,
  `RouteSubcategoria` varchar(450) NOT NULL,
  `Categorias_IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Subcategoria`
--

INSERT INTO `Subcategoria` (`IdSubcategoria`, `Subcategoria`, `RouteSubcategoria`, `Categorias_IdCategoria`) VALUES
(11, 'Computadoras de Escritorio', 'computadoras-de-escritorio', 38),
(12, 'Laptops', 'laptops', 38),
(13, 'Celulares', 'celulares', 39),
(14, 'Cargadores', 'cargadores', 39),
(15, 'Baterías', 'baterias', 39),
(16, 'Consolas', 'consolas', 40),
(17, 'Accesorios', 'accesorios', 40),
(18, 'Refrigeradores', 'refrigeradores', 41),
(19, 'Hornos', 'hornos', 41),
(20, 'Licuadoras', 'licuadoras', 41),
(21, 'Planchas', 'planchas', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NombreUser` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(400) NOT NULL,
  `TipoPerfil` varchar(45) NOT NULL,
  `Privilegios` int(11) NOT NULL,
  `UltimaConexion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`IdUsuario`, `NombreUser`, `Nombre`, `Apellido`, `Email`, `Password`, `TipoPerfil`, `Privilegios`, `UltimaConexion`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Administrador', 1, '2016-06-23 19:17:33'),
(2, 'Proveedor1', 'Proveedor_Uno', 'Proveedor1', 'prov1@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Proveedor', 2, '2016-06-23 19:16:31'),
(3, 'Proveedor2', 'Proveedor_Dos', 'Proveedor2', 'prov2@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Proveedor', 3, '2016-06-16 16:53:26'),
(4, 'Proveedor3', 'Proveedor_Tres', 'Proveedor3', 'prov3@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Proveedor', 4, '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `BannersHome`
--
ALTER TABLE `BannersHome`
  ADD PRIMARY KEY (`idBannersHome`);

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
  ADD PRIMARY KEY (`IdProducto`,`Marcas_IdMarca`,`Categorias_IdCategoria`,`Subcategoria_IdSubcategoria`),
  ADD KEY `fk_Productos_Marcas1_idx` (`Marcas_IdMarca`),
  ADD KEY `fk_Productos_Categorias1_idx` (`Categorias_IdCategoria`),
  ADD KEY `fk_Productos_Subcategoria1_idx` (`Subcategoria_IdSubcategoria`);

--
-- Indices de la tabla `Productos_has_Caracteristicas`
--
ALTER TABLE `Productos_has_Caracteristicas`
  ADD PRIMARY KEY (`Productos_IdProducto`,`Caracteristicas_IdCaracteristica`),
  ADD KEY `fk_Productos_has_Caracteristicas_Caracteristicas1_idx` (`Caracteristicas_IdCaracteristica`),
  ADD KEY `fk_Productos_has_Caracteristicas_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  ADD PRIMARY KEY (`IdImagen`,`Productos_IdProducto`),
  ADD KEY `fk_Productos_has_Imagenes_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Productos_has_Pedidos`
--
ALTER TABLE `Productos_has_Pedidos`
  ADD PRIMARY KEY (`Productos_IdProducto`,`Pedidos_IdPedido`),
  ADD KEY `fk_Productos_has_Pedidos_Pedidos1_idx` (`Pedidos_IdPedido`),
  ADD KEY `fk_Productos_has_Pedidos_Productos1_idx` (`Productos_IdProducto`);

--
-- Indices de la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  ADD PRIMARY KEY (`IdSubcategoria`,`Categorias_IdCategoria`),
  ADD KEY `fk_Subcategoria_Categorias1_idx` (`Categorias_IdCategoria`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `BannersHome`
--
ALTER TABLE `BannersHome`
  MODIFY `idBannersHome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Caracteristicas`
--
ALTER TABLE `Caracteristicas`
  MODIFY `IdCaracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  MODIFY `IdSubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `fk_Productos_Categorias1` FOREIGN KEY (`Categorias_IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Marcas1` FOREIGN KEY (`Marcas_IdMarca`) REFERENCES `Marcas` (`IdMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Subcategoria1` FOREIGN KEY (`Subcategoria_IdSubcategoria`) REFERENCES `Subcategoria` (`IdSubcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Caracteristicas`
--
ALTER TABLE `Productos_has_Caracteristicas`
  ADD CONSTRAINT `fk_Productos_has_Caracteristicas_Caracteristicas1` FOREIGN KEY (`Caracteristicas_IdCaracteristica`) REFERENCES `Caracteristicas` (`IdCaracteristica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Caracteristicas_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  ADD CONSTRAINT `fk_Productos_has_Imagenes_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos_has_Pedidos`
--
ALTER TABLE `Productos_has_Pedidos`
  ADD CONSTRAINT `fk_Productos_has_Pedidos_Pedidos1` FOREIGN KEY (`Pedidos_IdPedido`) REFERENCES `Pedidos` (`IdPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_has_Pedidos_Productos1` FOREIGN KEY (`Productos_IdProducto`) REFERENCES `Productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  ADD CONSTRAINT `fk_Subcategoria_Categorias1` FOREIGN KEY (`Categorias_IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
