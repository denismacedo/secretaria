<?php 
session_start();
require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 
require_once("sql/classOcorrencia.php"); 
require_once("sql/classEvento.php"); 
require_once("sql/classSubOcorrencia.php"); 


$metodo = $_GET["method"];

if ($metodo == "init") {
	init();
} else if ($metodo == "inserir") {
	inserir();
} else if ($metodo == "alterar") {
	alterar();
} else if ($metodo == "excluir") {
	excluir();
} else if ($metodo == "editar") {
	editar();
}

function init() {
	if ($_SESSION["OCORRENCIA_SESSION"] != "" && $_SESSION["EVENTO_SESSION"] != "") {
		$cSub = new classSubOcorrencia();
		$cEvento = new classEvento();
		$resultado = $cSub->findTemasByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
		$qualificacoes = $cEvento->findQualificacaoEventoByTipoEvento("1");
		
		include("cadTemas.php");
	} else {
		include("cadNaoAutorizado.php");
	}
}

function inserir() {
	$codEvento = getPost("codEvento");
	$nomeEvento = retiraCaracteresEspeciais(getPost("nomeEvento"));
	$tipoEvento = "1";
	$qualificacao = getPost("qualificacao");
	$idadeInicio = getPost("idadeInicio");
	$idadeFim = getPost("idadeFim");
	$numeroVagas = getPost("numeroVagas");
	$numero_bloco = getPost("numero_bloco");
	$andar = getPost("andar");
	$numero_sala = getPost("numero_sala");
	
	if ($idadeFim == "") {
		$idadeFim = 200;
	}
	if ($numeroVagas == "") {
		$numeroVagas = 0;
	}
	$canInsert = true;
	$eventoExists = false;
	
	if ($nomeEvento == "" || $qualificacao == "" ) {
		$ERROR_MSG = "OS CAMPOS NOME, TIPO SAO OBRIGATORIOS!";
		
	} else {
	
		$objEvento = null;
		if ($codEvento != "") {
			$objEvento = new classEvento();
			$objEvento = $objEvento->findEventoByCodigo($codEvento);
		}
		
		$codOcorrencia = 1;
		if ($objEvento == null) {
			$objEvento = new classEvento();
			$codEvento = $objEvento->findNextCodigoEvento();
			$objEvento->codigo = $codEvento;
			$objEvento->nome = $nomeEvento;
			$objEvento->tipoEvento = $tipoEvento;
			$objEvento->qualifEvento = $qualificacao;
			$objEvento->restricaoIdadeInicio = $idadeInicio;
			$objEvento->restricaoIdadeFim = $idadeFim;
	
			$objEvento->insert();
			
			$objOcorrencia = new classOcorrencia();
			$lastOcorrencia = $objOcorrencia->findLastOcorrenciaByEvento($codEvento);
			if ($lastOcorrencia != null && $lastOcorrencia > 0) {
				$codOcorrencia = $lastOcorrencia + 1;
			}
			$objOcorrencia->codigo = $codOcorrencia;
			$objOcorrencia->evento = $codEvento;
			$objOcorrencia->nome = $nomeEvento;
			$objOcorrencia->concafras_geradora = $_SESSION["EVENTO_SESSION"];
			$objOcorrencia->ocorrencia_geradora = $_SESSION["OCORRENCIA_SESSION"];
			
			$objOcorrencia->insert();
			
			$objSub = new classSubOcorrencia();
			$objSub->evento = $codEvento;
			$objSub->ocorrencia = 1;
			$objSub->codigo = 1;
			$objSub->nome = $nomeEvento;
			$objSub->capacidade = $numeroVagas;
			$objSub->numero_bloco = $numero_bloco;
			$objSub->andar = $andar;
			$objSub->numero_sala = $numero_sala;
			
			$objSub->insertSubOcorrencia();
			
			$INFO_MSG = "CURSO INSERIDO COM SUCESSO!";
			
			return edit($codEvento, $codOcorrencia, $objSub->codigo, $INFO_MSG);
			
		} else {
			$ERROR_MSG = "ESTE CODIGO JA ESTA SENDO USADO POR ".$objEvento->nome;
		}
	}
	
	$cEvento = new classEvento();
	$cSub = new classSubOcorrencia();
	$resultado = $cSub->findTemasByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	$qualificacoes = $cEvento->findQualificacaoEventoByTipoEvento("1");
	
	include("cadTemas.php");
}

