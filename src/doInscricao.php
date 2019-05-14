<?php 
session_start();

require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 

require_once("sql/classPF.php"); 
require_once("sql/classOcorrencia.php"); 
require_once("sql/classEvento.php"); 
require_once("sql/classInscricao.php"); 
require_once("sql/classTipoAlojamento.php"); 
require_once("sql/classParticipante.php"); 
require_once("sql/classCracha.php"); 
require_once("sql/classCidade.php"); 
require_once("cursoBean.php"); 

?>


<?php

$metodo = $_GET["method"];

if ($metodo == "init") {

	init();
	
} else if ($metodo == "save") {
	
	salvaInscricao();
	
} else if ($metodo == "initCracha") {
	
	initCracha();
	
} else if ($metodo == "printCracha") {

	printCracha();

} else if ($metodo == "searchCidadeByNome") {

	searchCidadeByNome();
	
} else if ($metodo == "salvar") {

	salvar();	
} else if ($metodo == "confirmPresenca") {

	confirmPresenca();	
} else if ($metodo == "excluir") {

	excluir();
} else if ($metodo == "printCrachaVarios") {

	printCrachaVarios();
}

function init() {
	exibeTelaInscricao("", "");
}

/**
 * EXIBE A TELA DE INSCRICAO
 */
function exibeTelaInscricao($tipoMsg, $msg) {

	$codPF = getPost("codPF");
	
	// Instancia o objeto PF
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	// Instancia o objeto evento
	$objEvento = new classEvento();
	$objEvento = $objEvento->findByCodigo($_SESSION["EVENTO_SESSION"]);

	// Instancia o objeto ocorrencia para pegar a data de inicio do evento
	$objOcorrencia = new classOcorrencia();
	$objOcorrencia = $objOcorrencia->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	
	// Calcula a idade da pessoa na data do evento
	$idadePF = dateDiff($objPF->data_nasc, $objOcorrencia->inicio);

	if ($_SESSION["OCORRENCIA_SESSION"] != "" && $_SESSION["EVENTO_SESSION"] != "") {
		$objOcorrencia = new classOcorrencia();
		$objInscricao = new classInscricao();
		$staticInsc = new classInscricao();
		$objTipoAlojamento = new classTipoAlojamento();
		
		
		// BUSCA A INSCRICAO *********************
		$objInscricao = $staticInsc->findInscricaoByPFEvento($codPF, $_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);
		
		
		// MONTA OS ALOJAMENTOS
		$resultado = $objTipoAlojamento->findAll();
		$selectTipoAlojamento = "<select name='tipoAlojamento' id='tipoAlojamento'><option value=''></option>";
		$linhas = mysql_num_rows($resultado);
		for ($i = 0; $i < $linhas; $i++) {
			$strSel = "";
			
			if (isset($objInscricao) && $objInscricao != NULL) {
				if ($objInscricao->tipo_alojamento == mysql_result($resultado, $i, 0)) {
					$strSel = "SELECTED";
				}
			}
			$selectTipoAlojamento .= "<option value='".mysql_result($resultado, $i, 0)."' ".$strSel.">"
			.mysql_result($resultado, $i, 1)."</option>";
		}
		$selectTipoAlojamento .= "</select>";
		
		
		// MONTA OPCOES DE IDIOMA PARA CONCAFRAS MUNDIAL
		if ($objEvento->tipoEvento == 11) {
			$arrayTemas = array("PORTUGUES", "ESPANHOL", "INGLES", "FRANCES", "ESPERANTO");
			
			// MONTA AS OPCOES DE TEMA
			$selectIdioma = "<select name='idioma' id='idioma'></option>";
			$countTemas = count($arrayTemas);

			for ($i = 0; $i < $countTemas; $i++) {
				$strSel = "";
				
				if (isset($objInscricao) && $objInscricao != NULL) {
					
					if ($objInscricao->idioma_tema_central == $arrayTemas[$i]) {
						$strSel = "SELECTED";
					}
				}
				//echo $arrayTemas($i);
				$selectIdioma .= "<option value='".$arrayTemas[$i]."' ".$strSel.">".$arrayTemas[$i]."</option>";
			}
			
			$selectIdioma .= "</select>";
		}
		
		// PARTICIPANTES
		if (isset($objInscricao)) {
			$participantes = array();
			$resultado = $staticInsc->findParticipantes($objInscricao->codigo);
			$linhas = mysql_num_rows($resultado);
			
			for ($i = 0; $i < $linhas; $i++) {
				$objPart = new classParticipante();
				$objPart->evento = mysql_result($resultado, $i, "evento");
				$objPart->ocorrencia = mysql_result($resultado, $i, "ocorrencia");
				$objPart->sub_ocorrencia = mysql_result($resultado, $i, "sub_ocorrencia");
				$objPart->tipo_evento = mysql_result($resultado, $i, "tipo_evento");
				$objPart->qualif_evento = mysql_result($resultado, $i, "qualif_evento");
				
				$participantes[$i] = $objPart;
			}
		
			// PARTICIPANTE OPCAO
			$participantesOpcao = array('', '', '', '', '', '');
			$resultado = $objInscricao->findOpcoes($objInscricao->codigo);
			$linhas = mysql_num_rows($resultado);
			
			for ($i = 0; $i < $linhas; $i++) {
				$objPart = new classParticipante();
				$objPart->evento = mysql_result($resultado, $i, "evento");
				$objPart->ocorrencia = mysql_result($resultado, $i, "ocorrencia");
				$objPart->sub_ocorrencia = mysql_result($resultado, $i, "sub_ocorrencia");
				$objPart->tipo_evento = mysql_result($resultado, $i, "tipo_evento");
				$objPart->qualif_evento = mysql_result($resultado, $i, "qualif_evento");
				$objPart->prioridade = mysql_result($resultado, $i, "prioridade");
				
				$participantesOpcao[$i] = $objPart;

			}
		}

		
		// VERIFICA SE EH TRABALHADOR E SE TEM ALGUMA COMISSAO SELECIONADA
		if (isset($objInscricao) && $objInscricao != NULL && $objInscricao->flag_trabalhador == 'S') {
			$codComissao = "";
			for ($i = 0; $i < sizeof($participantes); $i++) {
				if ($participantes[$i] != "" && $participantes[$i]->tipo_evento == 8) {
					$codComissao = $participantes[$i]->evento."/".$participantes[$i]->ocorrencia;
					break;
				}
			}
		}
		
		// BUSCA AS COMISSOES *********************
		$resultado = $objOcorrencia->findComissoes($_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);
		
		$selectComissoes = "<select name='comissoes' id='comissoes'><option value=''></option>";
		$linhas = mysql_num_rows($resultado);
		for($i = 0; $i < $linhas; $i++) {
			$strSel = "";
			
			if (isset($codComissao) && $codComissao != "") {
				if ($codComissao == (mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1))) {
					$strSel = "SELECTED";
				}
			}
			
			if ((mysql_result($resultado, $i, "CAPACIDADE") - mysql_result($resultado, $i, "INSCRITOS")) <= 0) {
				$strEsgotado = " - ESGOTADO";
			} else {
				$strEsgotado = "";
			}
		
			$selectComissoes .= "<option value='".mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1)."' ".$strSel.">"
			.mysql_result($resultado, $i, 2).$strEsgotado."</option>";
		}
		
		$selectComissoes .= "</select>";
		
		
		// BUSCA OS TEMAS ESPECIFICOS *********************
		$resultado = $objOcorrencia->findTemasEspecificosForInscricao($_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"], $idadePF);
		
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
			$selectTemasEspecificos1 = "<option value=''></option>";
			$selectTemasEspecificos2 = "<option value=''></option>";
			$selectTemasEspecificos3 = "<option value=''></option>";
		}
		
		for($i = 0; $i < $linhas; $i++) {
				if ((mysql_result($resultado, $i, "CAPACIDADE") - mysql_result($resultado, $i, "INSCRITOS")) <= 0) {
					$strEsgotado = " - ESGOTADO";
					
				} else {
					$strEsgotado = "";
					
				}
			
				$strSel1 = "";
				$strSel2 = "";
				$strSel3 = "";
			
				for ($j = 0; $j < sizeof($participantes); $j++) {
					if ( ( $participantes[$j] != "" )
						&& ( $participantes[$j]->tipo_evento == 1 && $participantes[$j]->qualif_evento == 1) 
						&& (($participantes[$j]->evento."/".$participantes[$j]->ocorrencia) == mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1))) {
						$strSel1 = "SELECTED";
						break;
					}
				}
				
				if ($strEsgotado != "" && $strSel1 == "") {
					$disabled = " disabled";
					$style=" style='background-color: #ffe0e0;'";
				} else {
					$disabled = "";
					$style=" ";
					$strEsgotado = "";
				}
				
				
			
				$selectTemasEspecificos1 .= "<option value='".mysql_result($resultado, $i, 0)."/".
											mysql_result($resultado, $i, 1)."' ".$strSel1.$style.$disabled.">".
											mysql_result($resultado, $i, 2).$strEsgotado."</option>";
											
											
				for ($j = 0; $j < sizeof($participantesOpcao); $j++) {
								if ( ( $participantesOpcao[$j] != "" )
									&& ( $participantesOpcao[$j]->tipo_evento == 1 && $participantesOpcao[$j]->qualif_evento == 1) 
									&& ( ($participantesOpcao[$j]->evento."/".$participantesOpcao[$j]->ocorrencia) ==  mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1)) 
									&& $participantesOpcao[$j]->prioridade == 2) {
									$strSel2 = "SELECTED";
									break;
								}
							}
											
				$selectTemasEspecificos2 .= "<option value='".mysql_result($resultado, $i, 0)."/".
											mysql_result($resultado, $i, 1)."' ".$strSel2.$style.$disabled.">".
											mysql_result($resultado, $i, 2).$strEsgotado."</option>";
											
				for ($j = 0; $j < sizeof($participantesOpcao); $j++) {
											if ( ( $participantesOpcao[$j] != "" )
												&& ( $participantesOpcao[$j]->tipo_evento == 1 && $participantesOpcao[$j]->qualif_evento == 1) 
												&& ( ($participantesOpcao[$j]->evento."/".$participantesOpcao[$j]->ocorrencia) ==  mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1)) 
												&& $participantesOpcao[$j]->prioridade == 3) {
									$strSel3 = "SELECTED";
									break;
								}
							}
											
				$selectTemasEspecificos3 .= "<option value='".mysql_result($resultado, $i, 0)."/".
											mysql_result($resultado, $i, 1)."' ".$strSel3.$style.$disabled.">".
											mysql_result($resultado, $i, 2).$strEsgotado."</option>";
		}
		
		// BUSCA OS TEMAS ATUAIS *********************
		$resultado = $objOcorrencia->findTemasAtuaisForInscricao($_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"], $idadePF);
		
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
			$selectTemasAtuais1 = "<option value=''></option>";
		$selectTemasAtuais2 = "<option value=''></option>";
		$selectTemasAtuais3 = "<option value=''></option>";
		}
		
		for($i = 0; $i < $linhas; $i++) {
		
			if ((mysql_result($resultado, $i, "CAPACIDADE") - mysql_result($resultado, $i, "INSCRITOS")) <= 0) {
				$strEsgotado = " - ESGOTADO";
				$style=" style='background-color: #FF6666;'";
			} else {
				$strEsgotado = "";
				$style = "";
			}
			
			$strSel1 = "";
			$strSel2 = "";
			$strSel3 = "";
		
			for ($j = 0; $j < sizeof($participantes); $j++) {
				if ( ( $participantes[$j] != "" )
					&& ( $participantes[$j]->tipo_evento == 1 && $participantes[$j]->qualif_evento == 2) 
					&& (($participantes[$j]->evento."/".$participantes[$j]->ocorrencia) == mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1))) {
					$strSel1 = "SELECTED";
					break;
				}
			}
			
			if ($strEsgotado != "" && $strSel1 == "") {
				$disabled = " disabled";
				$style=" style='background-color: #ffe0e0;'";
			} else {
				$disabled = "";
				$style=" ";
				$strEsgotado = "";
			}
			
			
			
			$selectTemasAtuais1 .= "<option value='".mysql_result($resultado, $i, 0)."/".
										mysql_result($resultado, $i, 1)."' ".$strSel1.$style.$disabled.">".
										mysql_result($resultado, $i, 2).$strEsgotado."</option>";
										
										
			for ($j = 0; $j < sizeof($participantesOpcao); $j++) {
							if ( ( $participantesOpcao[$j] != "" )
								&& ( $participantesOpcao[$j]->tipo_evento == 1 && $participantesOpcao[$j]->qualif_evento == 2) 
								&& ( ($participantesOpcao[$j]->evento."/".$participantesOpcao[$j]->ocorrencia) ==  mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1)) 
								&& $participantesOpcao[$j]->prioridade == 2) {
								$strSel2 = "SELECTED";
								break;
							}
						}
										
			$selectTemasAtuais2 .= "<option value='".mysql_result($resultado, $i, 0)."/".
										mysql_result($resultado, $i, 1)."' ".$strSel2.$style.$disabled.">".
										mysql_result($resultado, $i, 2).$strEsgotado."</option>";
										
			for ($j = 0; $j < sizeof($participantesOpcao); $j++) {
										if ( ( $participantesOpcao[$j] != "" )
											&& ( $participantesOpcao[$j]->tipo_evento == 1 && $participantesOpcao[$j]->qualif_evento == 2) 
											&& ( ($participantesOpcao[$j]->evento."/".$participantesOpcao[$j]->ocorrencia) ==  mysql_result($resultado, $i, 0)."/".mysql_result($resultado, $i, 1)) 
											&& $participantesOpcao[$j]->prioridade == 3) {
								$strSel3 = "SELECTED";
								break;
							}
						}
										
			$selectTemasAtuais3 .= "<option value='".mysql_result($resultado, $i, 0)."/".
										mysql_result($resultado, $i, 1)."' ".$strSel3.$style.$disabled.">".
										mysql_result($resultado, $i, 2).$strEsgotado."</option>";
		}
		
		if ($tipoMsg == "INFO") {
			$INFO_MSG = $msg;
		} else if ($tipoMsg == "ERROR") {
			$ERROR_MSG = $msg;
		}
		

	} else {
	
		$ERROR_MSG = "O EVENTO N&Atilde;O FOI IDENTIFICADO!";
		
	}

	include("inscricao.php");
}

