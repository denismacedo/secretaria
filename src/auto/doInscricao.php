<?php 
session_start();

require_once('../sql/conexao.php'); 
require_once('../util/http.php'); 
require_once('../util/comum.php'); 

require_once("../sql/classPF.php"); 
require_once("../sql/classEvento.php"); 
require_once("../sql/classOcorrencia.php"); 
require_once("../sql/classInscricao.php"); 
require_once("../sql/classTipoAlojamento.php"); 
require_once("../sql/classParticipante.php"); 
require_once("../sql/classCracha.php"); 
require_once("../cursoBean.php"); 
require_once("../sql/classPJ.php"); 
require_once("../sql/classConfiguracaoPagamento.php"); 
require_once("../sql/classBoleto.php"); 

$metodo = $_GET["method"];
if ($metodo == "") {
	$metodo = $_POST["method"];
}

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
	
} else if ($metodo == "getPaises") {

	getPaises();

} else if ($metodo == "getEstados") {

	getEstados(true);
	
} else if ($metodo == "getCidades") {

	getCidades(true);
	
} else if ($metodo == "getCentros") {

	getCentros(getPost("centro"));

} else if ($metodo == "getResponsaveis") {

	getResponsaveis(getPost("nome"));
	
} else if ($metodo == "initCadCentro") {

	initCadCentro();
	
} else if ($metodo == "salvarPJ") {

	salvarPJ();
	
} else if ($metodo == "geraBoleto") {

	geraBoleto();
	
} else if ($metodo == "buscaInscricao") {

	//echo "XX";
	buscaInscricao();
	
} else if ($metodo == "verFichaInscricao") {

	//echo "XX";
	verFichaInscricao();

} else if ($metodo == "pagSeguro") {

	pagSeguro();

} else if ($metodo == "paypal") {

	payPal();
}




function init() {

	$paises = getPaises();
	
	include("inscricao.php");

}


/**
 * EXIBE A TELA DE INSCRICAO
 */
function inscricaoPasso2($codPF, $tipoMsg, $msg) {

	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	// Instancia o objeto PF
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	


	if ($_SESSION["OCORRENCIA_SESSION"] != "" && $_SESSION["EVENTO_SESSION"] != "") {
		$objEvento = new classEvento();
		$objOcorrencia = new classOcorrencia();
		$objInscricao = new classInscricao();
		$staticInsc = new classInscricao();
		$objTipoAlojamento = new classTipoAlojamento();
		
		// BUSCA O OBJETO EVENTO **************
		$objEvento = $objEvento->findByCodigo($_SESSION["EVENTO_SESSION"]);

		// BUSCA O OBJETO OCORRENCIA **************
		$objOcorrencia = $objOcorrencia->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
		
		// Calcula a idade da pessoa na data do evento
		$idadePF = dateDiff($objPF->data_nasc, $objOcorrencia->inicio);
		
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
			$selectIdioma = "<select name='idioma_tema_central' id='idioma_tema_central'></option>";
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
		$resultado = $objOcorrencia->findTemasEspecificosForInscricao($_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"],$idadePF);
		
		
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
			
			
		
			$selectTemasEspecificos1 .= "<option value='".mysql_result($resultado, $i, 0)."/".
										mysql_result($resultado, $i, 1)."' ".$strSel1.">".
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
										mysql_result($resultado, $i, 1)."' ".$strSel2.">".
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
										mysql_result($resultado, $i, 1)."' ".$strSel3.">".
										mysql_result($resultado, $i, 2).$strEsgotado."</option>";
		}
		
		// BUSCA OS TEMAS ATUAIS *********************
		if ($idadePF >= 12) {
		
		$resultado = $objOcorrencia->findTemasAtuaisForInscricao($_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"], $idadePF);
		
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
			$selectTemasAtuais1 = "<option value=''></option>";
		$selectTemasAtuais2 = "<option value=''></option>";
		$selectTemasAtuais3 = "<option value=''></option>";
		}
		
		for($i = 0; $i < $linhas; $i++) {
		
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
			
			if ((mysql_result($resultado, $i, "CAPACIDADE") - mysql_result($resultado, $i, "INSCRITOS")) <= 0) {
				$strEsgotado = " - ESGOTADO";
			} else {
				$strEsgotado = "";
			}
			
			$selectTemasAtuais1 .= "<option value='".mysql_result($resultado, $i, 0)."/".
										mysql_result($resultado, $i, 1)."' ".$strSel1.">".
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
										mysql_result($resultado, $i, 1)."' ".$strSel2.">".
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
										mysql_result($resultado, $i, 1)."' ".$strSel3.">".
										mysql_result($resultado, $i, 2).$strEsgotado."</option>";
										
			}
		}
		
		if ($tipoMsg == "INFO") {
			$INFO_MSG = $msg;
		} else if ($tipoMsg == "ERROR") {
			$ERROR_MSG = $msg;
		}
		

	} else {
	
		$ERROR_MSG = "O EVENTO N&Atilde;O FOI IDENTIFICADO!";
		
	}
	
	if (!isset($objInscricao) || $objInscricao == "") {
		$objInscricao = new classInscricao();
	}
	if ($objInscricao->pessoa_fisica == "") {
		$objInscricao->pessoa_fisica = $codPF;
	}
	

	include("inscricaoPasso2.php");
}

