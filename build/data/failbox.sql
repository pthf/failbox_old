-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-07-2016 a las 17:14:39
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
(8, '20160627231625', 'http://paratodohayfans.com/web/failbox/#/', 'Banner 04'),
(15, '20160627235944', 'http://paratodohayfans.com/web/failbox/#/', 'Banner 02'),
(17, '20160628000234', 'http://paratodohayfans.com/web/failbox/#/', 'Banner 02'),
(18, '20160628000535', 'http://paratodohayfans.com/web/failbox/#/', 'Banner 01');

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
(12, 'Sistema Operativo'),
(13, 'Compatibilidad'),
(14, 'Capacidad'),
(15, 'Formatos Soportados'),
(16, 'Cpu'),
(17, 'Conectividad'),
(18, 'Alto'),
(19, 'Ancho'),
(20, 'Profundidad'),
(21, 'Luz'),
(22, 'Undefined'),
(23, 'Prueba'),
(24, 'Prueba2'),
(25, 'Prueba3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `RouteCategoria` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`IdCategoria`, `Categoria`, `RouteCategoria`) VALUES
(38, 'Cómputo y Eletrónica', 'computo-y-eletronica'),
(39, 'Telefonía', 'telefonia'),
(40, 'Videojuegos', 'videojuegos'),
(41, 'Línea Blanca', 'linea-blanca'),
(42, 'Hogar', 'hogar'),
(43, 'Electrónica', 'electronica'),
(44, 'Telefonia', 'telefonia'),
(48, 'Categoria1', 'categoria1'),
(49, 'Categoria2', 'categoria2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `Ciudades` (
  `IdCiudad` int(11) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
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
  `Estado` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(20, 'Dell', 'dell'),
(21, 'Iottie', 'iottie'),
(22, 'Microsoft', 'microsoft'),
(23, 'Sony', 'sony'),
(24, 'Nintendo', 'nintendo'),
(25, 'Whirlpool', 'whirlpool'),
(27, 'Marca1', 'marca1'),
(28, 'Marca2', 'marca2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Newsletter`
--

CREATE TABLE `Newsletter` (
  `idNewsletter` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Newsletter`
--

INSERT INTO `Newsletter` (`idNewsletter`, `Email`) VALUES
(1, 'jose@gmail.com'),
(2, 'pepe@gmail.com'),
(3, 'hola@gmail.com');

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
  `CostoEnvio` int(11) NOT NULL,
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

INSERT INTO `Productos` (`IdProducto`, `NombreProd`, `Descripcion`, `RouteProd`, `Stock`, `PrecioLista`, `PrecioFailbox`, `CostoEnvio`, `Garantia`, `Modelo`, `SKU`, `Estatus`, `Image`, `urlPaypal`, `Destacado`, `FechaAlta`, `IdPrivilegio`, `Marcas_IdMarca`, `Categorias_IdCategoria`, `Subcategoria_IdSubcategoria`) VALUES
(9, 'COMPUTADORA DE ESCRITORIO IMAC', 'Apple MK482E/A 27 Pulgadas Computadora de Escritorio iMac', 'computadora-de-escritorio-imac', 5, 49900, 47500, 120, '1', 'MK482E/A', '00001', 'Activo', 'mac_02.jpg,mac_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-07-07 18:04:33', 1, 18, 38, 11),
(10, 'DELL INSPIRON ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat suscipit dolor aliquam congue. Aenean posuere, metus non sollicitudin suscipit, ipsum massa egestas sapien, ut sollicitudin dui sem finibus mauris. Proin consequat metus sed urna tempor vestibulum. Sed purus ex, faucibus sed nis', 'dell-inspiron-', 3, 18500, 16649, 0, '3', 'I5559_I781TGSLW10S_1', '00002', 'Activo', 'dell_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 12:06:16', 1, 20, 38, 12),
(11, 'SAMSUNG GALAXY S7 EDGE DORADO ', 'Duis ut leo sapien. Ut eget velit sed eros viverra elementum. Aliquam non erat sed ante facilisis rutrum nec id diam. Sed ac augue semper, porttitor metus et, pharetra mauris. Nulla placerat, sapien vel accumsan hendrerit, ante tellus porta ex, ac sollicitudin eros ex ut purus.', 'samsung-galaxy-s7-edge-dorado-', 5, 17959, 17500, 0, '4', 'SM-G935F', '00003', 'Inactivo', 'sam_04.jpg,sam_03.jpeg,sam_02.jpg,sam_07.png', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 14:36:40', 1, 9, 39, 13),
(12, 'LOTTIE CARGADOR AUTOMÓVIL FLEX 2 NEGRO', 'Sed ac augue semper, porttitor metus et, pharetra mauris. Nulla placerat, sapien vel accumsan hendrerit, ante tellus porta ex, ac sollicitudin eros ex ut purus. Integer posuere consequat ex, sit amet semper est aliquam sit amet. Quisque maximus bibendum auctor. Duis vitae enim sem. Suspendisse est quam, interdum at dictum id, varius non mi.', 'lottie-cargador-automovil-flex-2-negro', 12, 399, 360, 0, '1', 'HCLR10104', '00004', 'Activo', 'cargador_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-06-24 16:59:19', 1, 21, 39, 14),
(13, 'APPLE CABLE LIGHTNING BLANCO BLANCO', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'apple-cable-lightning-blanco-blanco', 20, 599, 580, 0, '2', 'MD819ZM/A', '00005', 'Activo', 'cargador_02.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-06-30 18:51:25', 1, 18, 39, 14),
(14, 'XBOX ONE CONSOLA 500 GB + QUANTUM BREAK', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ', 'xbox-one-consola-500-gb-+-quantum-break', 5, 8249, 7549, 99, '3', 'Xbox One', '00006', 'Activo', 'xbox_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-07-07 18:04:59', 1, 22, 40, 16),
(15, 'PLAYSTATION 4 CONSOLA 500 GB + FIFA 16', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ', 'playstation-4-consola-500-gb-+-fifa-16', 5, 9299, 8700, 0, '4', 'PlayStation 4', '00007', 'Activo', 'ps4_03.jpg,ps4_02.jpg,ps4_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-06-24 17:12:56', 1, 23, 40, 16),
(16, 'WII U CONSOLA + MARIO KART 8', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'wii-u-consola-+-mario-kart-8', 1, 8299, 7799, 0, '2', 'WUP-S-KAGP', '00008', 'Activo', 'wii_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'NO', '2016-06-24 17:19:07', 1, 24, 40, 16),
(17, 'SAMSUNG RT38K5982SL/EM/RT38FEAKDSL REFRIGERAD', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'samsung-rt38k5982sl/em/rt38feakdsl-refrigerad', 10, 13999, 10709, 135, '4', 'RT38K5982SL/EM/RT38FEAKDSL', '00009', 'Activo', 'refri_04.jpg,refri_03.jpg,refri_01.jpg,refri_02.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-07-07 18:05:09', 1, 9, 41, 18),
(18, 'WHIRLPOOL WOS92ECOAS HORNO DE 30 PULGADAS ACE', 'Praesent non malesuada eros, ac semper ex. Maecenas rutrum, turpis sit amet imperdiet aliquam, neque ante molestie libero, quis pulvinar sapien justo sit amet urna. Pellentesque eget commodo metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'whirlpool-wos92ecoas-horno-de-30-pulgadas-ace', 9, 27999, 20229, 135, '4', 'WOS92ECOAS', '000010', 'Activo', 'est_02.jpg,est_01.jpg', 'https://www.paypal.com/mx/webapps/mpp/home', 'SI', '2016-07-07 18:05:17', 1, 25, 41, 19);

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
(9, 21, 'HD'),
(10, 8, 'Azul'),
(10, 9, 'Core i7-6500U'),
(10, 10, '8 GB DDR3L 1600 MHz'),
(10, 11, '1 TB 5400 RPM'),
(11, 8, 'Dorado'),
(11, 12, 'Android'),
(12, 8, 'Negro'),
(13, 8, 'Blanco'),
(13, 13, 'iPad, iPhone, iPod Nano, USB'),
(14, 14, '500 GB'),
(14, 15, 'Xbox One, CD, DVD'),
(15, 10, 'GDDR5 de 8 GB'),
(15, 11, '500 GB'),
(15, 16, 'AMD Jaguar x86-64 de baja potencia, 8 núcleos'),
(15, 17, 'Wi-Fi, Bluetooth'),
(16, 13, 'Amiibo (solo para algunos modelos)'),
(16, 14, '32 GB'),
(16, 15, 'Wii U'),
(17, 8, 'Gris acero'),
(17, 14, '14 pies cúbicos'),
(17, 18, '178.5 cm'),
(17, 19, '67.5 cm'),
(17, 20, '71.5 cm'),
(17, 21, 'Led'),
(18, 8, 'Acero inoxidable'),
(18, 14, '5 pies cúbicos'),
(18, 18, '97 cm aproximado'),
(18, 19, '83 cm aproximado'),
(18, 20, '78 cm aproximado');

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
(11, 45, 'sam_07.png'),
(12, 46, 'cargador_01.jpg'),
(13, 47, 'cargador_02.jpg'),
(14, 48, 'xbox_01.jpg'),
(15, 49, 'ps4_03.jpg'),
(15, 50, 'ps4_02.jpg'),
(15, 51, 'ps4_01.jpg'),
(16, 52, 'wii_01.jpg'),
(17, 53, 'refri_04.jpg'),
(17, 54, 'refri_03.jpg'),
(17, 55, 'refri_01.jpg'),
(17, 56, 'refri_02.jpg'),
(18, 57, 'est_02.jpg'),
(18, 58, 'est_01.jpg');

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
-- Estructura de tabla para la tabla `Proveedores`
--

CREATE TABLE `Proveedores` (
  `idProveedor` int(11) NOT NULL,
  `RazonSocial` varchar(70) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `CP` int(11) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `CostoEnvio` float NOT NULL,
  `PaqChico` float NOT NULL,
  `PaqMediano` float NOT NULL,
  `PaqGrande` float NOT NULL,
  `CodigoProveedor` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `IdPrivilegio` int(11) NOT NULL,
  `TipoProveedor_idTipoProveedor` int(11) NOT NULL,
  `Estados_IdEstado` int(11) NOT NULL,
  `Ciudades_IdCiudad` int(11) NOT NULL
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
(21, 'Planchas', 'planchas', 41),
(24, 'Sub1', 'sub1', 40),
(25, 'Sub2', 'sub2', 49),
(27, 'Cargadores', 'cargadores', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoProveedor`
--

CREATE TABLE `TipoProveedor` (
  `idTipoProveedor` int(11) NOT NULL,
  `TipoProveedor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `TipoProveedor`
--

INSERT INTO `TipoProveedor` (`idTipoProveedor`, `TipoProveedor`) VALUES
(1, 'Distribuidores especializados'),
(2, 'Mayoristas'),
(3, 'Marcas y fabricantes');

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
(1, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Administrador', 1, '2016-07-07 17:34:35'),
(2, 'Proveedor1', 'Proveedor_Uno', 'Proveedor1', 'prov1@gmail.com', '$2y$10$K893WptPPtRswyXYeZPj2.mm3KyPnFQaYokzMenTjrMaIJPGtQYpq', 'Proveedor', 2, '2016-06-30 12:35:09'),
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
  ADD PRIMARY KEY (`IdCiudad`,`IdEstado`),
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
-- Indices de la tabla `Newsletter`
--
ALTER TABLE `Newsletter`
  ADD PRIMARY KEY (`idNewsletter`);

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
-- Indices de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD PRIMARY KEY (`idProveedor`,`TipoProveedor_idTipoProveedor`,`Estados_IdEstado`,`Ciudades_IdCiudad`),
  ADD KEY `fk_Proveedores_TipoProveedor1_idx` (`TipoProveedor_idTipoProveedor`),
  ADD KEY `fk_Proveedores_Estados1_idx` (`Estados_IdEstado`),
  ADD KEY `fk_Proveedores_Ciudades1_idx` (`Ciudades_IdCiudad`);

--
-- Indices de la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  ADD PRIMARY KEY (`IdSubcategoria`,`Categorias_IdCategoria`),
  ADD KEY `fk_Subcategoria_Categorias1_idx` (`Categorias_IdCategoria`);

--
-- Indices de la tabla `TipoProveedor`
--
ALTER TABLE `TipoProveedor`
  ADD PRIMARY KEY (`idTipoProveedor`);

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
  MODIFY `idBannersHome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `Caracteristicas`
--
ALTER TABLE `Caracteristicas`
  MODIFY `IdCaracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
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
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `Newsletter`
--
ALTER TABLE `Newsletter`
  MODIFY `idNewsletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `Productos_has_Imagenes`
--
ALTER TABLE `Productos_has_Imagenes`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  MODIFY `IdSubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `TipoProveedor`
--
ALTER TABLE `TipoProveedor`
  MODIFY `idTipoProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  ADD CONSTRAINT `FK_EstadoCiudad` FOREIGN KEY (`IdEstado`) REFERENCES `Estados` (`IdEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD CONSTRAINT `fk_Proveedores_Ciudades1` FOREIGN KEY (`Ciudades_IdCiudad`) REFERENCES `Ciudades` (`IdCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proveedores_Estados1` FOREIGN KEY (`Estados_IdEstado`) REFERENCES `Estados` (`IdEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proveedores_TipoProveedor1` FOREIGN KEY (`TipoProveedor_idTipoProveedor`) REFERENCES `TipoProveedor` (`idTipoProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Subcategoria`
--
ALTER TABLE `Subcategoria`
  ADD CONSTRAINT `fk_Subcategoria_Categorias1` FOREIGN KEY (`Categorias_IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
