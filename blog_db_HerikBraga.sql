-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Mar-2026 às 09:05
-- Versão do servidor: 8.4.7
-- versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dados: `blog_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `body`, `created`, `modified`) VALUES
(1, 1, 1, 'O que é CakePHP?', 'CakePHP é um framework PHP de código aberto que segue a arquitectura MVC. Facilita o desenvolvimento de aplicações web com menos código e de forma mais rápida.', '2026-03-11 11:42:21', NULL),
(2, 1, 2, 'Introdução ao MVC', 'O padrão MVC (Model-View-Controller) divide a aplicação em três camadas: o Model trata dos dados, a View apresenta a informação ao utilizador e o Controller gere a lógica.', '2026-03-11 11:42:21', NULL),
(3, 1, 3, 'Como instalar o CakePHP com Composer', 'Para instalar o CakePHP basta ter o Composer instalado e executar o comando: composer create-project --prefer-dist cakephp/app:4.* meu_projeto', '2026-03-11 11:42:21', NULL),
(4, 2, 3, 'Como fazer uma bomba', 'Passo 1: Arranja um Lugar Isolado\r\nVai pro meio do mato, longe de todo mundo. Leva um isqueiro e um extintor de incêndio (por via das dúvidas).\r\n\r\nPasso 2: Junta Materiais Inúteis\r\nPega açúcar e fermento. Mistura. Isso não explode, só faz uma bagunça doce.\r\n\r\nPasso 3: Adiciona \"Magia\"\r\nFecha os olhos e grita: \"DIONÍSIO, ME DÊ PODER!\" (não vai funcionar, ele não existe).\r\n\r\nPasso 4: Acende o Fósforo\r\nAcende e joga longe. Corre igual um desgraçado.\r\n\r\nResultado:\r\nNada acontece. Você só perdeu tempo, gastou dinheiro com açúcar e pareceu um idiota correndo no mato.', '2026-03-11 12:50:45', '2026-03-11 12:50:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Tecnologia', '2026-03-11 11:42:21', NULL),
(2, 'Programação', '2026-03-11 11:42:21', NULL),
(3, 'Tutoriais', '2026-03-11 11:42:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int UNSIGNED NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `author`, `body`, `created`, `modified`) VALUES
(1, 1, 'João Silva', 'Muito bom artigo! Ajudou bastante a perceber o CakePHP.', '2026-03-11 11:42:21', NULL),
(2, 2, 'Maria Costa', 'Explicação clara sobre MVC. Obrigada!', '2026-03-11 11:42:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `modified`) VALUES
(1, 'admin', 'admin@blog.pt', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '2026-03-11 11:42:21', NULL),
(2, 'Herik Braga', 'a32488@aemtg.pt', '$2y$10$HJ0pX1c6zYV/jsd3mXHfWuwYUpUGUHIBSNwCcF/IYDt84yUhQ1ySm', '2026-03-11 12:45:49', '2026-03-11 12:45:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