function salvaInscricao() {

	$codPF = getPost("codPF");
	$codInscricao = getPost("codInscricao");
	$nroInscricao = getPost("nroInscricao");
	$tipoAlojamento = getPost("tipoAlojamento");
	$idioma = getPost("idioma");
	$flag_trabalhador = getPost("flag_trabalhador");
	$comissoes = getPost("comissoes");
	$temasAtuaisOp1 = getPost("temasAtuaisOp1");
	$temasAtuaisOp2 = getPost("temasAtuaisOp2");
	$temasAtuaisOp3 = getPost("temasAtuaisOp3");
	$temasEspecificosOp1 = getPost("temasEspecificosOp1");
	$temasEspecificosOp2 = getPost("temasEspecificosOp2");
	$temasEspecificosOp3 = getPost("temasEspecificosOp3");
	
	$objInscricao = new classInscricao();
	$objInscricao->codigo = $codInscricao;
	$objInscricao->pessoa_fisica = $codPF;
	$objInscricao->nro_inscricao = $nroInscricao;
	$objInscricao->tipo_alojamento = $tipoAlojamento;
	$objInscricao->idioma_tema_central = $idioma;
	$objInscricao->flag_trabalhador = $flag_trabalhador;
	$objInscricao->comissao = $comissoes;
	$objInscricao->temaAtual1 = $temasAtuaisOp1;
	$objInscricao->temaAtual2 = $temasAtuaisOp2;
	$objInscricao->temaAtual3 = $temasAtuaisOp3;
	$objInscricao->temaEspecifico1 = $temasEspecificosOp1;
	$objInscricao->temaEspecifico2 = $temasEspecificosOp2;
	$objInscricao->temaEspecifico3 = $temasEspecificosOp3;
	
	$objInscricao->usuario_insercao = $_SESSION["USER_SESSION"];
	if ($objInscricao->usuario_insercao == "") {
		$objInscricao->usuario_insercao = "SECRETARIA";
	}

	$objInscricao->evento = $_SESSION["EVENTO_SESSION"];
	$objInscricao->ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	$erro = "";
	if ($tipoAlojamento == "" || ($flag_trabalhador == 'S' && $comissoes == "")) {
		$erro = "OS CAMPOS ALOJAMENTO E COMISS&Atilde;O (CASO SEJA TRABALHADOR) S&Atilde;O OBRIGAT&Oacute;RIOS!";
	}
	
	if ($erro == "") {
		
		mysql_query("BEGIN");
		
		$retorno = $objInscricao->save();
		
		if ($retorno[0] >= 0) {
		
			$objInscricao = $retorno[1];
			
			mysql_query("COMMIT");
			
			exibeTelaInscricao("INFO", "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!");
			
		} else {
		
			mysql_query("ROLLBACK");
		
			exibeTelaInscricao("ERROR", $retorno[1]);
		}
		
	} else {
	
		exibeTelaInscricao("ERROR", $erro);

	}
}

