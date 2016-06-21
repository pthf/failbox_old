SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `failbox` DEFAULT CHARACTER SET latin1 ;
USE `failbox` ;

-- -----------------------------------------------------
-- Table `failbox`.`Caracteristicas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Caracteristicas` (
  `IdCaracteristica` INT(11) NOT NULL AUTO_INCREMENT ,
  `NombreCaracteristica` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`IdCaracteristica`) )
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Categorias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Categorias` (
  `IdCategoria` INT(11) NOT NULL AUTO_INCREMENT ,
  `Categoria` VARCHAR(45) NOT NULL ,
  `IdSubcategoria` INT NOT NULL ,
  PRIMARY KEY (`IdCategoria`) )
ENGINE = InnoDB
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Estados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Estados` (
  `IdEstado` INT(11) NOT NULL AUTO_INCREMENT ,
  `Estado` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`IdEstado`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Ciudades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Ciudades` (
  `IdCiudad` INT(11) NOT NULL AUTO_INCREMENT ,
  `Ciudad` VARCHAR(45) NULL DEFAULT NULL ,
  `IdEstado` INT(11) NOT NULL ,
  PRIMARY KEY (`IdCiudad`) ,
  INDEX `FK_EstadoCiudad_idx` (`IdEstado` ASC) ,
  CONSTRAINT `FK_EstadoCiudad`
    FOREIGN KEY (`IdEstado` )
    REFERENCES `failbox_dev`.`Estados` (`IdEstado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Contactos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Contactos` (
  `IdContacto` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `Email` VARCHAR(45) NULL DEFAULT NULL ,
  `Asunto` VARCHAR(45) NULL DEFAULT NULL ,
  `Telefono` INT(11) NULL DEFAULT NULL ,
  `Mensaje` VARCHAR(500) NULL DEFAULT NULL ,
  PRIMARY KEY (`IdContacto`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Usuarios` (
  `IdUsuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(45) NOT NULL ,
  `Apellido` VARCHAR(45) NOT NULL ,
  `Email` VARCHAR(50) NOT NULL ,
  `Password` VARCHAR(400) NOT NULL ,
  `TipoPerfil` VARCHAR(45) NOT NULL ,
  `FechaAlta` DATE NOT NULL ,
  `Privilegios` INT(11) NOT NULL ,
  `UltimaConexion` DATETIME NOT NULL ,
  PRIMARY KEY (`IdUsuario`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Pedidos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Pedidos` (
  `IdPedido` INT(11) NOT NULL AUTO_INCREMENT ,
  `FechaPedido` DATETIME NULL DEFAULT NULL ,
  `Estatus` VARCHAR(45) NULL DEFAULT NULL ,
  `Usuarios_IdUsuario` INT(11) NOT NULL ,
  PRIMARY KEY (`IdPedido`) ,
  INDEX `FK_PedProdu_idx` (`IdPedido` ASC) ,
  INDEX `fk_Pedidos_Usuarios1` (`Usuarios_IdUsuario` ASC) ,
  CONSTRAINT `fk_Pedidos_Usuarios1`
    FOREIGN KEY (`Usuarios_IdUsuario` )
    REFERENCES `failbox_dev`.`Usuarios` (`IdUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`DatosEnvios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`DatosEnvios` (
  `IdDatosEnvios` INT(11) NOT NULL AUTO_INCREMENT ,
  `TipoDireccion` VARCHAR(45) NULL DEFAULT NULL ,
  `Estado` VARCHAR(45) NULL DEFAULT NULL ,
  `Ciudad` VARCHAR(45) NULL DEFAULT NULL ,
  `Direccion` VARCHAR(200) NULL DEFAULT NULL ,
  `Colonia` VARCHAR(45) NULL DEFAULT NULL ,
  `CP` INT(11) NULL DEFAULT NULL ,
  `Telefono` INT(11) NULL DEFAULT NULL ,
  `Celular` INT(11) NULL DEFAULT NULL ,
  `IdPedido` INT(11) NOT NULL ,
  PRIMARY KEY (`IdDatosEnvios`) ,
  INDEX `FK_DatosPed_idx` (`IdPedido` ASC) ,
  CONSTRAINT `FK_DatosPed`
    FOREIGN KEY (`IdPedido` )
    REFERENCES `failbox_dev`.`Pedidos` (`IdPedido` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Marcas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Marcas` (
  `IdMarca` INT(11) NOT NULL AUTO_INCREMENT ,
  `Marca` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`IdMarca`) )
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Subcategoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Subcategoria` (
  `IdSubcategoria` INT NOT NULL AUTO_INCREMENT ,
  `Subcategoria` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`IdSubcategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `failbox`.`Productos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Productos` (
  `IdProducto` INT(11) NOT NULL AUTO_INCREMENT ,
  `NombreProd` VARCHAR(45) NOT NULL ,
  `Descripcion` VARCHAR(300) NOT NULL ,
  `Stock` INT(11) NOT NULL ,
  `PrecioLista` FLOAT NOT NULL ,
  `PrecioFailbox` FLOAT NOT NULL ,
  `Modelo` VARCHAR(45) NOT NULL ,
  `SKU` VARCHAR(50) NOT NULL ,
  `Estatus` VARCHAR(45) NOT NULL ,
  `Image` VARCHAR(5000) NOT NULL ,
  `urlPaypal` VARCHAR(2000) NOT NULL ,
  `Destacado` VARCHAR(45) NOT NULL ,
  `FechaAlta` DATETIME NOT NULL ,
  `Marcas_IdMarca` INT(11) NOT NULL ,
  `Categorias_IdCategoria` INT(11) NOT NULL ,
  `Subcategoria_IdSubcategoria` INT NOT NULL ,
  PRIMARY KEY (`IdProducto`, `Marcas_IdMarca`, `Categorias_IdCategoria`, `Subcategoria_IdSubcategoria`) ,
  INDEX `fk_Productos_Marcas1_idx` (`Marcas_IdMarca` ASC) ,
  INDEX `fk_Productos_Categorias1_idx` (`Categorias_IdCategoria` ASC) ,
  INDEX `fk_Productos_Subcategoria1_idx` (`Subcategoria_IdSubcategoria` ASC) ,
  CONSTRAINT `fk_Productos_Marcas1`
    FOREIGN KEY (`Marcas_IdMarca` )
    REFERENCES `failbox_dev`.`Marcas` (`IdMarca` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_Categorias1`
    FOREIGN KEY (`Categorias_IdCategoria` )
    REFERENCES `failbox_dev`.`Categorias` (`IdCategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_Subcategoria1`
    FOREIGN KEY (`Subcategoria_IdSubcategoria` )
    REFERENCES `failbox_dev`.`Subcategoria` (`IdSubcategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Productos_has_Caracteristicas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Productos_has_Caracteristicas` (
  `Productos_IdProducto` INT(11) NOT NULL ,
  `Caracteristicas_IdCaracteristica` INT(11) NOT NULL ,
  `DetalleCaracteristica` VARCHAR(500) NOT NULL ,
  PRIMARY KEY (`Productos_IdProducto`, `Caracteristicas_IdCaracteristica`) ,
  INDEX `fk_Productos_has_Caracteristicas_Caracteristicas1_idx` (`Caracteristicas_IdCaracteristica` ASC) ,
  INDEX `fk_Productos_has_Caracteristicas_Productos1_idx` (`Productos_IdProducto` ASC) ,
  CONSTRAINT `fk_Productos_has_Caracteristicas_Caracteristicas1`
    FOREIGN KEY (`Caracteristicas_IdCaracteristica` )
    REFERENCES `failbox_dev`.`Caracteristicas` (`IdCaracteristica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_Caracteristicas_Productos1`
    FOREIGN KEY (`Productos_IdProducto` )
    REFERENCES `failbox_dev`.`Productos` (`IdProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Productos_has_Imagenes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Productos_has_Imagenes` (
  `Productos_IdProducto` INT(11) NOT NULL ,
  `IdImagen` INT(11) NOT NULL AUTO_INCREMENT ,
  `NombreImagen` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`IdImagen`, `Productos_IdProducto`) ,
  INDEX `fk_Productos_has_Imagenes_Productos1_idx` (`Productos_IdProducto` ASC) ,
  CONSTRAINT `fk_Productos_has_Imagenes_Productos1`
    FOREIGN KEY (`Productos_IdProducto` )
    REFERENCES `failbox_dev`.`Productos` (`IdProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 58
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `failbox`.`Productos_has_Pedidos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `failbox`.`Productos_has_Pedidos` (
  `Productos_IdProducto` INT(11) NOT NULL ,
  `Pedidos_IdPedido` INT(11) NOT NULL ,
  `Cantidad` DECIMAL(18,2) NULL DEFAULT NULL ,
  `Precio` FLOAT NULL DEFAULT NULL ,
  `CostoEnvio` FLOAT NULL DEFAULT NULL ,
  `Total` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`Productos_IdProducto`, `Pedidos_IdPedido`) ,
  INDEX `fk_Productos_has_Pedidos_Pedidos1_idx` (`Pedidos_IdPedido` ASC) ,
  INDEX `fk_Productos_has_Pedidos_Productos1_idx` (`Productos_IdProducto` ASC) ,
  CONSTRAINT `fk_Productos_has_Pedidos_Pedidos1`
    FOREIGN KEY (`Pedidos_IdPedido` )
    REFERENCES `failbox_dev`.`Pedidos` (`IdPedido` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_Pedidos_Productos1`
    FOREIGN KEY (`Productos_IdProducto` )
    REFERENCES `failbox_dev`.`Productos` (`IdProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

USE `failbox` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
