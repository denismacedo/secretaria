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
require_once("sql/classBoleto.php"); 
require_once("cursoBean.php"); 

?>


<?php

$metodo = $_GET["method"];

if ($metodo == "init") {

	init();
	
} else if ($metodo == "buscar") {
	
	buscar();
	
} else if ($metodo == "confirmar") {
	
	confirmar();
	
} else if ($metodo == "corrigir") {
	
	corrigir();
	
}

function init() {
	include("controlePagamento.php");
}

function buscar() {

	$evento = $_SESSION["EVENTO_SESSION"];
	$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];

	$nroInscricao = getPost("nroInscricao");
	$nomePF = getPost("nomePF");
	
	$objInscricao = new classInscricao();
	$resultado = $objInscricao->findByNroInscricaoAndNome($nroInscricao, $nomePF, $evento, $ocorrencia);

	include("controlePagamento.php");
}

function confirmar() {
	
	$evento = $_SESSION["EVENTO_SESSION"];
	$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	$nroInscricao = getPost("nroInscricao");
	$dataPago = getPost("dataPago");
	$valorPago = getPost("valorPago");
	$nossoNro = getPost("nossoNro");
	
	$sendEmail=getPost("sendEmail");
	
	if ($dataPago == "") {
		$dataPago = date("d/m/Y");
	}
	
	$valorPago = str_replace(",", ".", $valorPago);
	$classBoleto = new classBoleto();
	$boleto = $classBoleto->findByNroInscricaoAndEvento($nroInscricao, $evento, $ocorrencia);
	
	$classInscricao = new classInscricao();
	$codInscricao = $classInscricao->findCodInscricaoByNroInscricaoEvento($nroInscricao, $ocorrencia, $evento);
	
	echo $codInscricao;
	
	if ($boleto == NULL) {
		$boleto = new classBoleto();
		$boleto->inscricao = $codInscricao;
		$boleto->valor = $valorPago;
		
		$boleto->data_pago = getDBDate($dataPago);
		$boleto->valor_pago = $valorPago;
		if ($nossoNro != "") {
			$boleto->nosso_nro = $nossoNro;
		} else {
			$boleto->nosso_nro = "0";
		}
		$boleto->pago = 'S';
		
		$boleto = $boleto->savePago();
		
	} else {
		$boleto->data_pago = getDBDate($dataPago);
		$boleto->valor_pago = $valorPago;
		if ($nossoNro != "") {
			$boleto->nosso_nro = $nossoNro;
		} else {
			$boleto->nosso_nro = "0";
		}
		$boleto->pago = 'S';
		
		$boleto->confirmaPagamento();
	}
	
	echo "Operação realizada com sucesso!";
	
	if ($sendEmail=="1"){
	
		$objInscricao = $classInscricao->findInscricaoByCodigo($codInscricao);
		
		$classPF = new classPF();
		
		$objPF = $classPF->findByCodigo($objInscricao->pessoa_fisica);
		
		$headers = "From: concafras@concafras2010.org.br \r\n"; 
		$headers .= "Content-Type: text/html; charset=ISO-8859-1 "; 
		$headers .= "MIME-Version: 1.0 "; 
		
		$corpo = "<br><br>Caro(a) ".$objPF->nome.",<br><br>Sua inscri&ccedil;&atilde;o para a Concafras-PSE 2010 est&aacute; confirmada.<br> Caso tenha alguma d&uacute;vida ou sugest&atilde;o entre em contato conosco pelos emails secretariacastro@concafras2010.org.br ou secretariasp@concafras2010.org.br.<br><br>Muita paz!<br><b><a href='http://www.concafras2010.org.br'>www.concafras2010.org.br</a></b>";
		

		mail($objPF->email, "Inscrição Confirmada", $corpo, $headers) or die ("Infelizmente o email nao pode ser enviado!");
	}
}




function corrigir() {
	$evento = $_SESSION["EVENTO_SESSION"];
	$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
	
	$nroInscricao = getPost("nroInscricao");
	$classBoleto = new classBoleto();
	$boleto = $classBoleto->findByNroInscricaoAndEvento($nroInscricao, $evento, $ocorrencia);

	$boleto->corrigePagamento();

	echo "Operação realizada com sucesso!";
}

?>