function salvaInscricao() {

	$codPF = getPost("codPF");
	$codInscricao = getPost("codInscricao");
	$nroInscricao = getPost("nroInscricao");
	$tipoAlojamento = getPost("tipoAlojamento");
	$idioma_tema_central = getPost("idioma_tema_central");
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
	$objInscricao->idioma_tema_central = $idioma_tema_central;
	$objInscricao->flag_trabalhador = $flag_trabalhador;
	$objInscricao->comissao = $comissoes;
	$objInscricao->temaAtual1 = $temasAtuaisOp1;
	$objInscricao->temaAtual2 = $temasAtuaisOp2;
	$objInscricao->temaAtual3 = $temasAtuaisOp3;
	$objInscricao->temaEspecifico1 = $temasEspecificosOp1;
	$objInscricao->temaEspecifico2 = $temasEspecificosOp2;
	$objInscricao->temaEspecifico3 = $temasEspecificosOp3;
	$objInscricao->usuario_insercao = '1';

	$objInscricao->evento = $_SESSION["EVENTO_SESSION"];
	$objInscricao->ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	$objOcorrencia = new classOcorrencia();
	$objOcorrencia = $objOcorrencia->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	
	$erro = "";
	if ($tipoAlojamento == "" || ($flag_trabalhador == 'S' && $comissoes == "")) {
		$erro = "OS CAMPOS ALOJAMENTO E COMISS&Atilde;O (CASO SEJA TRABALHADOR) S&Atilde;O OBRIGAT&Oacute;RIOS!";
	} else if ((dateDiff($objPF->data_nasc, $objOcorrencia->inicio) >= 12 && ($temasAtuaisOp1 == "" || $temasAtuaisOp2 == "" || $temasAtuaisOp3 == "")) || $temasEspecificosOp1 == "" || $temasEspecificosOp2 == "" || $temasEspecificosOp3 == "") {
		$erro = "INFORME TODAS AS OP&Ccedil;&Otilde;ES DE CURSO!";
	}
	
	if ($erro == "") {
	
		$objInscFinder = new classInscricao();
		$objX = $objInscFinder->findInscricaoByPFEvento($codPF, $_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);
		if ($objX == "") {
			
			mysql_query("BEGIN");
		
			$retorno = $objInscricao->save();
		
			if ($retorno[0] >= 0) {
			
				$objInscricao = $retorno[1];
				
				mysql_query("COMMIT");
				
				inscricaoPasso3($codPF, $objInscricao->codigo, "INFO", "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!");
				
			} else {
		
				mysql_query("ROLLBACK");
		
				inscricaoPasso2($codPF, "ERROR", $retorno[1]);
			}
			
  	    } else {
		
			$objInscricao = $objX;
		
			inscricaoPasso3($codPF, $objInscricao->codigo, "INFO", "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!");
		
		}
		
		
	} else {
	
		inscricaoPasso2($codPF, "ERROR", $erro);

	}
}

