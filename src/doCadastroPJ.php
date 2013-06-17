<?php 
require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 
require_once("sql/classPF.php"); 
require_once("sql/classPJ.php"); 
require_once("sql/classCidade.php"); 


$metodo = $_GET["method"];

if ($metodo == "searchNomePJByNome") {

	searchNomePJByNome();
	
} else if ($metodo == "searchPJ") {
	
	searchPJ();
	
} else if ($metodo == "searchCidadeByNome") {

	searchCidadeByNome();

} else if ($metodo == "initPop") {

	initPop();	
		
} else if ($metodo == "salvar") {

	salvar();	
}

function initPop() {
	
	include("cadastroPJ.php");
}

/**
 * BUSCA OS DADOS DE UMA PESSOA QUANDO UM CODIGO É SELECIONADO.
 */
function searchPJ() {

	$codigo = getPost("codigo");
	
	exibeDadosPJ($codigo);

}

/**
 * EXIBE OS DADOS DE UMA PESSOA FISICA IDENTIFICADA PELO CODIGO INFORMADO
 */
function exibeDadosPJ($codigo) {

	if ($codigo != "") {
		$cPJ = new classPJ();
		$objPJ = $cPJ->findByCodigo($codigo);
	}
	
	include("cadastroPJ.php");

}

/**
 * BUSCA UMA PESSOA JURIDICA PELO NOME (UTILIZADA NO AUTOCOMPLETE - AJAX)
 */
function searchNomePJByNome() {
	$cPJ = new classPJ();
	$resultado = $cPJ->searchNomePJByNome(retiraCaracteresEspeciais(getPost("nome")));
	
	header("Content-Type: text/xml");

	echo '<?xml version="1.0" encoding="iso-8859-1"?><results>';
	
	$linhas = mysql_num_rows($resultado);
	for($x=0; $x < $linhas; $x++) 	{
		echo "<rs id=\"".mysql_result($resultado,$x,0)."\" info=\"".mysql_result($resultado,$x,2)." - ".mysql_result($resultado,$x,3)."\">".mysql_result($resultado,$x,1)."</rs>";
	}
	echo "</results>";
}

/**
 * SALVA OS DADOS DE UMA PJ
 */
function salvar() {

	$erro = "";

	$codigo = getPost("codigo");
	$nome = retiraCaracteresEspeciais(getPost("nome"));
	$rua = retiraCaracteresEspeciais(getPost("rua"));
	$nro = getPost("nro");
	$complemento = retiraCaracteresEspeciais(getPost("complemento"));
	$cep = getPost("cep");
	$bairro = retiraCaracteresEspeciais(getPost("bairro"));
	$codCidade = getPost("codCidade");
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
	
	if ($codCidade == "" || $nome == "") {
		$erro = "OS CAMPOS NOME E CIDADE S&Atilde;O DE PREENCHIMENTO OBRIGAT&Oacute;RIO";
	}
	
	
	// TRATA CIDADE
	if (isset($codCidade) && $codCidade != "") {
		list($cidade, $estado, $pais) = split('[/.-]', $codCidade);
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
		
	 	
	} else {
	
		$ERROR_MSG = $erro;
	
	}
	
	if ($codigo != "") {
			$cPJ = new classPJ();
			$objPJ = $cPJ->findByCodigo($codigo);
		}
		include("cadastroPJ.php");
	
}
?>