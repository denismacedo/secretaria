<?php 
require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 
require_once("sql/classOcorrencia.php"); 
require_once("sql/classEvento.php"); 
require_once("sql/classUsuarioOcorrencia.php"); 
require_once("sql/classInscricao.php"); 


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
	$cEvento = new classEvento();
	$resultado = $cEvento->findMasterEventos();
	$tipoEventos = $cEvento->findMasterTipoEventos();
	
	include("cadEvento.php");
}

function inserir() {
	$codEvento = getPost("codEvento");
	$nomeEvento = retiraCaracteresEspeciais(getPost("nomeEvento"));
	$tipoEvento = getPost("tipoEvento");
	$inicioEvento = getPost("inicioEvento");
	$terminoEvento = getPost("terminoEvento");
	
	if ($nomeEvento == "" || $tipoEvento == "" || $inicioEvento == "") {
		$ERROR_MSG = "OS CAMPOS NOME, TIPO E INICIO SAO OBRIGATORIOS!";
	} else {
	
		$objEvento = null;
		
		if ($codEvento != "") {
			$objEvento = new classEvento();
			$objEvento = $objEvento->findEventoByCodigo($codEvento);
		}
	
		if ($objEvento == null) {
			$objEvento = new classEvento();
			$codEvento = $objEvento->findNextCodigoEvento();
			$objEvento->codigo = $codEvento;
			$objEvento->nome = $nomeEvento;
			$objEvento->tipoEvento = $tipoEvento;
	
			$objEvento->insert();
			
			$objOcorrencia = new classOcorrencia();
			$objOcorrencia->codigo = 1;
			$objOcorrencia->evento = $codEvento;
			$objOcorrencia->nome = $nomeEvento;
			$objOcorrencia->inicio = $inicioEvento;
			$objOcorrencia->termino = $terminoEvento;
			
			$objOcorrencia->insert();
			
			// INSERE AS COMISSOES
			$maxCodigoComissao = $objOcorrencia->getMaxCodigoComissoes();
			if ($maxCodigoComissao == null || $maxCodigoComissao == "") {
				$maxCodigoComissao = 0;
			}
			$objOcorrencia->insereComissoes($codEvento, 1, $maxCodigoComissao+1) ;
			
			$objUsuarioOcorrencia = new classUsuarioOcorrencia();
			$objUsuarioOcorrencia->evento = $codEvento;
			$objUsuarioOcorrencia->ocorrencia = 1;
			$objUsuarioOcorrencia->usuario = 1; // DEFAULT USUARIO ADMIN
			$objUsuarioOcorrencia->insertUsuarioOcorrencia();
			
			$objUsuarioOcorrencia = new classUsuarioOcorrencia();
			$objUsuarioOcorrencia->evento = $codEvento;
			$objUsuarioOcorrencia->ocorrencia = 1;
			$objUsuarioOcorrencia->usuario = 2; // DEFAULT USUARIO SECRETARIA
			$objUsuarioOcorrencia->insertUsuarioOcorrencia();
			
			$INFO_MSG = "EVENTO INSERIDO COM SUCESSO!";
		} else {
			$ERROR_MSG = "JA EXISTE UM EVENTO COM O MESMO CODIGO!";
		}

	}

	$cEvento = new classEvento();
	$resultado = $cEvento->findMasterEventos();
	$tipoEventos = $cEvento->findMasterTipoEventos();
	
	include("cadEvento.php");	
}

function alterar() {
	$codEvento = getPost("codEvento");
	$nomeEvento = retiraCaracteresEspeciais(getPost("nomeEvento"));
	$tipoEvento = getPost("tipoEvento");
	$inicioEvento = getPost("inicioEvento");
	$terminoEvento = getPost("terminoEvento");
	
	if ($codEvento == "" || $nomeEvento == "" || $tipoEvento == "" || $inicioEvento == "") {
		$ERROR_MSG = "OS CAMPOS CODIGO, NOME, TIPO E INICIO SAO OBRIGATORIOS!";
	} else {
	
		$objEvento = new classEvento();
		
		$objEvento = $objEvento->findEventoByCodigo($codEvento);
		
	
		if ($objEvento != null) {
			$objEvento = new classEvento();
			$objEvento->codigo = $codEvento;
			$objEvento->nome = $nomeEvento;
			$objEvento->tipoEvento = $tipoEvento;
	
			$objEvento->update();
			
			$objOcorrencia = new classOcorrencia();
			$objOcorrencia->codigo = 1;
			$objOcorrencia->evento = $codEvento;
			$objOcorrencia->nome = $nomeEvento;
			$objOcorrencia->inicio = $inicioEvento;
			$objOcorrencia->termino = $terminoEvento;
			
			$objOcorrencia->update();
			
			$INFO_MSG = "EVENTO ALTERADO COM SUCESSO!";
		} else {
			$ERROR_MSG = "NAO EXISTE EVENTO COM O CODIGO [".$codEvento."]!";
		}
	}

	$cEvento = new classEvento();
	$resultado = $cEvento->findMasterEventos();
	$tipoEventos = $cEvento->findMasterTipoEventos();
	
	include("cadEvento.php");	

}


function editar() {
	$codEvento = getPost("codEvento");
	
	$objEvento = new classEvento();
	
	$objEvento = $objEvento->findEventoByCodigo($codEvento);

	if ($objEvento != null) {
		
		$objOcorrencia = new classOcorrencia();
		$objOcorrencia = $objOcorrencia->findByCodigo($codEvento, 1);

	} else {
		$ERROR_MSG = "NAO EXISTE EVENTO COM O CODIGO [".$codEvento."]!";
	}


	$cEvento = new classEvento();
	$resultado = $cEvento->findMasterEventos();
	$tipoEventos = $cEvento->findMasterTipoEventos();
	
	include("cadEvento.php");	

}


function excluir() {
	$codEvento = getPost("codEvento");
	
	$objEvento = new classEvento();
	$objEvento = $objEvento->findEventoByCodigo($codEvento);
	

	if ($objEvento != null) {
	
		$cInsc = new classInscricao();
		$inscricoes = $cInsc->findTotalInscricoesByEvento($codEvento, 1);
		if ($inscricoes <= 0) {
	
			$objOcorrencia = new classOcorrencia();
			$objOcorrencia = $objOcorrencia->findByCodigo($codEvento, 1);
			if ($objOcorrencia != "" && $objOcorrencia != null) {
			
				// EXCLUI TODAS AS OCORRENCIAS
				$objOcorrencia->deleteOcorrenciasByEvento($codEvento, 1);
				
				// EXCLI AS ASSOCIACOES DE PERMISSAO
				$objUsuarioOcorrencia = new classUsuarioOcorrencia();
				$objUsuarioOcorrencia->evento = $codEvento;
				$objUsuarioOcorrencia->ocorrencia = $objOcorrencia->codigo;
				$objUsuarioOcorrencia->deleteTodasOcorrencias();
			
				$objOcorrencia->delete();
			}
			
			$objEvento->delete();
			
			$INFO_MSG = "EVENTO EXCLUIDO COM SUCESSO!";
		
		} else {
			$ERROR_MSG = "JA EXISTEM INSCRICOES REALIZADAS PARA O EVENTO [".$codEvento."]!";
		}

	} else {
		$ERROR_MSG = "NAO EXISTE EVENTO COM O CODIGO [".$codEvento."]!";
	}


	$cEvento = new classEvento();
	$resultado = $cEvento->findMasterEventos();
	$tipoEventos = $cEvento->findMasterTipoEventos();
	
	include("cadEvento.php");	

}

?>
