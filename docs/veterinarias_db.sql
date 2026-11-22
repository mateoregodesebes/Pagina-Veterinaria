-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2026 at 10:47 PM
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
-- Database: `veterinarias_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `atenciones`
--

CREATE TABLE `atenciones` (
  `id` int(11) NOT NULL,
  `mascota_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `atenciones`
--

INSERT INTO `atenciones` (`id`, `mascota_id`, `servicio_id`, `personal_id`, `fecha_hora`, `titulo`, `descripcion`) VALUES
(1, 1, 2, 1, '2023-04-20 09:59:25', 'Consulta', 'Le duele la espalda al rrope\nSe le indica descanso y netflix'),
(2, 1, 3, 4, '2025-03-01 15:30:00', 'Cortenla', 'Habría que cortarle un poco el pelo al wacho'),
(3, 2, 6, 3, '2026-01-17 16:00:00', 'Enfermedad leve', 'Bueno fue'),
(5, 1, 3, 4, '2026-02-27 16:00:00', 'Turno cancelado', 'Turno cancelado'),
(6, 5, 1, 4, '2026-02-27 15:30:00', 'Turno cancelado', 'Turno cancelado'),
(7, 5, 9, 3, '2026-02-20 16:30:00', 'Turno solicitado por web', 'Turno solicitado vía página web'),
(8, 5, 9, 3, '2026-02-27 16:30:00', 'Turno solicitado por web', 'Turno solicitado vía página web');

-- --------------------------------------------------------

--
-- Table structure for table `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto` varchar(320) DEFAULT NULL,
  `raza` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `fecha_de_nac` date DEFAULT NULL,
  `fecha_muerte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mascotas`
--

INSERT INTO `mascotas` (`id`, `cliente_id`, `nombre`, `foto`, `raza`, `color`, `fecha_de_nac`, `fecha_muerte`) VALUES
(1, 1, 'Otho', NULL, 'Caniche Toy', 'Marron', '2014-04-16', NULL),
(2, 1, 'Borrys', NULL, 'Callejero Barbudo', 'Atigrado', '2019-12-01', NULL),
(3, 1, 'Bernardo', NULL, 'Pez tropical azulado', 'azul-negro', '2023-03-06', '2023-04-05'),
(4, 6, 'Shidou', 'Shidou.jpg', 'U20', 'Blanco', '2025-03-06', NULL),
(5, 1, 'Rocco', 'asdasd (2).png', 'Labrador', 'Blanco', '2025-09-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token_hash` varchar(64) DEFAULT NULL,
  `verification_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `email`, `clave`, `ciudad`, `direccion`, `telefono`, `rol_id`, `reset_token_hash`, `reset_token_expires_at`, `is_verified`, `verification_token_hash`, `verification_expires_at`) VALUES
(1, 'Roberto', 'Napolitano', 'papo@blues.net', '$2y$10$tZi0/267xneMDQO2xYuxN.kpCxYHdib9.ZsKbRGeXnH7Ro7t8KxpS', 'Rosario', 'Zeballos 1341', '12345678', NULL, NULL, NULL, 0, NULL, NULL),
(2, 'Asistente', 'que asiste', 'Asistente@gmail.com', '$2y$10$tZi0/267xneMDQO2xYuxN.kpCxYHdib9.ZsKbRGeXnH7Ro7t8KxpS', 'Rosario', 'Pepero 345', '01234345345', 3, '$2y$10$wE5rKj6by2JLVetJQVe7t.C5DvesZX6dcm2Mpd36d2FZO8/jMyhMO', '2026-01-02 23:59:06', 0, NULL, NULL),
(3, 'Veterinario', 'que veterina', 'veterinario@gmail.com', '$2y$10$bXJVdBJ/RXsd2bKm/U2V9OC0kcErhFGQD1fglY2QNxbG0wCARx/4u', 'Lol 123', 'Pedro Alfonso 300', '12345436346', 1, NULL, NULL, 0, NULL, NULL),
(4, 'Peluquero', 'que peluca', 'peluquero@gmail.com', '$2y$10$k0ajN/qSTBFJ3VX3uf1qc.tm5dMdtYa65JqhCuTFisDBheJ.QfU7K', 'RoLanDo', 'Roberto carlos 5', '12345436346', 2, NULL, NULL, 0, NULL, NULL),
(5, 'Estudiante', 'que estudia', 'estudiante@gmail.com', '$2y$10$gPnhp3H0uw2FP57jMpPvnOkd4WC2KTe204JyFzvRkBWvlX6SSUsM.', 'Piola 123', 'Topper 3', '0123434534523', 4, NULL, NULL, 0, NULL, NULL),
(6, 'Jorge', 'Medina', 'Tomando@gmail.com.ar', '$2y$10$wkowoaDlQbBDhGIK5OKnheSjm7hgziN5IUyjfVOijN36ffjUxSxjS', 'Rosario', 'Arrivedercci 923', '01234345345', NULL, NULL, NULL, 0, NULL, NULL),
(12, 'Dou', 'MegaDou', 'diverofheaven@gmail.com', '$2y$10$Jj0VS0HQ5rtOIqRfX90/MuxuXJ8S4GsFf8OjiUzxdoGXwQDJWhQnG', 'Rosario', 'Pedro Alfonso 300', '03416140762', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Veterinario'),
(2, 'Peluquero'),
(3, 'Asistente'),
(4, 'Estudiante');

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `tipo`, `precio`) VALUES
(1, 'Lavado', 'peluqueria', 2000.00),
(2, 'Revisión Médica', 'veterinario', 5000.00),
(3, 'Corte de Pelo', 'peluqueria', 3200.00),
(4, 'Vacunas de Rutina', 'veterinario', 8000.00),
(5, 'Radiografía', 'veterinario', 12000.00),
(6, 'Consulta general', 'veterionario', 1000.00),
(7, 'Otro', 'otros', 0.00),
(8, 'Consulta Bonificada', 'veterinario', 500.00),
(9, 'Práctica estudiante', 'veterinario', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atenciones`
--
ALTER TABLE `atenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atencion_mascota_idx` (`mascota_id`),
  ADD KEY `atencion_servicio_idx` (`servicio_id`),
  ADD KEY `atencion_personal_idx` (`personal_id`);

--
-- Indexes for table `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `personal_rol_idx` (`rol_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atenciones`
--
ALTER TABLE `atenciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atenciones`
--
ALTER TABLE `atenciones`
  ADD CONSTRAINT `atencion_mascota` FOREIGN KEY (`mascota_id`) REFERENCES `mascotas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `atencion_personal` FOREIGN KEY (`personal_id`) REFERENCES `personas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `atencion_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personal_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