function excluir() {
	
	$codPF = getPost("codPF");
	$codInscricao = getPost("codInscricao");
	$nroInscricao = getPost("nroInscricao");
	$tipoAlojamento = getPost("tipoAlojamento");
	$flag_trabalhador = getPost("flag_trabalhador");
	$comissoes = getPost("comissoes");
	$temasAtuaisOp1 = getPost("temasAtuaisOp1");
	$temasAtuaisOp2 = getPost("temasAtuaisOp2");
	$temasAtuaisOp3 = getPost("temasAtuaisOp3");
	$temasEspecificosOp1 = getPost("temasEspecificosOp1");
	$temasEspecificosOp2 = getPost("temasEspecificosOp2");
	$temasEspecificosOp3 = getPost("temasEspecificosOp3");
	
	$objInscricao = new classInscricao();
	$objInscricao->codigo = $codInscricao;
	$objInscricao->pessoa_fisica = $codPF;
	$objInscricao->nro_inscricao = $nroInscricao;
	$objInscricao->tipo_alojamento = $tipoAlojamento;
	$objInscricao->flag_trabalhador = $flag_trabalhador;
	$objInscricao->comissao = $comissoes;
	$objInscricao->temaAtual1 = $temasAtuaisOp1;
	$objInscricao->temaAtual2 = $temasAtuaisOp2;
	$objInscricao->temaAtual3 = $temasAtuaisOp3;
	$objInscricao->temaEspecifico1 = $temasEspecificosOp1;
	$objInscricao->temaEspecifico2 = $temasEspecificosOp2;
	$objInscricao->temaEspecifico3 = $temasEspecificosOp3;

	$objInscricao->evento = $_SESSION["EVENTO_SESSION"];
	$objInscricao->ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	$erro = "";
	
	if ($erro == "") {
		
		mysql_query("BEGIN");
		
		$retorno = $objInscricao->delete();
		
		if ($retorno[0] >= 0) {
		
			$objInscricao = $retorno[1];
			$objInscricao->codigo = NULL;
			
			mysql_query("COMMIT");
			
			exibeTelaInscricao("INFO", "INSCRI&Ccedil;&Atilde;O EXCLU&Iacute;DA COM SUCESSO! FECHA A TELA PARA COMPLETAR A OPERA&Ccedil;&Atilde;O.");
			
		} else {
		
			mysql_query("ROLLBACK");
		
			exibeTelaInscricao("ERROR", $retorno[1]);
		}
		
	} else {
	
		exibeTelaInscricao("ERROR", $erro);

	}
}


