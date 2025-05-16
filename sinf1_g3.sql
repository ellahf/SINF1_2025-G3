-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Maio-2025 às 16:20
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
  `imagem` longblob NOT NULL,
  `utilizador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `imagem` longblob NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `colecao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `data` date NOT NULL,
  `data_aquisicao` date NOT NULL,
  `imagem` longblob NOT NULL,
  `utilizador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `utilizador_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`utilizador_id`, `nome`, `data_nascimento`, `email`, `password`) VALUES
(1, 'liah', '2006-07-04', 'liah@gmail.com', '$2y$10$wtGpNM5v'),
(2, 'ellah', '2003-02-19', 'ellah@gmail.com', '$2y$10$59Be7MTw'),
(3, 'joao', '1998-07-28', 'joao@gmail.com', '$2y$10$3IRVtcn2');

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
  ADD PRIMARY KEY (`colecoes_id`),
  ADD KEY `fk_colecao_utilizador` (`utilizador_id`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`evento_id`),
  ADD KEY `fk_evento_utilizador` (`utilizador_id`),
  ADD KEY `fk_evento_colecao` (`colecao_id`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_item_utilizador` (`utilizador_id`),
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
  MODIFY `colecoes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `evento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `utilizador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Limitadores para a tabela `colecao`
--
ALTER TABLE `colecao`
  ADD CONSTRAINT `fk_colecao_utilizador` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`utilizador_id`);

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_colecao` FOREIGN KEY (`colecao_id`) REFERENCES `evento` (`evento_id`),
  ADD CONSTRAINT `fk_evento_utilizador` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`utilizador_id`);

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_colecao` FOREIGN KEY (`colecao_id`) REFERENCES `colecao` (`colecoes_id`),
  ADD CONSTRAINT `fk_item_utilizador` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`utilizador_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
