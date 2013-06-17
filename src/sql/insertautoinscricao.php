<?php		
  session_start();
	require_once("conexao.php");
	include_once("classInsertInscricao.php");

  if (!isset($_SESSION["fEvento"])) or (!isset($_SESSION["fCodigo"]))
  {
    echo "<h3 align='center'>Evento ou Pessoa Física não cadastrado</h3>"; 
	exit;
  }	
	//INICIA TRANSACAO DE INSCRICAO
	mysql_query("begin"); 
	
	$inscricao = new classInsertInscricao();
	$result = mysql_query("select nextval('seq_codigo_inscricao')");
	$codigo_inscricao = mysql_result($result,0,0);
	
	$inscricao->setCodigo($codigo_inscricao);		
	$inscricao->setEvento($_SESSION["fEvento"]); //VARIAVEL COM O CODIGO DA CONCAFRAS-2009 OU OUTRO EVENTO
	$inscricao->setOcorrencia($fOcorrencia); //VARIAVEL COM O CODIGO DA OCORRENCIA: CONCAFRAS CRISTALINA OU CATALAO, POR EXEMPLO
    $inscricao->setPessoa_Fisica($_SESSION["fCodigo"]);
	$inscricao->setTipo_Alojamento($fTipoAlojamento);
	$inscricao->setData_Insercao(date("Ymd"));
	$inscricao->setUsuario_Insercao('null'); //SE É AUTOCADASTRO ENTÃO NÃO TEM CODIGO DE USUARIO
		
	$result = $inscricao->insertInscricao();
		
	if (!$result) {
		echo "<h3 align='center'>Não foi possível efetuar a inscricao.</h3>";
		mysql_query("rollback"); //DESFAZ TRANSACAO DE INSCRICAO
		exit;
	}
	mysql_query("commit"); //CONFIRMA TRANSACAO DE INSCRICAO E PESSOA FÍSICA
	echo "<h3 align='center'>Inscrição efetuada com sucesso!</h3>";
?>