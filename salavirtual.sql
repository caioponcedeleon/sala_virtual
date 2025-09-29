-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 29 sep 2025 kl 09:53
-- Serverversion: 5.7.21
-- PHP-version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `salavirtual`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `acessos`
--

CREATE TABLE `acessos` (
  `id_acesso` int(11) NOT NULL,
  `token_acesso` text NOT NULL,
  `usuario_acesso` text NOT NULL,
  `data_acesso` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `apresenta`
--

CREATE TABLE `apresenta` (
  `id_apre` int(11) NOT NULL,
  `nom_apre` text NOT NULL,
  `token_apre` text NOT NULL,
  `desc_apre` text NOT NULL,
  `cria_apre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `apresenta`
--

INSERT INTO `apresenta` (`id_apre`, `nom_apre`, `token_apre`, `desc_apre`, `cria_apre`) VALUES
(1, 'Aula sueco 1', 'e929c94bb293a9935700ab25c30f19e6', 'Aula sueco 1 do dia 30/06/2020', '30/Jun/2020 16:49:10'),
(2, 'Reforço alemão - A1 (06/11)', '5675f75c3e12065e339567efc288ea15', 'Reforço alemão - A1 (06/11)', '06/Nov/2020 16:06:48');

-- --------------------------------------------------------

--
-- Tabellstruktur `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(200) NOT NULL,
  `lingua_curso` varchar(20) NOT NULL,
  `desc_curso` text NOT NULL,
  `token_curso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nome_curso`, `lingua_curso`, `desc_curso`, `token_curso`) VALUES
(1, 'Alemao A1', 'de', '', '8b4e94e250e4d5f1128b24c769a13ea4');

-- --------------------------------------------------------

--
-- Tabellstruktur `matriculas`
--

CREATE TABLE `matriculas` (
  `id_mat` int(11) NOT NULL,
  `usuario_mat` text NOT NULL,
  `curso_mat` text NOT NULL,
  `nivel_mat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `matriculas`
--

INSERT INTO `matriculas` (`id_mat`, `usuario_mat`, `curso_mat`, `nivel_mat`) VALUES
(1, 'e59a35225773e8ae0c50ac2c041208ab', '8b4e94e250e4d5f1128b24c769a13ea4', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `online`
--

CREATE TABLE `online` (
  `id_on` int(11) NOT NULL,
  `nome_on` varchar(200) NOT NULL,
  `sala_on` varchar(200) NOT NULL,
  `ultimo_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `online`
--

INSERT INTO `online` (`id_on`, `nome_on`, `sala_on`, `ultimo_on`) VALUES
(1, 'Caio Ponce de Leon', 'uvs6oh7s', '2020-11-11 19:19:39'),
(5, 'Test User', 'iie4gbhq', '2020-11-11 22:02:57');

-- --------------------------------------------------------

--
-- Tabellstruktur `respostas`
--

CREATE TABLE `respostas` (
  `id_resp` int(11) NOT NULL,
  `usu_resp` text NOT NULL,
  `apre_resp` text NOT NULL,
  `parte_resp` varchar(20) NOT NULL,
  `resp_resp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `sala`
--

CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL,
  `tok_sala` text NOT NULL,
  `apre_sala` text NOT NULL,
  `coman_sala` int(11) NOT NULL,
  `parte_sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `sala`
--

INSERT INTO `sala` (`id_sala`, `tok_sala`, `apre_sala`, `coman_sala`, `parte_sala`) VALUES
(1, 'uvs6oh7s', 'e929c94bb293a9935700ab25c30f19e6', 0, 2),
(2, 'uogutok5', '5675f75c3e12065e339567efc288ea15', 0, 1),
(3, 'ixn7mu2e', 'e929c94bb293a9935700ab25c30f19e6', 0, 1),
(4, 'iie4gbhq', 'e929c94bb293a9935700ab25c30f19e6', 1, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `transp`
--

CREATE TABLE `transp` (
  `id_tra` int(11) NOT NULL,
  `tit_tra` text NOT NULL,
  `tok_tra` text NOT NULL,
  `n_tra` int(11) NOT NULL,
  `tipo_tra` int(11) NOT NULL,
  `cont_tra` text NOT NULL,
  `toktra_tra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `transp`
--

INSERT INTO `transp` (`id_tra`, `tit_tra`, `tok_tra`, `n_tra`, `tipo_tra`, `cont_tra`, `toktra_tra`) VALUES
(2, 'Inicial', 'e929c94bb293a9935700ab25c30f19e6', 1, 1, '<div style=&quot;height:100%;width:100%;background-color:#0CF;top:0; padding:10px;&quot;><p align=&quot;center&quot;><font size=&quot;+2&quot; color=&quot;#FFFFFF&quot;><strong>SVENSKA - LEKTION 3</strong></font></p></div>', 'e9asd545asdbb293a9935700ab25c30f19e6'),
(3, 'exercicio 1', 'e929c94bb293a9935700ab25c30f19e6', 2, 2, '<div style=&quot;height:100%;width:100%;background-color:#0CF;top:0; padding:10px;&quot;>Complete o exercício abaixo§1§2§La lumière est |, sur le Porto-Vecchio<br />Les nuages et le |, ont tatoué ma peau<br />Je ne pars pas, je nage, dans le murmure des vagues<br />Et j&#39;ai laissé ton |, et mon cœur sur la plage, aah hah ah</div>§divine;spleen;nom', 'e92a91as322dsa9935700ab25c30f19e6');

-- --------------------------------------------------------

--
-- Tabellstruktur `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(11) NOT NULL,
  `nome_usu` varchar(200) NOT NULL,
  `email_usu` varchar(200) NOT NULL,
  `senha_usu` text NOT NULL,
  `token_usu` text NOT NULL,
  `turma_usu` text NOT NULL,
  `nivel_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `nome_usu`, `email_usu`, `senha_usu`, `token_usu`, `turma_usu`, `nivel_usu`) VALUES
(1, 'Caio Ponce de Leon', 'caioponcedeleon@gmail.com', '90c6962fe98eac25ac5eaeb9c0b0926b', 'e59a35225773e8ae0c50ac2c041208ab', '', 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id_acesso`);

--
-- Index för tabell `apresenta`
--
ALTER TABLE `apresenta`
  ADD PRIMARY KEY (`id_apre`);

--
-- Index för tabell `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Index för tabell `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_mat`);

--
-- Index för tabell `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id_on`);

--
-- Index för tabell `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id_resp`);

--
-- Index för tabell `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`);

--
-- Index för tabell `transp`
--
ALTER TABLE `transp`
  ADD PRIMARY KEY (`id_tra`);

--
-- Index för tabell `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id_acesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `apresenta`
--
ALTER TABLE `apresenta`
  MODIFY `id_apre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `online`
--
ALTER TABLE `online`
  MODIFY `id_on` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id_resp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `sala`
--
ALTER TABLE `sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `transp`
--
ALTER TABLE `transp`
  MODIFY `id_tra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
