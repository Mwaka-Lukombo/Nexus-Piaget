-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Out-2025 às 18:37
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
(1, 1, 1, 'kmk'),
(2, 1, 1, 'Como vai isso'),
(3, 1, 1, 'Como tens passado'),
(4, 1, 1, 'Conta la essas novidades irmao'),
(5, 1, 2, 'Kmk'),
(6, 2, 1, 'Ola, tudo bem?'),
(7, 2, 1, 'Como tem passado'),
(8, 2, 1, 'pesso alguma ajudinha'),
(9, 1, 1, 'kmk'),
(10, 1, 1, 'na boa'),
(11, 1, 1, 'ola'),
(12, 1, 1, 'mkm'),
(13, 1, 1, 'kmkasdasd'),
(14, 1, 1, 'asdasdasd'),
(15, 1, 1, 'boa tarde!');

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
(1, 1, 2, 'kmk', '2025-03-26 12:46:51'),
(2, 2, 1, 'Na boa e ai?', '2025-03-26 12:48:15'),
(3, 1, 2, 'Estou cool, como tens passado?', '2025-03-26 12:48:26'),
(4, 2, 1, 'tenho passado bem e tu?', '2025-03-26 12:48:35'),
(5, 1, 3, 'kmk', '2025-05-05 08:29:55'),
(6, 1, 2, 'freak', '2025-05-05 08:30:47'),
(7, 1, 2, 'como tens passadpo', '2025-05-05 08:30:53'),
(8, 2, 1, 'Numa boa e ai?', '2025-05-05 08:31:01'),
(9, 2, 1, 'yayaya', '2025-05-05 08:31:08'),
(10, 2, 1, 'kmk', '2025-05-13 19:47:00'),
(11, 1, 2, 'Na boa e ai?', '2025-05-13 19:47:12'),
(12, 2, 1, 'tudo bem?', '2025-06-16 07:42:53'),
(13, 1, 2, 'KMKM', '2025-06-16 07:42:57'),
(14, 1, 2, 'kmk boy, o que aconteu na aula de hoje', '2025-07-20 09:59:16'),
(15, 2, 1, 'Nada de especial, apenas o docente sintio a tua falta', '2025-07-20 09:59:35'),
(16, 1, 2, 'asdadasd', '2025-07-20 09:59:38'),
(17, 1, 2, 'dasdasda', '2025-10-02 13:39:56'),
(18, 1, 2, 'kmk, como vai isso?', '2025-10-02 14:00:07'),
(19, 2, 1, 'Esta tudo bem, o docente sentiu falta de ti hoje na sala', '2025-10-02 14:00:19'),
(20, 1, 2, 'asdasd', '2025-10-02 14:00:22');

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
(1, 'Marla Sheng', 'Marlasheng@gmail.com', '418317262_723731949862106_7793722909428430663_n.jpg', 'alura.png', 'Cornelder 2017 - 2020', 'Cornelder - 2025', '', '', 'Especialista em desenvolvimento de sistemas de gerenciamento e escolares, capacitada para a montagem e gerenciamento de redes de computadores', 'Luto pela seguranca da informacao e melhor desenvolvimento das tecnologias', 'Muito dedicada na resolucacao de problemas infretados pelas empresas na qual ela trabalha', 'Engenharia Informarica e de Computadores', 'http://www.faceboock.com', '', ''),
(2, 'Amilton de Jesus Portraite', 'amilton33@gmail.com', '', '', 'Portrait 22', 'Portrait 22', 'images.png', 'CornelderMoçambique.jpg', 'Java para desktop para aplicacoes extremante complexas que necessitam de uma grade capacidade de racicinio', 'Luto para o desenvolvimento de latas aplicacoes com melhor performace de desenpenho', 'Engenheiro de Software pela Universidade Jean paiget de mocambique, atualmente trabalho como desenvolvedor full stack da empresa Portrait dev\'s', 'Engenharia Informatica e de Computadores', 'www.facebook.com', 'https://www.twiiter.com', 'https://www.linkedin.com/home?originalSubdomain=mz');

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
(1, 1, 'Escola Nossa Senhora da Fatima', 'Escola Nossa Senhora da Fatima', 'Universidade jean piaget de moçambique', '', '2009 - 2015 Ensino Primario na escola nossa senhora da Fatima', '2015 - 2020 Ensino Secundario na escola nossa senho da Fatima', '2020 - 2024 Universidade Jean Piaget de Mocambique', ''),
(2, 2, 'Escola Joao XXIII', 'Escola Secundaria da Manga', 'Universidade jean piaget de moçambique', '', '2009 - 2015 Ensino Primario na escola Joao XXIII onde pude aprender as coisa basicas', '2016 - 2020 Consolidacao dos conhecimentos basicos e definiacao de metas profissionais para a minha carreira estudantil', '2021 - 2025 Universidade Jean Piaget de Mocambique onde fiz a minha formacao superior onde pude ter o contacto com as linguaguens de programacao e pude me aprofundar nesse conhecimento', '');

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
(1, 'Alphonse M Lukombo', 'Alphonsejunior43@gmail.com', '123', '544578_267941866675295_847825128_n.jpg', 3),
(2, 'Carlitos Gove', 'carlitos@gmail.com', '123', 'docente_carlitos.jpg', 1),
(3, 'Alfredo Maleca', 'maleca12@gmail.com', '123', 'docente_maleca.jpg', 1),
(4, 'Amilton de Jesus Portraite', 'amilton33@gmail.com', '75776246', 'Imagem WhatsApp 2024-07-10 às 13.29.32_a4f01126.jpg', 2),
(5, 'Marla Sheng', 'Marlasheng@gmail.com', '72183197', '418317262_723731949862106_7793722909428430663_n.jpg', 2),
(6, 'Marla Sheng', 'Marlasheng@gmail.com', '98402965', '418317262_723731949862106_7793722909428430663_n.jpg', 2);

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

