<?php
  session_start();
	require_once("conexao.php");
	include_once("classInsertPF.php");
	include_once("classTelefonePF.php");
	include_once("classInsertParticularidade.php");
	include_once("classInsertEmail.php");
	include_once("classInsertOrigem.php");
	
	$insert = new classInsertPF();
	$telefone = new classTelefonePF();
	$particularidade = new classInsertParticularidade();
	$email = new classInsertEmail();
	$origem = new classInsertOrigem();
	
	//INICIO DA TRANSAÇÃO DE CADASTRO
	mysql_query("begin");
	
	$result = mysql_query(" SELECT ifnull(max(codigo),0) + 1 from pessoa_fisica ");
	$codigo = mysql_result($result,0,0);

	$_SESSION["fCodigo"] = $codigo;
	$_SESSION["fEvento"] = $fEvento;
	$insert->setCodigo($codigo);
	$insert->setNome($fNome);
	$insert->setSexo($fSexo);
	$insert->setRua_ou_quadra($fRua);
	$insert->setComplemento_ou_conjunto($fComplemento);
	$insert->setNumero($fNumero);
	$insert->setBairro($fBairro);
	$insert->setCep($fCep);
	$insert->setData_Nasc($fDataNasc);
	$insert->setDirigente($fDirigente);
	$insert->setProfissao($fProfissao);
	$insert->setResponsavel($fResponsavel);
	$insert->setUnidade_da_federacao($_POST['fEstados']);
	$insert->setCidade($_POST['fCidades']);
	$insert->setPais($fPais);
	$insert->setTipoPF($fTipoPF);
	  
	$result = $insert->insertPF();
	
	if (!$result) 
	{
	 	echo "<h3 align='center'>Não foi possível salvar. Tecle F5 para reenviar as informações ou clique em voltar e tente novamente!</h3>";
		mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
		exit;
	} 
	else 
	{
		if ($fResidencial <> '' and $fDDDResid <> '')
		{
			$telefone->setDDD($fDDDResid);
			$telefone->setNumero($fResidencial);
			$telefone->setTipoTelefone(1);
			$telefone->setPessoaFisica($codigo);
			$result = $telefone->insertTelefonePF();			
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível incluir o telefone residencial.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}
		}
		if ($fComercial <> '' and $fDDDComerc <> '')
		{
			$telefone->setDDD($fDDDComerc);
			$telefone->setNumero($fComercial);
			$telefone->setTipoTelefone(2);
			$telefone->setPessoaFisica($codigo);
			$result = $telefone->insertTelefonePF();
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível incluir o telefone comercial.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}		
		}
		if ($fCelular <> '' and $fDDDCel <> '')
		{
			$telefone->setDDD($fDDDCel);
			$telefone->setNumero($fCelular);
			$telefone->setTipoTelefone(3);
			$telefone->setPessoaFisica($codigo);
			$result = $telefone->insertTelefonePF();
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível incluir o telefone celular.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}		
		}
		if ($fDoenca <> '' and $fMedicamento <> '' and $fObservacao <> '') 
		{
			$particularidade->setPessoa_Fisica($codigo);
			$particularidade->setCodigo(1);
			$particularidade->setDoenca($fDoenca);
			$particularidade->setMedicamento($fMedicamento);
			$particularidade->setObservacao($fObservacao);
			$result = $particularidade->insertParticularidade();
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível incluir particularidade.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}
		}
		if ($fEmail <> '') 
		{
			$email->setEmail($fEmail);
			$email->setTipoEmail(1);
			$email->setPessoaFisica($codigo);
			$email->setPessoaJuridica(''); //para a classe setar null 
			$result = $email->insertEmail();
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível inserir o email.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}
		}
		if ($fNomeOrigem <> '') 
		{
			$origem->setPessoaFisica($codigo);
			$origem->setPessoaJuridica($fOrigem);
			$origem->setDataRegistro(date("Ymd"));
			if ($fEvento <> '') 
			{
				$origem->setEvento($fEvento); //CODIGO DA CONCAFRAS-2009 (POR EXEMPLO) OU EVENTO NO QUAL O SISTEMA ESTA SENDO UTILIZADO
			}
			$origem->insertOrigem();
			
			if (!$result) 
			{
				echo "<h3 align='center'>Não foi possível inserir a origem.</h3>";
				mysql_query("rollback"); //DESFAZ A TRANSAÇÃO
				exit;
			}
		}
		mysql_query("commit"); //CONFIRMA TRANSAÇÃO DE CADASTRO
		echo "<h3 align='center'>Pessoa Física cadastrada com sucesso!</h3>";
	}
?>