function initCracha() {

	$codPF = getPost("codPF");
	
	$objInscricao = new classInscricao();
	$codInscricao = $objInscricao->findCodInscricaoByPFEvento($codPF, $_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);

	$resultado = $objInscricao->findParticipantesCracha($codInscricao);
	
	// VARRE OS VALORES RETORNADOS E MONTA UM ARRAY DE CURSOS
	$cursos = array();
	
	$linhas = mysql_num_rows($resultado);
	
	for ($i = 0; $i < $linhas; $i++) {
		$objCurso = new cursoBean();
		
		$objCurso->tipo = mysql_result($resultado, $i, "tipo");
		if (mysql_result($resultado, $i, "qualificacao") != "") {
			$objCurso->tipo = $objCurso->tipo." - ".mysql_result($resultado, $i, "qualificacao");
		}
		$objCurso->nome = mysql_result($resultado, $i, "nome");
		$objCurso->bloco = mysql_result($resultado, $i, "numero_bloco");
		$objCurso->andar = mysql_result($resultado, $i, "andar");
		$objCurso->sala = mysql_result($resultado, $i, "numero_sala");
		$objCurso->codigo = mysql_result($resultado, $i, "evento")."/".mysql_result($resultado, $i, "ocorrencia")."/".mysql_result($resultado, $i, "sub_ocorrencia");
		
		$cursos[$i] = $objCurso;
	}

	include("cracha.php");
}