--
-- Extraindo dados da tabela `tb_site.guardados_noticia`
--

INSERT INTO `tb_site.guardados_noticia` (`id`, `estudante_id`, `noticia_id`, `status`) VALUES
(12, 8, 1, 1),
(19, 1, 3, 1),
(20, 1, 2, 1);

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
(1, 1, 1, 'REPORT-Monografia_Alphonse_Mwaka_Lukombo_V.1__2__-_ana__lise_1 (19-05-25) (1).pdf', 0),
(2, 2, 4, 'Rodsone-Bacela.pdf', 0),
(3, 3, 1, 'AnotherCv.pdf', 0),
(4, 4, 1, 'document (16).pdf', 0),
(5, 5, 2, 'document (16) (1).pdf', 0),
(6, 5, 2, 'document (16).pdf', 0),
(7, 6, 8, 'Alphonse Mwaka Lukombo, Nexus Plataforma integrada de Comunicao e Gestao_Verficado02_090139.docx', 0);

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
(1, 1, 1, 'clark_jr_tv_mz (1).mp4', 0),
(2, 2, 4, 'recildo_junior_official.mp4', 0),
(3, 2, 4, 'Snake Play.mp4', 0),
(4, 3, 1, 'moz_princess.official.mp4', 0),
(5, 4, 1, 'txiobullet_madlipz.mp4', 0),
(6, 6, 8, 'moz_princess.official (5).mp4', 0);

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
(1, 2, '', '_chelton_vieira_496088900_18381714550189677_3069740957329653290_n.jpg', 'Aqui vai a nossa noticia de teste em nossa aplicacao, vamos trabalhar com os nossos elementos ou nossos dados em nossa aplicacao', '2025-09-30 15:46:08'),
(2, 2, '', 'jamie-coupaud-sxtrNe9BwKA-unsplash.jpg', 'Essa e a nossa dinamica de trabalho quando estamos no porto', '2025-09-30 15:47:05'),
(3, 2, 'AQMjrNDgHRAgM3I7Me01wQNu_y0HX-jloCsx1b0zd-l4wRe9wXGFRfH6kKs4vUojKiWkJb2gTSi4X5lRNSTFSvL-DJapuvQHk8XDuks.mp4', '', 'Assim como nos trabalhamos em nossa empresa', '2025-10-02 13:29:25'),
(4, 2, 'txiobullet_madlipz (1).mp4', '', 'Aqui vai a nossa noticia recente dentro da nossa aplicacao', '2025-10-02 16:35:36'),
(5, 2, 'txiobullet_madlipz (1).mp4', '', 'Aqui vai a nossa noticia recente dentro da nossa aplicacao', '2025-10-02 16:35:47'),
(6, 2, 'txiobullet_madlipz (1).mp4', '', 'Aqui vai a nossa noticia recente dentro da nossa aplicacao', '2025-10-02 16:36:04');

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
(2, 1, 1, 1),
(3, 1, 3, 1);

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
(7, 2, 1, 1),
(11, 1, 1, 1),
(12, 1, 2, 1);

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
(1, 1, 3, 1),
(3, 2, 3, 0),
(6, 1, 2, 1),
(7, 8, 1, 0);

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
(1, 2, 'Carlitos Gove', 'Desenvolvimento Web', 4, 'Engenharia Informatica e de Computadores', 'web_dev.webp'),
(2, 2, 'Carlitos Gove', 'Wordpress E-commerce', 4, 'Engenharia Informatica e de Computadores', 'images.png'),
(3, 2, 'Carlitos Gove', 'Vendas Internacionais', 2, 'Engenharia Informatica e de Computadores', 'pexels-arina-krasnikova-5424974.jpg'),
(4, 2, 'Carlitos Gove', 'Computacao grafica', 4, 'Engenharia Informatica e de Computadores', 'images.jpeg'),
(5, 2, 'Carlitos Gove', 'Areas pesadas', 4, 'Geologia e Minas', '-www-netacad-com-launch (9).png');

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