function alterar() {
	$codEvento = getPost("codEvento");
	$codOcorrencia = getPost("codOcorrencia");
	$codSub = getPost("codSub");
	$nomeEvento = retiraCaracteresEspeciais(getPost("nomeEvento"));
	$tipoEvento = "1";
	$qualificacao = getPost("qualificacao");
	$idadeInicio = getPost("idadeInicio");
	$idadeFim = getPost("idadeFim");
	$numeroVagas = getPost("numeroVagas");
	$numero_bloco = getPost("numero_bloco");
	$andar = getPost("andar");
	$numero_sala = getPost("numero_sala");
	
	
	if ($idadeFim == "") {
		$idadeFim = 200;
	}
	
	if ($numeroVagas == "") {
		$numeroVagas = 0;
	}
	if ($codEvento == "" || $nomeEvento == "" || $qualificacao == "" ) {
		$ERROR_MSG = "OS CAMPOS CODIGO, NOME, TIPO SAO OBRIGATORIOS!";
	} else {
	
		$objEvento = new classEvento();
		
		$objEvento = $objEvento->findEventoByCodigo($codEvento);

		$objEvento->nome = $nomeEvento;
		$objEvento->tipoEvento = $tipoEvento;
		$objEvento->qualifEvento = $qualificacao;
		$objEvento->restricaoIdadeInicio = $idadeInicio;
		$objEvento->restricaoIdadeFim = $idadeFim;

		$objEvento->update();
		
		
		$objOcorrencia = new classOcorrencia();
		$objOcorrencia = $objOcorrencia->findByCodigo($codEvento, $codOcorrencia);
		$objOcorrencia->nome = $nomeEvento;
		
		$objOcorrencia->update();
		
		
		$objSub = new classSubOcorrencia();
		$objSub = $objSub->findSubOcorrenciaByPK($codEvento, $codOcorrencia, $codSub);	
		$objSub->nome = $nomeEvento;
		$objSub->capacidade = $numeroVagas;
			$objSub->numero_bloco = $numero_bloco;
			$objSub->andar = $andar;
			$objSub->numero_sala = $numero_sala;
			
		
		$objSub->updateSubOcorrencia();
		
		
		$INFO_MSG = "CURSO ATUALIZADO COM SUCESSO!";
	}

	edit($codEvento, $codOcorrencia, $codSub, $INFO_MSG);
}

function editar() {
	$codEvento = getPost("codEvento");
	$codOcorrencia = getPost("codOcorrencia");
	$codSub = getPost("codSub");
	
	edit($codEvento, $codOcorrencia, $codSub, null);
}

function edit($codEvento, $codOcorrencia, $codSub, $INFO_MSG) {

	$objEvento = new classEvento();
	
	$objEvento = $objEvento->findEventoByCodigo($codEvento);

	if ($objEvento != null) {
		$objOcorrencia = new classOcorrencia();
		$objOcorrencia = $objOcorrencia->findByCodigo($codEvento, $codOcorrencia);
		
		if ($objOcorrencia != null) {
			$objSub = new classSubOcorrencia();
			$objSub = $objSub->findSubOcorrenciaByPK($codEvento, $codOcorrencia, $codSub);
			
		} else {
			$ERROR_MSG = "NAO EXISTE CURSO COM O CODIGO [".$codEvento."]!";
		}

	} else {
		$ERROR_MSG = "NAO EXISTE CURSO COM O CODIGO [".$codEvento."]!";
	}

	$cEvento = new classEvento();
	$cSub = new classSubOcorrencia();
	$resultado = $cSub->findTemasByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	$qualificacoes = $cEvento->findQualificacaoEventoByTipoEvento("1");
	
	include("cadTemas.php");
}


function excluir() {
	$codEvento = getPost("codEvento");
	$codOcorrencia = getPost("codOcorrencia");
	$codSub = getPost("codSub");
	
	
	$cSub = new classSubOcorrencia();
	$participantes = $cSub->existsAssociacaoSubOcorrencia($codEvento, $codOcorrencia, $codSub);
	if ($participantes <= 0) {
		$objEvento = new classEvento();
		$objEvento = $objEvento->findEventoByCodigo($codEvento);
	
		$objOcorrencia = new classOcorrencia();
		$objOcorrencia = $objOcorrencia->findByCodigo($codEvento, 1);
		if ($objOcorrencia != "" && $objOcorrencia != null) {
			$objSubOcorrencia = $cSub->findSubOcorrenciaByPK($codEvento, $codOcorrencia, $codSub);
			if ($objSubOcorrencia != "" && $objSubOcorrencia != null) {
				$objSubOcorrencia->deleteSubOcorrencia();
			}
			$objOcorrencia->delete();
		}
		
		$objEvento->delete();
		
		$INFO_MSG = "CURSO EXCLUIDO COM SUCESSO!";

	} else {
		$ERROR_MSG = "JA EXISTEM INSCRICOES ASSOCIADAS AO CURSO [".$codEvento."] NO EVENTO ".$_SESSION["NOME_EVENTO_SESSION"];
	}

	$objEvento = null;
	$objOcorrencia = null;
	$objSubOcorrencia = null;
	
	$cEvento = new classEvento();
	$cSub = new classSubOcorrencia();
	$resultado = $cSub->findTemasByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	$qualificacoes = $cEvento->findQualificacaoEventoByTipoEvento("1");
	
	$clearForm = true;
	include("cadTemas.php");

}

?>
