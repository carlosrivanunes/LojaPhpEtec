-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Ago-2024 às 20:13
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
-- SET time_zone = "+00:00";


--
-- Banco de dados: `wda_crud`
--
CREATE DATABASE IF NOT EXISTS `wda_crud` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wda_crud`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `customers`
--

CREATE TABLE `customers` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(9) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customers`
--

INSERT INTO `customers` (`name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
('Fulano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Pilar do Sul', 'SP', '41 42241167', '15998474599', '143623456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
('Ciclano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 124', 'Internet', '12345678', 'Pilar do Sul', 'SP', '41 42241169', '15798474599', '143823456', '2016-05-24 00:00:00', '2016-05-24 00:00:00');

CREATE TABLE IF NOT EXISTS `clothes` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `descricao` varchar(50) NOT NULL,
    `quantidade` int NOT NULL,
    `precou` float NOT NULL,
    `tamanho` int NOT NULL,
    `img` varchar(30) NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL
);

INSERT INTO `clothes` (`id`, `descricao`, `quantidade`, `precou`, `tamanho`, `img`, `created`, `modified`) VALUES
(1,'Camisa da banda norueguesa Burzum', 10, 78.99, 20, 'camisa01.jpeg', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(2,'Camisa da banda norueguesa Mayhem', 6, 102.90, 20, 'camisa02.jpeg', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(3,'Camisa da banda sueca Bathory', 3, 135.50, 20, 'camisa03.jpeg', '2016-05-24 00:00:00', '2016-05-24 00:00:00');

CREATE TABLE usuarios(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    nome varchar(50) not null,
    user varchar(50) not null,
    pass varchar(100) not null,
    foto varchar(50)
);

INSERT INTO `usuarios`(`nome`, `user`, `pass`) 
VALUES ('Zé Lele','zelele','5243897562837456982'),
('Mary Zica','mazi','786098767869'),
('Fugiru Nakombi','fugina','623485634753234');

COMMIT;