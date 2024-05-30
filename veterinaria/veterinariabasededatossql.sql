-- MySQL Workbench Forward Engineering

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Schema clinicaveterinaria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema clinicaveterinaria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema clinicaveterinaria
-- -----------------------------------------------------
USE `clinicaveterinaria` ;

-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`nivel` (
  `idnivel` INT NOT NULL,
  `nivelUsuario` VARCHAR(45) NULL,
  PRIMARY KEY (`idnivel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`usuario` (
  `idusuario` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` INT NULL,
  `telefonosecundario` INT NULL,
  `nivelUsuario` VARCHAR(45) NULL,
  `fechaAlta` DATETIME NULL,
  `fotoPortada` BLOB NULL,
  `foto` BLOB NULL,
  `estado` INT NULL,
  `nivel_idnivel` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  CONSTRAINT `fk_usuario_nivel`
    FOREIGN KEY (`nivel_idnivel`)
    REFERENCES `clinicaveterinaria`.`nivel` (`idnivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`planvacunacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`planvacunacion` (
  `idplanvacunacion` INT NOT NULL,
  `vacuna1` VARCHAR(45) NULL,
  `vacuna2` VARCHAR(45) NULL,
  `vacuna3` VARCHAR(45) NULL,
  `vacuna4` VARCHAR(45) NULL,
  `vacuna5` VARCHAR(45) NULL,
  `fechaAlta` VARCHAR(45) NULL,
  `fechaActual` VARCHAR(45) NULL,
  PRIMARY KEY (`idplanvacunacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`HIstorialMedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`HIstorialMedido` (
  `idHIstorialMedido` INT NOT NULL,
  `diagnostico` VARCHAR(45) NULL,
  `hospitalizacion` VARCHAR(45) NULL,
  `fechaIngreso` DATETIME NULL,
  `fechaAlta` DATETIME NULL,
  `planvacunacion_idplanvacunacion` INT NOT NULL,
  PRIMARY KEY (`idHIstorialMedido`),
  CONSTRAINT `fk_HIstorialMedido_planvacunacion1`
    FOREIGN KEY (`planvacunacion_idplanvacunacion`)
    REFERENCES `clinicaveterinaria`.`planvacunacion` (`idplanvacunacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`pacientes` (
  `idpacientes` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `raza` VARCHAR(45) NULL,
  `color` VARCHAR(45) NULL,
  `certificados` BLOB NULL,
  `foto` BLOB NULL,
  `usuario_idusuario` INT NOT NULL,
  `HIstorialMedido_idHIstorialMedido` INT NOT NULL,
  PRIMARY KEY (`idpacientes`),
  CONSTRAINT `fk_pacientes_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `clinicaveterinaria`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pacientes_HIstorialMedido1`
    FOREIGN KEY (`HIstorialMedido_idHIstorialMedido`)
    REFERENCES `clinicaveterinaria`.`HIstorialMedido` (`idHIstorialMedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`cita` (
  `idcita` INT NOT NULL,
  `fechaAlta` DATETIME NULL,
  `fechaCita` DATETIME NULL,
  `pacientes_idpacientes` INT NOT NULL,
  PRIMARY KEY (`idcita`),
  CONSTRAINT `fk_cita_pacientes1`
    FOREIGN KEY (`pacientes_idpacientes`)
    REFERENCES `clinicaveterinaria`.`pacientes` (`idpacientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`posteos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`posteos` (
  `idposteos` INT NOT NULL,
  `fechaAlta` DATETIME NULL,
  `imagen` BLOB NULL,
  `texto` VARCHAR(45) NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idposteos`),
  CONSTRAINT `fk_posteos_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `clinicaveterinaria`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`comentarios` (
  `idcomentarios` INT NOT NULL,
  `texto` VARCHAR(45) NULL,
  `fechaAlta` DATETIME NULL,
  `usuario_idusuario` INT NOT NULL,
  `posteos_idposteos` INT NOT NULL,
  PRIMARY KEY (`idcomentarios`),
  CONSTRAINT `fk_comentarios_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `clinicaveterinaria`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_posteos1`
    FOREIGN KEY (`posteos_idposteos`)
    REFERENCES `clinicaveterinaria`.`posteos` (`idposteos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`PlanDesparacitacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`PlanDesparacitacion` (
  `idPlanDesparacitacion` INT NOT NULL,
  `21Dias` VARCHAR(45) NULL,
  `Semana5` VARCHAR(45) NULL,
  `Semana7` VARCHAR(45) NULL,
  `Semana9` VARCHAR(45) NULL,
  `3meses` VARCHAR(45) NULL,
  `4meses` VARCHAR(45) NULL,
  `5meses` VARCHAR(45) NULL,
  `cada 3 meses` VARCHAR(45) NULL,
  `fechaAlta` DATETIME NULL,
  `FechaActual` DATETIME NULL,
  `HIstorialMedido_idHIstorialMedido` INT NOT NULL,
  PRIMARY KEY (`idPlanDesparacitacion`),
  CONSTRAINT `fk_PlanDesparacitacion_HIstorialMedido1`
    FOREIGN KEY (`HIstorialMedido_idHIstorialMedido`)
    REFERENCES `clinicaveterinaria`.`HIstorialMedido` (`idHIstorialMedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`pequeño`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`pequeño` (
  `idpequeño` INT NOT NULL,
  `alto` VARCHAR(45) NULL,
  `ancho` VARCHAR(45) NULL,
  `largo` VARCHAR(45) NULL,
  `peso` VARCHAR(45) NULL,
  PRIMARY KEY (`idpequeño`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`mediano`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`mediano` (
  `idmediano` INT NOT NULL,
  `alto` VARCHAR(45) NULL,
  `ancho` VARCHAR(45) NULL,
  `largo` VARCHAR(45) NULL,
  `peso` VARCHAR(45) NULL,
  PRIMARY KEY (`idmediano`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`grande`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`grande` (
  `idgrande` INT NOT NULL,
  `alto` VARCHAR(45) NULL,
  `ancho` VARCHAR(45) NULL,
  `largo` VARCHAR(45) NULL,
  `peso` VARCHAR(45) NULL,
  PRIMARY KEY (`idgrande`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`productos` (
  `idproductos` INT NOT NULL,
  `categoria` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `precio` VARCHAR(45) NULL,
  `color` VARCHAR(45) NULL,
  `material` VARCHAR(45) NULL,
  `marca` VARCHAR(45) NULL,
  `usuario_idusuario` INT NOT NULL,
  `pequeño_idpequeño` INT NOT NULL,
  `mediano_idmediano` INT NOT NULL,
  `grande_idgrande` INT NOT NULL,
  `categoria` VARCHAR(45) NULL,
  PRIMARY KEY (`idproductos`),
  CONSTRAINT `fk_productos_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `clinicaveterinaria`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_pequeño1`
    FOREIGN KEY (`pequeño_idpequeño`)
    REFERENCES `clinicaveterinaria`.`pequeño` (`idpequeño`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_mediano1`
    FOREIGN KEY (`mediano_idmediano`)
    REFERENCES `clinicaveterinaria`.`mediano` (`idmediano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_grande1`
    FOREIGN KEY (`grande_idgrande`)
    REFERENCES `clinicaveterinaria`.`grande` (`idgrande`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinicaveterinaria`.`publicaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinicaveterinaria`.`publicaciones` (
  `idpublicaciones` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `fechaAlta` VARCHAR(45) NULL,
  `foto` VARCHAR(45) NULL,
  `precio` VARCHAR(45) NULL,
  `descuento` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `usuario_idusuario` INT,
  `categoria` VARCHAR(45) NULL,
  PRIMARY KEY (`idpublicaciones`),
  CONSTRAINT `fk_publicaciones_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `clinicaveterinaria`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

