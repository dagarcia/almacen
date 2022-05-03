CREATE DATABASE almacen CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'almacen_user'@'%' IDENTIFIED BY 'almacen';
GRANT SELECT,INSERT,UPDATE,DELETE ON alamacen.* TO 'almacen_user'@'%';

USE almacen;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for laptops
-- ----------------------------
DROP TABLE IF EXISTS `laptops`;
CREATE TABLE `laptops` (
  `id` int(10) unsigned NOT NULL,
  `procesador` enum('AMD','INTEL') NOT NULL,
  `memoria_ram` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_laptops_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `SKU` varchar(20) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for televisores
-- ----------------------------
DROP TABLE IF EXISTS `televisores`;
CREATE TABLE `televisores` (
  `id` int(10) unsigned NOT NULL,
  `tipo_pantalla` enum('OLED','LCD','LED') NOT NULL,
  `tamanio_pantalla` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_televisores_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zapatos
-- ----------------------------
DROP TABLE IF EXISTS `zapatos`;
CREATE TABLE `zapatos` (
  `id` int(10) unsigned NOT NULL,
  `material` enum('Piel','Plástico') NOT NULL,
  `talle` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_zapatos_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;
