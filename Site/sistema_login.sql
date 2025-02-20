-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Out-2024 às 00:10
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alugueis`
--

CREATE TABLE `alugueis` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `data_saida` date NOT NULL,
  `data_entrega` date NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alugueis`
--

INSERT INTO `alugueis` (`id`, `usuario`, `livro_id`, `data_saida`, `data_entrega`, `quantidade`) VALUES
(9, 'rafael@gmail.com', 8, '2024-10-29', '2024-11-01', 1),
(10, 'rafael@gmail.com', 4, '2024-10-29', '2024-11-01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `status` enum('pendente','enviado','entregue') DEFAULT 'pendente',
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `produtos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `produto_id`, `status`, `data_pedido`, `usuario`, `total`, `produtos`) VALUES
(18, NULL, 'pendente', '2024-10-29 22:15:36', 'lucas@gmail.com', '136.02', '{\"1\":2,\"3\":1}'),
(19, NULL, 'enviado', '2024-10-29 22:19:01', 'rafael@gmail.com', '75.90', '{\"8\":1,\"15\":1}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `nome_produtos` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `preco`, `quantidade`, `imagem`, `nome_produtos`, `usuario`) VALUES
(1, 'Um amor cinco estrelas', 'Romance', '50.00', 1, 'https://m.media-amazon.com/images/I/41OFW3DDZQL._SY445_SX342_.jpg', '', ''),
(2, 'Orgulho e preconceito', 'Romance', '50.00', 1, 'https://m.media-amazon.com/images/I/51lC3sHYyML._SY445_SX342_.jpg', '', ''),
(3, 'É Assim que Acaba', 'Romance', '36.02', 1, 'https://m.media-amazon.com/images/I/51i7kH+rh9L._SY445_SX342_.jpg', '', ''),
(4, 'Gokurakugai', 'Mangá', '35.90', 1, 'https://m.media-amazon.com/images/I/61CFV6diVeL._SY445_SX342_.jpg', '', ''),
(5, 'Crazy Food Truck', 'Mangá', '69.90', 1, 'https://m.media-amazon.com/images/I/51UeuDARMsL._SY445_SX342_.jpg', '', ''),
(6, 'Mulheres sem nome', 'Não-ficção', '14.07', 1, 'https://m.media-amazon.com/images/I/518Ekt4hFtL._SY445_SX342_.jpg', '', ''),
(7, 'A abolição', 'História', '36.58', 1, 'https://m.media-amazon.com/images/I/51jXUroAsAL._SY445_SX342_.jpg', '', ''),
(8, 'Este é o mar', 'Ficção', '40.00', 1, 'https://m.media-amazon.com/images/I/81ipM1rerRL._SY425_.jpg', '', ''),
(9, 'O legado de Lutero', 'História', '70.00', 1, 'https://m.media-amazon.com/images/I/51-1ppW+V0L._SY445_SX342_.jpg', '', ''),
(10, 'O Homem-Cão', 'Infantil', '35.00', 1, 'https://m.media-amazon.com/images/I/51oqtsPW3hL._SY445_SX342_.jpg', '', ''),
(11, 'O idiota', 'Romance', '56.19', 1, 'https://m.media-amazon.com/images/I/31mjUV-3MVS._SY445_SX342_.jpg', '', ''),
(12, 'O diário de Anne Frank', 'Bibliografia', '15.00', 1, 'https://m.media-amazon.com/images/I/41+PZUZS7LL._SY445_SX342_.jpg', '', ''),
(13, 'Demon Slayer: Academia', 'Mangá', '35.90', 1, 'https://m.media-amazon.com/images/I/61Io09gb90L._SY425_.jpg', '', ''),
(14, 'Sonic The Hedgehog', 'Quadrinhos', '47.49', 1, 'https://m.media-amazon.com/images/I/91RcGOBaU3L._SY425_.jpg', '', ''),
(15, 'Blue Lock Vol. 23', 'Mangá', '35.90', 1, 'https://m.media-amazon.com/images/I/61Ds6t9A2TL._SY425_.jpg', '', ''),
(16, 'One Piece Vol. 1', 'Mangá', '27.63', 1, 'https://m.media-amazon.com/images/I/51zPKHupwGL._SY445_SX342_.jpg', '', ''),
(17, 'O mágico de Oz', 'Ficção', '50.12', 1, 'https://m.media-amazon.com/images/I/518xcvEcOFL._SY445_SX342_.jpg', '', ''),
(18, 'Dom Casmurro', 'Romance', '17.68', 1, 'https://m.media-amazon.com/images/I/61Z2bMhGicL._SY425_.jpg', '', ''),
(19, 'O Alienista', 'Ficção', '14.13', 1, 'https://m.media-amazon.com/images/I/41ls0DpJwOL._SY445_SX342_.jpg', '', ''),
(20, 'O Hobbit', 'Fantasia', '43.76', 1, 'https://m.media-amazon.com/images/I/511+-lOOtsL._SY445_SX342_.jpg', '', ''),
(21, 'It: A coisa', 'Terror', '78.99', 1, 'https://m.media-amazon.com/images/I/51z0s3GcvwL._SY445_SX342_.jpg', '', ''),
(22, 'O homem de giz', 'Suspense', '65.00', 1, 'https://m.media-amazon.com/images/I/414ONi-RmLL._SY445_SX342_.jpg', '', ''),
(23, 'O nome do vento', 'Fantasia', '49.90', 1, 'https://m.media-amazon.com/images/I/81CGmkRG9GL._SY425_.jpg', '', ''),
(24, 'Duna', 'Ficção Científica', '69.33', 1, 'https://m.media-amazon.com/images/I/41MRn6hy8-L._SY445_SX342_.jpg', '', ''),
(25, '1984', 'Ficção', '39.90', 1, 'https://m.media-amazon.com/images/I/819js3EQwbL._SL1500_.jpg', '', ''),
(26, 'O Grande Gatsby', 'Romance', '44.90', 1, 'https://m.media-amazon.com/images/I/71+G89dpO4L._SL1500_.jpg', '', ''),
(27, 'A Metamorfose', 'Ficção', '29.90', 1, 'https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg', '', ''),
(28, 'Cem Anos de Solidão', 'Ficção', '49.90', 1, 'https://m.media-amazon.com/images/I/817esPahlrL._SL1500_.jpg', '', ''),
(29, 'O Sol é para Todos', 'Ficção', '34.90', 1, 'https://m.media-amazon.com/images/I/91WKPd60P4L._SL1500_.jpg', '', ''),
(30, 'A Revolção dos Bichos', 'Ficção', '29.90', 1, 'https://m.media-amazon.com/images/I/81DBKwEXkFL._SL1500_.jpg', '', ''),
(31, 'Frankenstein', 'Ficção', '29.90', 1, 'https://m.media-amazon.com/images/I/91Kz+sC5X0L._SL1500_.jpg', '', ''),
(32, 'A Cor Púrpura', 'Ficção', '42.90', 1, 'https://m.media-amazon.com/images/I/719J3+g-GuL._SL1500_.jpg', '', ''),
(33, 'O Senhor dos Anéis: A Sociedade do Anel', 'Fantasia', '59.90', 1, 'https://m.media-amazon.com/images/I/81hCVEC0ExL._SL1500_.jpg', '', ''),
(34, 'O Processo', 'Ficção', '34.90', 1, 'https://m.media-amazon.com/images/I/61rHTFLIceL._SL1000_.jpg', '', ''),
(35, 'A Sombra do Vento', 'Ficção', '54.90', 1, 'https://m.media-amazon.com/images/I/91xOzA3VHtL._SL1500_.jpg', '', ''),
(36, 'A História Sem Fim', 'Ficção', '49.90', 1, 'https://m.media-amazon.com/images/I/71X-YY3HIjL._SL1500_.jpg', '', ''),
(37, 'Com Amor, Clara', 'Crônicas', '49.90', 1, 'https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2020-05-31-at-18-50-291-567faf02c9da72890815909627636200-1024-1024.webp', '', ''),
(38, 'Seja Livre', 'Crônicas', '38.00', 1, 'https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2021-03-23-at-20-03-161-b9673b4dd75b55c3c416165414220481-1024-1024.webp', '', ''),
(39, 'Diva do Cotidiano', 'Crônicas', '28.00', 1, 'assets/img/Livros_Fabio/Diva_do_cotidiano.jpeg', '', ''),
(40, 'Entre a Realidade e o Perdão', 'Drama', '48.00', 1, 'assets/img/Livro_Editora/Frente.jpeg', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `nivel` varchar(250) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nome`, `email`, `data_criacao`, `cpf`, `telefone`, `endereco`, `nivel`) VALUES
(14, 'Lucas ', '$2y$10$.PCSlPnbagekytficH6jJuYWEPgH4ArHEo4VtitQJvIJwmqpmWilq', 'Lucas ', 'lucas@gmail.com', '2024-10-29 20:20:10', '564.563.654-65', '(12) 24598-8967', 'Rua Nova', 'admin'),
(15, 'Rafael', '$2y$10$ZkvL4PSrcru9a.OUvREsQeXlhy0hvIhtKRabqVB9y7V42NFFYwa0W', 'Rafael Lucas', 'rafael@gmail.com', '2024-10-29 21:06:18', '214.124.421-24', '(21) 22123-1321', 'Rua Belém', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alugueis`
--
ALTER TABLE `alugueis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livro_id` (`livro_id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alugueis`
--
ALTER TABLE `alugueis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alugueis`
--
ALTER TABLE `alugueis`
  ADD CONSTRAINT `alugueis_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