function inscricaoPasso3($codPF, $codInsc, $tipoMsg, $msg) {


	$objInscricao = new classInscricao();
	$objInscricao = $objInscricao->findInscricaoByCodigo($codInsc);
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($codPF);
	
	$objCPFinder = new classConfiguracaoPagamento();
	$objCP = $objCPFinder->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
		

	if ($tipoMsg == "INFO") {
			$INFO_MSG = $msg;
		} else if ($tipoMsg == "ERROR") {
			$ERROR_MSG = $msg;
		}
		

	include("inscricaoPasso3.php");

}


function getPaises() {

	$pais = getPost("pais");

  $result = mysql_query("select sigla, nome from pais order by nome");
  $linhas=mysql_num_rows($result);
  $retorno = "";
  for($x=0; $x < $linhas; $x++)
  {
  
  if (isset($pais) && $pais != "" && $pais == mysql_result($result,$x,0)) {
		$SELECTED = "SELECTED";
	} else {
		$SELECTED = "";
	}
  
    $retorno .= "<option value='".mysql_result($result,$x,0)."' ".$SELECTED.">".mysql_result($result,$x,1)."</option>";
  }
  
  return $retorno;


}

function getEstados($echo) {

	$uf = getPost("uf");

	$retorno = '<select name="uf" id="uf" onchange="changeEstado(document.cadastroForm.pais.value, this.value);"><option></option>';

	$sql = "SELECT sigla, nome FROM estado where pais = '".getPost("pais")."' ORDER BY nome ";	
	$result = mysql_query($sql);
	$linhas = mysql_num_rows($result);
	for($x=0; $x < $linhas; $x++)
	{
	
		if (isset($uf) && $uf != "" && $uf == mysql_result($result,$x,0)) {
		$SELECTED = "SELECTED";
	} else {
		$SELECTED = "";
	}
	  $retorno .= "<option value='".mysql_result($result,$x,0)."' ".$SELECTED.">".mysql_result($result,$x,1)."</option>";
	}
  $retorno .= "</select>";

	 if ($echo) {
	
		echo $retorno;
		
	} else {
	
		return $retorno;
	}

}

function getCidades($echo) {

	$cid = getPost("cidade");

  $retorno = '<select name="cidade" id="cidade"><option></option>';
  $sql = "SELECT nome FROM cidade WHERE unidade_da_federacao = '".getPost("uf")."' AND pais = '".getPost("pais")."' ORDER BY nome";
  $result = mysql_query($sql);
  $linhas = mysql_num_rows($result);
  for($x=0; $x < $linhas; $x++)
  {
  	if (isset($cid) && $cid != "" && $cid == mysql_result($result,$x,0)) {
		$SELECTED = "SELECTED";
	} else {
		$SELECTED = "";
	}
    $retorno .= "<option value='".mysql_result($result,$x,0)."' ".$SELECTED.">".mysql_result($result,$x,0)."</option><br>";
  }
  $retorno .= "</select>";
  
 if ($echo) {
	
		echo $retorno;
		
	} else {
	
		return $retorno;
	}

}

