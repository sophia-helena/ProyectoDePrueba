SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `jbalmes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` smallint(6) NOT NULL,
  `NIF` char(9) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(30) NOT NULL,
  `login` varchar(10) NOT NULL,
  `clau` varchar(50) NOT NULL,
  `direccio` varchar(30) DEFAULT NULL,
  `CP` char(5) DEFAULT NULL,
  `poblacio` varchar(30) DEFAULT NULL,
  `telefon` varchar(20) NOT NULL,
  `mobil` varchar(30) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;