function printCrachaBKP() {

	$codInscricao = getPost("codInscricao");
	$codPF = getPost("codPF");

	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	
	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	
	// TRATA A DATA
	if (dateDiff($objPF->data_nasc, $objOco->inicio) < 12) {
		$inscricaoInfantil = true;
	} else {
		$inscricaoInfantil = false;
	}	
	
	// TRATA NOME DO CRACHA
	$nomeCracha = buildNomeCracha($objPF->nome, $objPF->apelido);
	
	$objInscricao = new classInscricao();
	
	$objInscricao = $objInscricao->findInscricaoByCodigo($codInscricao);
	
	$selecionados = array();
	
	if ( strstr(getPost("inscricoes"), ";")) {
		$selecionados = explode(";", getPost("inscricoes"));
	}
	
	
	$cursos = array();
	
	for ($i = 0; $i < sizeof($selecionados); $i++) {
		if ($selecionados[$i] != "") {
			list($evento, $ocorrencia, $subOcorrencia) = split('[/]', $selecionados[$i]);
	
			$resultado = $objInscricao->findParticipante($codInscricao, $evento, $ocorrencia, $subOcorrencia);
			$linhas = mysql_num_rows($resultado);
			
			if ($linhas > 0) {
				$objCurso = new cursoBean();
				
				$objCurso->nome = mysql_result($resultado, 0, "nome");
				
				if (mysql_result($resultado, 0, "qualificacao") != "") {
					$objCurso->nome = mysql_result($resultado, 0, "qualificacao")." - ".$objCurso->nome;
				}
				
				$objCurso->tipo = mysql_result($resultado, 0, "tipo");
				
				$objCurso->bloco = mysql_result($resultado, 0, "numero_bloco");
				$objCurso->andar = mysql_result($resultado, 0, "andar");
				$objCurso->sala = mysql_result($resultado, 0, "numero_sala");
			
				$cursos[$i] = $objCurso;
			}
		}
	}
	
	$objCracha = new classCracha();
	$objCracha = $objCracha->findCrachaByEvento($_SESSION["EVENTO_SESSION"],  $_SESSION["OCORRENCIA_SESSION"]);
	
	
	//include("printCracha".$_SESSION["EVENTO_SESSION"].".php");
	include("printCracha156.php");
}

function printCracha() {

	$codInscricao = getPost("codInscricao");
	$codPF = getPost("codPF");

	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$objInscricao = new classInscricao();
	$codInscricao = $objInscricao->findCodInscricaoByPFEvento($codPF, $_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);

	if ($codInscricao > 0) {
		$objInscricao = $objInscricao->findInscricaoByCodigo($codInscricao);
		
		$objCracha = new classCracha();
		$objCracha = $objCracha->findCrachaByEvento($_SESSION["EVENTO_SESSION"],  $_SESSION["OCORRENCIA_SESSION"]);
		
		$objCidade = new classCidade();
		$objCracha->objCidade = $objCidade->findByPK($objPF->pais, $objPF->unidade_da_federacao, $objPF->cidade);
		
		//echo $objCracha->objCidade->nomePais;
		
		$objCracha = buildObjCracha($objInscricao, $objPF, $objOco, $objCracha, true, true, true);
					
		// MARCA A INSCRICAO COMO IMPRESSA
		$objInscricao->confirmCrachaImpresso($objInscricao->codigo);
		
		if ($objCracha->idade < 7 && getPost("SPECIAL_PARAM") == "CRACHA_INFANTIL") {
			include("printCrachaInfantilUnico.php");
		} else {
			include("printCrachaUnico.php");
		}
	} else {
		$ERROR_MSG = "INSCRICAO NAO ENCONTRADA!";
		include("message.php");
	}
}

