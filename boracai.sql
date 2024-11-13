-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/10/2024 às 12:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `boracai`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicionais`
--

CREATE TABLE `adicionais` (
  `id_adicional` int(11) NOT NULL,
  `nome_adicional` varchar(100) NOT NULL,
  `valor_adicional` varchar(100) NOT NULL,
  `status_adicional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `brigadeiro`
--

CREATE TABLE `brigadeiro` (
  `id_brigadeiro` int(11) NOT NULL,
  `nome_brigadeiro` varchar(100) NOT NULL,
  `statusbrigadeiro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id_itens` int(11) NOT NULL,
  `nome_itens` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id_itens`, `nome_itens`) VALUES
(1, 'Açai'),
(2, 'Bolo de pote'),
(3, 'Torta'),
(4, 'Alfajor'),
(5, 'Brigadeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `numeropedido`
--

CREATE TABLE `numeropedido` (
  `id` int(11) NOT NULL,
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `numeropedido` int(11) NOT NULL,
  `nomeproduto` varchar(100) NOT NULL,
  `adicionais` varchar(200) NOT NULL,
  `pagamento` varchar(100) NOT NULL,
  `valortotal` varchar(100) NOT NULL,
  `taxaentrega` varchar(100) NOT NULL,
  `responsavel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome_pessoa` varchar(100) NOT NULL,
  `senha_pessoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome_pessoa`, `senha_pessoa`) VALUES
(1, 'gabriel', '$2y$10$PvND.iwL/uvnEpaT.opO7.iz/7bcNliqhVTc0djl0DP2Sqc9T3lQi'),
(2, 'larissa', '$2y$10$88aWUA40iqbf6ckb9swDK.mSljNGScq7HySzeuHT3d1BJchC5WtaC'),
(3, 'alan', '$2y$10$EpGQgRDZF9pG/c/NNgKFr.Lg/zI5f08QBxnnL7eqmFulxGZbsZ.eK');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` int(11) NOT NULL,
  `sabor` int(11) NOT NULL,
  `tamanho` int(11) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `sabor`, `tamanho`, `valor`, `status`) VALUES
(1, 1, 0, 300, '0.00', 0),
(2, 1, 0, 500, '0.00', 0),
(3, 1, 0, 700, '0.00', 0),
(4, 5, 0, 4, '0.00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `saborgeral`
--

CREATE TABLE `saborgeral` (
  `id_geral` int(11) NOT NULL,
  `nome_sabor` varchar(100) NOT NULL,
  `statusgeral` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `saborgeral`
--

INSERT INTO `saborgeral` (`id_geral`, `nome_sabor`, `statusgeral`) VALUES
(0, 'nada', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD PRIMARY KEY (`id_adicional`);

--
-- Índices de tabela `brigadeiro`
--
ALTER TABLE `brigadeiro`
  ADD PRIMARY KEY (`id_brigadeiro`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id_itens`);

--
-- Índices de tabela `numeropedido`
--
ALTER TABLE `numeropedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `produto_ibfk_1` (`nome_produto`),
  ADD KEY `sabor2` (`sabor`);

--
-- Índices de tabela `saborgeral`
--
ALTER TABLE `saborgeral`
  ADD PRIMARY KEY (`id_geral`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicionais`
--
ALTER TABLE `adicionais`
  MODIFY `id_adicional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `brigadeiro`
--
ALTER TABLE `brigadeiro`
  MODIFY `id_brigadeiro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_itens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `numeropedido`
--
ALTER TABLE `numeropedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `saborgeral`
--
ALTER TABLE `saborgeral`
  MODIFY `id_geral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`nome_produto`) REFERENCES `itens` (`id_itens`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`sabor`) REFERENCES `saborgeral` (`id_geral`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
