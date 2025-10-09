-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Out-2025 às 15:54
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nexus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.alumin_chat`
--

CREATE TABLE `tb_site.alumin_chat` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.alumin_chat`
--

INSERT INTO `tb_site.alumin_chat` (`id`, `estudante_id`, `aluno_id`, `mensagem`) VALUES
(1, 1, 1, 'asdasd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.chat`
--

CREATE TABLE `tb_site.chat` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.chat`
--

INSERT INTO `tb_site.chat` (`id`, `id_from`, `id_to`, `mensagem`, `data_envio`) VALUES
(1, 2, 1, 'kmk', '2025-10-07 19:21:52'),
(2, 1, 2, 'Numa boa e ai?', '2025-10-07 19:22:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.comentario_alumin`
--

CREATE TABLE `tb_site.comentario_alumin` (
  `id` smallint(6) NOT NULL,
  `estudante_id` smallint(6) DEFAULT NULL,
  `noticia_id` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.cursos`
--

CREATE TABLE `tb_site.cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.cursos`
--

INSERT INTO `tb_site.cursos` (`id`, `nome`) VALUES
(1, 'Engenharia Informatica e de Computadores'),
(2, 'Geologia e Minas'),
(3, 'Contabilidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.estudantes`
--

CREATE TABLE `tb_site.estudantes` (
  `id_estudante` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` varchar(55) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `ano` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.estudantes`
--

INSERT INTO `tb_site.estudantes` (`id_estudante`, `nome`, `email`, `sexo`, `perfil`, `senha`, `curso`, `ano`) VALUES
(1, 'Alphonse junior', 'Alphonsejunior43@gmail.com', 'Masculino', 'Imagem WhatsApp 2024-06-16 às 12.21.34_81b8b247.jpg', '123', 'Engenharia Informatica e de Computadores', '4°'),
(2, 'Naire Áfido Freitas', 'Naire12@gmail.com', 'Masculino', 'naire.jpg', '123', 'Geologia e Minas', '4°'),
(3, 'Érica Elías ', 'Ericaelias12@gmail.com', 'Femenino', 'Erica.jpg', '123', 'Análises Clínicas e Saúde Pública', '2°'),
(4, 'Dercio Domingos Mutombo', 'Dercio14@gmail.com', 'Masculino', 'Imagem WhatsApp 2024-07-10 às 13.29.32_1163b7e6.jpg', '123', 'Engenharia Informatica e de Computadores', '4°'),
(5, 'Sheidy Francisco Matanganhate', 'SheydeFrancisco12@gmail.com', 'Femenino', '', '123', 'Direito', '3°'),
(6, 'Manuel Tivana', 'tivana@gmail.com', 'Masculino', 'Imagem WhatsApp 2024-07-10 às 13.29.32_1163b7e6.jpg', '123', 'Engenharia Informatica e de Computadores', '4'),
(7, 'Dickson Armando', 'armando@gmail.com', 'Masculino', 'Imagem WhatsApp 2024-06-03 às 14.38.15_ff90f238.jpg', '123', 'Engenharia Informatica e de Computadores', '4'),
(8, 'Ricardo Nhacuogue', 'ricardo@gmail.com', 'Masculino', '544578_267941866675295_847825128_n.jpg', '123', 'Engenharia Informatica e de Computadores', '4'),
(9, 'Teste', 'teste@gmail.com', 'Masculino', 'SharedScreenshot.jpg', 'teste', 'Engenharia Informatica e de Computadores', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.estudantes_antigos`
--

CREATE TABLE `tb_site.estudantes_antigos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `banner_perfil` varchar(225) NOT NULL,
  `empresa_1` varchar(225) NOT NULL,
  `empresa_2` varchar(255) NOT NULL,
  `img_empresa_1` varchar(225) NOT NULL,
  `img_empresa_2` varchar(255) NOT NULL,
  `Experiencia` text NOT NULL,
  `causas` text NOT NULL,
  `sobre` text NOT NULL,
  `curso` varchar(225) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.estudantes_antigos`
--

INSERT INTO `tb_site.estudantes_antigos` (`id`, `nome`, `email`, `perfil`, `banner_perfil`, `empresa_1`, `empresa_2`, `img_empresa_1`, `img_empresa_2`, `Experiencia`, `causas`, `sobre`, `curso`, `facebook`, `twitter`, `linkedin`) VALUES
(1, 'Domingo Carlos', 'Domingocarlos@gmail.com', '469683929_1510727896297731_3258239661149943730_n.jpg', 'mobile-developer-skills-1152x648.jpg', 'Cornelder - 2020', 'Sasol - 2022', 'images.png', 'Sasol-Logo-One-Color1-1-e1509748703991.png', 'Sou desenvolvedor mobile a cerca de 4 anos, tendo desevolvidos diversos projectos que impactaram em minha empresa e venho ainda desenvovlendo.\r\nCom conhecimento avancado em Java para desenvolvimento mobile e desktop, contruindo aplicacoes de ponta', 'Luto pela integridade e ligitimidade do codigo', 'Apaixonado por tecnologia, ja trabalhei em diversas empresas de consultoria entre outros elementos', 'Engenharia Informatica e de Computadores', 'www.faceboock.com', 'www.twitter.com', 'www.lidedin.com'),
(2, 'Amilton de Jesus Portraite', 'Amilton@gmail.com', 'Imagem WhatsApp 2024-07-10 às 13.29.32_a4f01126.jpg', '', 'Cornelder - 2020', 'Sasol - 2022', 'images.jpeg', 'images (1).jpeg', 'asdasdasdasd', 'asdasdasdas', 'asdasdasdasd', 'Engenharia Informatica e de Computadores', 'www.faceboock.com', 'www.twitter.com', 'www.lidedin.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.estudante_antigo_formacao`
--

CREATE TABLE `tb_site.estudante_antigo_formacao` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `ensino_primario` varchar(255) NOT NULL,
  `ensino_secundario` varchar(255) NOT NULL,
  `ensino_superior` varchar(255) NOT NULL,
  `mestrado` varchar(225) NOT NULL,
  `descricao_primario` text NOT NULL,
  `descricao_secundario` text NOT NULL,
  `descricao_superior` text NOT NULL,
  `descricacao_mestrado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.estudante_antigo_formacao`
--

INSERT INTO `tb_site.estudante_antigo_formacao` (`id`, `estudante_id`, `ensino_primario`, `ensino_secundario`, `ensino_superior`, `mestrado`, `descricao_primario`, `descricao_secundario`, `descricao_superior`, `descricacao_mestrado`) VALUES
(1, 1, 'Escola João XXIII', 'Escola João XXIII', 'Universidade Jean Piaget de Moçambique', '', 'A Escola João XXIII pretende ser e é uma escola de referência tendo como objectivo uma educação de qualidade, sempre foi uma escola de referência que funcionava como ponto de observação para outras instituições que se interessavam em aprender mais.\n\nO responsável pela instituição é a Diocese da Beira e os IrmãosLa Salle apenas administram. A congregação e a diocese têm um convénio e quem indica o diretor é congregação o qual é confirmado pelo Bispo', 'A Escola João XXIII pretende ser e é uma escola de referência tendo como objectivo uma educação de qualidade, sempre foi uma escola de referência que funcionava como ponto de observação para outras instituições que se interessavam em aprender mais.\n\nO responsável pela instituição é a Diocese da Beira e os IrmãosLa Salle apenas administram. A congregação e a diocese têm um convénio e quem indica o diretor é congregação o qual é confirmado pelo Bispo', 'O Instituto Piaget, Cooperativa para o Desenvolvimento Humano, Integral e Ecológico, CRL foi constituído em 1979, em Portugal, como cooperativa sem fins lucrativos, fruto de um percurso onde se desenvolveram e implementaram diversos projectos de carácter pedagógico e social. O Instituto Piaget de', ''),
(2, 2, 'Escola João XXIII', 'Escola João XXIII', 'Universidade Jean Piaget de Moçambique', '', 'A Escola João XXIII pretende ser e é uma escola de referência tendo como objectivo uma educação de qualidade, sempre foi uma escola de referência que funcionava como ponto de observação para outras instituições que se interessavam em aprender mais.\r\n\r\nO responsável pela instituição é a Diocese da Beira e os IrmãosLa Salle apenas administram. A congregação e a diocese têm um convénio e quem indica o diretor é congregação o qual é confirmado pelo Bispo', 'A Escola João XXIII pretende ser e é uma escola de referência tendo como objectivo uma educação de qualidade, sempre foi uma escola de referência que funcionava como ponto de observação para outras instituições que se interessavam em aprender mais.\r\n\r\nO responsável pela instituição é a Diocese da Beira e os IrmãosLa Salle apenas administram. A congregação e a diocese têm um convénio e quem indica o diretor é congregação o qual é confirmado pelo Bispo', 'O Instituto Piaget, Cooperativa para o Desenvolvimento Humano, Integral e Ecológico, CRL foi constituído em 1979, em Portugal, como cooperativa sem fins lucrativos, fruto de um percurso onde se desenvolveram e implementaram diversos projectos de carácter pedagógico e social. O Instituto Piaget de', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.funcionarios`
--

CREATE TABLE `tb_site.funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` text NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.funcionarios`
--

INSERT INTO `tb_site.funcionarios` (`id`, `nome`, `email`, `senha`, `perfil`, `cargo`) VALUES
(1, 'Alphonse Mwaka Lukombo', 'alphonse@gmail.com', '123', 'Imagem WhatsApp 2024-06-16 às 12.21.37_ad4638b0.jpg', 3),
(2, 'Alfredo Maleca', 'AlfredoMaleca3@gmail.com', '70431994', 'docente_maleca.jpg', 1),
(3, 'Domingo Carlos', 'Domingocarlos@gmail.com', '123', '469683929_1510727896297731_3258239661149943730_n.jpg', 2),
(4, 'Amilton de Jesus Portraite', 'Amilton@gmail.com', '123', 'Imagem WhatsApp 2024-07-10 às 13.29.32_a4f01126.jpg', 2),
(5, 'Carlitos Gove', 'carlitos@gmail.com', '123', 'docente_carlitos.jpg', 1),
(6, 'João Cussara', 'joao@gmail.com', '90190902', 'docente_cussara.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.guardados_noticia`
--

CREATE TABLE `tb_site.guardados_noticia` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.materia_audios`
--

CREATE TABLE `tb_site.materia_audios` (
  `id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nome_documento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.materia_documentos`
--

CREATE TABLE `tb_site.materia_documentos` (
  `id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `nome_documento` varchar(255) NOT NULL,
  `funcionario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.materia_documentos`
--

INSERT INTO `tb_site.materia_documentos` (`id`, `materia_id`, `estudante_id`, `nome_documento`, `funcionario_id`) VALUES
(1, 9, 0, 'ParecerDercio (1).pdf', 5),
(2, 10, 1, 'requisitos_fullstack_2026.pdf', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.materia_videos`
--

CREATE TABLE `tb_site.materia_videos` (
  `id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `nome_documento` varchar(255) NOT NULL,
  `funcionario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.materia_videos`
--

INSERT INTO `tb_site.materia_videos` (`id`, `materia_id`, `estudante_id`, `nome_documento`, `funcionario_id`) VALUES
(1, 9, 0, '2025-06-01 20-01-29.mp4', 5),
(2, 10, 1, 'Delete.mp4', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias`
--

CREATE TABLE `tb_site.noticias` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `noticia` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `estudante_id`, `funcionario_id`, `noticia`, `data`) VALUES
(1, 1, 0, 'Aqui vai a nossa primeira noticia Para que serve o curso de Informática? A importância do curso de Informática se reflete na formação de profissionais que coordenam operações tecnológicas em organizações e para fins particulares, abrangendo programação, análise de sistemas, redes de computadores e segurança da informação.', '2024-10-25 09:18:05'),
(2, 2, 0, 'Nos do curso de Geologia e minas achamos uma grande rocha no distrito de murubalaMorrumbala é uma vila de Moçambique, sede do distrito do mesmo nome da província da Zambézia. A vila de Morrumbala tinha, de acordo com o Censo de 2007, uma população de 20,727 habitantes. O Posto Administrativo de Morrumbala, de acordo com o Censo de 2007, incluia uma população de 162 070 residentes', '2024-10-25 09:21:51'),
(5, 3, 0, 'Eu irei postar sobre a minha viagem em nampula 😍😍😍😍❤', '2024-10-25 11:43:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias_alumin`
--

CREATE TABLE `tb_site.noticias_alumin` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `video` varchar(225) NOT NULL,
  `imagem` text NOT NULL,
  `noticia` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.noticias_alumin`
--

INSERT INTO `tb_site.noticias_alumin` (`id`, `estudante_id`, `video`, `imagem`, `noticia`, `data`) VALUES
(1, 1, 'AQMgEjc3pfoF1bwdewzwxEDs6V6ns4OMhYrrmVJJuhcvRI8RX4yVhO-7CLI9tnnnLbFQLe6ZaPgV1y5_dMhykxfkF62tWRMSNLlqqZ6KxH_xRQ.mp4', '', 'A universidade Jean Piaget, conta com um grande campus e cursos para voce poder se formar', '2025-10-08 19:28:07'),
(2, 1, '', '487248344_1191587396309924_7649055213576148442_n.jpg', 'Esta e a rotina de um engenheiro de minas, ontem nos tivemos a oprtunidade de visitar mais uma mina e podemos explorar mais ', '2025-10-08 19:36:25'),
(3, 1, 'AQM8gePCwfkICSH-jIxQ67N8yCO3q_o1XvU0mSYzJpvQOnms00eV5bA1fe-eNNG91KuJGH18UUEQqq5BpcbSY7xK3JfH0JMrgmkLwgpakHdNxg.mp4', '', 'Este e o ambiente de agricultura que nos temos em nossa empresa, venha conhecer mais campus dessa natureza. esperamos por voce', '2025-10-09 09:04:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias_alumin_like`
--

CREATE TABLE `tb_site.noticias_alumin_like` (
  `id` smallint(6) NOT NULL,
  `estudante_id` smallint(6) DEFAULT NULL,
  `noticia_id` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.noticias_alumin_like`
--

INSERT INTO `tb_site.noticias_alumin_like` (`id`, `estudante_id`, `noticia_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.seguidores`
--

CREATE TABLE `tb_site.seguidores` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.seguidores`
--

INSERT INTO `tb_site.seguidores` (`id`, `id_from`, `id_to`, `status`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.solicitacoes`
--

CREATE TABLE `tb_site.solicitacoes` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.solicitacoes`
--

INSERT INTO `tb_site.solicitacoes` (`id`, `id_from`, `id_to`, `status`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.turma`
--

CREATE TABLE `tb_site.turma` (
  `id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `nome_docente` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `capa_turma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.turma`
--

INSERT INTO `tb_site.turma` (`id`, `docente_id`, `nome_docente`, `nome`, `ano`, `curso`, `capa_turma`) VALUES
(2, 5, 'Carlitos Gove', 'Desenvolvimento Mobile', 4, 'Engenharia Informatica e de Computadores', 'mobile-developer-skills-1152x648.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.turma_comentario`
--

CREATE TABLE `tb_site.turma_comentario` (
  `id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.turma_materia`
--

CREATE TABLE `tb_site.turma_materia` (
  `id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `ano` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.turma_materia`
--

INSERT INTO `tb_site.turma_materia` (`id`, `turma_id`, `estudante_id`, `docente_id`, `mensagem`, `ano`, `data`) VALUES
(9, 2, 0, 5, 'Esta sera a nossa primeira aula de desenvolvimento mobile, resolvam com atencao os exercicios', 0, '2025-10-09 13:25:13'),
(10, 2, 1, 0, '<p>Esta certo docente, eu ja completei a minha atividade</p>', 0, '2025-10-09 13:27:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.vagas`
--

CREATE TABLE `tb_site.vagas` (
  `id` int(11) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `link_site` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `cartaz` text NOT NULL,
  `descricacao` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.vagas`
--

INSERT INTO `tb_site.vagas` (`id`, `id_estudante`, `titulo`, `link_site`, `curso`, `cartaz`, `descricacao`, `data`) VALUES
(4, 3, 'Programador PHP', 'https://mwaka-lukombo.github.io/site_emprego/', 'Engenharia Informatica e de Computadores', 'images.png', 'Estamos a recutrar um programador PHP senior, capacitado para denseolver diversos sistemas de forma rapida e eficiente', '2025-10-09 09:56:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.vagas_recentes`
--

CREATE TABLE `tb_site.vagas_recentes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.vagas_recentes`
--

INSERT INTO `tb_site.vagas_recentes` (`id`, `titulo`, `descricao`, `imagem`, `data`) VALUES
(1, 'Administrador de Redes', 'Estamos a recrutar engenheiros de redes de computadores, para poderem fazer a administracao dos nossos sitema de internet. mande o seu CV e junte-se a nossa empresa', '191148204.jpg', '2025-10-08 22:09:42'),
(2, 'Programador PHP', 'Estamos a contratar programadores senior PHP, que possam desenvolver diversos programas de forma rapida e escalavel', 'images.png', '2025-10-09 11:48:41'),
(3, 'Programador PHP', 'Estamos a contratar programadores senior PHP, que possam desenvolver diversos programas de forma rapida e escalavel', 'images.png', '2025-10-09 11:49:15'),
(4, 'Programador PHP', 'Estamos a recutrar um programador PHP senior, capacitado para denseolver diversos sistemas de forma rapida e eficiente', 'images.png', '2025-10-09 11:56:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_forum`
--

CREATE TABLE `tb_site_forum` (
  `id` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `topico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site_forum`
--

INSERT INTO `tb_site_forum` (`id`, `id_curso`, `topico`) VALUES
(1, 1, 'Redes de computadores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_forum.post`
--

CREATE TABLE `tb_site_forum.post` (
  `id` int(11) NOT NULL,
  `id_topico` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site_forum.post`
--

INSERT INTO `tb_site_forum.post` (`id`, `id_topico`, `id_usuario`, `nome`, `mensagem`, `funcionario_id`, `cargo`) VALUES
(1, 1, 0, 'Carlitos Gove', 'Vamas continuar com o debate que foi iniciado na sala de aulas', 5, 1),
(2, 1, 1, 'Alphonse junior', '<p>Esta certo docente, nos iremos ler mais para podermos interar mais nas aulas presenciais</p>', 0, 0),
(3, 1, 0, 'Carlitos Gove', 'Esta certo, vamos remarcar a aula de hoje', 5, 1),
(4, 1, 0, 'Domingo Carlos', 'Eu acho que deveria ser feito da seguinte maneira', 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_noticias.recentes`
--

CREATE TABLE `tb_site_noticias.recentes` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site_noticias.recentes`
--

INSERT INTO `tb_site_noticias.recentes` (`id`, `noticia_id`, `estudante_id`, `descricao`, `imagem`, `video`, `data`) VALUES
(1, 1, 1, 'A universidade Jean Piaget, conta com um grande campus e cursos para voce poder se formar', '', 'AQMgEjc3pfoF1bwdewzwxEDs6V6ns4OMhYrrmVJJuhcvRI8RX4yVhO-7CLI9tnnnLbFQLe6ZaPgV1y5_dMhykxfkF62tWRMSNLlqqZ6KxH_xRQ.mp4', '2025-10-08 21:28:07'),
(2, 2, 1, 'Esta e a rotina de um engenheiro de minas, ontem nos tivemos a oprtunidade de visitar mais uma mina e podemos explorar mais ', '487248344_1191587396309924_7649055213576148442_n.jpg', '', '2025-10-08 21:36:25'),
(3, 3, 1, 'Este e o ambiente de agricultura que nos temos em nossa empresa, venha conhecer mais campus dessa natureza. esperamos por voce', '', 'AQM8gePCwfkICSH-jIxQ67N8yCO3q_o1XvU0mSYzJpvQOnms00eV5bA1fe-eNNG91KuJGH18UUEQqq5BpcbSY7xK3JfH0JMrgmkLwgpakHdNxg.mp4', '2025-10-09 11:04:33'),
(4, 4, 1, 'Este e o ambiente de agricultura que nos temos em nossa empresa, venha conhecer mais campus dessa natureza. esperamos por voce', '', 'AQM8gePCwfkICSH-jIxQ67N8yCO3q_o1XvU0mSYzJpvQOnms00eV5bA1fe-eNNG91KuJGH18UUEQqq5BpcbSY7xK3JfH0JMrgmkLwgpakHdNxg.mp4', '2025-10-09 11:34:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_site.alumin_chat`
--
ALTER TABLE `tb_site.alumin_chat`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.chat`
--
ALTER TABLE `tb_site.chat`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.comentario_alumin`
--
ALTER TABLE `tb_site.comentario_alumin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.cursos`
--
ALTER TABLE `tb_site.cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.estudantes`
--
ALTER TABLE `tb_site.estudantes`
  ADD PRIMARY KEY (`id_estudante`);

--
-- Índices para tabela `tb_site.estudantes_antigos`
--
ALTER TABLE `tb_site.estudantes_antigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.estudante_antigo_formacao`
--
ALTER TABLE `tb_site.estudante_antigo_formacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.funcionarios`
--
ALTER TABLE `tb_site.funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.guardados_noticia`
--
ALTER TABLE `tb_site.guardados_noticia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.materia_audios`
--
ALTER TABLE `tb_site.materia_audios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.materia_documentos`
--
ALTER TABLE `tb_site.materia_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.materia_videos`
--
ALTER TABLE `tb_site.materia_videos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.noticias_alumin`
--
ALTER TABLE `tb_site.noticias_alumin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.noticias_alumin_like`
--
ALTER TABLE `tb_site.noticias_alumin_like`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.seguidores`
--
ALTER TABLE `tb_site.seguidores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.solicitacoes`
--
ALTER TABLE `tb_site.solicitacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.turma`
--
ALTER TABLE `tb_site.turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.turma_comentario`
--
ALTER TABLE `tb_site.turma_comentario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.turma_materia`
--
ALTER TABLE `tb_site.turma_materia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.vagas`
--
ALTER TABLE `tb_site.vagas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.vagas_recentes`
--
ALTER TABLE `tb_site.vagas_recentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_forum`
--
ALTER TABLE `tb_site_forum`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_forum.post`
--
ALTER TABLE `tb_site_forum.post`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_noticias.recentes`
--
ALTER TABLE `tb_site_noticias.recentes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_site.alumin_chat`
--
ALTER TABLE `tb_site.alumin_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_site.chat`
--
ALTER TABLE `tb_site.chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.comentario_alumin`
--
ALTER TABLE `tb_site.comentario_alumin`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site.cursos`
--
ALTER TABLE `tb_site.cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_site.estudantes`
--
ALTER TABLE `tb_site.estudantes`
  MODIFY `id_estudante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_site.estudantes_antigos`
--
ALTER TABLE `tb_site.estudantes_antigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.estudante_antigo_formacao`
--
ALTER TABLE `tb_site.estudante_antigo_formacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.funcionarios`
--
ALTER TABLE `tb_site.funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.guardados_noticia`
--
ALTER TABLE `tb_site.guardados_noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_audios`
--
ALTER TABLE `tb_site.materia_audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_documentos`
--
ALTER TABLE `tb_site.materia_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_videos`
--
ALTER TABLE `tb_site.materia_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias_alumin`
--
ALTER TABLE `tb_site.noticias_alumin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias_alumin_like`
--
ALTER TABLE `tb_site.noticias_alumin_like`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.seguidores`
--
ALTER TABLE `tb_site.seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_site.solicitacoes`
--
ALTER TABLE `tb_site.solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_site.turma`
--
ALTER TABLE `tb_site.turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_site.turma_comentario`
--
ALTER TABLE `tb_site.turma_comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.turma_materia`
--
ALTER TABLE `tb_site.turma_materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_site.vagas`
--
ALTER TABLE `tb_site.vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_site.vagas_recentes`
--
ALTER TABLE `tb_site.vagas_recentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_site_forum`
--
ALTER TABLE `tb_site_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_site_forum.post`
--
ALTER TABLE `tb_site_forum.post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_site_noticias.recentes`
--
ALTER TABLE `tb_site_noticias.recentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
