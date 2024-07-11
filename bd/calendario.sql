-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Fev-2024 às 14:01
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `calendario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(20) NOT NULL,
  `titulo_evento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_evento` date NOT NULL,
  `horario_evento` time(6) DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `titulo_evento`, `data_evento`, `horario_evento`, `descricao`) VALUES
(1, 'Culto Administrativo', '2024-02-28', '19:30:00.000000', 'Culto de oração e assembléia regular.'),
(5, 'Nota (culto administrativo)', '2024-02-28', '19:30:00.000000', ' Colocar o seminário da amanda na pauta da assembléia. Lembrar de fazer carta de recomendação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pregacoes`
--

CREATE TABLE `pregacoes` (
  `id` int(11) NOT NULL,
  `titulo_pregacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_pregacao` date NOT NULL,
  `horario_pregacao` time DEFAULT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pregacoes`
--

INSERT INTO `pregacoes` (`id`, `titulo_pregacao`, `data_pregacao`, `horario_pregacao`, `conteudo`) VALUES
(1, 'Coroa de Glória', '2024-02-18', '10:00:00', '“Venho sem demora; guarda o que tens, para que ninguém tome a tua coroa”. Ap 3:11\r\nSérie as três coroas.'),
(2, 'Caminhada Cristã', '2024-02-18', '19:00:00', '1 Ts 4:1-12 - três maneiras segundo as quais o cristão deve andar: Andar em santidade (1 Ts 4:1-8); Andar em Amor fraternal (1 Ts 4:9, 10); Andar em dignidade (1 Ts 4:11, 12 ).'),
(4, 'Estudo Lucas 2 (8 a 20)', '2024-02-21', '19:30:00', 'Estudo bíblico visão harmonica dos evangelhos. Testemunho dos pastores (Lc 2:8-20)'),
(5, 'Culto Jovens e Adolescentes', '2024-02-25', '19:00:00', 'Culto de jovens e adolescentes - pregador: Carol');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pregacoes`
--
ALTER TABLE `pregacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `pregacoes`
--
ALTER TABLE `pregacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
