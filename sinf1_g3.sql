-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Maio-2025 às 01:02
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sinf1_g3`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao_evento`
--

CREATE TABLE `classificacao_evento` (
  `classificacao_evento_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `classificacao` decimal(10,0) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecao`
--

CREATE TABLE `colecao` (
  `colecoes_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `colecao`
--

INSERT INTO `colecao` (`colecoes_id`, `nome`, `tipo`, `imagem`) VALUES
(9, 'Miniaturas Automotivas', 'Miniaturas', '../imagens/automotiva1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `evento_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `colecoes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`evento_id`, `nome`, `descricao`, `localizacao`, `data`, `imagem`, `colecoes_id`) VALUES
(4, 'Feira de Miniaturas', 'Feira organizada por um grupo de colecionadores de Vila Nova de Gaia', 'Palácio de Cristal', '2025-05-29', '../imagens/feiraMiniaturas2.jpg', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `colecao_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `importancia` int(11) NOT NULL,
  `peso` double NOT NULL,
  `preco` double NOT NULL,
  `data_aquisicao` date NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`item_id`, `colecao_id`, `nome`, `descricao`, `importancia`, `peso`, `preco`, `data_aquisicao`, `imagem`) VALUES
(2, 9, 'Mini cooper', 'Carro moderno', 7, 100, 50, '2025-03-06', '../imagens/682a65efbf24a_automotiva1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `utilizador_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `passw` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`utilizador_id`, `nome`, `data_nascimento`, `email`, `passw`) VALUES
(1, 'liah', '2006-07-04', 'liah@gmail.com', '$2y$10$wtGpNM5v'),
(2, 'ellah', '2003-02-19', 'ellah@gmail.com', '$2y$10$59Be7MTw'),
(3, 'joao', '1998-07-28', 'joao@gmail.com', '$2y$10$3IRVtcn2'),
(4, 'stefany', '2006-03-13', '123@gmail.com', '$2y$10$ah9IITXU'),
(5, 'bruno', '2004-07-21', 'bruno@gmail.com', '$2y$10$Y5ht8zq.'),
(6, 'joana', '2004-07-21', 'joana@gmail.com', '123456'),
(7, 'catarina', '2025-05-09', 'catarina@gmail.com', '$2y$10$FdWipKK9'),
(8, 'ines', '2024-10-30', 'ines@gmail.com', '$2y$10$tSE3ZnYc');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classificacao_evento`
--
ALTER TABLE `classificacao_evento`
  ADD PRIMARY KEY (`classificacao_evento_id`),
  ADD KEY `fk_classificacao_utilizador` (`utilizador_id`),
  ADD KEY `fk_classificacao_evento` (`evento_id`);

--
-- Índices para tabela `colecao`
--
ALTER TABLE `colecao`
  ADD PRIMARY KEY (`colecoes_id`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`evento_id`),
  ADD KEY `fk_evento_colecao` (`colecoes_id`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_item_colecao` (`colecao_id`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`utilizador_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classificacao_evento`
--
ALTER TABLE `classificacao_evento`
  MODIFY `classificacao_evento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `colecao`
--
ALTER TABLE `colecao`
  MODIFY `colecoes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `evento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `utilizador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `classificacao_evento`
--
ALTER TABLE `classificacao_evento`
  ADD CONSTRAINT `fk_classificacao_evento` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`evento_id`),
  ADD CONSTRAINT `fk_classificacao_utilizador` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`utilizador_id`);

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_colecao` FOREIGN KEY (`colecoes_id`) REFERENCES `colecao` (`colecoes_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_colecao` FOREIGN KEY (`colecao_id`) REFERENCES `colecao` (`colecoes_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
