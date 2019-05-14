<?php 

	$nroInscricao = $objInsc->nro_inscricao;
	
	//$vencimento = substr($row['vencimento'], 8, 2)."/".substr($row['vencimento'], 5, 2)."/".substr($row['vencimento'], 0, 4);
	$vencimento = formatDate($objBoleto->data_vencimento);
//	$valor = $objBoleto->valor + 2.50; // COBRANDO 2.50 PELA EMISSAO DO BOLETO
	$valor = $objBoleto->valor; // COBRANDO 2.50 PELA EMISSAO DO BOLETO
	
	// 02008 + $nroInscricao
	$nossoNro = $objBoleto->nosso_nro;

	$nroDoc = $nroInscricao;

	while (strlen($nroDoc) < 5) {
		$nroDoc = '0'.$nroDoc;
	}

	$nome = $objBoleto->sacado;
		
	$endereco1 = $objPF->rua_ou_quadra.", ".$objPF->numero.". ".$objPF->bairro;
	$endereco2 = $objPF->cidade." - ".$objPF->unidade_da_federacao;
	
	$agencia = $objCP->agencia; //substr($objCP->agencia, 0, 3);
	$conta = $objCP->conta_corrente; //substr($objCP->conta_corrente, 0, 4);
	$convenio = $objCP->convenio;
	$cedente = $objCP->titular;
	

	// INCLUI O CODIGO QUE GERA O BOLETO
	if ($objCP->banco == "BRASIL") {
		include("boleto_bb.php");
	} else if ($objCP->banco == "ITAU") {
		include("boleto_itau.php");
	}

?>