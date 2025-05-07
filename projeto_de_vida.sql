-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/05/2025 às 20:30
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
-- Banco de dados: `projeto_de_vida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas`
--

CREATE TABLE `contas` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nome_inteiro` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_de_registro` datetime NOT NULL,
  `nome_arquivo_fotoperfil` varchar(255) DEFAULT NULL,
  `link_personalidade` varchar(255) NOT NULL,
  `genero` enum('Male','Female','Other','') NOT NULL,
  `aniversario` date DEFAULT NULL,
  `sobre_mim` text DEFAULT NULL,
  `pontos_fracos` text DEFAULT NULL,
  `pontos_fortes` text DEFAULT NULL,
  `profissao_atual` varchar(255) NOT NULL,
  `minhas_aspiracoes` varchar(255) NOT NULL,
  `meus_principais_objetivos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contas`
--

INSERT INTO `contas` (`id_user`, `username`, `nome_inteiro`, `email`, `password`, `data_de_registro`, `nome_arquivo_fotoperfil`, `link_personalidade`, `genero`, `aniversario`, `sobre_mim`, `pontos_fracos`, `pontos_fortes`, `profissao_atual`, `minhas_aspiracoes`, `meus_principais_objetivos`) VALUES
(21, 'T1NT4', 'Thiago Gabriel', 'T1NT4@gmail.com', '$2y$10$7WZF2ECGEu1H.gaO8olPM..wkHbhVhHC3NwA7vOGSRpXCMjB8Am3K', '2025-04-16 14:58:50', 'T1NT4.png', 'https://www.16personalities.com/br/resultados/isfp-t/m/csrswrcp', 'Male', '2007-05-15', 'asdfasdfasdf', NULL, NULL, '0', '0', '0'),
(22, 'Bernini', '', 'Bernini@bernini.org.br', '$2y$10$Dl5kGlKQ0mIGnKtQVzGG4ucGUqCJlitO4bOoLY7w5h3G.7jLQvZlq', '2025-04-16 17:55:05', 'Bernini.png', '', 'Male', '1988-03-24', '', NULL, NULL, '0', '0', '0'),
(23, 'Ana', 'Ana Luísa Vasconcelos Angelo Ribeiro', 'Ana@Ana.com', '$2y$10$H3dgsSBEL4Qyv42qCEuyvOGzhqGfbfhS3GHtvvWOgFHyu1O0J2TJa', '2025-04-30 18:37:37', 'Ana.png', 'https://www.16personalities.com/br/resultados/isfp-t/f/culyzwjd', 'Female', '2007-12-05', '', NULL, NULL, '', '', ''),
(27, 'Jon', 'Jonatas', 'Jo@Jo.natas', '$2y$10$VI/XCVr.vl7Y.jpogmDXZuORr/afYTlQbdPPVTtkRD6zoIV7J8y5G', '2025-05-07 15:23:29', NULL, 'https://www.16personalities.com/br/resultados/isfj-t/o/cum0s2q1', 'Other', '1908-01-15', NULL, '', NULL, '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
