<?php 
session_start();

require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 

require_once("sql/classPF.php"); 
require_once("sql/classOcorrencia.php"); 
require_once("sql/classInscricao.php"); 
require_once("sql/classTipoAlojamento.php"); 
require_once("sql/classParticipante.php"); 
require_once("sql/classCracha.php"); 
require_once("cursoBean.php"); 

?>


<?php

$metodo = $_GET["method"];

if ($metodo == "init") {

	init();
	
} else if ($metodo == "save") {
	
	salvar();
	
}

function init() {
	if ($_SESSION["OCORRENCIA_SESSION"] != "" && $_SESSION["EVENTO_SESSION"] != "") {
	
		$objCracha = new classCracha();
		$objCracha = $objCracha->findCrachaByEvento($_SESSION["EVENTO_SESSION"],  $_SESSION["OCORRENCIA_SESSION"]);

		if ($objCracha->evento != NULL && $objCracha->evento != "" && $objCracha->evento >= 0) {
			$altura =  $objCracha->altura;
			$largura = $objCracha->largura;
			$margem_superior = $objCracha->margem_superior;
			$margem_esquerda = $objCracha->margem_esquerda;
			$tamanho_fonte = $objCracha->tamanho_fonte;
		} else {
			// APRESENTA VALORES DFEAULT
			$altura =  15.0;
			$largura = 10.0;
			$margem_superior = 5.5;
			$margem_esquerda = 0.0;
			$tamanho_fonte = 18;
			$INFO_MSG="O CRACHA AINDA NAO FOI CONFIGURADO PARA ESTE EVENTO! OS DADOS ABAIXO REPRESENTAM UMA SUGESTAO DE CONFIGURACAO.";
		}
	}
	include("configuracaoCracha.php");
}

function salvar() {

	$altura = getPost("altura");
	$largura = getPost("largura");
	$margem_superior = getPost("margem_superior");
	$margem_esquerda = getPost("margem_esquerda");
	$tamanho_fonte = getPost("tamanho_fonte");
	
	$objCracha = new classCracha();
	$objCracha = $objCracha->findCrachaByEvento($_SESSION["EVENTO_SESSION"],  $_SESSION["OCORRENCIA_SESSION"]);
	
	$objCracha->altura = $altura;
	$objCracha->largura = $largura;
	$objCracha->margem_superior = $margem_superior;
	$objCracha->margem_esquerda = $margem_esquerda;
	$objCracha->tamanho_fonte = $tamanho_fonte;

	if ($objCracha->evento != NULL && $objCracha->evento != "" && $objCracha->evento >= 0) {
		$objCracha->updateCracha();
	} else {
		$objCracha->evento = $_SESSION["EVENTO_SESSION"];
		$objCracha->ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
		$objCracha->insertCracha();
	}
	$INFO_MSG = "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!";
	include("configuracaoCracha.php");
}

?>