function buildObjCracha($objInscricao, $objPF, $objOco, $objCracha, $showCursos, $showComissao, $showSalas) {
	
	// TRATA A DATA
	$diff = dateDiff($objPF->data_nasc, $objOco->inicio);
	if ($diff < 12) {
		$tipoInscricao = "INFANTIL";
	} else if ($diff < 14) {
		$tipoInscricao = "JOVEM";
	} else {
		$tipoInscricao = "ADULTO";
	}
	$objCracha->idade = $diff;
		
	$nomeCracha = buildNomeCracha($objPF->nome, $objPF->apelido);
	
	$resultado = $objInscricao->findParticipantesCracha($objInscricao->codigo);
	
	// VARRE OS VALORES RETORNADOS E MONTA UM ARRAY DE CURSOS
	$cursos = array();
	$linhas = mysql_num_rows($resultado);
	$count = 0;
	for ($i = 0; $i < $linhas; $i++) {
		if ((mysql_result($resultado, $i, "cod_tipo_evento") == 1 && $showCursos)
		|| (mysql_result($resultado, $i, "cod_tipo_evento") == 8 && $showComissao)) {
			$objCurso = new cursoBean();
			$objCurso->nome = mysql_result($resultado, $i, "nome");
			if (mysql_result($resultado, $i, "qualificacao") != "" && $tipoInscricao != "INFANTIL") {
				$objCurso->nome = (mysql_result($resultado, $i, "qualificacao") == "TEMA ATUAL" ? "Atual" : "Especifico")." - ".$objCurso->nome;
			}
			
			$objCurso->nome = strtoupper($objCurso->nome);
			
			$objCurso->tipo = mysql_result($resultado, $i, "tipo");
			if ($showSalas) {
				$objCurso->bloco = mysql_result($resultado, $i, "numero_bloco");
				$objCurso->andar = mysql_result($resultado, $i, "andar");
				$objCurso->sala = mysql_result($resultado, $i, "numero_sala");
			}
			
			$cursos[$count] = $objCurso;
			$count++;
		}
	}
	
	$objCracha->objPF = $objPF;
	$objCracha->objInscricao = $objInscricao;
	$objCracha->tipoInscricao = $tipoInscricao;
	$objCracha->nomeCracha = $nomeCracha;
	$objCracha->cursos = $cursos;
	if ($tipoInscricao == "INFANTIL") {
		if ($objInscricao->contatoResponsavel != "") {
			$objCracha->responsavel = $objInscricao->contatoResponsavel;
		} else if ($objPF->objResponsavel != NULL && $objPF->objResponsavel != "") {
			$objCracha->responsavel = buildNomeCracha($objPF->objResponsavel->nome, $objPF->objResponsavel->apelido);
		}
	}
	
	return $objCracha;
}



function buildObjCrachaForVarios($objInscricao, $objPF, $objOco, $objCracha, $showCursos, $showComissao, $showSalas) {
	
	// TRATA A DATA
	$diff = dateDiff($objPF->data_nasc, $objOco->inicio);
	if ($diff < 12) {
		$tipoInscricao = "INFANTIL";
	} else if ($diff < 14) {
		$tipoInscricao = "JOVEM";
	} else {
		$tipoInscricao = "ADULTO";
	}
	$objCracha->idade = $diff;
		
	$nomeCracha = buildNomeCracha($objPF->nome, $objPF->apelido);
	
	$resultado = $objInscricao->findParticipantesCracha($objInscricao->codigo);
	
	// VARRE OS VALORES RETORNADOS E MONTA UM ARRAY DE CURSOS
	$cursos = array();
	$linhas = mysql_num_rows($resultado);
	$count = 0;
	for ($i = 0; $i < $linhas; $i++) {
		if ((mysql_result($resultado, $i, "cod_tipo_evento") == 1 && $showCursos)
		|| (mysql_result($resultado, $i, "cod_tipo_evento") == 8 && $showComissao)) {
			$objCurso = new cursoBean();
			$objCurso->nome = mysql_result($resultado, $i, "nome");
			if (mysql_result($resultado, $i, "qualificacao") != "" && $tipoInscricao != "INFANTIL") {
				$objCurso->nome = (mysql_result($resultado, $i, "qualificacao") == "TEMA ATUAL" ? "Atual" : "Especifico")." - ".$objCurso->nome;
			}
			
			$objCurso->nome = strtoupper($objCurso->nome);
			
			$objCurso->tipo = mysql_result($resultado, $i, "tipo");
			if ($showSalas) {
				$objCurso->bloco = mysql_result($resultado, $i, "numero_bloco");
				$objCurso->andar = mysql_result($resultado, $i, "andar");
				$objCurso->sala = mysql_result($resultado, $i, "numero_sala");
			}
			
			$cursos[$count] = $objCurso;
			$count++;
		}
	}
	
	$objCracha->objPF = $objPF;
	$objCracha->objInscricao = $objInscricao;
	$objCracha->tipoInscricao = $tipoInscricao;
	$objCracha->nomeCracha = $nomeCracha;
	$objCracha->cursos = $cursos;
	
	if ($tipoInscricao == "INFANTIL") {
		if ($objInscricao->contatoResponsavel != "") {
			$objCracha->responsavel = $objInscricao->contatoResponsavel;
		} else if ($objPF->objResponsavel != NULL && $objPF->objResponsavel != "") {
			$objCracha->responsavel = buildNomeCracha($objPF->objResponsavel->nome, $objPF->objResponsavel->apelido);
		}
	}
	
	return $objCracha;
}

function buildNomeCracha($nome, $apelido) {

	if ($apelido == "") {
		$nomeCracha = $nome;
	} else {
		$nomeCracha = $apelido;
	}

	$nomes = array();
	$nomes = explode(" ", $nomeCracha);
	
	$nomeCracha = $nomes[0]." ".$nomes[1];
	
	if ($nomes[2] != "DE" && $nomes[2] != "DA" && $nomes[2] != "DO" && $nomes[2] != "DAS" && $nomes[2] != "DOS" && $nomes[2] != "DI") {
		$nomeCracha .= " ".$nomes[2];
	}
	
	
	if (strlen($nomeCracha) > 18) {
		$nomeCracha = $nomes[0];
		
		if ($nomes[1] != "DE" && $nomes[1] != "DA" && $nomes[1] != "DO" && $nomes[1] != "DAS" && $nomes[1] != "DOS" && $nomes[1] != "DI") {
		
		$nomeCracha .= " ".$nomes[1];
		
		}
		
		if (strlen($nomeCracha) > 18) {
		
			$nomeCracha = $nomes[0];
		}
	}
	
	return $nomeCracha;
}


