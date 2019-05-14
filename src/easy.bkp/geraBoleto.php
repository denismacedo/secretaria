<?php 

	// Inclui o código que faz a conexão com o banco de dados
	require("../db.php"); 
	
	$nroCadastro = $_POST["nroCadastro"];
	
	$query = "SELECT A.NOME AS nome, A.TIPO AS tipo, A.RESPONSAVEL AS responsavel, A.LOGRADOURO AS logradouro, A.NUMERO AS numero,
			A.BAIRRO as bairro, A.CIDADE AS cidade, A.UF AS uf, B.DATA_VENCIMENTO AS vencimento, B.NOSSO_NRO AS nosso_nro, B.VALOR AS valor
			FROM PESSOA_FISICA A, BOLETO B
			WHERE A.CODIGO = B.COD_CADASTRO
			AND A.CODIGO = $nroCadastro";
			
	$result = mysql_query($query);
	$row = mysql_fetch_array($result) or die(mysql_error());
	
	$vencimento = substr($row['vencimento'], 8, 2)."/".substr($row['vencimento'], 5, 2)."/".substr($row['vencimento'], 0, 4);
	$valor = $row['valor'];
	$nossoNro = $row['nosso_nro'];
	$nroDoc = $nroCadastro;
	while (strlen($nroDoc) < 5) {
		$nroDoc = '0'.$nroDoc;
	}
	if ($row['tipo'] == "I")
		$nome = $row['responsavel'];
	else
		$nome = $row['nome'];
		
	$endereco1 = $row['logradouro'].", ".$row['numero'].". ".$row['bairro'];
	$endereco2 = $row['cidade']." - ".$row['uf'];
	

	// INCLUI O CODIGO QUE GERA O BOLETO
	include("boleto_bb.php");

?>