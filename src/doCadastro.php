<?php 
require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 
require_once("sql/classPF.php"); 
require_once("sql/classPJ.php"); 
require_once("sql/classCidade.php"); 
require_once("sql/classOcorrencia.php"); 


$metodo = $_GET["method"];

if ($metodo == "searchNomePFByNome") {

	searchNomePFByNome();
	
} else if ($metodo == "searchPF") {
	
	searchPF();
	
} else if ($metodo == "searchResponsavelByNome") {
	
	searchResponsavelByNome();
} else if ($metodo == "searchNomePJByNome") {

	searchNomePJByNome();

} else if ($metodo == "searchCidadeByNome") {

	searchCidadeByNome();
	
} else if ($metodo == "salvar") {

	salvar();	
	
} else if ($metodo == "getPaises") {

	getPaises();

} else if ($metodo == "getEstados") {

	getEstados();

} else if ($metodo == "getCidades") {

	getCidades();

}

/**
 * BUSCA UMA PESSOA PELO NOME (UTILIZADA NO AUTOCOMPLETE - AJAX)
 */
function searchNomePFByNome() {
	$cPF = new classPF();
	$resultado = $cPF->searchNomePFByNome(getPost("nome"));
	
	header("Content-Type: text/xml");

	echo '<?xml version="1.0" encoding="iso-8859-1"?><results>';
	
	$linhas = mysql_num_rows($resultado);
	for($x=0; $x < $linhas; $x++) 	{
		echo "<rs id=\"".mysql_result($resultado,$x,0)."\" info=\"".mysql_result($resultado,$x,2)." - ".mysql_result($resultado,$x,3)."\">".mysql_result($resultado,$x,1)."</rs>";
	}
	echo "</results>";
}

/**
 * BUSCA UMA PESSOA PELO NOME (UTILIZADA NO AUTOCOMPLETE - AJAX)
 */
function searchResponsavelByNome() {
	$cPF = new classPF();
	$resultado = $cPF->searchResponsavelByNome(getPost("nome"));
	
	header("Content-Type: text/xml");

	echo '<?xml version="1.0" encoding="iso-8859-1"?><results>';
	
	$linhas = mysql_num_rows($resultado);
	for($x=0; $x < $linhas; $x++) 	{
		echo "<rs id=\"".mysql_result($resultado,$x,0)."\" info=\"".mysql_result($resultado,$x,2)." - ".mysql_result($resultado,$x,3)."\">".mysql_result($resultado,$x,1)."</rs>";
	}
	echo "</results>";
}

/**
 * BUSCA OS DADOS DE UMA PESSOA QUANDO UM CODIGO É SELECIONADO.
 */
function searchPF() {

	$codigo = getPost("codigo");
	
	exibeDadosPF($codigo);

}

/**
 * EXIBE OS DADOS DE UMA PESSOA FISICA IDENTIFICADA PELO CODIGO INFORMADO
 */