function printCrachaVarios() {
	$codInscricao = getPost("codInscricao");
	$situacao = getPost("situacao");
	$participante = getPost("participante");
	$conteudo = getPost("conteudo");
	$nomePF = getPost("nomePF");
	$impressos = getPost("impressos");
	$idade = getPost("idade");
	$idadeIni = getPost("idadeIni");
	$idadeFim = getPost("idadeFim");
	$dataIni = getPost("dataIni");
	$dataFim = getPost("dataFim");
	$ensalamento = getPost("ensalamento");
	$print = getPost("print");
	$crachaInfantil = getPost("crachaInfantil");
	$semCurso = getPost("semCurso");
	$vegetariano = getPost("vegetariano");

	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	
	$sql = "select a.codigo as cod_insc, a.nro_inscricao, b.codigo as codigo, b.nome, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais :selCountCurso from inscricao a :joinSemCurso  :joinBoleto, pessoa_fisica b, ocorrencia d
				where a.evento = ".$_SESSION["EVENTO_SESSION"]." and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo 
				and a.evento = d.evento
				and a.ocorrencia = d.codigo :vegetarianos :boletoNaoPagoSemBoleto
				:codInscricao :nomePF :impressos :participante :idade :idIni :idFim :dataIni :dataFim";
		
		if ($codInscricao != "") {
			$sql = str_replace(":nomePF", "", $sql);
			$sql = str_replace(":impressos", "", $sql);
			$sql = str_replace(":participante", "", $sql);
			$sql = str_replace(":idade", "", $sql);
			$sql = str_replace(":idIni", "", $sql);
			$sql = str_replace(":idFim", "", $sql);
			$sql = str_replace(":dataIni", "", $sql);
			$sql = str_replace(":dataFim", "", $sql);
			$sql = str_replace(":selCountCurso", "", $sql);
			$sql = str_replace(":joinBoleto", "", $sql);
			$sql = str_replace(":joinSemCurso", "", $sql);
			$sql = str_replace(":boletoNaoPagoSemBoleto", "", $sql);
			$sql = str_replace(":vegetarianos", "", $sql);
						
			$sql = str_replace(":codInscricao", " AND a.nro_inscricao = $codInscricao", $sql);
						
		} else {
			
			$sql = str_replace(":codInscricao", " ", $sql);
			
			if ($situacao == 'P') {
				$sql = str_replace(":joinBoleto", " INNER JOIN boleto c ON (a.codigo = c.inscricao AND c.pago = 'S') ", $sql);
			} else {
				$sql = str_replace(":joinBoleto", "", $sql);
			}

			if ($situacao == 'N') {
				$sql = str_replace(":boletoNaoPagoSemBoleto", " and a.codigo not in (select inscricao from boleto where pago = 'S') ", $sql);
			} else {
				$sql = str_replace(":boletoNaoPagoSemBoleto", "", $sql);
			}
	
			if ($participante != "" && $participante != "T") {
				if ($participante == 'B') {
					$sql = str_replace(":participante", " AND a.flag_trabalhador = 'S' ", $sql);
				} else if ($participante == 'C') {
					$sql = str_replace(":participante", " AND (a.flag_trabalhador = 'N' OR a.flag_trabalhador is NULL) ", $sql);
				}
			} else {
				$sql = str_replace(":participante", "", $sql);
			}
			if ($vegetariano == "S") {
				$sql = str_replace(":vegetarianos", " AND b.vegetariano = 'S' ", $sql);
			} else if ($vegetariano == "N") {
				$sql = str_replace(":vegetarianos", " AND (b.vegetariano = 'N' or b.vegetariano is NULL) ", $sql);
			} else {
				$sql = str_replace(":vegetarianos", " ", $sql);
			}
			
			if ($nomePF != "") {
				$sql = str_replace(":nomePF", " AND UPPER(b.nome) like UPPER('".$nomePF."%') ", $sql);
			} else {
				$sql = str_replace(":nomePF", "", $sql);
			}
			
			if ($impressos != "" && $impressos == 'N') {
				$sql = str_replace(":impressos", " AND (a.cracha_impresso <> 'S' OR a.cracha_impresso is null) ", $sql);
			} else {
				$sql = str_replace(":impressos", "", $sql);
			}
			
			if ($idade != "" && $idade != 'T') {
				if ($idade == 'C') {
					$sql = str_replace(":idade", " AND DATEDIFF(d.inicio,b.data_nasc)/365  < 12 ", $sql);
				} else if ($idade == 'J') {
					$sql = str_replace(":idade", " AND (DATEDIFF(d.inicio,b.data_nasc)/365  >= 12 AND DATEDIFF(d.inicio,b.data_nasc)/365  < 14) ", $sql);
				} else {
					$sql = str_replace(":idade", " AND DATEDIFF(d.inicio,b.data_nasc)/365  >= 14 ", $sql);
				}
			} else {
				$sql = str_replace(":idade", "", $sql);
			}
			
			
			if ($idadeIni != "") {
				$sql = str_replace(":idIni", " AND ((YEAR(d.inicio)-YEAR(b.data_nasc)) - (RIGHT(d.inicio,5)-RIGHT(b.data_nasc,5))) >= ".$idadeIni." ", $sql);
			} else {
				$sql = str_replace(":idIni", "", $sql);
			}
			if ($idadeFim != "") {
				$sql = str_replace(":idFim", " AND ((YEAR(d.inicio)-YEAR(b.data_nasc)) - (RIGHT(d.inicio,5)-RIGHT(b.data_nasc,5))) <= ".$idadeFim." ", $sql);
			} else {
				$sql = str_replace(":idFim", "", $sql);
			}
			
			if ($dataIni != "") {
				$sql = str_replace(":dataIni", " AND a.data_insercao >= '".getDBDate($dataIni)."' ", $sql);
			} else {
				$sql = str_replace(":dataIni", "", $sql);
			}
			if ($dataFim != "") {
				$sql = str_replace(":dataFim", " AND a.data_insercao <= '".getDBDate($dataFim)."' ", $sql);
			} else {
				$sql = str_replace(":dataFim", "", $sql);
			}
			
			if ($semCurso == "N" ) {
			$sql = str_replace(":selCountCurso", " , count(pa.inscricao) ", $sql);
			$sql = str_replace(":joinSemCurso", " INNER JOIN participante pa ON ( a.codigo = pa.inscricao ) INNER JOIN evento e ON (pa.evento = e.codigo and e.tipo_evento = 1) ", $sql);
			} else {
				$sql = str_replace(":selCountCurso", "", $sql);
				$sql = str_replace(":joinSemCurso", "", $sql);
			}
			
			$sql = $sql." group by a.codigo, a.nro_inscricao, b.codigo, b.nome, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais
					:groupSemCurso
					order by b.nome";
	
					
			if ($semCurso == "N" ) {
				$sql = str_replace(":groupSemCurso", " having count(pa.inscricao) > 0 ", $sql);
			} else {
				$sql = str_replace(":groupSemCurso", "", $sql);
			}
		
		}

		
		//echo $sql;

		$resultado = mysql_query($sql);

		$linhas = mysql_num_rows($resultado);
		$crachas = array();
		if ($linhas > 0) {
			if ($conteudo == 'T') {
				$showCursos = true;
				$showComissao = true;
			} else if ($conteudo == 'C') {
				$showCursos = true;
				$showComissao = false;
			} else if ($conteudo == 'S') {
				$showCursos = false;
				$showComissao = true;
			} else {
				$showCursos = false;
				$showComissao = false;
			}
			
			if ($ensalamento == 'S') {
				$showSalas = true;
			} else {
				$showSalas = false;
			}
		
			$cor = false;
			
			$objCracha = new classCracha();
			$objCracha = $objCracha->findCrachaByEvento($_SESSION["EVENTO_SESSION"],  $_SESSION["OCORRENCIA_SESSION"]);
				
			for ($i = 0; $i < $linhas; $i++) {
			
				$objPF = new classPF();
				$objPF = $objPF->findByCodigo(mysql_result($resultado, $i, "codigo"));
	
				$objInscricao = new classInscricao();
				//$objInscricao = $objInscricao->findInscricaoByCodigo(mysql_result($resultado, $i, "cod_insc"));
				$objInscricao->nro_inscricao = mysql_result($resultado, $i, "nro_inscricao");
				$objInscricao->codigo = mysql_result($resultado, $i, "cod_insc");
				
				$objCrachaClone = $objCracha->clone_cracha();
				
				$crachas[$i] = buildObjCrachaForVarios($objInscricao, $objPF, $objOco, $objCrachaClone, $showCursos, $showComissao, $showSalas);
				//echo $i."<br>";
				//flush();
				if ($print == 'S') {
					// MARCA A INSCRICAO COMO IMPRESSA
					$objInscricao->confirmCrachaImpresso($objInscricao->codigo);
				}
			}
		}
		
		if ($print == 'S') {
			if ($crachaInfantil == 'S') {
				include("printCrachaInfantilVarios.php");
			} else {
				include("printCrachaVarios.php");
			}
		} else {
			include("paramPrintCrachaVarios.php");
		}
}