function getCentros($centro) {

	$retorno= '<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
              <TBODY>
              <TR bgColor=#5676a9>
                <TD width=30 height=20><SPAN 
                  style="COLOR: #ffffff"><B>CODIGO</B></SPAN></TD>
                <TD height=20><SPAN 
                style="COLOR: #ffffff"><B>NOME</B></SPAN></TD>
                <TD width="10%" height=20><SPAN 
                  style="COLOR: #ffffff"><B>CIDADE/ESTADO</B></SPAN></TD></TR>';

  $sql = "SELECT codigo, nome, cidade, unidade_da_federacao FROM pessoa_juridica WHERE tipo_pj = '1' ";
  
  if ($centro != "") {
  	$sql .= " AND nome like '%$centro%' ";
  }
   $sql .= " ORDER BY nome";
  
  $result = mysql_query($sql);
  $linhas = mysql_num_rows($result);
  if ($linhas > 0) {
	  for($x=0; $x < $linhas; $x++)
	  {
	  
		if ($x % 2 == 0) {
			$cor = '#ffffff';
		} else {
			$cor = '#f0f0f0';
		}
	  
		$retorno .= "<TR bgColor='".$cor."'>
					<TD height=20><A href='javascript:colaPJ(\"".mysql_result($result,$x,0).'\", \"'.mysql_result($result,$x,1)."\");'>".formatNumber(mysql_result($result,$x,0), 4)."</A></TD>
					<TD><A href=\"javascript:colaPJ('".mysql_result($result,$x,0)."', '".mysql_result($result,$x,1)."');\">".mysql_result($result,$x,1)."</A></TD>
					<TD>".mysql_result($result,$x,2)."/".mysql_result($result,$x,3)."</TD></TR>";
	  
	  }
	  $retorno .= "<TR>
					<TD  valign='middle' colSpan=3 height='30'><B>Total de 
					".$linhas." registro(s) encontrado(s).</B>        </TD>
				  </TR></TBODY></TABLE>";
	} else {
	
		$retorno .= "<TR>
					<TD   valign='middle' colSpan=3 height='30' align='center'><B>Nenhum registro encontrado.</B> </TD> </TR></TBODY></TABLE>";
	}
	
	$CENTROS = $retorno;
	
	include("origemPop.php");

}



function getResponsaveis($nome) {

	$retorno= '<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
              <TBODY>
              <TR bgColor=#5676a9>
                <TD height=20><SPAN 
                  style="COLOR: #ffffff"><B>NOME</B></SPAN></TD>
                <TD height=20  align=center width="8%"><SPAN 
                style="COLOR: #ffffff"><B>SEXO</B></SPAN></TD>
                <TD height=20  align="center" width="20%"><SPAN 
                style="COLOR: #ffffff"><B>DATA NASCIMENTO</B></SPAN></TD>
                <TD width="22%" height=20><SPAN 
                  style="COLOR: #ffffff"><B>CIDADE/ESTADO</B></SPAN></TD></TR>';

  $sql = "select p.codigo, p.nome, p.sexo, p.data_nasc, p.cidade, p.unidade_da_federacao
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(p.data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(p.data_nasc,5))) >= 14";
  
  if ($nome != "") {
  	$sql .= " AND p.nome like '%$nome%' ";
  }
   $sql .= " ORDER BY p.nome";
  
  $result = mysql_query($sql);
  $linhas = mysql_num_rows($result);
  if ($linhas > 0) {
	  for($x=0; $x < $linhas; $x++)
	  {
	  
		if ($x % 2 == 0) {
			$cor = '#ffffff';
		} else {
			$cor = '#f0f0f0';
		}
	  
		$retorno .= "<TR bgColor='".$cor."'>
					<TD height=20><A href='javascript:colaPF(\"".mysql_result($result,$x,0)."\", \"".mysql_result($result,$x,1)."\");'>".mysql_result($result,$x,1)."</A></TD>
					<TD align=center>".mysql_result($result,$x,2)."</TD>
					<TD align=center>".formatDate(mysql_result($result,$x,3))."</TD>
					<TD>".mysql_result($result,$x,4)."/".mysql_result($result,$x,5)."</TD></TR>";
	  
	  }
	  $retorno .= "<TR>
					<TD  valign='middle' colSpan=4 height='30'><B>Total de 
					".$linhas." registro(s) encontrado(s).</B>        </TD>
				  </TR></TBODY></TABLE>";
	} else {
	
		$retorno .= "<TR>
					<TD   valign='middle' colSpan=4 height='30' align='center'><B>Nenhum registro encontrado.</B> </TD> </TR></TBODY></TABLE>";
	}
	
	$RESPONSAVEIS = $retorno;
	
	include("responsavelPop.php");

}

function initCadCentro() {

	$paises = getPaises();
	
	include("cadCentro.php");

}

