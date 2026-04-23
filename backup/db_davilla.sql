-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/04/2026 às 13:10
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
-- Banco de dados: `db_davilla`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id_banner` int(11) NOT NULL,
  `nome_banner` varchar(30) NOT NULL,
  `foto_banner` varchar(50) NOT NULL,
  `status_banner` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_banner`
--

INSERT INTO `tbl_banner` (`id_banner`, `nome_banner`, `foto_banner`, `status_banner`) VALUES
(1, 'Vitrine de Páscoa', 'banner/vitrine-de-pascoa.png', 'ATIVO'),
(2, 'Bolos Sob Encomenda', 'banner/bolos-sob-encomenda.png', 'ATIVO'),
(3, 'Café da Tarde', 'banner/cafe-da-tarde.png', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(30) NOT NULL,
  `descricao_categoria` text NOT NULL,
  `criado_em_categoria` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_categoria` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nome_categoria`, `descricao_categoria`, `criado_em_categoria`, `atualizado_em_categoria`) VALUES
(1, 'Bolos', 'Bolos de vitrine e sob encomenda.', '2026-03-05 09:53:45', '2026-03-05 09:53:45'),
(2, 'Doces', 'Brigadeiros, trufas e doces finos.', '2026-03-05 09:55:10', '2026-03-05 09:55:10'),
(3, 'Bebidas Quentes', 'Café, capuccino e chás.', '2026-03-05 09:57:57', '2026-03-05 09:57:57'),
(4, 'Tortas', 'Tortas doces vendidas por fatia ou inteira', '2026-03-12 09:38:56', '2026-03-12 09:38:56'),
(5, 'Kits Presente', 'Kits especiais para presentear', '2026-03-12 09:38:56', '2026-03-12 09:38:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(50) NOT NULL,
  `tipo_cliente` varchar(2) NOT NULL,
  `cpf_cnpj_cliente` varchar(18) NOT NULL,
  `data_nasc_cliente` date NOT NULL,
  `endereco_cliente` varchar(40) NOT NULL,
  `numero_cliente` varchar(6) NOT NULL,
  `complemento_cliente` varchar(50) DEFAULT NULL,
  `bairro_cliente` varchar(40) NOT NULL,
  `cidade_cliente` varchar(40) NOT NULL,
  `uf_cliente` varchar(2) NOT NULL,
  `cep_cliente` varchar(9) NOT NULL,
  `email_cliente` varchar(80) NOT NULL,
  `senha_cliente` varchar(255) NOT NULL,
  `telefone_cliente` varchar(14) NOT NULL,
  `foto_cliente` varchar(60) NOT NULL,
  `status_cliente` varchar(10) NOT NULL DEFAULT 'ATIVO',
  `criado_em_cliente` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_cliente` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`id_cliente`, `nome_cliente`, `tipo_cliente`, `cpf_cnpj_cliente`, `data_nasc_cliente`, `endereco_cliente`, `numero_cliente`, `complemento_cliente`, `bairro_cliente`, `cidade_cliente`, `uf_cliente`, `cep_cliente`, `email_cliente`, `senha_cliente`, `telefone_cliente`, `foto_cliente`, `status_cliente`, `criado_em_cliente`, `atualizado_em_cliente`) VALUES
(1, 'Fernanda Oliveira', 'PF', '123.456.789-10', '1992-07-18', 'Rua Doce Mel', '85', 'Casa A', 'Vila Maria', 'São Paulo', 'SP', '02010-000', 'fernanda.oli@gmail.com', 'senha123', '(11)98765-8521', 'cliente/fernanda-oliveira.png', 'ATIVO', '2026-03-10 09:44:54', '2026-03-10 09:44:54'),
(2, 'Amanda Souza', 'PF', '12345678901', '1995-04-12', 'Rua das Flores', '120', 'Casa', 'Centro', 'São Paulo', 'SP', '01010000', 'amanda@gmail.com', '123456', '11988887777', 'cliente/amanda-souza.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(3, 'Bruno Lima', 'PF', '23456789012', '1992-08-21', 'Av. Paulista', '850', 'Apto 45', 'Bela Vista', 'São Paulo', 'SP', '01310000', 'bruno@gmail.com', '123456', '11997776666', 'cliente/bruno-lima.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(4, 'Camila Ferreira', 'PF', '34567890123', '1998-02-10', 'Rua do Açúcar', '56', 'Casa', 'Mooca', 'São Paulo', 'SP', '03120000', 'camila@gmail.com', '123456', '11996665555', 'cliente/camila-ferreira.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(5, 'Diego Martins', 'PF', '45678901234', '1989-11-03', 'Rua do Café', '210', 'Casa', 'Tatuapé', 'São Paulo', 'SP', '03333000', 'diego@gmail.com', '123456', '11995554444', 'cliente/diego-martins.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(6, 'Elaine Rocha', 'PF', '56789012345', '1990-06-17', 'Rua Brigadeiro', '98', 'Apto 12', 'Santana', 'São Paulo', 'SP', '02020000', 'elaine@gmail.com', '123456', '11994443333', 'cliente/elaine-rocha.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(7, 'Felipe Nunes', 'PF', '67890123456', '1987-09-25', 'Rua das Palmeiras', '333', 'Casa', 'Penha', 'São Paulo', 'SP', '03654000', 'felipe@gmail.com', '123456', '11993332222', 'cliente/felipe-nunes.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(8, 'Gabriela Costa', 'PF', '78901234567', '1996-03-09', 'Av. Celso Garcia', '741', 'Apto 67', 'Brás', 'São Paulo', 'SP', '03015000', 'gabriela@gmail.com', '123456', '11992221111', 'cliente/gabriela-costa.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(9, 'Henrique Alves', 'PF', '89012345678', '1993-12-01', 'Rua dos Sonhos', '150', 'Casa', 'Ipiranga', 'São Paulo', 'SP', '04210000', 'henrique@gmail.com', '123456', '11991110000', 'cliente/henrique-alves.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20'),
(10, 'Festa Feliz Eventos', 'PJ', '12345678000190', '2005-01-01', 'Rua dos Eventos', '500', 'Sala 3', 'Vila Mariana', 'São Paulo', 'SP', '04110000', 'contato@festafeliz.com.br', '123456', '1133334444', 'cliente/festa-feliz-eventos.png', 'ATIVO', '2026-03-12 10:07:20', '2026-03-12 10:08:25'),
(11, 'Cafeteria Central', 'PJ', '98765432000198', '2010-05-15', 'Av. Central', '1000', 'Loja 2', 'República', 'São Paulo', 'SP', '01045000', 'compras@cafecentral.com.br', '123456', '1132221111', 'cliente/cafeteria-central.png', 'INATIVO', '2026-03-12 10:07:20', '2026-03-12 10:07:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_contato`
--

CREATE TABLE `tbl_contato` (
  `id_contato` int(11) NOT NULL,
  `nome_contato` varchar(50) NOT NULL,
  `email_contato` varchar(80) NOT NULL,
  `telefone_contato` varchar(14) NOT NULL,
  `assunto_contato` varchar(30) NOT NULL,
  `mensagem_contato` text NOT NULL,
  `status_contato` varchar(10) NOT NULL DEFAULT 'ENVIADO',
  `criado_em_contato` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_contato` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_contato`
--

INSERT INTO `tbl_contato` (`id_contato`, `nome_contato`, `email_contato`, `telefone_contato`, `assunto_contato`, `mensagem_contato`, `status_contato`, `criado_em_contato`, `atualizado_em_contato`) VALUES
(1, 'Juliana Rocha', 'juliana.r@gmail.com', '(11)98888-1111', 'Encomenda', 'Quero um bolo de 20kg para um chá de bebê', 'ENVIADO', '2026-03-05 09:37:36', '2026-03-05 09:37:36'),
(2, 'Pedro Martins', 'pedro.m@gmail.com', '(11)97777-2222', 'Cardápio', 'Vocês tem opção sem lactose?', 'ENVIADO', '2026-03-05 09:40:51', '2026-03-05 09:40:51'),
(3, 'Carla Nunes', 'carla.n@gmail.com', '(11)96666-3333', 'Pagamento', 'Consigo pagar via PIX na entrega?', 'ENVIADO', '2026-03-05 09:42:34', '2026-03-05 09:42:34'),
(4, 'Juliana Rocha', 'juliana@gmail.com', '11988881111', 'Encomenda', 'Gostaria de encomendar um bolo para 20 pessoas.', 'ENVIADO', '2026-03-12 10:09:34', '2026-03-12 10:09:34'),
(5, 'Pedro Martins', 'pedro@gmail.com', '11987772222', 'Cardápio', 'Vocês fazem bolo sem lactose?', 'ENVIADO', '2026-03-12 10:09:34', '2026-03-12 10:09:34'),
(6, 'Carla Nunes', 'carla@gmail.com', '11986663333', 'Pagamento', 'Aceitam Pix e cartão na retirada?', 'LIDO', '2026-03-12 10:09:34', '2026-03-12 10:09:34'),
(7, 'Lucas Almeida', 'lucas@gmail.com', '11985554444', 'Orçamento', 'Qual valor de 100 brigadeiros gourmet?', 'RESPONDIDO', '2026-03-12 10:09:34', '2026-03-12 10:09:34'),
(8, 'Renata Silva', 'renata@gmail.com', '11984445555', 'Entrega', 'Vocês entregam no bairro da Mooca?', 'ENVIADO', '2026-03-12 10:09:34', '2026-03-12 10:09:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_controle_materia_prima`
--

CREATE TABLE `tbl_controle_materia_prima` (
  `id_controle` int(11) NOT NULL,
  `id_materia_prima` int(11) NOT NULL,
  `tipo_controle` varchar(7) NOT NULL,
  `qtde_controle` double(10,3) NOT NULL,
  `data_controle` datetime NOT NULL DEFAULT current_timestamp(),
  `obs_controle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_controle_materia_prima`
--

INSERT INTO `tbl_controle_materia_prima` (`id_controle`, `id_materia_prima`, `tipo_controle`, `qtde_controle`, `data_controle`, `obs_controle`) VALUES
(1, 1, 'ENTRADA', 10.000, '2026-03-17 08:20:36', 'Compra semanal de farinha'),
(2, 2, 'ENTRADA', 8.000, '2026-03-17 08:20:36', 'Reposição de açúcar refinado'),
(3, 3, 'SAIDA', 2.500, '2026-03-17 08:20:36', 'Produção de ovos de Páscoa'),
(4, 4, 'SAIDA', 12.000, '2026-03-17 08:20:36', 'Produção de brigadeiros'),
(5, 5, 'SAIDA', 8.000, '2026-03-17 08:20:36', 'Produção de recheios'),
(6, 6, 'ENTRADA', 5.000, '2026-03-17 08:20:36', 'Compra de morangos frescos'),
(7, 7, 'SAIDA', 30.000, '2026-03-17 08:20:36', 'Produção de bolos e tortas'),
(8, 8, 'SAIDA', 1.500, '2026-03-17 08:20:36', 'Consumo no preparo de cafés'),
(9, 9, 'ENTRADA', 20.000, '2026-03-17 08:20:36', 'Compra de embalagens'),
(10, 10, 'SAIDA', 3.000, '2026-03-17 08:20:36', 'Produção de massas e coberturas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_fornecedores`
--

CREATE TABLE `tbl_fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(50) NOT NULL,
  `representante_fornecedor` varchar(50) NOT NULL,
  `email_fornecedor` varchar(80) NOT NULL,
  `telefone_fornecedor` varchar(14) NOT NULL,
  `status_fornecedor` varchar(10) NOT NULL DEFAULT 'ATIVO',
  `criado_em_fornecedor` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_fornecedor` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_fornecedores`
--

INSERT INTO `tbl_fornecedores` (`id_fornecedor`, `nome_fornecedor`, `representante_fornecedor`, `email_fornecedor`, `telefone_fornecedor`, `status_fornecedor`, `criado_em_fornecedor`, `atualizado_em_fornecedor`) VALUES
(1, 'Doce Sabor Distribuidora', 'Marcos Lima', 'contato@docesabor.com.br', '11987654321', 'ATIVO', '2026-03-12 09:39:06', '2026-03-12 09:39:06'),
(2, 'Laticínios Serra Azul', 'Fernanda Rocha', 'vendas@serraazul.com.br', '11981234567', 'ATIVO', '2026-03-12 09:39:06', '2026-03-12 09:39:06'),
(3, 'Embala Festas LTDA', 'Carla Mendes', 'comercial@embalafestas.com.br', '11993456789', 'ATIVO', '2026-03-12 09:39:06', '2026-03-12 09:39:06'),
(4, 'Frutas Boa Colheita', 'Pedro Alves', 'pedidos@boacolheita.com.br', '11992345678', 'ATIVO', '2026-03-12 09:39:06', '2026-03-12 09:39:06'),
(5, 'Chocolates Premium Brasil', 'Juliana Costa', 'suporte@cpbrasil.com.br', '11994567812', 'INATIVO', '2026-03-12 09:39:06', '2026-03-12 09:39:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_itens_venda`
--

CREATE TABLE `tbl_itens_venda` (
  `id_item` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor_unit_item` double(10,2) NOT NULL,
  `qtde_item` double(10,2) NOT NULL,
  `status_item` varchar(10) NOT NULL,
  `atualizado_em_item` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_itens_venda`
--

INSERT INTO `tbl_itens_venda` (`id_item`, `id_venda`, `id_produto`, `valor_unit_item`, `qtde_item`, `status_item`, `atualizado_em_item`) VALUES
(1, 1, 1, 12.50, 1.00, 'ATIVO', '2026-03-17 07:59:28'),
(2, 2, 4, 19.90, 1.00, 'ATIVO', '2026-03-17 08:00:07'),
(3, 3, 7, 6.00, 1.00, 'ATIVO', '2026-03-17 08:00:13'),
(4, 3, 3, 3.50, 2.00, 'ATIVO', '2026-03-17 08:00:24'),
(5, 4, 9, 49.90, 1.00, 'ATIVO', '2026-03-17 08:00:33'),
(6, 5, 5, 13.00, 1.00, 'ATIVO', '2026-03-17 08:00:38'),
(7, 5, 7, 6.00, 1.00, 'ATIVO', '2026-03-17 08:00:44'),
(8, 5, 3, 3.50, 2.00, 'ATIVO', '2026-03-17 08:00:48'),
(9, 7, 8, 10.50, 3.00, 'ATIVO', '2026-03-17 08:00:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_materia_prima`
--

CREATE TABLE `tbl_materia_prima` (
  `id_materia_prima` int(11) NOT NULL,
  `nome_materia_prima` varchar(30) NOT NULL,
  `unid_med_materia_prima` varchar(2) NOT NULL,
  `qtde_atual_materia_prima` double(10,3) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `criado_em_materia_prima` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_materia_prima` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_materia_prima`
--

INSERT INTO `tbl_materia_prima` (`id_materia_prima`, `nome_materia_prima`, `unid_med_materia_prima`, `qtde_atual_materia_prima`, `id_fornecedor`, `criado_em_materia_prima`, `atualizado_em_materia_prima`) VALUES
(1, 'Farinha de Trigo', 'KG', 25.000, 1, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(2, 'Açúcar Refinado', 'KG', 18.000, 1, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(3, 'Chocolate em Barra', 'KG', 12.000, 5, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(4, 'Leite Condensado', 'UN', 40.000, 2, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(5, 'Creme de Leite', 'UN', 30.000, 2, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(6, 'Morango', 'KG', 10.000, 4, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(7, 'Ovos', 'UN', 150.000, 1, '2026-03-12 10:16:08', '2026-03-13 08:34:11'),
(8, 'Café em Pó', 'KG', 8.000, 1, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(9, 'Caixas para Doces', 'UN', 60.000, 3, '2026-03-12 10:16:08', '2026-03-12 10:16:08'),
(10, 'Manteiga', 'KG', 9.000, 2, '2026-03-12 10:16:08', '2026-03-12 10:16:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_produtos`
--

CREATE TABLE `tbl_produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(30) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descricao_produto` text NOT NULL,
  `tamanho_produto` varchar(10) NOT NULL,
  `unid_med_produto` varchar(2) NOT NULL,
  `valor_produto` double(10,2) NOT NULL,
  `foto_produto` varchar(60) NOT NULL,
  `status_produto` varchar(10) NOT NULL DEFAULT 'ATIVO',
  `criado_em_produto` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_produto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_produtos`
--

INSERT INTO `tbl_produtos` (`id_produto`, `nome_produto`, `id_categoria`, `descricao_produto`, `tamanho_produto`, `unid_med_produto`, `valor_produto`, `foto_produto`, `status_produto`, `criado_em_produto`, `atualizado_em_produto`) VALUES
(1, 'Bolo de Chocolate Fatia', 1, 'Fatia de bolo de chocolate com cobertura', 'Médio', 'FT', 12.50, 'produto/bolo-de-chocolate-fatia.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(2, 'Bolo Red Velvet Fatia', 1, 'Fatia de bolo red velvet com cream cheese', 'Grande', 'FT', 14.00, 'produto/bolo-red-velvet-fatia.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(3, 'Brigadeiro Gourmet', 2, 'Brigadeiro gourmet tradicional', 'Pequeno', 'UN', 3.50, 'produto/brigadeiro-gourmet.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(4, 'Caixa com 6 Doces Finos', 2, 'Caixa com 6 doces finos variados', 'Médio', 'CX', 19.90, 'produto/caixa-com-6-doces-finos.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(5, 'Torta de Limão Fatia', 4, 'Fatia de torta de limão', 'Pequeno', 'FT', 13.00, 'produto/torta-de-limao-fatia.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(6, 'Cheesecake de Frutas Vermelhas', 4, 'Pedaço de cheesecake com frutas vermelhas', 'Grande', 'UN', 15.50, 'produto/cheesecake-de-frutas-vermelhas.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(7, 'Café Expresso 80ml', 3, 'Café expresso tradicional', 'Pequeno', 'ML', 6.00, 'produto/cafe-expresso.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(8, 'Cappuccino 300ml', 3, 'Cappuccino cremoso com toque especial', 'Grande', 'ML', 10.50, 'produto/cappuccino-cremoso.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(9, 'Kit Presente Doce', 5, 'Kit com mini bolo e doces especiais', 'Grande', 'UN', 49.90, 'produto/kit-presente-doce.png', 'INATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14'),
(10, 'Bolo de Cenoura Mini', 1, 'Mini bolo de cenoura com cobertura de chocolate', 'Pequeno', 'UN', 18.00, 'produto/mini-bolo-de-cenoura.png', 'ATIVO', '2026-03-17 07:51:14', '2026-03-17 07:51:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(80) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `perfil_usuario` varchar(13) NOT NULL,
  `foto_usuario` varchar(30) NOT NULL,
  `status_usuario` varchar(10) NOT NULL,
  `criado_em_usuario` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em_usuario` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `perfil_usuario`, `foto_usuario`, `status_usuario`, `criado_em_usuario`, `atualizado_em_usuario`) VALUES
(1, 'Roberto Souza', 'roberto.atend@davilla.com.br', 'senha123', 'ATENDENTE', 'usuario/roberto-souza.png', 'ATIVO', '2026-03-10 09:58:30', '2026-03-10 09:58:30'),
(2, 'Ana Caixa', 'ana.atend@davilla.com', '123456', 'ATENDENTE', 'usuario/ana-caixa.jpg', 'ATIVO', '2026-03-12 10:18:39', '2026-03-12 10:18:39'),
(3, 'Beatriz Vendas', 'beatriz.atend@davilla.com', '123456', 'ATENDENTE', 'usuario/beatriz-vendas.jpg', 'ATIVO', '2026-03-12 10:18:39', '2026-03-12 10:18:39'),
(4, 'Carlos Gerente', 'carlos.geren@davilla.com', '123456', 'GERENTE', 'usuario/carlos-gerente.jpg', 'ATIVO', '2026-03-12 10:18:39', '2026-03-12 10:18:39'),
(5, 'Daniela Admin', 'daniela.admin@davilla.com', '123456', 'ADMIN', 'usuario/daniela-admin.jpg', 'ATIVO', '2026-03-12 10:18:39', '2026-03-12 10:18:39'),
(6, 'Eduardo Produção', 'eduardo.confe@davilla.com', '123456', 'CONFEITEIRO', 'usuario/eduardo-producao.jpg', 'INATIVO', '2026-03-12 10:18:39', '2026-03-12 10:18:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_vendas`
--

CREATE TABLE `tbl_vendas` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp(),
  `valor_venda` double(10,2) NOT NULL,
  `status_venda` varchar(12) NOT NULL,
  `data_entrega_venda` datetime NOT NULL,
  `atualizado_em_venda` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_vendas`
--

INSERT INTO `tbl_vendas` (`id_venda`, `id_cliente`, `id_usuario`, `data_venda`, `valor_venda`, `status_venda`, `data_entrega_venda`, `atualizado_em_venda`) VALUES
(1, 1, 1, '2026-03-10 10:43:16', 12.50, 'FINALIZADA', '2026-03-10 00:00:00', '2026-03-17 08:05:37'),
(2, 2, 2, '2026-03-12 10:49:53', 19.90, 'FINALIZADA', '2026-03-06 15:30:00', '2026-03-17 08:05:45'),
(3, 3, 3, '2026-03-12 10:49:53', 13.00, 'FINALIZADA', '2026-03-06 16:00:00', '2026-03-17 08:05:51'),
(4, 4, 2, '2026-03-12 10:49:53', 49.90, 'FINALIZADA', '2026-03-06 10:00:00', '2026-03-17 08:05:57'),
(5, 5, 4, '2026-03-12 10:49:53', 26.00, 'FINALIZADA', '2026-03-07 18:30:00', '2026-03-17 08:06:53'),
(6, 6, 3, '2026-03-12 10:49:53', 0.00, 'CANCELADA', '2026-03-07 14:00:00', '2026-03-17 08:07:11'),
(7, 7, 2, '2026-03-12 10:49:53', 31.50, 'FINALIZADA', '2026-03-07 16:20:00', '2026-03-17 08:06:59'),
(8, 8, 5, '2026-03-12 10:49:53', 0.00, 'EM ANDAMENTO', '2026-03-08 11:00:00', '2026-03-17 08:07:38'),
(9, 9, 3, '2026-03-12 10:49:53', 0.00, 'EM ANDAMENTO', '2026-03-08 17:00:00', '2026-03-17 08:08:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Índices de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf_cnpj_cliente` (`cpf_cnpj_cliente`),
  ADD UNIQUE KEY `email_cliente` (`email_cliente`);

--
-- Índices de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices de tabela `tbl_controle_materia_prima`
--
ALTER TABLE `tbl_controle_materia_prima`
  ADD PRIMARY KEY (`id_controle`),
  ADD KEY `fk_controle_materia_prima_materia_prima` (`id_materia_prima`);

--
-- Índices de tabela `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`),
  ADD UNIQUE KEY `email_fornecedor` (`email_fornecedor`);

--
-- Índices de tabela `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_itens_venda_venda` (`id_venda`),
  ADD KEY `fk_itens_venda_produto` (`id_produto`);

--
-- Índices de tabela `tbl_materia_prima`
--
ALTER TABLE `tbl_materia_prima`
  ADD PRIMARY KEY (`id_materia_prima`),
  ADD KEY `fk_materia_prima_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tbl_produtos`
--
ALTER TABLE `tbl_produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produtos_categorias` (`id_categoria`);

--
-- Índices de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- Índices de tabela `tbl_vendas`
--
ALTER TABLE `tbl_vendas`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `fk_venda_cliente` (`id_cliente`),
  ADD KEY `fk_venda_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbl_controle_materia_prima`
--
ALTER TABLE `tbl_controle_materia_prima`
  MODIFY `id_controle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbl_materia_prima`
--
ALTER TABLE `tbl_materia_prima`
  MODIFY `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbl_produtos`
--
ALTER TABLE `tbl_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_vendas`
--
ALTER TABLE `tbl_vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_controle_materia_prima`
--
ALTER TABLE `tbl_controle_materia_prima`
  ADD CONSTRAINT `fk_controle_materia_prima_materia_prima` FOREIGN KEY (`id_materia_prima`) REFERENCES `tbl_materia_prima` (`id_materia_prima`);

--
-- Restrições para tabelas `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  ADD CONSTRAINT `fk_itens_venda_produto` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produtos` (`id_produto`),
  ADD CONSTRAINT `fk_itens_venda_venda` FOREIGN KEY (`id_venda`) REFERENCES `tbl_vendas` (`id_venda`);

--
-- Restrições para tabelas `tbl_materia_prima`
--
ALTER TABLE `tbl_materia_prima`
  ADD CONSTRAINT `fk_materia_prima_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedores` (`id_fornecedor`);

--
-- Restrições para tabelas `tbl_produtos`
--
ALTER TABLE `tbl_produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`);

--
-- Restrições para tabelas `tbl_vendas`
--
ALTER TABLE `tbl_vendas`
  ADD CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_venda_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