function confirmPresenca() {
	$nroInscricao = getPost("txtCodigoBarra");
	$objInscricao = new classInscricao();
	
	$evento = $_SESSION["EVENTO_SESSION"];
	$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];

	$nroInscricao = getPost("txtCodigoBarra");
	
	$nroInscricao = substr($nroInscricao, 0, strlen($nroInscricao) -1);
	
	//$INFO_MSG = "CODIGO DE BARRAS => ".$nroInscricao;
	
	$codInscricao = $objInscricao->findCodInscricaoByNroInscricaoEvento($nroInscricao, $ocorrencia, $evento);
	
	$objInscricao = $objInscricao->findInscricaoByCodigo($codInscricao);
	
	if ($objInscricao != NULL) {
	
		$objInscricao->confirmPresenca($codInscricao);
	
		$objPF = new classPF();
		$objPF = $objPF->findByCodigo($objInscricao->pessoa_fisica);
		
		$INFO_MSG = "PRESEN&Ccedil;A CONFIRMADA: ".$objPF->nome;
	
	} else {
	
		$ERROR_MSG = "INSCRI&Ccedil;&Atilde;O N&Atilde;O ENCONTRADA! POR FAVOR, PROCURE O RESPONS&Aacute;VEL PELA SECRETARIA DO EVENTO.";
	}
	
	include("controlePresenca.php");
}


?>