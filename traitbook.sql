-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 03:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_de_vida`
--

-- --------------------------------------------------------

--
-- Table structure for table `contas`
--

CREATE TABLE `contas` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL UNIQUE,
  `nome_inteiro` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `data_de_registro` datetime NOT NULL,
  `aniversario` date NOT NULL,
  `genero` enum('Other','Male','Female') NOT NULL,
  `nome_arquivo_fotoperfil` varchar(255) DEFAULT NULL,
  `link_personalidade` varchar(255) NOT NULL,
  `personalidade_data` text NOT NULL,
  `sobre_mim` text NOT NULL,
  `pontos_fracos` text NOT NULL,
  `pontos_fortes` text NOT NULL,
  `profissao_atual` varchar(255) NOT NULL,
  `minhas_aspiracoes` varchar(255) NOT NULL,
  `meus_principais_objetivos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contas`
--

INSERT INTO `contas` (`id_user`, `username`, `nome_inteiro`, `email`, `password`, `data_de_registro`, `aniversario`, `genero`, `nome_arquivo_fotoperfil`, `link_personalidade`, `personalidade_data`, `sobre_mim`, `pontos_fracos`, `pontos_fortes`, `profissao_atual`, `minhas_aspiracoes`, `meus_principais_objetivos`) VALUES
(1, 'Thiago', 'Thiago Gabriel', 'Thiago@email.com', '$2y$10$1LDUoGdycvOeFF.IPx0K8OVzQQ0y93v/jlbvMjA./suAs03VxnKj2', '2000-01-01 01:35:37', '2007-05-15', 'Male', 'Thiago.png', 'https://www.16personalities.com/br/resultados/intp-t/m/pswed0bd', '{\"isSelf\":false,\"locale\":\"br\",\"details\":{\"description\":\"Veja os resultados deste teste de personalidade e aprenda mais sobre esse tipo de personalidade e tra\\u00e7os principais.\",\"cards\":{\"personality\":{\"key\":\"logician\",\"animationSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/animations\\/avatars\\/all\\/logician-male.json\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/personality-types\\/avatars\\/intp-logician-male.svg?v=3\",\"imageAlt\":\"Avatar para INTP\",\"snippetHtml\":\"Os L\\u00f3gicos s\\u00e3o inventores criativos, com uma sede insaci\\u00e1vel de conhecimento.\",\"groupSnippetHtml\":null,\"color\":\"purple\",\"link\":\"https:\\/\\/www.16personalities.com\\/br\\/personalidade-intp\",\"title\":\"Tipo de personalidade\",\"subtitleHtml\":\"<span class=\\\"type__full prevent--drag\\\">L\\u00f3gico <span class=\\\"type__code\\\">(INTP-T)<\\/span><\\/span>\"}},\"traits\":[{\"key\":\"introverted\",\"label\":\"Energia\",\"color\":\"blue\",\"score\":2,\"pct\":51,\"trait\":\"Introvertido\",\"link\":\"https:\\/\\/www.16personalities.com\\/articles\\/energy-introverted-vs-extraverted\",\"reverse\":false,\"reversed\":true,\"titles\":[\"Extrovertido\",\"Introvertido\"],\"description\":\"Os indiv\\u00edduos Introvertidos costumam preferir menos intera\\u00e7\\u00f5es sociais, por\\u00e9m profundas e significativas. Eles se sentem frequentemente atra\\u00eddos por ambientes mais calmos.\",\"snippet\":\"Os indiv\\u00edduos Introvertidos costumam preferir menos intera\\u00e7\\u00f5es sociais, por\\u00e9m profundas e significativas. Eles se sentem frequentemente atra\\u00eddos por ambientes mais calmos.\",\"imageAlt\":\"Uma cena que mostra um homem sentado pr\\u00f3ximo de uma \\u00e1rvore e ouvindo m\\u00fasica.\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/theory\\/traits\\/16personalities_trait_introverted.svg\"},{\"key\":\"intuitive\",\"label\":\"Mente\",\"color\":\"yellow\",\"score\":22,\"pct\":61,\"trait\":\"Intuitivo\",\"link\":\"https:\\/\\/www.16personalities.com\\/articles\\/mind-intuitive-vs-observant\",\"reverse\":true,\"reversed\":false,\"titles\":[\"Intuitivo\",\"Realista\"],\"description\":\"Os indiv\\u00edduos Intuitivos s\\u00e3o muito imaginativos, de mente aberta e curiosos. Eles valorizam a originalidade e focam em significados ocultos e possibilidades remotas.\",\"snippet\":\"Os indiv\\u00edduos Intuitivos s\\u00e3o muito imaginativos, de mente aberta e curiosos. Eles valorizam a originalidade e focam em significados ocultos e possibilidades remotas.\",\"imageAlt\":\"Uma cena que mostra dois pesquisadores discutindo sobre um carro voador.\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/theory\\/traits\\/16personalities_trait_intuitive.svg\"},{\"key\":\"thinking\",\"label\":\"Natureza\",\"color\":\"green\",\"score\":13,\"pct\":57,\"trait\":\"Anal\\u00edtico\",\"link\":\"https:\\/\\/www.16personalities.com\\/articles\\/nature-thinking-vs-feeling\",\"reverse\":true,\"reversed\":false,\"titles\":[\"Anal\\u00edtico\",\"Emocional\"],\"description\":\"Os indiv\\u00edduos Racionais s\\u00e3o focados na objetividade e racionalidade, frequentemente desconsiderando emo\\u00e7\\u00f5es a favor da l\\u00f3gica. Eles tendem a valorizar mais a efic\\u00e1cia do que a harmonia social.\",\"snippet\":\"Os indiv\\u00edduos Racionais s\\u00e3o focados na objetividade e racionalidade, frequentemente desconsiderando emo\\u00e7\\u00f5es a favor da l\\u00f3gica. Eles tendem a valorizar mais a efic\\u00e1cia do que a harmonia social.\",\"imageAlt\":\"Uma cena que mostra uma menina e um menino. Ele se apresenta e ela analisa o comportamento dele, com um bal\\u00e3o de pensamento cheio de caixas de sele\\u00e7\\u00e3o acima da cabe\\u00e7a dela.\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/theory\\/traits\\/16personalities_trait_thinking.svg\"},{\"key\":\"prospecting\",\"label\":\"T\\u00e1ticas\",\"color\":\"purple\",\"score\":47,\"pct\":74,\"trait\":\"Desbravador\",\"link\":\"https:\\/\\/www.16personalities.com\\/articles\\/tactics-judging-vs-prospecting\",\"reverse\":false,\"reversed\":true,\"titles\":[\"Planejador\",\"Desbravador\"],\"description\":\"Os indiv\\u00edduos Adapt\\u00e1veis s\\u00e3o muito bons em improvisar e se adaptar a oportunidades. Tendem a ser n\\u00e3o conformistas flex\\u00edveis que valorizam a novidade acima da estabilidade.\",\"snippet\":\"Os indiv\\u00edduos Adapt\\u00e1veis s\\u00e3o muito bons em improvisar e se adaptar a oportunidades. Tendem a ser n\\u00e3o conformistas flex\\u00edveis que valorizam a novidade acima da estabilidade.\",\"imageAlt\":\"Uma cena que mostra um casal comprando v\\u00e1rios produtos em promo\\u00e7\\u00e3o.\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/theory\\/traits\\/16personalities_trait_prospecting.svg\"},{\"key\":\"turbulent\",\"label\":\"Identidade\",\"color\":\"red\",\"score\":1,\"pct\":51,\"trait\":\"Turbulento\",\"link\":\"https:\\/\\/www.16personalities.com\\/articles\\/identity-assertive-vs-turbulent\",\"reverse\":false,\"reversed\":true,\"titles\":[\"Assertivo\",\"Turbulento\"],\"description\":\"As pessoas turbulentas s\\u00e3o autoconscientes e sens\\u00edveis ao estresse. Existe um sentido de urg\\u00eancia associado \\u00e0s suas emo\\u00e7\\u00f5es e tendem a ser motivadas pelo sucesso, perfeccionistas e \\u00e1vidas por melhorar.\",\"snippet\":\"As pessoas turbulentas s\\u00e3o autoconscientes e sens\\u00edveis ao estresse. Existe um sentido de urg\\u00eancia associado \\u00e0s suas emo\\u00e7\\u00f5es e tendem a ser motivadas pelo sucesso, perfeccionistas e \\u00e1vidas por melhorar.\",\"imageAlt\":\"Uma cena que mostra um aluno estressado tentando concluir uma tese tarde da noite, em meio a v\\u00e1rios esbo\\u00e7os espalhados.\",\"imageSrc\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/theory\\/traits\\/16personalities_trait_turbulent.svg\"}],\"traitsTitle\":\"Tra\\u00e7os de personalidade\",\"lastTestAt\":null,\"factsheetUrl\":\"https:\\/\\/www.16personalities.com\\/static\\/factsheets\\/L\\u00f3gico (Turbulent) (Male).pdf\"},\"personality\":\"L\\u00f3gico (INTP-T)\",\"personalityShort\":\"L\\u00f3gico\",\"personalityLink\":\"https:\\/\\/www.16personalities.com\\/br\\/personalidade-intp\",\"personalityCode\":\"INTP-T\",\"typeCode\":\"INTP\",\"typeArticle\":\"a\",\"fullCodeHtml\":\"<span class=\\\"type__code\\\">(INTP-T)<\\/span>\",\"personalityNice\":\"L\\u00f3gico (INTP-T) (INTP-T)\",\"personalityNiceShort\":\"L\\u00f3gico (INTP-T)\",\"score1\":\"51% Introvertido\",\"score2\":\"61% Intuitivo\",\"score3\":\"57% Anal\\u00edtico\",\"score4\":\"74% Desbravador\",\"score5\":\"51% Turbulento\",\"variant\":\"turbulent\",\"scores\":[2,22,13,47,1],\"traitPcts\":[51,61,57,74,51],\"traitPctString\":\"51% Introvertido, 61% Intuitivo, 57% Anal\\u00edtico, 74% Desbravador, 51% Turbulento\",\"strategy\":\"Constant Improvement\",\"role\":\"Analyst\",\"traits\":{\"energy\":\"Introvertido\",\"mind\":\"Intuitivo\",\"nature\":\"Anal\\u00edtico\",\"tactics\":\"Desbravador\",\"identity\":\"Turbulento\"},\"factsheetUrl\":\"https:\\/\\/www.16personalities.com\\/static\\/factsheets\\/L\\u00f3gico (Turbulent) (Male).pdf\",\"avatarAlt\":\"Avatar para INTP\",\"avatar\":{\"isCustom\":false,\"isDynamic\":true,\"dynamicPath\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/personality-types\\/avatars\\/faces\\/main-intp-male.svg\",\"staticFacePath\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/personality-types\\/avatars\\/faces\\/intp-logician-s3-v1-male.svg?v=3\",\"staticBodyPath\":\"https:\\/\\/www.16personalities.com\\/static\\/images\\/personality-types\\/avatars\\/intp-logician-male.svg?v=3\",\"staticBodyJson\":\"https:\\/\\/www.16personalities.com\\/static\\/animations\\/avatars\\/all\\/logician-male.json\",\"classes\":\"tr--free tp--intp g--m avatar--dynamic tn--3\",\"alt\":\"Avatar para INTP\"},\"gender\":\"male\",\"possessivePronoun\":\"his\",\"compareUrl\":\"https:\\/\\/www.16personalities.com\\/profiles\\/compare\\/intp-t\\/m\\/pswed0bd\",\"color\":\"purple\"}', 'Eu sou Thiago, mas a maioria de pessoas me chamam de Thigas, eu sempre gostei de computadores desde quando era criança e ainda gosto e quero seguir esta carreira.', '[\"me distraio f\\u00e1cil\",\"falta de dedica\\u00e7\\u00e3o\",\"\",\"\"]', '[\"me dedico muito quando \\u00e9 uma coisa que gosto\",\"mente de programdor\",\"\",\"\"]', 'Estudante na escola SESI', 'Mudar a vida de outros por meio da arte', 'Ter tempo para fazer as coisas que gosto de verdade');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
