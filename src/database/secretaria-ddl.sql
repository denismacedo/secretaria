
--
-- Table structure for table `bloco`
--

CREATE TABLE IF NOT EXISTS `bloco` (
  `numero_bloco` char(4) NOT NULL,
  `pessoa_juridica` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_juridica`,`numero_bloco`),
  KEY `if11bloco` (`pessoa_juridica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `boleto`
--

CREATE TABLE IF NOT EXISTS `boleto` (
  `codigo` int(11) NOT NULL,
  `nosso_nro` varchar(30) NOT NULL,
  `inscricao` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor` decimal(15,2) NOT NULL,
  `pago` char(1) DEFAULT NULL,
  `data_pago` date DEFAULT NULL,
  `valor_pago` decimal(15,2) DEFAULT NULL,
  `data_vencimento` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_boleto_inscricao` (`inscricao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `capacitante`
--

CREATE TABLE IF NOT EXISTS `capacitante` (
  `evento` int(11) NOT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_fisica`,`evento`),
  KEY `capacitante_ie1` (`pessoa_fisica`),
  KEY `capacitante_ie2` (`evento`),
  KEY `if13capacitante` (`evento`),
  KEY `if8capacitante` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `caracteristica_pf`
--

CREATE TABLE IF NOT EXISTS `caracteristica_pf` (
  `tipo_pf` int(11) NOT NULL,
  `pessoa_caracterizada` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_caracterizada`,`tipo_pf`),
  KEY `caracteristicas_pf_ie` (`pessoa_caracterizada`),
  KEY `if28caracteristica_pf` (`tipo_pf`),
  KEY `if32caracteristica_pf` (`pessoa_caracterizada`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `unidade_da_federacao` char(2) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `pais` char(2) NOT NULL,
  PRIMARY KEY (`unidade_da_federacao`,`pais`,`nome`),
  KEY `if153cidade` (`unidade_da_federacao`,`pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comissao`
--

CREATE TABLE IF NOT EXISTS `comissao` (
  `codigo` int(11) NOT NULL,
  `instituto` int(11) DEFAULT NULL,
  `nome` varchar(80) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `comissao_ie1` (`instituto`),
  KEY `comissao_ie2` (`nome`),
  KEY `if34comissao` (`instituto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `componente_comissao`
--

CREATE TABLE IF NOT EXISTS `componente_comissao` (
  `comissao` int(11) NOT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  `inicio` date NOT NULL,
  PRIMARY KEY (`comissao`,`pessoa_fisica`,`inicio`),
  KEY `componenete_comisao_ie1` (`comissao`),
  KEY `componenete_comisao_ie2` (`pessoa_fisica`),
  KEY `if69componente_comissao` (`comissao`),
  KEY `if70componente_comissao` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `componente_instituto`
--

CREATE TABLE IF NOT EXISTS `componente_instituto` (
  `instituto` int(11) NOT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `pessoa_juridica` int(11) NOT NULL,
  PRIMARY KEY (`instituto`,`pessoa_fisica`,`pessoa_juridica`,`inicio`),
  KEY `componentes_instituto_ie1` (`instituto`),
  KEY `componentes_instituto_ie2` (`pessoa_fisica`),
  KEY `if36componente_instituto` (`instituto`),
  KEY `if37componente_instituto` (`pessoa_juridica`),
  KEY `if39componente_instituto` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuracao_cracha`
--

CREATE TABLE IF NOT EXISTS `configuracao_cracha` (
  `evento` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tamanho_fonte` int(11) NOT NULL,
  `largura` decimal(5,2) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `margem_superior` decimal(5,2) NOT NULL,
  `margem_esquerda` decimal(5,2) NOT NULL,
  PRIMARY KEY (`evento`,`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuracao_pagamento`
--

CREATE TABLE IF NOT EXISTS `configuracao_pagamento` (
  `evento` int(11) NOT NULL,
  `ocorrencia` int(11) NOT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `conta_corrente` varchar(10) DEFAULT NULL,
  `titular` varchar(50) DEFAULT NULL,
  `convenio` varchar(12) DEFAULT NULL,
  `gera_boleto` char(1) NOT NULL,
  `texto_informativo` varchar(254) DEFAULT NULL,
  `banco` varchar(40) DEFAULT NULL,
  `texto_valor_adulto` varchar(100) DEFAULT NULL,
  `texto_valor_crianca` varchar(100) DEFAULT NULL,
  `valor_crianca` decimal(15,2) DEFAULT NULL,
  `valor_adulto` decimal(15,2) DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `detalhe_forma_pagamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `email` varchar(80) NOT NULL,
  `tipo_email` int(11) NOT NULL,
  `pessoa_fisica` int(11) DEFAULT NULL,
  `pessoa_juridica` int(11) DEFAULT NULL,
  UNIQUE KEY `email_ak` (`email`),
  KEY `email_ie1` (`pessoa_fisica`),
  KEY `email_ie2` (`pessoa_juridica`),
  KEY `if14email` (`pessoa_fisica`),
  KEY `if29email` (`pessoa_juridica`),
  KEY `if35email` (`tipo_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emailtodelete`
--

CREATE TABLE IF NOT EXISTS `emailtodelete` (
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `sigla` char(2) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `pais` char(2) NOT NULL,
  PRIMARY KEY (`sigla`,`pais`),
  KEY `if42estado` (`pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `codigo` int(11) NOT NULL,
  `tipo_evento` int(11) NOT NULL,
  `qualif_evento` int(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `restricao_idade_inicio` int(11) DEFAULT NULL,
  `restricao_idade_fim` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `eventos_ak` (`codigo`,`qualif_evento`,`tipo_evento`),
  KEY `if33evento` (`qualif_evento`),
  KEY `classifica_evento` (`tipo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inscricao`
--

CREATE TABLE IF NOT EXISTS `inscricao` (
  `evento` int(11) NOT NULL,
  `ocorrencia` int(11) NOT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_atualizacao` date DEFAULT NULL,
  `usuario_atualizacao` varchar(20) DEFAULT NULL,
  `usuario_insercao` varchar(20) DEFAULT NULL,
  `tipo_alojamento` int(11) DEFAULT NULL,
  `flag_trabalhador` char(1) NOT NULL DEFAULT 'N',
  `nro_inscricao` int(11) DEFAULT NULL,
  `flag_presente` char(1) DEFAULT NULL,
  `cracha_impresso` char(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `inscricao_chave` (`evento`,`ocorrencia`,`pessoa_fisica`),
  KEY `if50inscricao` (`evento`,`ocorrencia`),
  KEY `if51inscricao` (`pessoa_fisica`),
  KEY `fk_tipo_alojamento` (`tipo_alojamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instituto`
--

CREATE TABLE IF NOT EXISTS `instituto` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ocorrencia`
--

CREATE TABLE IF NOT EXISTS `ocorrencia` (
  `codigo` int(11) NOT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `evento` int(11) NOT NULL,
  `periodicidade` int(11) DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `responsavel` varchar(80) DEFAULT NULL,
  `ocorrencia_geradora` int(11) DEFAULT NULL,
  `concafras_geradora` int(11) DEFAULT NULL,
  `nome` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`evento`,`codigo`),
  KEY `if27ocorrencia` (`evento`),
  KEY `if41ocorrencia` (`ocorrencia_geradora`,`concafras_geradora`),
  KEY `ocorrencia_ie2` (`concafras_geradora`,`ocorrencia_geradora`),
  KEY `ocorrencia_ie3` (`concafras_geradora`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `origem`
--

CREATE TABLE IF NOT EXISTS `origem` (
  `pessoa_fisica` int(11) NOT NULL,
  `evento` int(11) DEFAULT NULL,
  `data_registro` date NOT NULL,
  `pessoa_juridica` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_fisica`,`pessoa_juridica`,`data_registro`),
  KEY `if11origem` (`pessoa_fisica`),
  KEY `if19origem` (`pessoa_juridica`),
  KEY `if35origem` (`evento`),
  KEY `origem_ie` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `sigla` char(2) NOT NULL,
  `nome` varchar(80) NOT NULL,
  PRIMARY KEY (`sigla`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `condicao_pagamento` smallint(6) DEFAULT NULL,
  `ocorrencia` int(11) NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `evento` int(11) NOT NULL,
  `sub_ocorrencia` int(11) NOT NULL,
  `inscricao` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`sub_ocorrencia`,`inscricao`),
  KEY `if10participante` (`ocorrencia`,`evento`,`sub_ocorrencia`),
  KEY `if52participante` (`inscricao`),
  KEY `participante_ie2` (`evento`,`ocorrencia`,`sub_ocorrencia`),
  KEY `participante_ie3` (`evento`,`ocorrencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participante_opcao`
--

CREATE TABLE IF NOT EXISTS `participante_opcao` (
  `evento` int(11) NOT NULL,
  `ocorrencia` int(11) NOT NULL,
  `sub_ocorrencia` int(11) NOT NULL,
  `inscricao` int(11) NOT NULL,
  `prioridade` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`sub_ocorrencia`,`inscricao`),
  KEY `if55participante_opcao` (`evento`,`ocorrencia`,`sub_ocorrencia`),
  KEY `if56participante_opcao` (`inscricao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `particularidade`
--

CREATE TABLE IF NOT EXISTS `particularidade` (
  `doenca` varchar(200) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `medicamento` varchar(200) DEFAULT NULL,
  `observacao` varchar(1000) DEFAULT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_fisica`,`codigo`),
  KEY `if12particularidade` (`pessoa_fisica`),
  KEY `particularidades_ie` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patrocinador`
--

CREATE TABLE IF NOT EXISTS `patrocinador` (
  `promotor` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `ocorrencia` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`promotor`),
  KEY `if38patrocinador` (`promotor`),
  KEY `if42patrocinador` (`evento`,`ocorrencia`),
  KEY `patrocinador_ie` (`evento`,`ocorrencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_fisica`
--

CREATE TABLE IF NOT EXISTS `pessoa_fisica` (
  `nome` varchar(80) NOT NULL,
  `sexo` char(1) NOT NULL,
  `rua_ou_quadra` varchar(80) DEFAULT NULL,
  `complemento_ou_conjunto` varchar(80) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `alegria_crista` char(1) DEFAULT NULL,
  `dirigente_centro` char(1) DEFAULT NULL,
  `profissao` varchar(60) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `responsavel` int(11) DEFAULT NULL,
  `nome_mae` varchar(80) DEFAULT NULL,
  `unidade_da_federacao` char(2) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `pais` char(2) DEFAULT NULL,
  `data_insercao` date DEFAULT NULL,
  `usuario_insercao` varchar(20) DEFAULT NULL,
  `data_atualizacao` date DEFAULT NULL,
  `usuario_atualizacao` varchar(20) DEFAULT NULL,
  `tipo_pf` int(11) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `apelido` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `IX_NOME_SEXO_DT` (`nome`,`sexo`,`data_nasc`),
  KEY `if154pessoa_fisica` (`unidade_da_federacao`,`cidade`,`pais`),
  KEY `if16pessoa_fisica` (`responsavel`),
  KEY `pessoa_fisica_ie` (`nome`),
  KEY `cidade_localiza_pf` (`unidade_da_federacao`,`pais`,`cidade`),
  KEY `fk_pf_tipo_pf` (`tipo_pf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_fisica_telefone`
--

CREATE TABLE IF NOT EXISTS `pessoa_fisica_telefone` (
  `pessoa_fisica` int(11) NOT NULL,
  `ddd` char(2) NOT NULL,
  `numero` char(8) NOT NULL,
  PRIMARY KEY (`pessoa_fisica`,`ddd`,`numero`),
  KEY `if40pessoa_fisica_telefone` (`pessoa_fisica`),
  KEY `if41pessoa_fisica_telefone` (`ddd`,`numero`),
  KEY `pessoa_fisica_telefones_ie` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_juridica`
--

CREATE TABLE IF NOT EXISTS `pessoa_juridica` (
  `cgc` int(11) DEFAULT NULL,
  `tipo_pj` int(11) NOT NULL,
  `razao_social` varchar(80) DEFAULT NULL,
  `nome` varchar(80) NOT NULL,
  `rua_ou_quadra` varchar(80) DEFAULT NULL,
  `complemento_ou_conjunto` varchar(80) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `unidade_da_federacao` char(2) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `pais` char(2) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `possui_cfas` char(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `pessoa_juridica_chave` (`tipo_pj`,`nome`,`rua_ou_quadra`,`complemento_ou_conjunto`,`bairro`,`cidade`,`unidade_da_federacao`),
  KEY `if41pessoa_juridica` (`unidade_da_federacao`,`cidade`,`pais`),
  KEY `pessoa_juridica_ie` (`nome`),
  KEY `localiza_pj` (`unidade_da_federacao`,`pais`,`cidade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `ocorrencia` int(11) NOT NULL,
  `pessoa_fisica` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `sub_ocorrencia` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`sub_ocorrencia`,`pessoa_fisica`),
  KEY `if23professor` (`pessoa_fisica`),
  KEY `if40professor` (`ocorrencia`,`evento`,`sub_ocorrencia`),
  KEY `professor_ie1` (`evento`,`ocorrencia`,`sub_ocorrencia`),
  KEY `professor_ie2` (`evento`,`ocorrencia`),
  KEY `professor_ie3` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualificacao_de_evento`
--

CREATE TABLE IF NOT EXISTS `qualificacao_de_evento` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `tipo_evento` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `if47qualificacao_de_evento` (`tipo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `andar` varchar(8) NOT NULL,
  `numero_sala` varchar(60) NOT NULL,
  `numero_bloco` varchar(60) NOT NULL,
  `capacidade` int(11) DEFAULT NULL,
  `pessoa_juridica` int(11) NOT NULL,
  PRIMARY KEY (`pessoa_juridica`,`numero_bloco`,`andar`,`numero_sala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_ocorrencia`
--

CREATE TABLE IF NOT EXISTS `sub_ocorrencia` (
  `ocorrencia` int(11) NOT NULL,
  `pessoa_juridica` int(11) DEFAULT NULL,
  `numero_bloco` varchar(60) DEFAULT NULL,
  `andar` varchar(8) DEFAULT NULL,
  `numero_sala` varchar(60) DEFAULT NULL,
  `capacidade` int(11) DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `evento` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nome` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`codigo`),
  KEY `if28sub_ocorrencia` (`ocorrencia`,`evento`),
  KEY `if36sub_ocorrencia` (`numero_bloco`,`andar`,`numero_sala`,`pessoa_juridica`),
  KEY `sub_ocorrencia_ie1` (`ocorrencia`),
  KEY `sala_possui_sub_ocorrencia` (`pessoa_juridica`,`numero_bloco`,`andar`,`numero_sala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telefone`
--

CREATE TABLE IF NOT EXISTS `telefone` (
  `ddd` char(2) NOT NULL,
  `numero` char(8) NOT NULL,
  `tipo_telefone` int(11) NOT NULL,
  `pessoa_juridica` int(11) DEFAULT NULL,
  PRIMARY KEY (`ddd`,`numero`),
  KEY `if23telefone` (`pessoa_juridica`),
  KEY `if37telefone` (`tipo_telefone`),
  KEY `telefones_ie` (`pessoa_juridica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_alojamento`
--

CREATE TABLE IF NOT EXISTS `tipo_alojamento` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(80) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `unique_tipo` (`descricao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_email`
--

CREATE TABLE IF NOT EXISTS `tipo_email` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_evento`
--

CREATE TABLE IF NOT EXISTS `tipo_evento` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `caracteristica` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_pf`
--

CREATE TABLE IF NOT EXISTS `tipo_pf` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_pj`
--

CREATE TABLE IF NOT EXISTS `tipo_pj` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_telefone`
--

CREATE TABLE IF NOT EXISTS `tipo_telefone` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `pessoa_fisica` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `usuario_ak` (`login`),
  KEY `if88usuario` (`pessoa_fisica`),
  KEY `usuario_ie` (`pessoa_fisica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_ocorrencia`
--

CREATE TABLE IF NOT EXISTS `usuario_ocorrencia` (
  `ocorrencia` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`ocorrencia`,`usuario`),
  KEY `if89usuario_ocorrencia` (`ocorrencia`,`evento`),
  KEY `if90usuario_ocorrencia` (`usuario`),
  KEY `usuario_ocorrencia_ie` (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