--
-- Extraindo dados da tabela `tb_site.turma_comentario`
--

INSERT INTO `tb_site.turma_comentario` (`id`, `turma_id`, `estudante_id`, `comentario`, `data`) VALUES
(3, 3, 1, 'adsdasdasdasda', '2025-06-26 16:30:52'),
(4, 3, 1, 'asdasdasdsdasdasd', '2025-06-26 16:31:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.turma_materia`
--

CREATE TABLE `tb_site.turma_materia` (
  `id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `estudante_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `ano` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.turma_materia`
--

INSERT INTO `tb_site.turma_materia` (`id`, `turma_id`, `estudante_id`, `mensagem`, `ano`, `data`) VALUES
(1, 1, 1, '<p>Aqui vai o resultado final da minha monografia</p>', 0, '2025-06-23 07:01:37'),
(2, 1, 4, '<p>A resolucacao dos exercicios que seria para aula de hoje em anexo</p>', 0, '2025-06-23 07:07:47'),
(3, 4, 1, '<p>Aqui esta o meu trabalho final de investigacao</p>', 0, '2025-06-26 16:30:17'),
(4, 1, 1, '<p>Docente aqui esta o meu trabalho</p>', 0, '2025-07-20 09:56:01'),
(5, 5, 2, '<p>nuioasbxnoaisxnoiasnxasoixasxasxa</p>', 0, '2025-07-20 09:58:24'),
(6, 1, 8, '<p>Este e o meu TCC</p>', 0, '2025-09-24 11:27:27');

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
(6, 1, 'Sistemas Operativos'),
(7, 1, 'IA');

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
(20, 6, 8, 'Ricardo Nhacuogue', '<p>Estou com duvidas sorasdadas</p>', 0, 0),
(24, 8, 9, 'Teste', '<p>Boa tarde docente, como vai ?</p>', 0, 0),
(25, 7, 1, 'Alphonse junior', '<p>Estou com duvidas na materia de xxs</p>', 0, 0),
(26, 7, 0, 'Carlitos Gove', 'Tudo bem, nos iremos continuar com essa materia na sala de aula proxima semana', 2, 1),
(27, 6, 1, 'Alphonse junior', '<p>Eu posso ajudar-te colega a resolver essa duvida que tu tens, apenas irei precisar de um determinado refresco</p>', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_site.chat`
--
ALTER TABLE `tb_site.chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_site.comentario_alumin`
--
ALTER TABLE `tb_site.comentario_alumin`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site.cursos`
--
ALTER TABLE `tb_site.cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_audios`
--
ALTER TABLE `tb_site.materia_audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_documentos`
--
ALTER TABLE `tb_site.materia_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_site.materia_videos`
--
ALTER TABLE `tb_site.materia_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias_alumin`
--
ALTER TABLE `tb_site.noticias_alumin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias_alumin_like`
--
ALTER TABLE `tb_site.noticias_alumin_like`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_site.seguidores`
--
ALTER TABLE `tb_site.seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_site.solicitacoes`
--
ALTER TABLE `tb_site.solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_site.turma`
--
ALTER TABLE `tb_site.turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_site.turma_comentario`
--
ALTER TABLE `tb_site.turma_comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.turma_materia`
--
ALTER TABLE `tb_site.turma_materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_site.vagas`
--
ALTER TABLE `tb_site.vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site.vagas_recentes`
--
ALTER TABLE `tb_site.vagas_recentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_site_forum`
--
ALTER TABLE `tb_site_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_site_forum.post`
--
ALTER TABLE `tb_site_forum.post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_site_noticias.recentes`
--
ALTER TABLE `tb_site_noticias.recentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