function salvarPJ() {

	$erro = "";

	$codigo = getPost("codigo");
	$nome = retiraCaracteresEspeciais(getPost("nome"));
	$rua = retiraCaracteresEspeciais(getPost("rua"));
	$nro = getPost("nro");
	$complemento = retiraCaracteresEspeciais(getPost("complemento"));
	$cep = getPost("cep");
	$bairro = retiraCaracteresEspeciais(getPost("bairro"));
	$pais = getPost("pais");
	$estado = getPost("uf");
	$cidade = getPost("cidade");
	$email = getPost("email");
	$ddd = getPost("ddd");
	$telefone = getPost("telefone");
	$possui_cfas = getPost("possui_cfas");
	
	$objPJ = new classPJ();
	$objPJ->codigo = $codigo;
	$objPJ->nome = $nome;
	$objPJ->rua_ou_quadra = $rua;
	$objPJ->numero = $nro;
	$objPJ->complemento_ou_conjunto = $complemento;
	$objPJ->cep = $cep;
	$objPJ->bairro = $bairro;
	$objPJ->email = $email;
	$objPJ->possui_cfas = $possui_cfas;
	
	if ($cidade == "" || $nome == "") {
		$erro = "OS CAMPOS NOME E CIDADE S&Atilde;O DE PREENCHIMENTO OBRIGAT&Oacute;RIO";
	}
	
	
	// TRATA CIDADE
	if (isset($cidade) && $cidade != "") {
		$objPJ->cidade = $cidade;
		$objPJ->unidade_da_federacao = $estado;
		$objPJ->pais = $pais;
	}

	// TRATAR TELEFONE
	$objPJ->ddd = $ddd;
	$objPJ->telefone = $telefone;
	
	if (($ddd != "" && $telefone == "") || ($ddd == "" && $telefone != "")) {
	
		$erro = "INFORME O TELEFONE CORRETAMENTE (DDD E NUMERO)";
	}
	
	if ($erro == "") {
		
		mysql_query("BEGIN");
		$objPJ->save();
		mysql_query("COMMIT");
		
		$INFO_MSG = "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!";
		
		if ($codigo != "") {
			$cPJ = new classPJ();
			$objPJ = $cPJ->findByCodigo($codigo);
		}	
		
		include("cadCentroFinish.php");
		
	 	
	} else {
	
		$ERROR_MSG = $erro;
		
		$paises = getPaises();
		
		include("cadCentro.php");
	
	}
}


/**
 * SALVA OS DADOS DE UMA PF
 */
