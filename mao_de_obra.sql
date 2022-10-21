-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jun-2016 às 12:35
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mao_de_obra`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `id_login_adm` int(11) NOT NULL,
  `nome_adm` varchar(200) NOT NULL,
  `email_adm` varchar(100) NOT NULL,
  PRIMARY KEY (`id_adm`),
  KEY `id_log_adm` (`id_login_adm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `id_login_adm`, `nome_adm`, `email_adm`) VALUES
(1, 85, 'Rodrigo Soares Medeiros', 'soares.rj@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `id_login_cli` int(11) NOT NULL,
  `nome_cli` varchar(200) NOT NULL,
  `data_nascimento_cli` datetime NOT NULL,
  `data_cadastro_cli` datetime NOT NULL,
  `endereco_cli` varchar(200) NOT NULL,
  `cep_cli` varchar(100) NOT NULL,
  `bairro_cli` varchar(100) NOT NULL,
  `cidade_cli` varchar(100) NOT NULL,
  `estado_cli` varchar(100) NOT NULL,
  `telefone_cli` varchar(100) NOT NULL,
  `email_cli` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cli`),
  KEY `log_cli` (`id_login_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cli`, `id_login_cli`, `nome_cli`, `data_nascimento_cli`, `data_cadastro_cli`, `endereco_cli`, `cep_cli`, `bairro_cli`, `cidade_cli`, `estado_cli`, `telefone_cli`, `email_cli`) VALUES
(9, 107, 'Samuel Santos', '1999-12-20 00:00:00', '2016-06-06 14:40:37', 'Rua A', '21200-120', 'Campo Grande', 'Rio de JANEIRO', 'Rio de Janeiro', '(21) 54652345', 'samuelsantos@gmail.com'),
(13, 114, 'Rogério Gomes', '2000-04-02 00:00:00', '2016-06-21 13:50:19', 'Rua X', '23466-454', 'Santa Cruz', 'Sorocaba', 'São Paulo', '(11) 97676-5567', 'rodolforogerio@gmail.com'),
(15, 117, 'Ademar Santos', '2000-10-02 00:00:00', '2016-06-21 21:33:11', 'Rua A', '21200-120', 'Campo Grande', 'Rio de JANEIRO', 'Pernambuco', '(21) 54652345', 'ademar@gmail.com'),
(17, 121, 'Rafael Brito', '2000-12-12 00:00:00', '2016-06-25 22:18:02', 'Rua S', '23332-234', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', '(21) 233323333', 'brito@ig.com'),
(18, 122, 'Robson Gomes ', '1998-12-12 00:00:00', '2016-06-25 22:23:28', 'Rua A ', '23112-099', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', '(21) 23332333', 'rob@gmail.com'),
(19, 123, 'João neto', '2001-12-12 00:00:00', '2016-06-25 22:29:53', 'Rua Z', '21223-233', 'Santa Cruz', 'Rio de JANEIRO', 'Rio de Janeiro', '(21) 34344-4444', 'joaon@ig.com'),
(20, 124, 'Elio Mendes', '2000-10-12 00:00:00', '2016-06-25 22:32:09', 'Rua D', '23122-222', 'Campo Grande', 'Rio de Janeiro', 'Rio de Janeiro', '(21) 223333233', 'elio@ig.com'),
(21, 125, 'Paulo Victor', '2000-05-12 00:00:00', '2016-06-25 22:35:24', 'Rua A 10', '23123-900', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', '(21) 43445455', 'paulo@ig.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel_acesso` varchar(100) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Extraindo dados da tabela `logins`
--

INSERT INTO `logins` (`id_login`, `login`, `senha`, `nivel_acesso`) VALUES
(85, 'adminrodrigo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1'),
(104, 'Matheus', 'afc97ea131fd7e2695a98ef34013608f97f34e1d', '2'),
(107, 'samuel10', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(111, 'lucio', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(112, 'lucas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(114, 'rodolfo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(116, 'abner', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(117, 'anderson10', '37ad5fdf33749722e67aa907bb216911f5b6e017', '3'),
(118, 'hmilton', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(121, 'brito', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(122, 'rob', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(123, 'neto', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(124, 'elio', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(125, 'paulo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3'),
(127, 'CarlosCostas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(128, 'PedroSP', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(129, 'Robson10', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(130, 'Rodrigo1020', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(131, 'Jmendes', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(132, 'JoseNasc', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(133, 'DiegoLemos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(134, 'AndersonSanna', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(135, 'adsantos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(136, 'Vinimattos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(137, 'jmatias', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(138, 'Pramos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(139, 'JoseAlves', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(140, 'CarlosAguiar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(141, 'AndersonLucas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(142, 'Rneto', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2'),
(143, 'ELucas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissionais`
--

CREATE TABLE IF NOT EXISTS `profissionais` (
  `id_pro` int(11) NOT NULL AUTO_INCREMENT,
  `id_login_pro` int(11) NOT NULL,
  `id_serv_pro` int(11) NOT NULL,
  `nome_pro` varchar(200) NOT NULL,
  `cpf_pro` varchar(100) NOT NULL,
  `data_nascimento_pro` datetime NOT NULL,
  `data_cadastro_pro` datetime NOT NULL,
  `escolaridade_pro` varchar(100) NOT NULL,
  `endereco_pro` varchar(200) NOT NULL,
  `cep_pro` varchar(100) NOT NULL,
  `bairro_pro` varchar(100) NOT NULL,
  `cidade_pro` varchar(100) NOT NULL,
  `estado_pro` varchar(100) NOT NULL,
  `resumo_experiencia_pro` varchar(500) NOT NULL,
  `telefone_pro` varchar(100) NOT NULL,
  `email_pro` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pro`),
  KEY `id_login_str` (`id_login_pro`),
  KEY `id_serv_str` (`id_serv_pro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `profissionais`
--

INSERT INTO `profissionais` (`id_pro`, `id_login_pro`, `id_serv_pro`, `nome_pro`, `cpf_pro`, `data_nascimento_pro`, `data_cadastro_pro`, `escolaridade_pro`, `endereco_pro`, `cep_pro`, `bairro_pro`, `cidade_pro`, `estado_pro`, `resumo_experiencia_pro`, `telefone_pro`, `email_pro`) VALUES
(9, 104, 14, 'Mateus Santos  ', '274.310.729-45', '2000-02-02 00:00:00', '2016-05-25 18:23:33', 'Ensino superior completo', 'Rua Z', '23455-121', 'Campo Grande', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço de colocação de telhas em geral ', '(21) 44542345', 'matheus.rj@gmail.com'),
(12, 111, 15, 'Lúcio Santos Mendes   ', '764.772.304-96', '2000-12-20 00:00:00', '2016-06-18 22:02:50', 'Ensino fundamental completo', 'Rua', '23454-123', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço de vidraçaria em geral', '(21) 98778-5435', 'luciosantos@gmail.com'),
(13, 112, 8, 'Lucas Santos Mendes', '418.435.613-36', '1998-03-01 00:00:00', '2016-06-18 22:06:31', 'Ensino superior completo', 'Rua Nicolau Santos', '21200-120', 'Poços de Caldas', 'Poços de Caldas', 'Minas Gerais', 'Serviço Gesso em geral', '(34) 4022-1221', 'lucas12@gmail.com'),
(14, 116, 11, 'Abner Dias Albino ', '211.326.466-85', '2000-02-01 00:00:00', '2016-06-21 14:32:59', 'Ensino medio incompleto', 'Rua A nº 08', '23332-323', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço de pintura em geral', '(21) 98889-4559', 'almeida@gmail.com'),
(15, 118, 15, 'Rogério Hamilton', '334.999.456-00', '2000-02-12 00:00:00', '2016-06-22 16:44:49', 'Não tem escolaridade', 'Rua w nº 30', '23466-454', 'Santa Cruz', 'Rio de Janeiro', 'Rio de Janeiro', 'Vidraçaria', '(21) 97676-5561', 'hamiltonrogerio@gmail.com'),
(17, 127, 1, 'Carlos Silva Costa ', '325.413.053-70', '1971-07-12 00:00:00', '2016-06-29 01:01:58', 'Ensino fundamental incompleto', 'Rua João Xavier - nº 10', '23100-212', 'Campo Grande', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço de ajudante de pedreiro - auxiliando em serviços gerais', '(21) 98181-3454', 'carlossilva@gmail.com'),
(18, 128, 1, 'Pedro da Silva Cunha ', '313.330.662-60', '1987-12-05 00:00:00', '2016-06-29 01:06:59', 'Ensino fundamental incompleto', 'Rua Candido - nº 89', '21100-212', 'Altos Pinheiros', 'São Paulo', 'São Paulo', 'Serviços em gerais em construção civil', '(11) 2334-9889', 'psilvacunha@ig.com'),
(19, 129, 2, 'Robson Santos Senna ', '368.759.846-28', '1993-10-12 00:00:00', '2016-06-29 01:10:59', 'Ensino superior completo', 'Rua Lopes de Moura nº 100', '21700-121', 'Santa Lucia', 'Belo Horizonte', 'Minas Gerais', 'Serviço de arquitetura para todos os tipos de imóveis', '(34) 98881-2288', 'robsonss@bol.com'),
(20, 130, 3, 'Rodrigo Santos Neto ', '834.814.622-98', '1985-02-01 00:00:00', '2016-06-29 01:15:33', 'Ensino medio completo', 'Rua Dantas nº 09', '23332-333', 'Vila Velha', 'Espirito Santo', 'Espírito Santo', 'Serviço de colocação de calhas e telhados ', '(24) 3455-4555', 'rodrigo.neto@gmail.com'),
(21, 131, 3, 'João Mendes Lopes ', '131.302.358-25', '1981-07-09 00:00:00', '2016-06-29 01:19:01', 'Ensino superior incompleto', 'Rua Lopes nº 12', '21340-001', 'Santíssimo', 'Rio de Janeiro', 'Rio de Janeiro', 'Colocação de todas as variedades de calhas e telhas', '(21) 98776-1324', 'jlopes@ig.com'),
(22, 132, 4, 'José Nascimento ', '638.077.441-69', '2000-02-01 00:00:00', '2016-06-29 01:29:54', 'Ensino medio completo', 'Rua Costas nº 1000', '21400-909', 'Paranauá', 'SantaCatarina', 'Santa Catarina', 'Serviço de carpintaria a todos os gostos', '(48) 98873-4434', 'josenascimento@bol.com'),
(23, 133, 4, 'Diego Lopes Lemos', '742.686.974-11', '1971-01-03 00:00:00', '2016-06-29 01:33:25', 'Ensino superior completo', 'Rua Franco nº 2903', '23110-101', 'Recreio dos Bandeirantes', 'Rio de Janeiro', 'Rio de Janeiro', 'Todos os tipos serviços de carpintaria você encontrará aqui', '(21) 3411-9090', 'diegolemos@gmail.com'),
(24, 134, 5, 'Anderson Sanna ', '047.655.377-65', '1985-06-23 00:00:00', '2016-06-29 01:42:19', 'Ensino superior completo', 'Rua Estacio de Sá nº 2', '25200-100', 'Panamas', 'Itaubal', 'Amapá', 'Todo tipo de pintura para decorar o seu imóvel casa ou apartamento', '(96) 3211-1020', 'andersanna@hotmail.com'),
(25, 135, 6, 'Adriano Severino Santos ', '225.221.193-89', '1969-10-03 00:00:00', '2016-06-29 01:49:13', 'Ensino superior incompleto', 'Rua Caboçú nº 3010', '23450-121', 'Toledo', 'Curitiba', 'Paraná', 'Serviço geral elétrico e instalação de equipamentos elétricos', '(43) 2477-6122', 'adsantos@bol.com'),
(26, 136, 7, 'Vinicius Matias Mattos ', '117.664.640-09', '1967-04-20 00:00:00', '2016-06-29 05:51:27', 'Ensino medio completo', 'Rua Glaucio Gil', '21450-120', 'Recreio dos Bandeirantes', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço hidráulico para apartamentos e casa deixando o imóvel cada vez mais chique', '(21) 98670-1210', 'vinimattos@yahoo.com'),
(27, 137, 7, 'Jair Rogério da Silva ', '261.685.121-01', '1999-01-01 00:00:00', '2016-06-29 05:55:44', 'Ensino medio completo', 'Rua Carlos Moura nº 1500', '21900-120', 'Telles', 'São Paulo', 'São Paulo', 'Serviço Hidráulico, vazamento, e projeto de encanação ', '(11) 980114344', 'jmatias@bol.com'),
(28, 138, 9, 'Paulo Ramos ', '277.845.147-19', '1984-03-05 00:00:00', '2016-06-29 06:20:08', 'Ensino superior completo', 'Rua W Nº 20', '28450-120', 'Anchieta', 'Sorocaba', 'São Paulo', 'Serviço Geral marcenaria com qualidade ', '(11) 9775-1239', 'pramos@gmail.com'),
(29, 139, 10, 'Jose Alves Neto ', '836.416.825-84', '2000-11-20 00:00:00', '2016-06-29 06:24:39', 'Ensino superior incompleto', 'Rua Lúcio Cunha nº 20', '20121-500', 'Bangu', 'Rio de Janeiro', 'Rio de Janeiro', 'Construção de casas, apartamentos, e reformas de serviços gerais', '(21) 94201-2090', 'jalves@ig.com'),
(30, 140, 10, 'Carlos Aguiar Santos ', '949.528.299-36', '1986-08-30 00:00:00', '2016-06-29 06:29:25', 'Ensino fundamental completo', 'Rua Uruguai nº 10', '29100-120', 'Iamirin', 'Bahia', 'Bahia', 'Serviço geral em construção de boa qualidade', '(29) 3454-0098', 'aguiarsantos@gmail.com'),
(31, 141, 12, 'Anderson Lucas  ', '759.752.534-62', '1998-10-02 00:00:00', '2016-06-29 07:00:37', 'Ensino superior completo', 'Rua Lucas Silva nº 80', '23090-807', 'Tietê', 'São Paulo', 'São Paulo', 'Serviço de plantas de imóveis com recursos do Auto Cad e tecnologia', '(11) 4556-1224', 'andersonlucas@gmail.com'),
(32, 142, 13, 'Rafael Ramalho Neto ', '961.448.323-78', '2000-03-02 00:00:00', '2016-06-29 07:03:52', 'Ensino medio incompleto', 'Rua C nº 100', '23332-121', 'Mineirinho', 'Belo Horizonte', 'Minas Gerais', 'Serviço em geral de serralheria', '(34) 78563-4433', 'rneto@gmail.com'),
(33, 143, 16, 'Elias Lucas  ', '524.087.711-45', '1978-07-12 00:00:00', '2016-06-29 07:11:13', 'Ensino fundamental incompleto', 'Rua Vasconcelos nº 45', '23122-121', 'Realengo', 'Rio de Janeiro', 'Rio de Janeiro', 'Serviço de permeabilizar a laje contra vazamentos de água', '(21) 98893-4344', 'elucas@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
  `id_serv` int(11) NOT NULL AUTO_INCREMENT,
  `nome_serv` varchar(200) NOT NULL,
  PRIMARY KEY (`id_serv`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id_serv`, `nome_serv`) VALUES
(1, 'Ajudante'),
(2, 'Arquiteto'),
(3, 'Calheiro'),
(4, 'Carpinteiro'),
(5, 'Desenhista'),
(6, 'Eletricista'),
(7, 'Encanador'),
(8, 'Gesseiro'),
(9, 'Marceneiro'),
(10, 'Pedreiro'),
(11, 'Pintor'),
(12, 'Projetista'),
(13, 'Serralheiro'),
(14, 'Telhadista'),
(15, 'Vidraceiro'),
(16, 'Outros');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
