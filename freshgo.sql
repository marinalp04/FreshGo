-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2025 a las 18:02:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `freshgo`
--
CREATE DATABASE IF NOT EXISTS `freshgo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `freshgo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergeno`
--

CREATE TABLE `alergeno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alergeno`
--

INSERT INTO `alergeno` (`id`, `nombre`) VALUES
(1, 'Gluten'),
(2, 'Crustáceos'),
(3, 'Huevos'),
(4, 'Pescado'),
(5, 'Cacahuetes'),
(6, 'Soja'),
(7, 'Leche'),
(8, 'Frutos de cáscara'),
(9, 'Apio'),
(10, 'Mostaza'),
(13, 'Altramuces'),
(14, 'Moluscos'),
(15, 'Sésamo'),
(16, 'Dióxido de azufre y sulfitos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `destacada` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `foto`, `descripcion`, `destacada`, `activo`) VALUES
(1, 'Platos vegetarianos', 'vegetariano-1747647882.jpg', 'Comidas completas sin ingredientes de origen animal o con productos derivados como queso o huevos.', 0, 1),
(2, 'Platos proteicos', 'proteicos.jpg', 'Platos ricos en proteínas, ideales para quienes buscan aumentar su masa muscular.', 1, 1),
(3, 'Ensaladas completas', 'ensaladas-1747648167.jpg', 'Ensaladas frescas, equilibradas y saciantes con proteínas, vegetales y grasas saludables.', 0, 1),
(4, 'Comidas Bajas en Carbohidratos', 'carbohidratos-1747648278.jpg', 'Platos pensados para dietas keto o low-carb, con alto contenido proteico y grasas buenas.', 1, 1),
(5, 'Platos Veganos', 'vegano-1747650579.jpg', 'Comidas 100% vegetales, sin ningún derivado animal. Ideal para quienes siguen una dieta vegana.', 1, 1),
(6, 'Desayunos saludables', 'desayuno-1747650672.jpg', 'Opciones equilibradas para empezar el día con energía: bowls, pancakes fit, huevos y más.', 0, 1),
(7, 'Snacks y entrantes', 'snack-1747650756.jpg', 'Pequeñas porciones ideales para media mañana, meriendas o complementar tus comidas.', 0, 1),
(8, 'Postres Fit', 'postres-1747650869.jpg', 'Dulces saludables sin azúcares añadidos ni harinas refinadas.', 1, 1),
(9, 'Platos Sin Gluten', 'gluten-1747651030.jpg', 'Preparaciones pensadas para personas con intolerancia al gluten o celiaquía.', 0, 1),
(10, 'Comidas para Bajar de Peso', 'bajar-peso-1747651259.jpg', 'Platos balanceados, con control calórico, ideales para personas en plan de pérdida de peso.', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `composicion_producto`
--

CREATE TABLE `composicion_producto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  `cantidad_necesaria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `composicion_producto`
--

INSERT INTO `composicion_producto` (`id`, `producto_id`, `ingrediente_id`, `cantidad_necesaria`) VALUES
(4, 3, 3, 150),
(5, 3, 4, 80),
(6, 4, 30, 150),
(7, 4, 47, 50),
(8, 4, 48, 5),
(9, 4, 49, 100),
(10, 4, 12, 40),
(11, 4, 40, 5),
(12, 4, 44, 10),
(13, 5, 51, 80),
(14, 5, 52, 60),
(15, 5, 53, 60),
(16, 5, 17, 50),
(17, 5, 21, 50),
(18, 5, 44, 10),
(19, 5, 45, 5),
(20, 6, 3, 120),
(21, 6, 4, 80),
(22, 6, 28, 60),
(23, 6, 54, 10),
(24, 6, 8, 5),
(25, 6, 40, 5),
(26, 7, 55, 100),
(27, 7, 56, 100),
(28, 7, 57, 40),
(29, 7, 19, 30),
(30, 7, 44, 10),
(31, 7, 58, 10),
(32, 7, 45, 5),
(33, 8, 59, 50),
(34, 8, 60, 150),
(35, 8, 61, 60),
(36, 8, 62, 10),
(37, 8, 63, 5),
(38, 8, 64, 1),
(39, 9, 65, 60),
(40, 9, 66, 40),
(41, 9, 67, 40),
(42, 9, 24, 40),
(43, 10, 68, 100),
(44, 10, 69, 15),
(45, 10, 70, 30),
(46, 10, 71, 10),
(47, 10, 62, 10),
(48, 11, 72, 120),
(49, 11, 42, 50),
(50, 11, 12, 30),
(51, 11, 44, 10),
(52, 12, 73, 120),
(53, 12, 11, 60),
(54, 12, 18, 50),
(55, 12, 40, 5),
(56, 12, 44, 5),
(57, 12, 74, 1),
(86, 13, 9, 80),
(87, 13, 10, 60),
(88, 13, 11, 60),
(89, 13, 12, 30),
(90, 13, 13, 100),
(91, 13, 14, 50),
(92, 13, 25, 10),
(93, 13, 33, 3),
(94, 13, 34, 1),
(95, 13, 50, 5),
(96, 14, 10, 200),
(97, 14, 36, 120),
(98, 14, 6, 100),
(99, 14, 12, 80),
(100, 14, 40, 10),
(101, 14, 25, 15),
(102, 14, 33, 3),
(103, 14, 34, 1),
(104, 14, 32, 2),
(105, 15, 41, 150),
(106, 15, 37, 100),
(108, 15, 25, 10),
(109, 15, 33, 2),
(110, 15, 34, 1),
(111, 16, 36, 120),
(112, 16, 11, 80),
(113, 16, 6, 70),
(114, 16, 5, 90),
(115, 16, 25, 15),
(116, 17, 36, 150),
(117, 17, 10, 100),
(118, 17, 11, 100),
(119, 17, 6, 80),
(120, 17, 12, 50),
(121, 17, 58, 40),
(122, 17, 25, 15),
(123, 17, 40, 10),
(124, 18, 77, 150),
(125, 18, 75, 100),
(126, 18, 81, 120),
(127, 18, 25, 10),
(128, 18, 33, 3),
(129, 18, 34, 1),
(130, 19, 35, 180),
(131, 19, 10, 100),
(132, 19, 12, 80),
(133, 19, 13, 120),
(134, 19, 31, 150),
(135, 19, 25, 15),
(136, 19, 33, 3),
(137, 19, 34, 2),
(138, 20, 30, 150),
(139, 20, 36, 120),
(140, 20, 75, 100),
(141, 20, 17, 60),
(142, 20, 24, 50),
(143, 20, 25, 15),
(144, 20, 33, 2),
(145, 20, 45, 10),
(153, 22, 35, 200),
(154, 22, 4, 150),
(155, 22, 31, 120),
(156, 23, 80, 180),
(157, 23, 36, 120),
(158, 23, 37, 100),
(159, 23, 40, 5),
(160, 24, 17, 150),
(161, 24, 30, 120),
(162, 24, 29, 30),
(163, 24, 16, 20),
(164, 24, 44, 15),
(165, 25, 17, 150),
(166, 25, 18, 70),
(167, 25, 24, 60),
(168, 25, 22, 80),
(169, 25, 23, 40),
(170, 25, 44, 15),
(171, 25, 95, 10),
(172, 26, 30, 120),
(173, 26, 31, 100),
(174, 26, 17, 60),
(175, 26, 32, 5),
(176, 27, 36, 100),
(177, 27, 21, 80),
(178, 27, 24, 70),
(179, 27, 23, 50),
(180, 27, 22, 60),
(181, 27, 25, 15),
(182, 27, 45, 10),
(183, 28, 30, 120),
(184, 28, 17, 80),
(185, 28, 52, 70),
(186, 28, 101, 60),
(187, 28, 102, 15),
(188, 29, 113, 200),
(189, 29, 114, 150),
(190, 29, 118, 30),
(191, 29, 25, 10),
(192, 29, 119, 5),
(193, 29, 33, 2),
(201, 30, 30, 180),
(202, 30, 52, 100),
(203, 30, 21, 80),
(204, 30, 17, 120),
(205, 30, 25, 15),
(206, 30, 33, 2),
(207, 30, 34, 1),
(208, 31, 17, 100),
(209, 31, 38, 150),
(210, 31, 52, 80),
(211, 31, 18, 50),
(212, 31, 12, 40),
(213, 31, 45, 10),
(214, 31, 33, 2),
(215, 31, 34, 1),
(216, 32, 51, 150),
(217, 32, 57, 100),
(218, 32, 45, 10),
(219, 32, 25, 15),
(220, 32, 33, 2),
(221, 32, 34, 1),
(222, 32, 114, 120),
(223, 33, 51, 120),
(224, 33, 37, 100),
(225, 33, 44, 15),
(226, 33, 33, 2),
(227, 33, 34, 1),
(228, 34, 36, 150),
(229, 34, 15, 100),
(230, 34, 52, 70),
(231, 34, 5, 50),
(232, 34, 24, 50),
(233, 34, 25, 15),
(234, 34, 45, 10),
(235, 36, 15, 150),
(236, 36, 10, 120),
(237, 36, 47, 100),
(238, 36, 48, 15),
(239, 36, 44, 10),
(240, 36, 33, 2),
(241, 36, 34, 1),
(242, 37, 3, 150),
(243, 37, 6, 100),
(244, 37, 4, 100),
(245, 37, 5, 80),
(246, 37, 7, 30),
(247, 37, 8, 10),
(248, 37, 40, 5),
(249, 38, 36, 150),
(250, 38, 57, 100),
(251, 38, 5, 70),
(252, 38, 11, 80),
(253, 38, 12, 60),
(254, 38, 48, 10),
(255, 38, 25, 15),
(256, 39, 55, 120),
(257, 39, 6, 80),
(258, 39, 12, 50),
(259, 39, 54, 15),
(260, 39, 16, 100),
(261, 40, 126, 150),
(262, 40, 127, 50),
(263, 40, 125, 70),
(264, 40, 128, 30),
(265, 40, 123, 10),
(266, 40, 129, 2),
(267, 41, 16, 60),
(268, 41, 52, 80),
(269, 41, 72, 50),
(270, 41, 63, 5),
(271, 41, 34, 1),
(272, 42, 126, 150),
(273, 42, 99, 50),
(274, 42, 61, 60),
(275, 42, 127, 40),
(276, 42, 123, 15),
(277, 43, 39, 100),
(278, 43, 60, 200),
(279, 43, 61, 80),
(280, 43, 62, 30),
(285, 47, 15, 150),
(286, 47, 103, 100),
(287, 47, 58, 20),
(288, 47, 45, 10),
(289, 47, 40, 3),
(290, 47, 25, 15),
(291, 47, 33, 2),
(292, 47, 34, 1),
(293, 47, 5, 80),
(294, 47, 24, 80),
(295, 48, 11, 120),
(296, 48, 14, 80),
(297, 48, 62, 30),
(298, 48, 25, 10),
(299, 48, 33, 2),
(300, 48, 34, 1),
(307, 50, 24, 100),
(308, 50, 130, 60),
(309, 50, 62, 20),
(310, 50, 45, 5),
(311, 50, 33, 1),
(312, 50, 34, 1),
(328, 51, 31, 150),
(329, 51, 25, 10),
(330, 51, 131, 2),
(331, 51, 132, 1),
(332, 51, 33, 2),
(333, 52, 55, 120),
(334, 52, 59, 30),
(335, 52, 40, 5),
(336, 52, 12, 30),
(337, 52, 25, 10),
(338, 52, 34, 1),
(339, 52, 33, 2),
(340, 53, 52, 150),
(341, 53, 69, 30),
(342, 53, 58, 30),
(343, 53, 47, 100),
(344, 54, 59, 100),
(345, 54, 62, 60),
(346, 54, 123, 40),
(347, 55, 100, 150),
(348, 55, 99, 50),
(349, 55, 63, 20),
(353, 56, 134, 150),
(354, 56, 99, 50),
(355, 56, 127, 40),
(356, 58, 61, 100),
(357, 58, 99, 50),
(358, 58, 59, 40),
(359, 58, 63, 15),
(360, 58, 60, 150),
(361, 59, 30, 150),
(362, 59, 86, 120),
(363, 59, 47, 100),
(364, 59, 48, 5),
(365, 59, 33, 2),
(366, 59, 25, 10),
(367, 59, 12, 30),
(374, 60, 55, 120),
(375, 60, 42, 50),
(376, 60, 53, 1),
(377, 60, 25, 10),
(378, 60, 45, 5),
(379, 60, 33, 2),
(386, 62, 135, 150),
(387, 62, 6, 50),
(388, 62, 5, 50),
(389, 62, 11, 50),
(390, 62, 25, 10),
(391, 62, 33, 2),
(404, 63, 30, 120),
(405, 63, 136, 100),
(406, 63, 42, 50),
(407, 63, 25, 10),
(408, 63, 45, 10),
(409, 63, 33, 2),
(426, 64, 11, 150),
(427, 64, 80, 120),
(428, 64, 12, 30),
(429, 64, 40, 5),
(430, 64, 13, 80),
(431, 64, 25, 10),
(432, 64, 33, 2),
(433, 64, 34, 1),
(434, 65, 55, 120),
(435, 65, 5, 50),
(436, 65, 11, 50),
(437, 65, 12, 30),
(438, 65, 25, 10),
(439, 65, 45, 10),
(440, 65, 33, 2),
(441, 65, 34, 1),
(442, 66, 41, 120),
(443, 66, 37, 80),
(444, 66, 11, 60),
(445, 66, 12, 30),
(446, 66, 25, 10),
(447, 66, 33, 2),
(448, 66, 34, 1),
(449, 67, 15, 100),
(450, 67, 52, 60),
(451, 67, 18, 50),
(452, 67, 24, 40),
(453, 67, 12, 30),
(454, 67, 25, 10),
(455, 67, 45, 10),
(456, 67, 33, 2),
(465, 68, 3, 120),
(466, 68, 4, 60),
(467, 68, 5, 50),
(468, 68, 6, 50),
(469, 68, 40, 5),
(470, 68, 25, 10),
(471, 68, 33, 2),
(472, 68, 34, 1),
(473, 69, 24, 100),
(474, 69, 126, 100),
(475, 69, 40, 3),
(476, 69, 45, 10),
(477, 69, 25, 5),
(478, 69, 33, 2),
(479, 69, 34, 1),
(480, 15, 52, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido_cliente`
--