function salvar() {

	$codigo = getPost("codigo");
	$cpf = getPost("cpf");
	$nome = retiraCaracteresEspeciais(getPost("nome"));
	$apelido = retiraCaracteresEspeciais(getPost("apelido"));
	$dataNasc = getPost("dataNasc");
	$sexo = getPost("sexo");
	$rua = retiraCaracteresEspeciais(getPost("rua"));
	$nro = getPost("nro");
	$complemento = retiraCaracteresEspeciais(getPost("complemento"));
	$cep = getPost("cep");
	$bairro = retiraCaracteresEspeciais(getPost("bairro"));
	$cidade = getPost("cidade");
	$estado = getPost("uf");
	$pais = getPost("pais");
	$email = getPost("email");
	$violao = getPost("violao");
	$profissao = retiraCaracteresEspeciais(getPost("profissao"));
	$dirigente = getPost("dirigente");
	$vegetariano = getPost("vegetariano");
	$codResponsavel = getPost("codResponsavel");
	$codOrigem = getPost("codOrigem");
	$ddd = getPost("ddd");
	$residencial = getPost("residencial");
	$comercial = getPost("comercial");
	$celular = getPost("celular");
	$doenca = retiraCaracteresEspeciais(getPost("doenca"));
	$medicamento = retiraCaracteresEspeciais(getPost("medicamento"));
	$obs = retiraCaracteresEspeciais(getPost("obs"));
	
	
	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	
	// VALIDA OS CAMPOS
	$ok = false;
	$erro = "";
	
	if ($nome == "" || $dataNasc == "" || $sexo == "" || $cidade == "" || $rua == "" || $nro == "" || $bairro == "" || $email == "" || ($residencial == "" && $comercial == "" && $celular == "")) {
		$erro = "OS CAMPOS NOME, DATA DE NASCIMENTO, SEXO, CIDADE, RUA, NUMERO, BAIRRO, EMAIL e PELO MENOS UM TELEFONE S&Atilde;O DE PREENCHIMENTO OBRIGAT&Oacute;RIO!";
	} else if (dateDiff(getDBDate($dataNasc), $objOco->inicio) < 12 && $codResponsavel == "") {
	
		$erro = "INFORME O REPONS&Aacute;VEL PARA CRIAN&Ccedil;AS (ABAIXO DE 12 ANOS &Eacute; NECESS&Aacute;RIO INFORMAR O RESPONS&Aacute;VEL)";
	
	} else {
	
		$objPFFinder = new classPF();
		
		if ($cpf != "") {
			$objPF = $objPFFinder->findByCPF($cpf);
		}
		
		if ($objPF == "") {
			$objPF = $objPFFinder->searchPFByUniqueKey($nome, $sexo, $dataNasc);
		}
		
		if ($objPF == "") {
			$objPF = new classPF();
			
		} else {
		 	
		 	// VERIFICA SE JÁ REALIZOU INSCRICAO
			
			$objInscFinder = new classInscricao();
			$objInsc = $objInscFinder->findInscricaoByPFEvento($objPF->codigo, $_SESSION["OCORRENCIA_SESSION"], $_SESSION["EVENTO_SESSION"]);
			if ($objInsc != "") {
			
				$erro = "VOC&Ecirc; J&Aacute; EST&Aacute; INSCRITO NO EVENTO! SUA INSCRI&Ccedil;&Atilde;O &Eacute;: ".formatNumber($objInsc->nro_inscricao, 5);
			
			}

		 }
		 
		 if ($erro == "") {
		
			$objPF->cpf = $cpf;
			$objPF->nome = $nome;
			$objPF->apelido = $apelido;
			$objPF->data_nasc = $dataNasc;
			$objPF->sexo = $sexo;
			$objPF->rua_ou_quadra = $rua;
			$objPF->numero = $nro;
			$objPF->complemento_ou_conjunto = $complemento;
			$objPF->cep = $cep;
			$objPF->bairro = $bairro;
			$objPF->profissao = $profissao;
			$objPF->email = $email;
			$objPF->alegria_crista = $violao;
			$objPF->dirigente_centro = $dirigente;
			$objPF->vegetariano = $vegetariano;			
			$objPF->responsavel = $codResponsavel;
			
			// TRATA CIDADE
			if (isset($cidade) && $cidade != "") {
				$objPF->cidade = $cidade;
				$objPF->unidade_da_federacao = $estado;
				$objPF->pais = $pais;
			}
		
			// TRATAR ORIGEM
			$objPF->origem = $codOrigem;	
			
			// TRATAR TELEFONES
			$objPF->ddd = $ddd;
			$objPF->telRes = $residencial;
			$objPF->telCom = $comercial;
			$objPF->telCel = $celular;
			
			// TRATAR PARTICULARIDADES
			if ($doenca != "" || $medicamento != "" || $obs != "") {
				$objParticularidade = new classParticularidade();
				
				$objParticularidade->doenca = $doenca;
				$objParticularidade->medicamento = $medicamento;
				$objParticularidade->observacao = $obs;
				
				$objPF->objParticularidade = $objParticularidade;
			}
		}
	}
	
	
	$paises = getPaises();
	if ($pais != "") {
		$estados = getEstados(false);
		
		if ($estado != "") {
			$cidades = getCidades(false);
		}
	}
		
	if ($erro == "") {
		
		mysql_query("BEGIN");
		$objPF->save();
		mysql_query("COMMIT");
		
		$codigo = $objPF->codigo;
		
		
	 	if ($codigo != "") {
			$newPF = new classPF();
			$objPF = $newPF->findByCodigo($codigo);
		}
	
		inscricaoPasso2($codigo, "", "");
		
	} else {
	
		$ERROR_MSG = $erro;
		
		include("inscricao.php");
	}

}

