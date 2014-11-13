-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2014 a las 15:47:02
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `carpetas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `boxes`(IN `idAno` SMALLINT, IN `idMes` VARCHAR(15) CHARSET utf8)
    NO SQL
SELECT id, numero FROM caja WHERE ano=idAno AND mes=idMes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `caja`(IN `idCaja` INT)
    NO SQL
SELECT * FROM caja WHERE id=idCaja$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `carpeta`(IN `idCarpeta` INT)
    NO SQL
SELECT * FROM carpeta WHERE id=idCarpeta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `carpetas_prestadas`()
    NO SQL
SELECT nombre FROM users WHERE user_id=(SELECT id FROM carpeta WHERE estado=1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_caja`(IN `year` SMALLINT, IN `month` VARCHAR(15) CHARSET utf8, IN `number` INT)
    MODIFIES SQL DATA
INSERT INTO caja(ano, mes, numero) VALUES(year, month, number)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_carpeta`(IN `idCaja` INT)
    MODIFIES SQL DATA
INSERT INTO carpeta(caja) VALUES(idCaja)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_operacion`(IN `op` VARCHAR(50) CHARSET utf8, IN `folderId` INT)
    NO SQL
INSERT INTO operacion(numero, carpeta) VALUES(op, folderId)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `devolver`(IN `idCarpeta` INT)
    NO SQL
UPDATE carpeta SET estado = 0 WHERE id= idCarpeta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `folders`(IN `idCaja` INT)
    NO SQL
SELECT id FROM carpeta WHERE caja=idCaja$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listado_usuarios`()
    NO SQL
select user_id, nombre from users$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `months`(IN `idAno` VARCHAR(15))
    NO SQL
SELECT id, mes FROM caja WHERE ano=idAno GROUP BY mes ORDER BY mes ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `operacion`(IN `id` VARCHAR(50) CHARSET utf8)
    NO SQL
SELECT * FROM operacion WHERE numero=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `operacion_dup`(IN `op` VARCHAR(50) CHARSET utf8)
    NO SQL
SELECT * FROM operacion WHERE numero=op$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `operations`(IN `idCarpeta` INT)
    NO SQL
SELECT numero FROM operacion WHERE carpeta=idCarpeta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opInfo`(IN `op` VARCHAR(50) CHARSET utf8)
    NO SQL
SELECT * FROM caja WHERE id = (SELECT caja FROM carpeta WHERE carpeta=(SELECT carpeta FROM operacion WHERE numero=op ))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retirar`(IN `idUser` INT, IN `idCarpeta` INT)
    NO SQL
UPDATE `carpetas`.`carpeta` SET `estado` = '1', `usuario` = idUser  WHERE `carpeta`.`id` = idCarpeta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ultima_caja`()
    NO SQL
SELECT ano, numero, mes 
FROM caja
ORDER BY id DESC
LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ultimo_folder`()
    NO SQL
select id from carpeta order by id desc limit 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuario`(IN `idUser` INT)
    NO SQL
SELECT user_id, nombre FROM users WHERE user_id=idUser$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `years`()
    READS SQL DATA
SELECT DISTINCT ano FROM caja$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` smallint(4) NOT NULL,
  `mes` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `ano`, `mes`, `numero`, `fecha`) VALUES
(51, 2014, 'septiembre', 1, '2014-09-29 09:36:32'),
(52, 2014, 'septiembre', 2, '2014-09-30 11:49:09'),
(53, 2014, 'septiembre', 3, '2014-09-30 12:42:24'),
(55, 2014, 'septiembre', 5, '2014-10-01 10:38:58'),
(56, 2013, 'abril', 4, '2014-10-13 08:59:55'),
(57, 2014, 'julio', 4, '2014-10-13 09:00:42'),
(58, 2014, 'abril', 4, '2014-10-13 09:01:50'),
(59, 2014, 'abril', 3, '2014-10-13 09:02:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpeta`
--

CREATE TABLE IF NOT EXISTS `carpeta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `caja` (`caja`),
  KEY `caja_2` (`caja`),
  KEY `caja_3` (`caja`),
  KEY `caja_4` (`caja`),
  KEY `usuario` (`usuario`),
  KEY `usuario_2` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `carpeta`
--

INSERT INTO `carpeta` (`id`, `caja`, `estado`, `usuario`) VALUES
(22, 51, 0, 1),
(23, 52, 0, 2),
(24, 53, 1, 2),
(27, 59, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE IF NOT EXISTS `operacion` (
  `numero` varchar(50) NOT NULL,
  `carpeta` int(11) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `carpeta` (`carpeta`),
  KEY `carpeta_2` (`carpeta`),
  KEY `carpeta_3` (`carpeta`),
  KEY `carpeta_4` (`carpeta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`numero`, `carpeta`) VALUES
('', 22),
('111111', 22),
('222222', 22),
('321456987', 22),
('333333', 22),
('444444', 22),
('555555', 22),
('666666', 22),
('777777', 22),
('888888', 22),
('321654', 23),
('963852', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `nombre` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `nombre`) VALUES
(1, 'rigoberto', '$2y$10$/Q/QmSbvmrzYXAqvQVfiZeTWRBlqC/3cxNpDrUbwk07R2YDrBWVOi', 'soporte@worldtransport.cl', 'Rigoberto Cortazar'),
(2, 'rigoberto2', '$2y$10$62/wEQHkyELBDkoXkUhIe.wAHP1/PMbup8hSKcntBwVaLjac/V0rG', 'ricomo@outlook.com', 'Rigoberto x'),
(3, 'dani', '$2y$10$kYGtmjEjuorCIvluIl53iutSLmWiXS5C/aQRuxZUZ/hGSwm4L1Q46', 'daniela@maildedaniela.cl', 'daniela');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carpeta`
--
ALTER TABLE `carpeta`
  ADD CONSTRAINT `FK_ID_CAJA_CARPETA` FOREIGN KEY (`caja`) REFERENCES `caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD CONSTRAINT `FK_ID_ CARPETA_OPERACION` FOREIGN KEY (`carpeta`) REFERENCES `carpeta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