function exibeDadosPF($codigo) {

	if ($codigo != "") {
		$cPF = new classPF();
		$objPF = $cPF->findByCodigo($codigo);
	}
	if ($_SESSION["EVENTO_SESSION"] != "" && $_SESSION["OCORRENCIA_SESSION"] != "") {
	
		$objOco = new classOcorrencia();
		$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
		
		$idade = dateDiff($objPF->data_nasc, $objOco->inicio);
		
		if ($idade < 7) {
			$specialParam = "CRACHA_INFANTIL";
		} else {
			$specialParam = "";
		}
	}

	
	include("cadastroPF.php");

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
 * BUSCA UMA CIDADE PELO NOME (UTILIZADA NO AUTOCOMPLETE - AJAX)
 */
function searchCidadeByNome() {
	$cCidade = new classCidade();
	$resultado = $cCidade->searchCidadeByNome(retiraCaracteresEspeciais(getPost("nome")));
	
	header("Content-Type: text/xml");

	echo '<?xml version="1.0" encoding="iso-8859-1"?><results>';
	
	$linhas = mysql_num_rows($resultado);
	for($x=0; $x < $linhas; $x++) 	{
		echo "<rs id=\"".mysql_result($resultado,$x,0)."/".mysql_result($resultado,$x,1)."/".mysql_result($resultado,$x,3)."\" info=\"".mysql_result($resultado,$x,2)." - ".mysql_result($resultado,$x,4)."\">".mysql_result($resultado,$x,0)."</rs>";
	}
	echo "</results>";
}

/**
 * SALVA OS DADOS DE UMA PF
 */
function salvar() {

	$codigo = getPost("codigo");
	$nome = retiraCaracteresEspeciais(getPost("nome"));
	$apelido = retiraCaracteresEspeciais(getPost("apelido"));
	$dataNasc = getPost("dataNasc");
	$sexo = getPost("sexo");
	$rua = retiraCaracteresEspeciais(getPost("rua"));
	$nro = getPost("nro");
	$complemento = retiraCaracteresEspeciais(getPost("complemento"));
	$cep = getPost("cep");
	$bairro = retiraCaracteresEspeciais(getPost("bairro"));
	$codCidade = getPost("codCidade");
	$email = getPost("email");
	$violao = getPost("violao");
	$profissao = getPost("profissao");
	$dirigente = getPost("dirigente");
	$codResponsavel = getPost("codResponsavel");
	$codOrigem = getPost("codOrigem");
	$ddd = getPost("ddd");
	$residencial = getPost("residencial");
	$comercial = getPost("comercial");
	$celular = getPost("celular");
	$doenca = getPost("doenca");
	$medicamento = getPost("medicamento");
	$obs = getPost("obs");
	
	// VALIDA OS CAMPOS
	$ok = false;
	$erro = "";
	if ($nome == "" || $dataNasc == "" || $sexo == "") {
		$erro = "OS CAMPOS NOME, DATA DE NASCIMENTO E SEXO S&Atilde;O DE PREENCHIMENTO OBRIGAT&Oacute;RIO!";
	}

	$objPF = new classPF();
	$objPF->codigo = $codigo;
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
	$objPF->responsavel = $codResponsavel;
	
	// TRATA CIDADE
	if (isset($codCidade) && $codCidade != "") {
		list($cidade, $estado, $pais) = split('[/.-]', $codCidade);
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
		
	if ($erro == "") {
		
		mysql_query("BEGIN");
		$objPF->save();
		mysql_query("COMMIT");
		
		$INFO_MSG = "OPERA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!";
		
	 	if ($codigo != "") {
			$cPF = new classPF();
			$objPF = $cPF->findByCodigo($codigo);
		}
		if ($_SESSION["EVENTO_SESSION"] != "" && $_SESSION["OCORRENCIA_SESSION"] != "") {
			$objOco = new classOcorrencia();
			$objOco = $objOco->findByCodigo($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
			
			$idade = dateDiff($objPF->data_nasc, $objOco->inicio);
			
			if ($idade < 7) {
				$specialParam = "CRACHA_INFANTIL";
			} else {
				$specialParam = "";
			}
		}
	
		include("cadastroPF.php");
		
	} else {
	
		$ERROR_MSG = $erro;
		
		include("cadastroPF.php");
	}

}

function getPaises() {

  $result = mysql_query("select sigla, nome from pais order by nome");
  $linhas=mysql_num_rows($result);
  $retorno = "";
  for($x=0; $x < $linhas; $x++)
  {
    $retorno .= "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option>";
  }
  
  return $retorno;


}

function getEstados() {

	$retorno = "";
	$sql = "SELECT sigla, nome FROM estado where pais = '{$_GET['pais']}' ORDER BY nome ";	
	$result = mysql_query($sql);
	$linhas = mysql_num_rows($result);
	for($x=0; $x < $linhas; $x++)
	{
	  $retorno .= "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option><br>";
	}

	return $retorno;

}

function getCidades() {

	$retorno = "<option></option>";

  $sql = "SELECT nome FROM cidade WHERE unidade_da_federacao = '{$_GET['uf']}' AND pais = '{$_GET['pais']}' ORDER BY nome";
  $result = mysql_query($sql);
  $linhas = mysql_num_rows($result);
  for($x=0; $x < $linhas; $x++)
  {
    $retorno .= "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option><br>";
  }
  
  return $retorno;

}


?>