function geraBoleto() {

	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$objCP = new classConfiguracaoPagamento();
	$objCP = $objCP->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$codInscricao = getPost("codInscricao");
	
	$objInsc = new classInscricao();
	$objInsc = $objInsc->findInscricaoByCodigo($codInscricao);
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($objInsc->pessoa_fisica);
	
	$staticBoleto = new classBoleto();
	$objBoleto = $staticBoleto->findByInscricao($codInscricao);


	if ($objBoleto == NULL) {
	
		// GERA O BOLETO
		$objBoleto = new classBoleto();
		$objBoleto->inscricao = $codInscricao;
		
		//echo dateDiff($objPF->data_nasc, $objOco->inicio)."<br>";

		if (dateDiff($objPF->data_nasc, $objOco->inicio) >= 12) {
			$objBoleto->valor = $objCP->valor_adulto;
		} else {
			$objBoleto->valor = $objCP->valor_crianca;
			$crianca = true;
		}
		
		$objBoleto->nosso_nro = $objCP->ocorrencia.date("y").formatNumber($objInsc->nro_inscricao, 5);
		
		$objBoleto = $objBoleto->save();
	} else {
		if (dateDiffDias(date("Y-m-d"), $objBoleto->data_vencimento) < 1) {
			$objBoleto = $objBoleto->atualizaDataVencimento();
		}
	}
	
	if ($objPF->responsavel != "") {
		$objResponsavel = $objPF->findByCodigo($objPF->responsavel);
		
		$objBoleto->sacado = $objResponsavel->nome;
		
	} else {
	
		$objBoleto->sacado = $objPF->nome;
		
	}
	
	include("geraBoletoConcafras.php");

}


function pagSeguro() {

	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$objCP = new classConfiguracaoPagamento();
	$objCP = $objCP->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$codInscricao = getPost("codInscricao");
	
	$objInsc = new classInscricao();
	$objInsc = $objInsc->findInscricaoByCodigo($codInscricao);
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($objInsc->pessoa_fisica);
	
	$staticBoleto = new classBoleto();
	$objBoleto = $staticBoleto->findByInscricao($codInscricao);


	if ($objBoleto == NULL) {
	
		// GERA O BOLETO
		$objBoleto = new classBoleto();
		$objBoleto->inscricao = $codInscricao;
		
		//echo dateDiff($objPF->data_nasc, $objOco->inicio)."<br>";

		if (dateDiff($objPF->data_nasc, $objOco->inicio) >= 12) {
			$objBoleto->valor = $objCP->valor_adulto;
		} else {
			$objBoleto->valor = $objCP->valor_crianca;
			$crianca = true;
		}
		
		$objBoleto->nosso_nro = $objCP->ocorrencia.date("y").formatNumber($objInsc->nro_inscricao, 5);
		
		$objBoleto = $objBoleto->save();
	} else {
		if (dateDiffDias(date("Y-m-d"), $objBoleto->data_vencimento) < 1) {
			$objBoleto = $objBoleto->atualizaDataVencimento();
		}
	}
	
	if ($objPF->responsavel != "") {
		$objResponsavel = $objPF->findByCodigo($objPF->responsavel);
		
		$objBoleto->sacado = $objResponsavel->nome;
		
	} else {
	
		$objBoleto->sacado = $objPF->nome;
		
	}

		include("pagSeguro.php");

}


function payPal() {

	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$objCP = new classConfiguracaoPagamento();
	$objCP = $objCP->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$codInscricao = getPost("codInscricao");
	
	$objInsc = new classInscricao();
	$objInsc = $objInsc->findInscricaoByCodigo($codInscricao);
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($objInsc->pessoa_fisica);
	
	$staticBoleto = new classBoleto();
	$objBoleto = $staticBoleto->findByInscricao($codInscricao);


	if ($objBoleto == NULL) {
	
		// GERA O BOLETO
		$objBoleto = new classBoleto();
		$objBoleto->inscricao = $codInscricao;
		
		//echo dateDiff($objPF->data_nasc, $objOco->inicio)."<br>";

		if (dateDiff($objPF->data_nasc, $objOco->inicio) >= 12) {
			$objBoleto->valor = $objCP->valor_adulto;
		} else {
			$objBoleto->valor = $objCP->valor_crianca;
			$crianca = true;
		}
		
		$objBoleto->nosso_nro = $objCP->ocorrencia.date("y").formatNumber($objInsc->nro_inscricao, 5);
		
		$objBoleto = $objBoleto->save();
	} else {
		if (dateDiffDias(date("Y-m-d"), $objBoleto->data_vencimento) < 1) {
			$objBoleto = $objBoleto->atualizaDataVencimento();
		}
	}
	
	if ($objPF->responsavel != "") {
		$objResponsavel = $objPF->findByCodigo($objPF->responsavel);
		
		$objBoleto->sacado = $objResponsavel->nome;
		
	} else {
	
		$objBoleto->sacado = $objPF->nome;
		
	}

		include("payPal.php");
}


