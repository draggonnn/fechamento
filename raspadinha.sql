-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 21-Nov-2023 às 23:02
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `raspadinha`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacotes`
--

CREATE TABLE `pacotes` (
  `id` int(11) NOT NULL,
  `nome` varchar(225) DEFAULT NULL,
  `valor` varchar(255) NOT NULL,
  `min` int(11) NOT NULL DEFAULT 1,
  `max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pacotes`
--

INSERT INTO `pacotes` (`id`, `nome`, `valor`, `min`, `max`) VALUES
(1, 'Até R$ 100,00', '10,00', 1, 100),
(2, 'Até R$ 200,00', '50,00', 1, 200),
(3, 'Até R$ 500,00', '200,00', 1, 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `raspadinha`
--

CREATE TABLE `raspadinha` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reward` varchar(255) NOT NULL,
  `package` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `raspadinha`
--

INSERT INTO `raspadinha` (`id`, `user_id`, `reward`, `package`, `token`, `created`, `status`) VALUES
(108, 1, '39', 1, '655cffc774197ba2d959a00f21206d5d49872b44cff9e2154195793', '2023-11-21 16:06:47', 1),
(109, 1, '2', 1, '655d0010584bbf7ea6ec0a29aec939a8f7aee8b14ea621837128707', '2023-11-21 16:08:00', 1),
(110, 1, '45', 2, '655d0017d2b897bd534d4915650d0def084b2e19ca14c2581491515', '2023-11-21 16:08:07', 1),
(111, 1, '14', 1, '655d0041855f640187a03da2ad6a9098d76bf4e911e101712068562', '2023-11-21 16:08:49', 1),
(112, 1, '9', 1, '655d00481f06a052dc83b9aaad74d8a5bcf790f9fc6981220606921', '2023-11-21 16:08:56', 1),
(113, 1, '41', 1, '655d004c9eacb2d32bb1c4469bc0819775c23ba29c2f39311851679', '2023-11-21 16:09:00', 1),
(114, 1, '78', 1, '655d0076ba8a86d5ddfdaded5d240e74b259b26eb025a9557938607', '2023-11-21 16:09:42', 1),
(115, 1, '48', 2, '655d007a0ff2774571424f3b9e84389ecb488f01a4b285616727276', '2023-11-21 16:09:46', 1),
(116, 1, '92', 3, '655d007f5225bbabaa4a6adb73f07f1fb360e81ab8cbc4065305249', '2023-11-21 16:09:51', 1),
(117, 1, '76', 1, '655d04f138b2dc0adfd1c2d1ed3edb9bf98995657c80c371599894', '2023-11-21 16:28:49', 1),
(118, 1, '17', 1, '655d057a6dab20bc16e21a8c049cd169b27ec6160bcee9303736434', '2023-11-21 16:31:06', 1),
(119, 1, '1', 1, '655d057e16cc5f8944a42542c820d7f6a0167f592bd4f3707728474', '2023-11-21 16:31:10', 1),
(120, 1, '181', 3, '655d110c1b2e72aeb00f79e278347f455c7d7921c9a737707467797', '2023-11-21 17:20:28', 1),
(121, 1, '140', 3, '655d111506837cd2a6ce891d0ec9e9d059fc6a770904f5091026186', '2023-11-21 17:20:37', 1),
(122, 1, '34', 2, '655d11895688f6a5c16cdb720e44cce66201863a662cd9682373287', '2023-11-21 17:22:33', 1),
(123, 1, '66', 2, '655d11982b0842ac7bd9b343ab283286f5449c01fee185238362704', '2023-11-21 17:22:48', 1),
(124, 1, '8', 2, '655d1f57e5e5e20c712437a40b01ef39021396a5674088014827321', '2023-11-21 18:21:27', 1),
(125, 1, '73', 2, '655d1f62d29403920b0e2594ab7774961312d28ea7c104958781267', '2023-11-21 18:21:38', 1),
(126, 1, '42', 2, '655d1f6958f881d5c0dcef551a3cb5c7b71679a69e73d4120601674', '2023-11-21 18:21:45', 1),
(127, 1, '67', 2, '655d1f6c97be5f7b29eb939c06ff297ed902e271478f97968546529', '2023-11-21 18:21:48', 1),
(128, 1, '37', 2, '655d1f7023ca0758c163a54c2ed91e49a93971d3061929189625891', '2023-11-21 18:21:52', 1),
(129, 1, '36', 2, '655d1f73d39e0541a6d10f67dbe788c764524bef6fe6c9765987444', '2023-11-21 18:21:55', 1),
(130, 1, '40', 2, '655d1f774d682470ccf974fac29dc8f7ef4138b77389c4245901644', '2023-11-21 18:21:59', 1),
(131, 1, '79', 2, '655d1f7a8904844cf90fa735e7c3b46a42c92ab4530d58262673792', '2023-11-21 18:22:02', 1),
(132, 1, '136', 2, '655d1f7d1f2622efdc33e5ea8cdc3433ad55bfcb9210a4941181020', '2023-11-21 18:22:05', 1),
(133, 1, '20', 2, '655d1f856b3f16415f1f53dac381283000e04698acf966930516861', '2023-11-21 18:22:13', 1),
(134, 1, '5', 2, '655d1f8a01cd4a8dc9912a5d01eb652ddcb3305e6bde65067384992', '2023-11-21 18:22:18', 1),
(135, 1, '36', 2, '655d1f8e40ce9e3ceb5881a0a1fdaad01296d7554868d9401645966', '2023-11-21 18:22:22', 1),
(136, 1, '107', 2, '655d1f93acefb14e2758d707f33af24fb0b2d788c2db78073610292', '2023-11-21 18:22:27', 1),
(137, 1, '71', 2, '655d1f98c8de44750a0f966079c410a027e4a15aa45129152519655', '2023-11-21 18:22:32', 1),
(138, 1, '224', 3, '655d1f9dc3a98e4af6b905ffbdfd31a43173abefbe1a53218053635', '2023-11-21 18:22:37', 1),
(139, 1, '116', 3, '655d1fa9612c32471fee25565e0b3e88cb142485f7f193431828426', '2023-11-21 18:22:49', 1),
(140, 1, '8', 1, '655d1fb2d17ad702998594d25dd9283c41f41a5c9d82b1352767917', '2023-11-21 18:22:58', 1),
(141, 1, '98', 1, '655d1fb62cec236d1271f69e9890c979c14cb5d1411958177999488', '2023-11-21 18:23:02', 1),
(142, 1, '5', 3, '655d1fd43110345346d231c1ba260aeb39b0562f40f082009708445', '2023-11-21 18:23:32', 1),
(143, 1, '95', 1, '655d27b4699d61eb717ef2b753dba6d73f48a0fc943536274414203', '2023-11-21 18:57:08', 1),
(144, 1, '29', 1, '655d27c5af70d909e6f4d8a85ef818dea5d10e563bf925154266953', '2023-11-21 18:57:25', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `transactions_paid`
--

CREATE TABLE `transactions_paid` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `value` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_payment` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `transactions_paid`
--

INSERT INTO `transactions_paid` (`id`, `created`, `value`, `status`, `id_payment`, `id_user`) VALUES
(2, '2023-11-21 17:17:12', '10', 'approved', '67398294572', '1'),
(3, '2023-11-21 17:19:49', '10', 'approved', '67215883323', '1'),
(4, '2023-11-21 17:20:20', '10', 'approved', '67398442108', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `balance` varchar(255) DEFAULT '0,00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `balance`) VALUES
(1, 'teste', '$2y$10$5u8IQnbOt02JcF.XREY0GOi3iiXOGjQN7lv5lvlW/mPYUWIr9yluy', '138,00'),
(4, '123', '$2y$10$sK5TNPlSDACTs8iUg8P/PuQzj4BI91fUq0hYTrGHFBpua63cKtiOq', '10,00'),
(5, 'teste', '$2y$10$vEk8n/WN9LjtoDJrI6HJ3.sq0gf4r3mK0HeD1lAOYgNGDD76xgU1G', '0,00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pacotes`
--
ALTER TABLE `pacotes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `raspadinha`
--
ALTER TABLE `raspadinha`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transactions_paid`
--
ALTER TABLE `transactions_paid`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pacotes`
--
ALTER TABLE `pacotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `raspadinha`
--
ALTER TABLE `raspadinha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de tabela `transactions_paid`
--
ALTER TABLE `transactions_paid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
