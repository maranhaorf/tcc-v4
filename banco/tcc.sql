-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Set-2022 às 02:28
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produto` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `quantidade` double NOT NULL,
  `estoque_minimo` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `id_produto`, `id_usuario`, `quantidade`, `estoque_minimo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 5, 2, 0, 1, NULL, '2021-12-04 10:55:10', '2021-12-11 04:53:34'),
(11, 6, 2, 100, 1, NULL, '2021-12-11 02:34:26', '2022-02-12 13:18:58'),
(12, 7, 2, 5, 1, NULL, '2021-12-11 02:34:33', '2022-02-12 13:17:06'),
(13, 8, 5, 1, 3, NULL, '2021-12-11 20:09:58', '2021-12-11 20:10:43'),
(14, 10, 5, 1, 1, NULL, '2021-12-13 12:34:56', '2021-12-15 15:49:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `cnpj`, `endereco`, `created_at`, `updated_at`) VALUES
(1, 'Aluminio da jpdd', '63.765.287/0001-60', 'teste2222', NULL, '2021-11-13 21:29:54'),
(2, 'teste 1', '26.804.342/0001-58', 'teste 1', '2021-11-13 14:28:00', '2021-11-13 14:28:00'),
(4, 'teste 2', '90.426.506/0001-50', 'aaaaaateste 2', '2021-11-13 14:35:11', '2021-11-13 14:35:11'),
(5, 'teste 3', '97.601.557/0001-10', '49259-222teste 3', '2021-11-13 14:35:25', '2021-11-13 14:35:25'),
(6, 'teste 4', '61.505.855/0001-69', 'teste 4', '2021-11-13 14:37:47', '2021-11-13 14:37:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produto` bigint(20) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pedido` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`id`, `id_produto`, `quantidade`, `preco`, `created_at`, `updated_at`, `id_pedido`) VALUES
(20, 5, 1, '2555', '2021-12-11 02:38:45', '2021-12-11 02:38:45', 14),
(21, 6, 1, '2', '2021-12-11 02:38:50', '2021-12-11 02:38:50', 7),
(22, 7, 1, '2.01', '2021-12-11 02:38:55', '2021-12-11 02:38:55', 7),
(23, 5, 1, '0.02', '2021-12-11 04:29:09', '2021-12-11 04:29:09', 9),
(24, 6, 1, '2', '2021-12-11 04:29:13', '2021-12-11 04:29:13', 9),
(25, 7, 1, '2.01', '2021-12-11 04:29:18', '2021-12-11 04:29:18', 9),
(26, 5, 2, '0.04', '2021-12-11 04:53:34', '2021-12-11 04:53:34', 10),
(27, 6, 1, '2', '2021-12-11 04:53:42', '2021-12-11 04:53:42', 10),
(28, 7, 1, '2.01', '2021-12-11 04:53:46', '2021-12-11 04:53:46', 10),
(29, 8, 68, '272000', '2021-12-11 20:10:43', '2021-12-11 20:10:43', 11),
(30, 10, 2, '4', '2021-12-13 12:36:04', '2021-12-13 12:37:41', 12),
(32, 6, 6, '12', '2021-12-13 12:37:33', '2021-12-13 12:37:33', 12),
(35, 10, 1, '23.66', '2021-12-15 15:49:43', '2021-12-15 15:49:43', 15),
(36, 7, 1, '2.01', '2022-02-12 11:19:48', '2022-02-12 11:19:48', 16),
(37, 7, 1, '2.01', '2022-02-12 13:17:06', '2022-02-12 13:17:06', 17),
(38, 6, 100, '200', '2022-02-12 13:18:58', '2022-02-12 13:18:58', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2021_09_06_000000_create_perfil_table', 1),
(3, '2021_09_06_000001_create_users_table', 1),
(4, '2021_09_06_150004_create_fornecedors_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2019_08_19_000000_create_failed_jobs_table', 2),
(13, '2021_11_27_090839_createprodutos', 3),
(15, '2021_11_30_123242_createestoque', 4),
(16, '2021_12_04_081251_create_pedido_table', 5),
(17, '2021_12_06_165706_create_item_pedido_table', 6),
(18, '2021_12_10_224608_add_paid_to_users_table', 7),
(20, '2022_01_15_104656_create_solicitacao_orcamento', 8),
(21, '2022_01_20_094142_create_orcamento_pedido', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_pedido`
--

CREATE TABLE `orcamento_pedido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produto` bigint(20) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_orcamento` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `orcamento_pedido`
--

INSERT INTO `orcamento_pedido` (`id`, `id_produto`, `quantidade`, `preco`, `id_orcamento`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2', 13, '2022-01-20 13:46:14', '2022-01-20 13:46:14'),
(2, 8, 1, '4000', 13, '2022-01-20 13:46:23', '2022-01-20 13:46:23'),
(3, 5, 1, '0.02', 13, '2022-01-20 13:46:28', '2022-01-20 13:46:28'),
(4, 10, 1, '23.66', 13, '2022-01-20 13:46:54', '2022-01-20 13:46:54'),
(5, 10, 1, '23.66', 13, '2022-01-20 14:20:12', '2022-01-20 14:20:12'),
(6, 7, 0, '', 14, '2022-01-21 13:20:59', '2022-01-21 13:35:41'),
(8, 7, 6, '12.059999999999999', 15, '2022-01-21 13:47:13', '2022-01-21 13:47:13'),
(10, 5, 1, '0.02', 15, '2022-01-21 15:00:34', '2022-01-21 15:00:34'),
(11, 5, 1, '0.02', 10, '2022-01-21 15:09:39', '2022-01-21 15:09:39'),
(12, 6, 1, '2', 17, '2022-01-21 15:16:25', '2022-01-21 15:16:25'),
(13, 8, 1, '4000', 17, '2022-01-21 15:16:29', '2022-01-21 15:16:29'),
(14, 6, 1, '2', 18, '2022-01-21 15:19:22', '2022-01-21 15:19:22'),
(15, 10, 1, '23.66', 18, '2022-01-21 15:19:27', '2022-01-21 15:19:27'),
(16, 10, 1, '23.66', 19, '2022-01-21 15:20:54', '2022-01-21 15:20:54'),
(17, 6, 1, '2', 19, '2022-01-21 15:21:03', '2022-01-21 15:21:03'),
(18, 10, 1, '23.66', 20, '2022-01-21 15:24:21', '2022-01-21 15:24:21'),
(19, 6, 1, '2', 21, '2022-01-21 15:28:05', '2022-01-21 15:28:05'),
(20, 10, 1, '23.66', 21, '2022-01-21 15:28:09', '2022-01-21 15:28:09'),
(21, 5, 1, '0.02', 21, '2022-01-21 15:28:13', '2022-01-21 15:28:13'),
(22, 5, 1, '0.02', 22, '2022-01-21 15:35:51', '2022-01-21 15:35:51'),
(23, 8, 1, '4000', 22, '2022-01-21 15:35:56', '2022-01-21 15:35:56'),
(24, 5, 1, '0.02', 23, '2022-01-21 15:39:01', '2022-01-21 15:39:01'),
(25, 6, 1, '2', 23, '2022-01-21 15:39:06', '2022-01-21 15:39:06'),
(26, 7, 6, '12.059999999999999', 23, '2022-01-21 15:39:12', '2022-01-21 15:39:12'),
(27, 8, 1, '4000', 23, '2022-01-21 15:39:19', '2022-01-21 15:39:19'),
(28, 10, 1, '23.66', 23, '2022-01-21 15:39:24', '2022-01-21 15:39:24'),
(29, 6, 1, '2', 24, '2022-01-21 15:54:44', '2022-01-21 15:54:44'),
(30, 10, 1, '23.66', 25, '2022-07-07 14:08:38', '2022-07-07 14:08:38'),
(31, 5, 1, '0.02', 25, '2022-07-07 14:08:46', '2022-07-07 14:08:46'),
(32, 7, 4, '8.04', 25, '2022-07-07 14:08:54', '2022-07-07 14:08:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Criado',
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `nome_cliente`, `cpf_cliente`, `telefone_cliente`, `status`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'davidson', '78.501.477/0001-48', '6198642187', 'Excluido', 9, NULL, '2021-12-11 02:30:43'),
(2, 'francisco', '11111111111', '611869418', 'Excluido', 2, '2021-12-04 13:36:35', '2021-12-06 19:34:39'),
(3, 'carlos22', '66666666', '067647848a4', 'Excluido', 2, '2021-12-06 19:20:52', '2021-12-06 19:33:26'),
(4, 'teste', 'teste', 'teste', 'Excluido', 2, '2021-12-10 23:25:13', '2021-12-11 02:33:24'),
(5, 'teste', 'teste', 'teste', 'Excluido', 2, '2021-12-11 02:34:54', '2021-12-11 02:37:39'),
(6, 'teste2', 'teste2', 'teste2', 'Excluido', 2, '2021-12-11 02:35:03', '2021-12-11 02:38:23'),
(7, 'teste', 'teste', 'teste', 'Concluido', 5, '2021-12-11 02:38:38', '2021-12-11 04:51:28'),
(8, 'TESTE', 'TESTE', 'TESTE', 'Excluido', 2, '2021-12-11 03:20:34', '2021-12-11 04:28:38'),
(9, 'teste', 'teste', 'teste', 'Concluido', 9, '2021-12-11 04:28:59', '2021-12-11 04:51:35'),
(10, 'tese', 'teste', 'teste', 'Concluido', 9, '2021-12-11 04:53:22', '2021-12-11 04:54:01'),
(11, 'gabriel', '111111111', '61896448524', 'Concluido', 9, '2021-12-11 20:10:23', '2022-02-12 11:03:31'),
(12, 'norton junior', '84595632156', '6189651456', 'Concluido', 5, '2021-12-13 12:35:33', '2021-12-13 12:38:16'),
(13, 'rafael 32', '9563215475', '6198652145', 'Concluido', 5, '2021-12-13 12:36:32', '2021-12-13 12:37:11'),
(14, 'jp', '06585214566', '6189651456', 'Concluido', 5, '2021-12-15 15:44:45', '2021-12-15 15:49:06'),
(15, 'rafael 32', '84595632156', '6189651456', 'Finalizado', 5, '2021-12-15 15:49:35', '2022-02-12 13:36:58'),
(16, 'norton', '84595632156', '6189651456', 'Concluido', 5, '2022-01-06 13:41:46', '2022-02-12 11:20:14'),
(17, 'filipé', '067868665203', '6186642187', 'Concluido', 5, '2022-02-12 13:16:38', '2022-02-12 13:17:18'),
(18, 'norton', '84595632156', '6186642187', 'Concluido', 10, '2022-02-12 13:18:35', '2022-02-12 13:19:12'),
(19, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', '6186642187', 'Criado', 2, '2022-03-18 12:28:49', '2022-03-18 12:28:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `name`, `descricao`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'teste', NULL, NULL, NULL),
(2, 'gerente', 'dono da empresa', NULL, NULL, NULL),
(3, 'Atendente', 'atende as pessoas ', NULL, NULL, NULL),
(4, 'estoquista', 'estoca as coisas', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` double NOT NULL,
  `id_fornecedor` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Cadastrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `tamanho`, `descricao`, `cor`, `valor`, `id_fornecedor`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(5, 'ferro 4/9', '167 cm', 'vale 1 real', 'azuls', 0.02, 1, NULL, '2021-11-28 12:31:34', '2021-12-04 11:04:58', 'Estoque'),
(6, 'barra de aluminio', '1cm', 'teste', '12', 2, 5, NULL, '2021-12-11 02:33:51', '2021-12-11 02:34:26', 'Estoque'),
(7, 'boracha', '12cm', 'teste2', '12', 2.01, 2, NULL, '2021-12-11 02:34:06', '2021-12-11 02:34:33', 'Estoque'),
(8, 'retangulo de aluminio', '20', 'BKT LUIZ', 'AZUL', 4000, 5, NULL, '2021-12-11 20:09:22', '2021-12-11 20:09:58', 'Estoque'),
(10, 'jimo', '50 cm', 'é muito bom', 'prata', 23.66, 6, NULL, '2021-12-13 12:34:15', '2021-12-13 12:34:56', 'Estoque');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_orcamento`
--

CREATE TABLE `solicitacao_orcamento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Criado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `solicitacao_orcamento`
--

INSERT INTO `solicitacao_orcamento` (`id`, `nome_cliente`, `cpf_cliente`, `email_cliente`, `telefone_cliente`, `status`, `created_at`, `updated_at`) VALUES
(1, 'teste', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:47:20', '2022-01-15 15:47:20'),
(2, 'teste', '84595632156', 'Davidsoncarlos56@gmail.com', '1669995552', 'Criado', '2022-01-15 15:52:26', '2022-01-15 15:52:26'),
(3, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:53:14', '2022-01-15 15:53:14'),
(4, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:53:21', '2022-01-15 15:53:21'),
(5, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:54:07', '2022-01-15 15:54:07'),
(6, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:56:26', '2022-01-15 15:56:26'),
(7, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '1111', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:56:33', '2022-01-15 15:56:33'),
(8, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '1111', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 15:56:43', '2022-01-15 15:56:43'),
(9, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-15 16:09:29', '2022-01-15 16:09:29'),
(10, 'joaoo  apap', '067868665203', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-17 21:39:17', '2022-01-21 15:12:16'),
(11, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-17 21:42:59', '2022-01-17 21:42:59'),
(12, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-20 12:19:24', '2022-01-20 12:19:24'),
(13, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-20 12:28:38', '2022-01-21 15:33:02'),
(14, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '067868665203', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 13:20:54', '2022-01-21 15:08:56'),
(15, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '067868665203', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 13:36:57', '2022-01-21 15:03:14'),
(16, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '222222222222', 'Davidsoncarlos56@gmail.com', '6186642187', 'Criado', '2022-01-21 15:12:38', '2022-01-21 15:12:38'),
(17, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '2222', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:13:01', '2022-01-21 15:16:34'),
(18, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '22121212', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:19:17', '2022-01-21 15:19:29'),
(19, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:20:47', '2022-01-21 15:21:05'),
(20, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:24:17', '2022-01-21 15:27:31'),
(21, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:27:59', '2022-01-21 15:28:15'),
(22, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:35:47', '2022-01-21 15:38:27'),
(23, 'rafael 32', '11111111', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:38:56', '2022-01-21 15:49:24'),
(24, 'DAVIDSON CARLOS DA ROCHA FERREIRA', '84595632156', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-01-21 15:54:40', '2022-01-21 15:54:46'),
(25, 'Felipe', '3333333333', 'Davidsoncarlos56@gmail.com', '6186642187', 'Finalizado', '2022-07-07 14:08:28', '2022-07-07 14:09:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perfil` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `usuario`, `password`, `id_perfil`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'DAVIDSON ROCHA2', 'teste12', '$2y$10$DvFKsGwS.9EudgwO8uRmZul5A/alkpNvNJZLKj.450JJ0HGZ3y.4a', 1, NULL, 'pdaWdieIwYNmwhl3EzTRr2h9sXsxiLHThYnDK2s9rhdl8KAPQNxDuBaa5Clf', '2021-11-09 20:29:19', '2021-12-11 13:28:33'),
(5, 'DAVIDSOs', 'teste', '$2y$10$DQAFZMWZjq4AWXY0iE0e7eI97FDJ2oNSeqonHT5EcVSe5YFVtueKO', 1, NULL, 'stPPJ1MQjgiI8ySCV2E6OcgKQhI6n13Nv5yXDSeUQqb0k2UhBLVWT0fYBtBb', '2021-12-11 13:27:09', '2021-12-11 13:28:43'),
(9, 'rafael', 'rafael', '$2y$10$I40G3Sqs01VVtrX0opQb9OgsN5Q7Vi/SciUVe1FxI24gv8Fm1bTAG', 1, NULL, NULL, '2021-12-13 12:32:48', '2021-12-13 12:32:48'),
(10, 'davidson', 'davidson', '$2y$10$1rdlnPuAtXdWpLKCWhPrWOpmNWRYxm/p4PMFhSdCDmW//mUBa8IpG', 1, NULL, NULL, '2022-02-12 13:17:52', '2022-02-12 13:17:52');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estoque_id_produto_unique` (`id_produto`),
  ADD KEY `estoque_id_usuario_foreign` (`id_usuario`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_pedido_id_produto_foreign` (`id_produto`),
  ADD KEY `item_pedido_id_pedido_foreign` (`id_pedido`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orcamento_pedido`
--
ALTER TABLE `orcamento_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orcamento_pedido_id_produto_foreign` (`id_produto`),
  ADD KEY `orcamento_pedido_id_orcamento_foreign` (`id_orcamento`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id_usuario_foreign` (`id_usuario`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id_fornecedor_foreign` (`id_fornecedor`);

--
-- Índices para tabela `solicitacao_orcamento`
--
ALTER TABLE `solicitacao_orcamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_perfil_foreign` (`id_perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `orcamento_pedido`
--
ALTER TABLE `orcamento_pedido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `solicitacao_orcamento`
--
ALTER TABLE `solicitacao_orcamento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  ADD CONSTRAINT `estoque_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_id_pedido_foreign` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `item_pedido_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `orcamento_pedido`
--
ALTER TABLE `orcamento_pedido`
  ADD CONSTRAINT `orcamento_pedido_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `solicitacao_orcamento` (`id`),
  ADD CONSTRAINT `orcamento_pedido_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_id_fornecedor_foreign` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_perfil_foreign` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