function buscaInscricao() {
	$nroInscricao = getPost("nroInscricao");
	$paginaRetorno = getPost("paginaRetorno");
	$objInscricao = new classInscricao();

	$evento = $_SESSION["EVENTO_SESSION"];
	$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	if ($nroInscricao == "") {
		$ERROR_MSG = "INFORME O N&Uacute;MERO DA INSCRI&Ccedil;&Atilde;O!";
	} else {
	
		$codInscricao = $objInscricao->findCodInscricaoByNroInscricaoEvento($nroInscricao, $ocorrencia, $evento);
		$objInscricao = $objInscricao->findInscricaoByCodigo($codInscricao);
		
		//echo "cod_insc_0 = ".$objInscricao->codigo;
		
		if ($objInscricao == NULL) {
			$ERROR_MSG = "INSCRI&Ccedil;&Atilde;O N&Atilde;O ENCONTRADA!";
		} else {
			$objPF = new classPF();
			$objPF = $objPF->findByCodigo($objInscricao->pessoa_fisica);
		}
	}
	include("reimprimeBoletoPasso1.php");
}


function verFichaInscricao() {

	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$objCP = new classConfiguracaoPagamento();
	$objCP = $objCP->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);

	$codInscricao = getPost("codInscricao");
	
	$objInsc = new classInscricao();
	$objInsc = $objInsc->findInscricaoByCodigo($codInscricao);
	
	$objPF = new classPF();
	$objPF = $objPF->findByCodigo($objInsc->pessoa_fisica);
	
	// CURSOS ESCOLHIDOS
	if (isset($objInsc)) {
		$participantes = array();
		$resultado = $objInsc->findParticipantes($objInsc->codigo);
		$linhas = mysql_num_rows($resultado);

		for ($i = 0; $i < $linhas; $i++) {
			$objPart = new classParticipante();
			$objPart->evento = mysql_result($resultado, $i, "evento");
			$objPart->ocorrencia = mysql_result($resultado, $i, "ocorrencia");
			$objPart->sub_ocorrencia = mysql_result($resultado, $i, "sub_ocorrencia");
			$objPart->tipo_evento = mysql_result($resultado, $i, "tipo_evento");
			$objPart->qualif_evento = mysql_result($resultado, $i, "qualif_evento");
			$objPart->nome_evento = mysql_result($resultado, $i, "nome");
			$objPart->nome_qualif = mysql_result($resultado, $i, "nome_qualif");
			
			$participantes[$i] = $objPart;
		}
	
		// PARTICIPANTE OPCAO
		$participantesOpcao = array('', '', '', '', '', '');
		$resultado = $objInsc->findOpcoes($objInsc->codigo);
		$linhas = mysql_num_rows($resultado);
		
		for ($i = 0; $i < $linhas; $i++) {
			$objPart = new classParticipante();
			$objPart->evento = mysql_result($resultado, $i, "evento");
			$objPart->ocorrencia = mysql_result($resultado, $i, "ocorrencia");
			$objPart->sub_ocorrencia = mysql_result($resultado, $i, "sub_ocorrencia");
			$objPart->tipo_evento = mysql_result($resultado, $i, "tipo_evento");
			$objPart->qualif_evento = mysql_result($resultado, $i, "qualif_evento");
			$objPart->prioridade = mysql_result($resultado, $i, "prioridade");
			$objPart->nome_evento = mysql_result($resultado, $i, "nome");
			$objPart->nome_qualif = mysql_result($resultado, $i, "nome_qualif");
			
			$participantesOpcao[$i] = $objPart;

		}
	}
	
	$staticBoleto = new classBoleto();
	$objBoleto = $staticBoleto->findByInscricao($codInscricao);
	
	include("fichaInscricao.php");

}


?>