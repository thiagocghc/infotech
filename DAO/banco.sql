CREATE DATABASE infotech;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categoria` (`id_categoria`, `nome`, `descricao`, `data_cadastro`) VALUES
(1, 'Padrão', 'Cliente sem benefícios especiais', '2026-10-06 09:14:32'),
(2, 'Premium', 'Cliente com atendimento prioritário', '2026-10-06 09:14:32'),
(3, 'Teste', 'teste', '2026-10-06 09:14:32');


CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status_cliente` varchar(50) DEFAULT NULL,
  `telefone` char(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cliente` (`id_cliente`, `nome`, `status_cliente`, `telefone`, `email`, `data_cadastro`, `id_categoria`) VALUES
(7, 'Lucas Ernesto', 'ATIVO', '67686868686', 'lucas@gmail.com', '2026-09-15 20:49:58', 2),
(8, 'Antonio Joao da Silva', 'ATIVO', '67988888888', 'jao13@live.com', '2026-10-06 09:12:27', 5),
(9, 'Iza da SILVA', 'ATIVO', '5454545454', 'thiagonline.hc28@gmail.com', '2026-10-06 09:24:46', 6);


CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status_funcionario` char(6) DEFAULT 'ATIVO',
  `ultima_categoria_vista` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `funcionario` (`id_funcionario`, `nome`, `email`, `senha`, `status_funcionario`, `ultima_categoria_vista`) VALUES
(1, 'Thiago Almeida', 'admin@gmail.com', '123', 'ATIVO', 6);


ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nome` (`nome`);


ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_cliente_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;