CREATE TABLE `detalle_pedido_cliente` (
  `id` int(11) NOT NULL,
  `pedido_cliente_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio_unitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_producto`
--

CREATE TABLE `foto_producto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `foto_producto`
--

INSERT INTO `foto_producto` (`id`, `producto_id`, `foto`, `updated_at`) VALUES
(7, 3, 'pexels-ella-olsson-572949-3026808-683978b6cb1a6132801911.jpg', '2025-05-30 11:21:58'),
(8, 3, 'pexels-valeriya-1893563-683978b6cc750528083887.jpg', '2025-05-30 11:21:58'),
(9, 3, 'pexels-pixabay-434258-683978b6cd884763315158.jpg', '2025-05-30 11:21:58'),
(10, 13, 'pexels-ajit-shahu-1794732582-28321262-6839792027efb003157684.jpg', '2025-05-30 11:23:44'),
(12, 13, 'pexels-jose-luis-reveles-40704633-17847180-68397920299c4701674155.jpg', '2025-05-30 11:23:44'),
(13, 13, 'pexels-nano-erdozain-120534369-29535637-683979534f8e4711724992.jpg', '2025-05-30 11:24:35'),
(14, 14, 'pexels-yesim-g-ozdemir-331486613-29040190-68397997cc1b3549220492.jpg', '2025-05-30 11:25:43'),
(15, 14, 'pexels-zehra-yilmaz-407275500-23359709-68397997cd406831963452.jpg', '2025-05-30 11:25:43'),
(16, 14, 'pexels-cookeat-772513-68397997ce13e744299312.jpg', '2025-05-30 11:25:43'),
(17, 16, 'pexels-polina-tankilevitch-3872365-68397a280ca06451473806.jpg', '2025-05-30 11:28:08'),
(18, 16, 'pexels-polina-tankilevitch-3872370-68397a280da22981555308.jpg', '2025-05-30 11:28:08'),
(19, 16, 'pexels-pixabay-248509-68397a280e558103234479.jpg', '2025-05-30 11:28:08'),
(20, 17, 'pexels-kei-photo-1420806-2741458-68397a6090991219395519.jpg', '2025-05-30 11:29:04'),
(21, 17, 'pexels-loquellano-16123123-68397a6091798628232721.jpg', '2025-05-30 11:29:04'),
(22, 17, 'pexels-roman-odintsov-5337011-68397a60926e0025593769.jpg', '2025-05-30 11:29:04'),
(23, 4, 'pexels-iamabdullahsheik-9792458-68397aa0e4e14079876655.jpg', '2025-05-30 11:30:08'),
(24, 4, 'pexels-dee-dave-60341237-23897672-68397aa0e5a90140142975.jpg', '2025-05-30 11:30:08'),
(25, 4, 'pexels-amar-17593646-68397aa0e6586751334260.jpg', '2025-05-30 11:30:08'),
(29, 19, 'pexels-biabrg-15656549-68397b5654e87039010217.jpg', '2025-05-30 11:33:10'),
(30, 19, 'pexels-huzaifabukhari-16845751-68397b5656458175148910.jpg', '2025-05-30 11:33:10'),
(31, 19, 'pexels-nicu-cobasnean-860727842-19748958-68397b56571d5385397807.jpg', '2025-05-30 11:33:10'),
(32, 20, 'pexels-melaudelo-31923812-68397b8b4ec67454915160.jpg', '2025-05-30 11:34:03'),
(33, 20, 'pexels-mikegz-400576129-14968264-68397b8b4f61e596917465.jpg', '2025-05-30 11:34:03'),
(34, 20, 'pexels-galiiya-20473747-68397b8b50105554807914.jpg', '2025-05-30 11:34:03'),
(38, 23, 'pexels-nadin-sh-78971847-17146252-6839856c867e7871524986.jpg', '2025-05-30 12:16:12'),
(39, 23, 'pexels-sejio402-28618632-6839856c87976628105931.jpg', '2025-05-30 12:16:12'),
(40, 23, 'pexels-nadin-sh-78971847-25315522-6839856c8885b751970641.jpg', '2025-05-30 12:16:12'),
(41, 5, 'pexels-valeriya-15913488-683985af4b322178710066.jpg', '2025-05-30 12:17:19'),
(42, 5, 'pexels-valeriya-15913466-683985af4bdce332262907.jpg', '2025-05-30 12:17:19'),
(43, 5, 'pexels-polina-tankilevitch-4828151-683985af4c579718541946.jpg', '2025-05-30 12:17:19'),
(44, 24, 'pexels-kevin-malik-9031798-6839860e421ad447951529.jpg', '2025-05-30 12:18:54'),
(45, 24, 'pexels-kevin-malik-9031808-6839860e42f39544792324.jpg', '2025-05-30 12:18:54'),
(46, 24, 'pexels-julieaagaard-2097090-6839860e43988165464993.jpg', '2025-05-30 12:18:54'),
(47, 25, 'pexels-livilla-latini-1678510737-27850079-683986444fb2c257092947.jpg', '2025-05-30 12:19:48'),
(48, 25, 'pexels-farhad-8743813-6839864450476967060055.jpg', '2025-05-30 12:19:48'),
(49, 25, 'pexels-nati-87264186-16549051-6839864451d57766435024.jpg', '2025-05-30 12:19:48'),
(50, 26, 'pexels-kpaukshtite-1591226-6839868d00b5c357263273.jpg', '2025-05-30 12:21:01'),
(51, 26, 'pexels-roman-odintsov-5837004-6839868d01536295698193.jpg', '2025-05-30 12:21:01'),
(52, 26, 'pexels-sydney-troxell-223521-718742-1-6839868d021d2836084763.jpg', '2025-05-30 12:21:01'),
(53, 27, 'pexels-ella-olsson-572949-1640767-683986def4239989001477.jpg', '2025-05-30 12:22:23'),
(54, 27, 'pexels-shameel-mukkath-3421394-5639363-683986df00cef235957009.jpg', '2025-05-30 12:22:23'),
(55, 27, 'pexels-kpaukshtite-1591226-683986df0150d649804319.jpg', '2025-05-30 12:22:23'),
(56, 28, 'pexels-shameel-mukkath-3421394-10980007-68398720894c9758276174.jpg', '2025-05-30 12:23:28'),
(57, 28, 'pexels-chef-akey-51673050-8535717-683987208a2a8375626601.jpg', '2025-05-30 12:23:28'),
(58, 28, 'pexels-marvin-bayer-332281072-13887558-683987208afb5867849469.jpg', '2025-05-30 12:23:28'),
(59, 6, 'pexels-alesiakozik-6120236-6839876b8aec4014996672.jpg', '2025-05-30 12:24:43'),
(60, 6, 'pexels-polina-tankilevitch-4828221-6839876b8b67c848445997.jpg', '2025-05-30 12:24:43'),
(61, 6, 'pexels-ella-olsson-572949-3026808-1-6839876b8bcfb545245453.jpg', '2025-05-30 12:24:43'),
(62, 29, 'pexels-alesiakozik-6544500-683987ba4f038070359302.jpg', '2025-05-30 12:26:02'),
(63, 29, 'pexels-alesiakozik-6543754-683987ba5002b657988738.jpg', '2025-05-30 12:26:02'),
(64, 29, 'pexels-alesiakozik-6543757-683987ba50fcf392000161.jpg', '2025-05-30 12:26:02'),
(65, 30, 'pexels-rasul70-17597414-683987f54b64e270919917.jpg', '2025-05-30 12:27:01'),
(66, 30, 'pexels-nano-erdozain-120534369-28841113-683987f54c3bf633646688.jpg', '2025-05-30 12:27:01'),
(67, 30, 'pexels-alexandra-matviets-101599139-18476165-683987f54e932669464767.jpg', '2025-05-30 12:27:01'),
(68, 31, 'pexels-roman-odintsov-5837105-683989d653535665153347.jpg', '2025-05-30 12:35:02'),
(69, 31, 'pexels-thepaintedsquare-4352099-683989d6548fd824269967.jpg', '2025-05-30 12:35:02'),
(70, 31, 'pexels-jeswin-7474616-683989d6551d8331425329.jpg', '2025-05-30 12:35:02'),
(71, 32, 'pexels-valeriya-1247677-68398a30300a6581546966.jpg', '2025-05-30 12:36:32'),
(72, 32, 'pexels-bemistermister-3490368-68398a3031255246916109.jpg', '2025-05-30 12:36:32'),
(73, 32, 'pexels-jacobyavin-14542171-68398a3032392545279959.jpg', '2025-05-30 12:36:32'),
(74, 33, 'pexels-valeriya-15913504-68398aa7d0916400141850.jpg', '2025-05-30 12:38:31'),
(75, 33, 'pexels-valeriya-15913497-68398aa7d1330725153962.jpg', '2025-05-30 12:38:31'),
(76, 33, 'pexels-anthony-rahayel-125801377-30325083-68398aa7d1dc3005596941.jpg', '2025-05-30 12:38:31'),
(77, 7, 'pexels-andreas-schnabl-1775843-20443725-68398afa8d1dd939099170.jpg', '2025-05-30 12:39:54'),
(78, 7, 'pexels-alesiakozik-6066051-68398afa8e2a7016162368.jpg', '2025-05-30 12:39:54'),
(79, 7, 'pexels-ella-olsson-572949-1640772-68398afa8eeea732517652.jpg', '2025-05-30 12:39:54'),
(80, 34, 'pexels-alesiakozik-6631966-68398b488deb4170313735.jpg', '2025-05-30 12:41:12'),
(81, 34, 'pexels-panddamatic-30552850-68398b488ecbb633957560.jpg', '2025-05-30 12:41:12'),
(82, 34, 'pexels-loquellano-16123121-68398b488f5f4063523215.jpg', '2025-05-30 12:41:12'),
(83, 36, 'pexels-jerchung-2116092-68398b8686acf820133454.jpg', '2025-05-30 12:42:14'),
(84, 36, 'pexels-alesiakozik-6544378-68398b86877db306130567.jpg', '2025-05-30 12:42:14'),
(85, 36, 'pexels-alesiakozik-6544379-68398b8688186533337884.jpg', '2025-05-30 12:42:14'),
(86, 37, 'pexels-aibek-skakov-418917601-32036920-68398bd95ae13179316482.jpg', '2025-05-30 12:43:37'),
(87, 37, 'pexels-jonathanborba-29145753-68398bd95c3fb123741706.jpg', '2025-05-30 12:43:37'),
(88, 37, 'pexels-nadin-sh-78971847-23645813-68398bd95d401954034677.jpg', '2025-05-30 12:43:37'),
(89, 38, 'pexels-jerchung-2116093-68398c5b6f208710333174.jpg', '2025-05-30 12:45:47'),
(90, 38, 'pexels-dainiktales-19834446-68398c5b70571564583635.jpg', '2025-05-30 12:45:47'),
(91, 38, 'pexels-rachel-claire-5865239-68398c5b712b8745283927.jpg', '2025-05-30 12:45:47'),
(92, 39, 'pexels-leonardo-aquino-246345118-28959271-68398cb52782c006847944.jpg', '2025-05-30 12:47:17'),
(93, 39, 'pexels-alesiakozik-6543753-68398cb528241414688441.jpg', '2025-05-30 12:47:17'),
(94, 39, 'pexels-alesiakozik-6543754-1-68398cb529115991399521.jpg', '2025-05-30 12:47:17'),
(95, 8, 'pexels-nadin-sh-78971847-23940631-68398cf944f03354132881.jpg', '2025-05-30 12:48:25'),
(96, 8, 'pexels-nicola-barts-7937484-68398cf945979413043401.jpg', '2025-05-30 12:48:25'),
(97, 8, 'pexels-nicola-barts-7937341-68398cf9466bb283881971.jpg', '2025-05-30 12:48:25'),
(98, 40, 'pexels-life-of-pix-128865-68398d3b33181915438733.jpg', '2025-05-30 12:49:31'),
(99, 40, 'pexels-foodie-factor-162291-566564-68398d3b33e36515136991.jpg', '2025-05-30 12:49:31'),
(100, 40, 'pexels-solodsha-7662248-68398d3b34699664912143.jpg', '2025-05-30 12:49:31'),
(101, 41, 'pexels-nicola-barts-7936743-68398d7a0db83177000456.jpg', '2025-05-30 12:50:34'),
(102, 41, 'pexels-nicola-barts-7937463-68398d7a0eab5009087975.jpg', '2025-05-30 12:50:34'),
(103, 41, 'pexels-nicola-barts-7936735-68398d7a0f550023711128.jpg', '2025-05-30 12:50:34'),
(104, 42, 'pexels-shkrabaanthony-6823332-68398dc9b4222747405276.jpg', '2025-05-30 12:51:53'),
(105, 42, 'pexels-shkrabaanthony-6823324-68398dc9b4fc9322950880.jpg', '2025-05-30 12:51:53'),
(106, 42, 'pexels-shkrabaanthony-4397236-68398dc9b5d28887429306.jpg', '2025-05-30 12:51:53'),
(107, 43, 'pexels-polina-tankilevitch-4725732-68398e3edae8c803708373.jpg', '2025-05-30 12:53:50'),
(108, 43, 'pexels-polina-tankilevitch-4725748-68398e3edb9cf160981149.jpg', '2025-05-30 12:53:50'),
(109, 43, 'pexels-polina-tankilevitch-4725734-68398e3edc2a8886552365.jpg', '2025-05-30 12:53:50'),
(113, 58, 'pexels-claudio-rocha-13633618-11702427-68398ec9075dc643130856.jpg', '2025-05-30 12:56:09'),
(114, 58, 'pexels-cristian-rojas-8230017-68398ec9089e0242516030.jpg', '2025-05-30 12:56:09'),
(115, 58, 'pexels-roman-odintsov-4553027-68398ec9096b9785673176.jpg', '2025-05-30 12:56:09'),
(116, 9, 'pexels-shkrabaanthony-5852251-68398f381c7a7395904588.jpg', '2025-05-30 12:58:00'),
(117, 9, 'pexels-polina-tankilevitch-3872351-68398f381d070756834994.jpg', '2025-05-30 12:58:00'),
(118, 9, 'pexels-shkrabaanthony-5852261-68398f381da64952118788.jpg', '2025-05-30 12:58:00'),
(119, 47, 'pexels-alesiakozik-6072382-68398f6f668eb029945462.jpg', '2025-05-30 12:58:55'),
(120, 47, 'pexels-cookeat-12407095-68398f6f67457934412286.jpg', '2025-05-30 12:58:55'),
(121, 47, 'pexels-cookeat-12407094-68398f6f67fb4225859168.jpg', '2025-05-30 12:58:55'),
(122, 48, 'pavel-trishin-jht9mqsnz4g-unsplash-68398fdbe60d9588643714.jpg', '2025-05-30 13:00:43'),
(123, 48, 'mohamed-hassouna-5x4kmgi7xy4-unsplash-68398fdbe706c001051756.jpg', '2025-05-30 13:00:43'),
(124, 50, 'harrison-chang-xwl873nlrqw-unsplash-6839904aa128c098392674.jpg', '2025-05-30 13:02:34'),
(125, 50, 'toa-heftiba-7p3rhc9g9lc-unsplash-6839904aa249d310074430.jpg', '2025-05-30 13:02:34'),
(126, 51, 'karyna-panchenko-zxkhl8erou0-unsplash-683990978da7f785463943.jpg', '2025-05-30 13:03:51'),
(127, 51, 'syed-f-hashemi-a7l6qxrbnlc-unsplash-683990978e51c162889255.jpg', '2025-05-30 13:03:51'),
(128, 51, 'louis-hansel-x1ejncuwhdi-unsplash-683990978efb3688786966.jpg', '2025-05-30 13:03:51'),
(129, 52, 'nathenia-landers-mwojg51ezyo-unsplash-683990ebabc53570437317.jpg', '2025-05-30 13:05:15'),
(130, 52, 'ludovic-avice-uiclobu2sau-unsplash-683990ebac84c087259392.jpg', '2025-05-30 13:05:15'),
(131, 52, 'anton-cptkcrg-ooo-unsplash-683990ebad002718413693.jpg', '2025-05-30 13:05:15'),
(132, 10, 'pexels-karolina-grabowska-5386665-6839913330d07396135074.jpg', '2025-05-30 13:06:27'),
(133, 10, 'pexels-karolina-grabowska-5386684-6839913331a33238911918.jpg', '2025-05-30 13:06:27'),
(134, 10, 'pexels-karolina-grabowska-5386663-68399133322f2986932871.jpg', '2025-05-30 13:06:27'),
(135, 53, 'pexels-karolina-grabowska-5386663-683991849711e464174759.jpg', '2025-05-30 13:07:48'),
(136, 53, 'pexels-eva-bronzini-6261272-6839918497f3d777043364.jpg', '2025-05-30 13:07:48'),
(137, 53, 'pexels-eva-bronzini-6261274-6839918498cd9559379231.jpg', '2025-05-30 13:07:48'),
(138, 54, 'hayley-maxwell-xtpxtrhnt9g-unsplash-683992133a435805289100.jpg', '2025-05-30 13:10:11'),
(139, 54, 'netograph-capture-g54b-doz2qq-unsplash-683992133add0204574633.jpg', '2025-05-30 13:10:11'),
(140, 54, 'jacalyn-beales-ofejk-hr-jg-unsplash-683992133b689733859178.jpg', '2025-05-30 13:10:11'),
(141, 55, 'pexels-verenahinteregger-7535151-68399261dafab852095332.jpg', '2025-05-30 13:11:29'),
(142, 55, 'pexels-jdgromov-4669222-68399261dc46b750305762.jpg', '2025-05-30 13:11:29'),
(143, 55, 'pexels-shkrabaanthony-6823321-68399261dd0c7224954154.jpg', '2025-05-30 13:11:29'),
(144, 56, 'pexels-nicola-barts-7937392-6839bd40790ea641433205.jpg', '2025-05-30 16:14:24'),
(145, 56, 'pexels-nicola-barts-7937393-6839bd407a237949693930.jpg', '2025-05-30 16:14:24'),
(146, 56, 'pexels-nicola-barts-7937381-6839bd407b1be941423523.jpg', '2025-05-30 16:14:24'),
(147, 59, 'pexels-dhiraj-jain-207743066-12737913-6839bd8f98c50546907454.jpg', '2025-05-30 16:15:43'),
(148, 59, 'pexels-dhiraj-jain-207743066-12737914-6839bd8f99689597157154.jpg', '2025-05-30 16:15:43'),
(149, 59, 'pexels-dhiraj-jain-207743066-12737920-6839bd8f9ab38769449244.jpg', '2025-05-30 16:15:43'),
(150, 60, 'doug-r-w-dunigan-txnopsw2-fq-unsplash-6839bdf181951497384756.jpg', '2025-05-30 16:17:21'),
(151, 60, 'buddy-photo-0jjzwgoztfk-unsplash-6839bdf182d73525431445.jpg', '2025-05-30 16:17:21'),
(152, 60, 'nrd-9gxaxx2uaz8-unsplash-6839bdf183ca3641433510.jpg', '2025-05-30 16:17:21'),
(153, 62, 'pexels-conojeghuo-175753-6839be764829b697933115.jpg', '2025-05-30 16:19:34'),
(154, 62, 'pexels-arthousestudio-7287118-6839be7648e41092326513.jpg', '2025-05-30 16:19:34'),
(155, 62, 'pexels-makafood-82669418-9029642-6839be7649660657171922.jpg', '2025-05-30 16:19:34'),
(156, 63, 'pexels-valeriya-28292007-6839beb8d01f7250093541.jpg', '2025-05-30 16:20:40'),
(157, 63, 'pexels-sydney-troxell-223521-718742-2-6839beb8d1068827729844.jpg', '2025-05-30 16:20:40'),
(158, 63, 'pexels-roman-odintsov-4958951-6839beb8d1b0b867647028.jpg', '2025-05-30 16:20:40'),
(159, 64, 'pexels-jacquelinespotto-14343072-6839bfbe3399f936372871.jpg', '2025-05-30 16:25:02'),
(160, 64, 'pexels-panerai-7636404-6839bfbe3518f487844413.jpg', '2025-05-30 16:25:02'),
(161, 64, 'pexels-iamabdullahsheik-10615310-6839bfbe36642500563925.jpg', '2025-05-30 16:25:02'),
(162, 65, 'pexels-ella-olsson-572949-1640775-6839c07c52698522657273.jpg', '2025-05-30 16:28:12'),
(163, 65, 'pexels-matvalina-19870648-6839c07c53ad0338462475.jpg', '2025-05-30 16:28:12'),
(164, 65, 'pexels-heather-brock-31614773-6978180-6839c07c548ab078093186.jpg', '2025-05-30 16:28:12'),
(165, 66, 'sorin-popa-lu94npuxtks-unsplash-6839c141a5f78696763895.jpg', '2025-05-30 16:31:29'),
(166, 66, 'yana-gorbunova-ynj5wuwz77w-unsplash-6839c141a70cc588092326.jpg', '2025-05-30 16:31:29'),
(167, 66, 'yana-gorbunova-pw8uqasvqik-unsplash-6839c141a82e9118398464.jpg', '2025-05-30 16:31:29'),
(168, 67, 'pexels-deeanacreates-2894651-6839c1c9da983902688289.jpg', '2025-05-30 16:33:45'),
(169, 67, 'pexels-olenkabohovyk-3794378-6839c1c9dbafb818240005.jpg', '2025-05-30 16:33:45'),
(170, 67, 'pexels-shameel-mukkath-3421394-5639367-6839c1c9dc450338542698.jpg', '2025-05-30 16:33:45'),
(171, 68, 'pexels-anntarazevich-5182118-6839c21ea0341517840287.jpg', '2025-05-30 16:35:10'),
(172, 68, 'pexels-nonik-yench-3589897-6655415-6839c21ea0fa4948966855.jpg', '2025-05-30 16:35:10'),
(173, 68, 'pexels-anntarazevich-5182130-6839c21ea19a5222606757.jpg', '2025-05-30 16:35:10'),
(174, 69, 'micheile-henderson-nfhebysjcti-unsplash-6839c26f1635f372598398.jpg', '2025-05-30 16:36:31'),
(175, 69, 'eugene-kuznetsov-iy2lbtbyxbg-unsplash-6839c26f1748c534103674.jpg', '2025-05-30 16:36:31'),
(176, 69, 'karolina-kolodziejczak-rhexgeqebu8-unsplash-6839c26f181e7853377863.jpg', '2025-05-30 16:36:31'),
(177, 15, 'hanna-sadouskaya-1hw5jay8ltu-unsplash-6839c33a338f4897200571.jpg', '2025-05-30 16:39:54'),
(178, 15, 'yana-gorbunova-pw8uqasvqik-unsplash-1-6839c33a34845357427989.jpg', '2025-05-30 16:39:54'),
(179, 15, 'pexels-nadin-sh-78971847-25650513-1-6839c33a355db294574493.jpg', '2025-05-30 16:39:54'),
(180, 18, 'pexels-catscoming-724298-1-6839c43ef0e1a637015217.jpg', '2025-05-30 16:44:14'),
(181, 18, 'pexels-catscoming-724302-6839c43ef1a13801614319.jpg', '2025-05-30 16:44:14'),
(182, 18, 'pexels-enesfilm-9665028-6839c43ef22e3885021165.jpg', '2025-05-30 16:44:14'),
(183, 22, 'pexels-814191500-19362408-6839c5b1c6f16345291931.jpg', '2025-05-30 16:50:25'),
(184, 22, 'pexels-esmihel-16444386-6839c5b1c894c689997269.jpg', '2025-05-30 16:50:25'),
(185, 22, 'pexels-vui-nguyen-745287463-18752173-6839c5b1c97b3607692417.jpg', '2025-05-30 16:50:25'),
(186, 11, 'pexels-nadin-sh-78971847-25650513-2-6839d91742092770108824.jpg', '2025-05-30 18:13:11'),
(187, 11, 'pexels-followfauzia-10756661-1-6839d91742d39175262266.jpg', '2025-05-30 18:13:11'),
(188, 11, 'pexels-spencer-4393001-6839d91743585860387570.jpg', '2025-05-30 18:13:11'),
(189, 12, 'ra-fat-borini-f-9xyqgwce-unsplash-6839d9cab04a0916275805.jpg', '2025-05-30 18:16:10'),
(190, 12, 'taine-noble-nvxvz3xmc2m-unsplash-6839d9cab0e47670558094.jpg', '2025-05-30 18:16:10'),
(191, 12, 'hanxiao-xu-bzhui19a3fs-unsplash-6839d9cab1b6a793517584.jpg', '2025-05-30 18:16:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `stock` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`id`, `unidad_medida_id`, `nombre`, `stock`) VALUES
(3, 2, 'tofu firme', 2070),
(4, 2, 'brócoli', 2440),
(5, 2, 'zanahoria', 2850),
(6, 2, 'pimiento rojo', 3000),
(7, 1, 'salsa teriyaki', 1000),
(8, 1, 'aceite de sésamo', 980),
(9, 2, 'placas de lasaña integrales', 1000),
(10, 2, 'berenjena', 2880),
(11, 2, 'calabacín', 3000),
(12, 2, 'cebolla', 2840),
(13, 2, 'tomate triturado', 3000),
(14, 2, 'queso ricotta', 3000),
(15, 2, 'garbanzos cocidos', 2550),
(16, 2, 'pan integral', 2960),
(17, 2, 'lechuga', 2280),
(18, 2, 'tomate', 2850),
(19, 2, 'cebolla morada', 2940),
(20, 1, 'mostaza', 1000),
(21, 2, 'tomate cherry', 2920),
(22, 2, 'queso feta', 3000),
(23, 2, 'aceitunas negras', 1000),
(24, 2, 'pepino', 2850),
(25, 1, 'aceite de oliva', 2940),
(26, 2, 'harina integral', 3000),
(27, 2, 'pimiento verde', 3000),
(28, 2, 'champiñones', 2760),
(29, 2, 'queso mozzarella', 2940),
(30, 2, 'pechuga de pollo', 2430),
(31, 2, 'boniato', 3000),
(32, 2, 'romero fresco', 100),
(33, 2, 'sal', 990),
(34, 2, 'pimienta negra molida', 95),
(35, 2, 'filete de ternera', 3000),
(36, 2, 'quinoa cocida', 2310),
(37, 2, 'espinacas salteadas', 2800),
(38, 2, 'carne picada de pollo', 2550),
(39, 2, 'avena molida', 3000),
(40, 2, 'ajo', 965),
(41, 2, 'claras de huevo', 3000),
(42, 2, 'espinaca', 3000),
(44, 1, 'aceite de oliva virgen extra', 930),
(45, 1, 'limón', 930),
(46, 2, 'perejil fresco', 300),
(47, 1, 'leche de coco', 2850),
(48, 2, 'curry en polvo', 280),
(49, 2, 'arroz integral cocido', 200),
(50, 2, 'albahaca fresca', 300),
(51, 2, 'salmón ahumado', 3000),
(52, 2, 'aguacate', 2450),
(53, 2, 'huevo cocido', 3000),
(54, 1, 'salsa de soja baja en sal', 2960),
(55, 2, 'lentejas cocidas', 2800),
(56, 2, 'batata asada', 2800),
(57, 2, 'espinacas baby', 2920),
(58, 2, 'tahini', 280),
(59, 2, 'copos de avena', 2950),
(60, 1, 'bebida vegetal de almendra', 2850),
(61, 2, 'plátano', 2940),
(62, 2, 'nueces', 2950),
(63, 2, 'semillas de chía', 2995),
(64, 2, 'canela', 299),
(65, 2, 'hummus', 3000),
(66, 2, 'zanahoria en bastones', 3000),
(67, 2, 'apio en bastones', 3000),
(68, 2, 'boniato cocido', 2600),
(69, 2, 'cacao puro en polvo', 240),
(70, 2, 'harina de almendra', 4880),
(71, 1, 'aceite de coco', 260),
(72, 2, 'huevo', 3000),
(73, 2, 'filete de merluza', 3000),
(74, 2, 'orégano', 300),
(75, 2, 'quinoa cruda', 3000),
(76, 2, 'huevos enteros', 3000),
(77, 2, 'lomo de cerdo', 3000),
(78, 2, 'tofu ahumado', 3000),
(79, 2, 'guisantes', 3000),
(80, 2, 'pechuga de pavo', 2640),
(81, 2, 'judías verdes', 3000),
(82, 2, 'bacon de pavo', 3000),
(83, 2, 'quinoa inflada', 3000),
(84, 1, 'caldo de pollo', 3000),
(86, 2, 'arroz basmati cocido', 3000),
(87, 2, 'fideos de arroz', 3000),
(88, 2, 'edamame cocido', 3000),
(89, 2, 'brócoli al vapor', 3000),
(91, 2, 'huevo duro', 3000),
(92, 2, 'pasta integral cocida', 3000),
(93, 2, 'ternera desmechada', 3000),
(94, 2, 'claras de huevo pasteurizadas', 3000),
(95, 1, 'vinagre balsámico', 1000),
(96, 2, 'manzana verde', 3000),
(97, 2, 'zanahoria rallada', 3000),
(98, 2, 'col lombarda', 3000),
(99, 2, 'arándanos', 3000),
(100, 2, 'queso cottage', 3000),
(101, 2, 'maíz dulce', 3000),
(102, 2, 'alfalfa', 3000),
(103, 2, 'remolacha cocida', 3000),
(104, 2, 'rúcula', 3000),
(105, 2, 'pepinillos', 3000),
(106, 2, 'cebolla caramelizada', 3000),
(107, 1, 'vinagreta', 1000),
(108, 2, 'nueces pecanas', 3000),
(109, 2, 'semillas de girasol', 3000),
(110, 2, 'queso de cabra', 3000),
(111, 2, 'mango', 3000),
(112, 1, 'salsa de yogur y lima', 1000),
(113, 2, 'coliflor', 3000),
(114, 2, 'espárragos verdes', 3000),
(115, 2, 'calabaza', 3000),
(116, 2, 'berenjena asada', 3000),
(117, 2, 'queso crema bajo en grasa', 3000),
(118, 2, 'almendras picadas', 3000),
(119, 2, 'perejil seco', 300),
(120, 2, 'tomillo seco', 300),
(121, 2, 'nueces tostadas', 3000),
(122, 1, 'crema de leche ligera', 1000),
(123, 1, 'miel', 2000),
(124, 2, 'copos de maíz', 3000),
(125, 2, 'plátano maduro', 3000),
(126, 2, 'yogur natural', 3000),
(127, 2, 'granola', 3000),
(128, 2, 'arándanos frescos', 3000),
(129, 1, 'extracto de vainilla', 100),
(130, 2, 'queso vegano', 3000),
(131, 2, 'pimentón dulce', 100),
(132, 2, 'ajo en polvo', 100),
(134, 1, 'yogur griego', 3000),
(135, 2, 'ternera magra', 6000),
(136, 2, 'batata', 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente_alergeno`
--

CREATE TABLE `ingrediente_alergeno` (
  `ingrediente_id` int(11) NOT NULL,
  `alergeno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingrediente_alergeno`
--

INSERT INTO `ingrediente_alergeno` (`ingrediente_id`, `alergeno_id`) VALUES
(3, 6),
(7, 1),
(7, 6),
(8, 15),
(9, 1),
(14, 7),
(16, 1),
(20, 10),
(22, 7),
(26, 1),
(29, 7),
(39, 1),
(41, 3),
(51, 4),
(53, 3),
(54, 1),
(54, 6),
(58, 15),
(59, 1),
(60, 8),
(62, 8),
(65, 15),
(67, 9),
(70, 8),
(72, 3),
(73, 4),
(78, 6),
(84, 9),
(88, 6),
(91, 3),
(92, 1),
(94, 3),
(100, 7),
(107, 10),
(108, 8),
(110, 7),
(112, 7),
(117, 7),
(118, 8),
(121, 8),
(122, 7),
(126, 7),
(127, 1),
(127, 6),
(127, 8),
(127, 15),
(127, 16),
(130, 6),
(134, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_cliente`
--

CREATE TABLE `pedido_cliente` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `total` double NOT NULL,
  `estado` varchar(255) NOT NULL,
  `fecha_confirmacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `activo`) VALUES
(3, 1, 'Tofu Teriyaki con Verduras', 'Tofu marinado en salsa teriyaki y salteado con vegetales.', 8.9, 1),
(4, 2, 'Pollo al curry con arroz integral', 'Pechuga de pollo en salsa de curry ligera con guarnición de arroz integral.', 9.5, 1),
(5, 3, 'Ensalada de salmón ahumado y aguacate', 'Ensalada fresca con salmón, aguacate, huevo y vegetales.', 8.9, 1),
(6, 4, 'Salteado de tofu con brócoli y champiñones', 'Plato bajo en carbohidratos, ideal para dietas keto.', 8, 1),
(7, 5, 'Bowl vegano de lentejas y batata', 'Bowl saciante y 100% vegetal con legumbres y vegetales asados.', 8.5, 1),
(8, 6, 'Avena con plátano y frutos secos', 'Desayuno completo y saciante con carbohidratos complejos y grasas buenas.', 4.5, 1),
(9, 7, 'Hummus con palitos de verduras', 'Snack saludable para media mañana o merienda.', 4.2, 1),
(10, 8, 'Brownie de cacao y boniato', 'Postre saludable sin azúcar añadido ni harinas refinadas.', 3.8, 1),
(11, 9, 'Tortilla de espinacas y champiñones', 'Tortilla natural sin gluten, rica en proteínas y fibra.', 7, 1),
(12, 10, 'Filete de merluza con calabacín y tomate al horno', 'Comida ligera, baja en grasa y calorías, ideal para dieta.', 8.2, 1),
(13, 1, 'Lasaña de verduras con ricotta', 'Lasaña con capas de berenjena, calabacín, ricotta y salsa de tomate casera.', 8.7, 1),
(14, 1, 'Berenjenas Rellenas de Quinoa y Verduras', 'Berenjenas asadas rellenas con quinoa, pimiento rojo, cebolla y especias.', 8.8, 1),
(15, 1, 'Tortilla Francesa de Espinacas y Aguacate', 'Tortilla esponjosa con espinacas frescas y aguacate, ideal para una comida nutritiva.', 7.5, 1),
(16, 1, 'Buddha Bowl de Quinoa y Verduras Asadas', 'Bowl nutritivo con quinoa cocida, calabacín, pimiento rojo, zanahoria y un toque de aceite de oliva.', 9, 1),
(17, 1, 'Quinoa con Verduras Asadas y Salsa de Tahini', 'Quinoa cocida mezclada con verduras asadas y un toque de salsa de tahini casera.', 9.2, 1),
(18, 2, 'Lomo de cerdo a la plancha con quinoa y judías verdes', 'Lomo de cerdo magro a la plancha acompañado de quinoa y judías verdes al vapor.', 10.5, 1),
(19, 2, 'Ternera guisada con verduras y patatas', 'Ternera cocinada a fuego lento con verduras frescas y patatas.', 11, 1),
(20, 2, 'Bowl de quinoa con pollo y edamame', 'Bowl nutritivo con pechuga de pollo, quinoa, edamame y vegetales.', 10.5, 1),
(22, 2, 'Filete de ternera a la plancha con guarnición de brócoli y boniato', 'Filete de ternera magra a la plancha acompañado de brócoli al vapor y boniato asado, una opción rica en proteínas y baja en grasas.', 10.5, 1),
(23, 2, 'Pechuga de pavo a la plancha con quinoa y espinacas salteadas', 'Pechuga de pavo magra a la plancha acompañada de quinoa cocida y espinacas salteadas con ajo, una comida alta en proteínas y baja en grasas.', 9.9, 1),
(24, 3, 'Ensalada César con pollo a la plancha', 'Lechuga fresca, pechuga de pollo a la plancha, queso parmesano rallado, picatostes integrales y salsa César ligera.', 9.5, 1),
(25, 3, 'Ensalada mediterránea con queso feta y aceitunas', 'Mezcla de lechuga, tomate, pepino, queso feta, aceitunas negras y aliño de aceite de oliva y vinagre balsámico.', 10.5, 1),
(26, 3, 'Ensalada templada de pollo, boniato y romero', 'Pechuga de pollo a la plancha con boniato asado, lechuga fresca y toque de romero fresco.', 13.2, 1),
(27, 3, 'Ensalada mediterránea con quinoa y queso feta', 'Quinoa cocida mezclada con tomate cherry, pepino, aceitunas negras y queso feta, aliñada con aceite de oliva y limón.', 12.5, 1),
(28, 3, 'Ensalada de pollo, aguacate y mango', 'Pechuga de pollo a la plancha sobre una cama de lechuga fresca, aguacate y mango en dados, con un toque de salsa de yogur y lima.', 13.9, 1),
(29, 4, 'Bowl de coliflor y espárragos al horno', 'Delicioso bowl bajo en carbohidratos con coliflor asada, espárragos verdes y almendras picadas.', 8.95, 1),
(30, 4, 'Ensalada de pollo a la parrilla con aguacate', 'Ensalada fresca y nutritiva con pechuga de pollo a la parrilla, aguacate, tomate cherry y mezcla de hojas verdes.', 9.95, 1),
(31, 4, 'Tacos de lechuga con carne picada y guacamole', 'Tacos saludables con hojas de lechuga, carne picada sazonada y guacamole casero, bajos en carbohidratos.', 10.5, 1),
(32, 4, 'Ensalada templada de salmón y espárragos', 'Ensalada baja en carbohidratos con salmón a la plancha, espárragos verdes y aderezo de limón y aceite de oliva.', 11.9, 1),
(33, 4, 'Ensalada tibia de salmón y espinacas', 'Ensalada baja en carbohidratos con salmón a la plancha, espinacas salteadas y un toque de limón y aceite de oliva virgen extra.', 13, 1),
(34, 5, 'Buddha Bowl Vegano', 'Bol nutritivo con quinoa, garbanzos, aguacate y verduras frescas.', 9.9, 1),
(36, 5, 'Curry Vegano de Garbanzos y Berenjena', 'Delicioso curry vegano con garbanzos cocidos, berenjena asada, leche de coco y especias.', 10.2, 1),
(37, 5, 'Tofu salteado con verduras', 'Tofu firme salteado con pimiento rojo, brócoli y zanahoria en salsa teriyaki.', 8.9, 1),
(38, 5, 'Bowl de quinoa y verduras al curry', 'Quinoa cocida con verduras variadas, espinacas baby y toque de curry en polvo.', 9.2, 1),
(39, 5, 'Tacos veganos de lentejas y verduras', 'Tortillas integrales rellenas de lentejas cocidas, pimiento rojo, cebolla y salsa de soja baja en sal.', 8.8, 1),
(40, 6, 'Parfait de yogur natural con granola y frutas', 'Delicioso desayuno con capas de yogur natural, granola crujiente, plátano maduro y arándanos frescos, endulzado con un toque de miel y aroma de vainilla.', 7.95, 1),
(41, 6, 'Tostada integral con aguacate y huevo poché', 'Tostada de pan integral untada con aguacate maduro, coronada con huevo poché y espolvoreada con semillas de chía y pimienta negra.', 6.95, 1),
(42, 6, 'Bowl de yogur con frutas y granola', 'Yogur natural acompañado de frutas frescas variadas, granola casera y un toque de miel natural.', 5.8, 1),
(43, 6, 'Porridge de avena con plátano y nueces', 'Calentito porridge de avena molida preparado con bebida vegetal de almendra, acompañado con rodajas de plátano y nueces troceadas.', 5.9, 1),
(47, 7, 'Hummus de remolacha con crudités', 'Crema suave de garbanzos y remolacha, servida con bastones de zanahoria y pepino para dipear de forma saludable.', 4.2, 1),
(48, 7, 'Rollitos de calabacín con ricotta y nueces', 'Láminas finas de calabacín enrolladas con una mezcla cremosa de ricotta y nueces troceadas, un snack ligero y nutritivo.', 4.6, 1),
(50, 7, 'Rollitos de pepino con queso vegano y nueces', 'Delicados rollitos de pepino rellenos de queso vegano untable y trozos de nueces, perfectos como snack ligero y saludable.', 3.9, 1),
(51, 7, 'Chips de boniato al horno con especias', 'Crujientes chips de boniato horneadas y sazonadas con pimentón dulce, ajo en polvo y un toque de sal marina. Snack saludable y sabroso.', 2.9, 1),
(52, 7, 'Mini albóndigas veganas de lentejas', 'Pequeñas albóndigas elaboradas con lentejas, avena y especias. Perfectas para picar o acompañar con una salsa saludable.', 3.8, 1),
(53, 8, 'Mousse de aguacate y cacao', 'Mousse fit de aguacate cremoso con cacao puro y toque de tahini.', 3.5, 1),
(54, 8, 'Barritas energéticas caseras', 'Barritas fit con copos de avena, nueces y miel natural.', 2.8, 1),
(55, 8, 'Yogur con frutas y semillas', 'Yogur natural acompañado de frutas frescas y semillas de chía.', 3, 1),
(56, 8, 'Parfait de yogur griego y frutos rojos', 'Capa de yogur griego natural, con mezcla de frutos rojos frescos y granola casera.', 4.75, 1),
(58, 6, 'Bowl de frutas tropicales con granola y semillas', 'Delicioso bol con plátano, arándanos frescos, granola de copos de avena y semillas de chía, acompañado con bebida vegetal de almendra.', 5.5, 1),
(59, 9, 'Pollo al curry con arroz basmati', 'Trozos de pechuga de pollo cocinados al curry con leche de coco, acompañados de arroz basmati.', 8.5, 1),
(60, 9, 'Ensalada de lentejas con huevo y espinacas', 'Lentejas cocidas mezcladas con espinacas frescas, huevo cocido y un toque de aceite de oliva y limón.', 7.2, 1),
(62, 9, 'Ternera salteada con verduras al wok', 'Tiras de ternera salteadas con pimientos, zanahoria y calabacín, en salsa ligera sin gluten.', 8.2, 1),
(63, 9, 'Ensalada templada de pollo y batata', 'Trozos de pechuga de pollo a la plancha con batata asada, espinacas frescas y vinagreta de limón.', 7.9, 1),
(64, 9, 'Espaguetis de calabacín con boloñesa de pavo', 'Espaguetis elaborados con calabacín fresco acompañados de una salsa boloñesa de carne magra de pavo.', 8.5, 1),
(65, 10, 'Bowl saciante de lentejas y verduras', 'Una mezcla rica en fibra y proteínas con lentejas, zanahoria, calabacín y un toque de limón.', 7.5, 1),
(66, 10, 'Tortilla ligera de espinacas y calabacín', 'Tortilla al horno baja en grasa con espinacas frescas, calabacín y claras de huevo.', 6.9, 1),
(67, 10, 'Ensalada saciante de garbanzos y aguacate', 'Fresca y nutritiva, con garbanzos cocidos, aguacate, tomate y pepino, ideal para perder peso sin pasar hambre.', 7.2, 1),
(68, 10, 'Salteado de tofu con verduras al ajillo', 'Tofu dorado con mezcla de verduras frescas, ajo y un toque de aceite de oliva. Ligero y saciante.', 7.5, 1),
(69, 10, 'Crema fría de pepino y yogur', 'Refrescante crema a base de yogur natural, pepino y un toque de ajo y limón. Ideal para días calurosos.', 5.9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `unidad_abreviada` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id`, `nombre`, `unidad_abreviada`) VALUES
(1, 'mililitros', 'ml'),
(2, 'gramos', 'gr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `email`, `password`, `direccion`, `telefono`, `roles`, `activo`) VALUES
(3, 'Marina', 'Lopez Arriaga', 'mloparr@gmail.com', '$2y$13$536WK9LzMn5bP6qL276wT.mmIaKgN5oDk.NpDNKhkGUCIHcDnEUBa', 'Calle de la Paz, 123', 123456789, '[\"ROLE_ADMIN\",\"ROLE_USER\"]', 1),
(5, 'lectura', 'aa', 'lectura@gmail.com', '$2y$13$qGimu42RB93rjUshxVgQxOaj16KcwGpHAXSDQg3DJp6.qpa.ATpC.', 'ceawf', 1234, '[\"ROLE_ADMIN_READONLY\"]', 1),
(9, 'Marina', 'López Arriaga', 'arriagamarina4@gmail.com', '$2y$13$Uk7c/okQfkwEotyVxL/9/e4qyHvBN640V8S7/1h.y6rNTb4FaklMq', 'C/ Fantasía 17 3ºA', 626218608, '[\"ROLE_SUPER_ADMIN\",\"ROLE_USER\"]', 1),
(16, 'wefce', 'dedwqe', 'adminnormal@gmail.com', '$2y$13$7BRhMr5vbqBzzrc5mofzSOGotoKomkwYpfK7A5H6yPXWsi8kL/JSm', 'edwe', 123456789, '[\"ROLE_ADMIN\",\"ROLE_USER\"]', 1),
(17, 'rafa', 'dcfew', 'rafa@gmail.com', '$2y$13$g0AAJc5sf5rRY3CiIfYX0OUbHHbKBgmQvQ0q5eqnV6PbnGiN.bkwu', 'evfrve', 999999999, '[\"ROLE_SUPER_ADMIN\",\"ROLE_USER\"]', 1),
(18, 'usuario', 'usuario', 'usuario@gmail.com', '$2y$13$IhuzWsCQVzPzhlfPxj7Yo.RA7SQ07tudyOwUDPis8IZm3WNsRVRiG', 'calle cfesfc', 111111111, '[\"\"]', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergeno`
--
ALTER TABLE `alergeno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `composicion_producto`
--
ALTER TABLE `composicion_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_300C288E7645698E` (`producto_id`),
  ADD KEY `IDX_300C288E769E458D` (`ingrediente_id`);

--
-- Indices de la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A60A455A46B973C2` (`pedido_cliente_id`),
  ADD KEY `IDX_A60A455A7645698E` (`producto_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `foto_producto`
--
ALTER TABLE `foto_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FAC1992F7645698E` (`producto_id`);

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BFB4A41E2E003F4` (`unidad_medida_id`);

--
-- Indices de la tabla `ingrediente_alergeno`
--
ALTER TABLE `ingrediente_alergeno`
  ADD PRIMARY KEY (`ingrediente_id`,`alergeno_id`),
  ADD KEY `IDX_7BA377EC769E458D` (`ingrediente_id`),
  ADD KEY `IDX_7BA377EC3E89035` (`alergeno_id`);

--
-- Indices de la tabla `pedido_cliente`
--
ALTER TABLE `pedido_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9665134BDB38439E` (`usuario_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7BB06153397707A` (`categoria_id`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergeno`
--
ALTER TABLE `alergeno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `composicion_producto`
--
ALTER TABLE `composicion_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto_producto`
--
ALTER TABLE `foto_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `pedido_cliente`
--
ALTER TABLE `pedido_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `composicion_producto`
--
ALTER TABLE `composicion_producto`
  ADD CONSTRAINT `FK_300C288E7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `FK_300C288E769E458D` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingrediente` (`id`);

--
-- Filtros para la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  ADD CONSTRAINT `FK_A60A455A46B973C2` FOREIGN KEY (`pedido_cliente_id`) REFERENCES `pedido_cliente` (`id`),
  ADD CONSTRAINT `FK_A60A455A7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `foto_producto`
--
ALTER TABLE `foto_producto`
  ADD CONSTRAINT `FK_FAC1992F7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `FK_BFB4A41E2E003F4` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`id`);

--
-- Filtros para la tabla `ingrediente_alergeno`
--
ALTER TABLE `ingrediente_alergeno`
  ADD CONSTRAINT `FK_7BA377EC3E89035` FOREIGN KEY (`alergeno_id`) REFERENCES `alergeno` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7BA377EC769E458D` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingrediente` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido_cliente`
--
ALTER TABLE `pedido_cliente`
  ADD CONSTRAINT `FK_9665134BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
