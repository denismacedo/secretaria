<?php


session_start();


$user="root";
$password="";
$database="secretaria";
mysql_connect('localhost',$user,$password);
@mysql_select_db($database) or die( "Erro ao conectar com banco de dados...". mysql_error());
	

require_once('util/http.php'); 
require_once('util/comum.php'); 
require_once("sql/classPF.php"); 
require_once("sql/classPJ.php"); 
require_once("sql/classCidade.php"); 
require_once("sql/classOcorrencia.php"); 



$metodo = $_GET["method"];

if ($metodo == "init") {

	init();
	
} else if ($metodo == "execute") {
	
	backup();
}

function init() {

	include("backup.php");
}

function backup() {

	header('Content-Type: text\plain'); 
	header('Content-Disposition: attachment; filename="secretaria.bk"');

	echo "evento\n".$_SESSION["NOME_EVENTO_SESSION"]."\n\n";

	$tables = array("pessoa_fisica", "telefone");
	$queries = array("select codigo, nome, sexo, data_nasc, dirigente_centro, profissao, responsavel, cidade, unidade_da_federacao, pais, email, apelido from pessoa_fisica", "select pessoa_fisica, ddd, numero from pessoa_fisica_telefone");
	
	for ($i = 0; $i < count($tables); $i++) {
		$query      = $queries[$i];
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		if ($i > 0) {
			echo "\n\n";
		}
		echo $tables[$i]."\n";
		while($row=mysql_fetch_row($result)) {
			$count = count($row);
			for ($j = 0; $j < $count; $j++) {
				echo $row[$j].";";
			}
			echo "\n";
		}
	}
	


}


?>