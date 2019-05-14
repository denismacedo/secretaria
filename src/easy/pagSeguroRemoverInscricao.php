<?php 
	session_start();
	
	include('biblioteca_pagseguro_v0.22/pgs.php');


//$_SESSION['pgs'] = NULL;
//unset($_SESSION['pgs']);
  
// pegando o parceiro via get
$pgsStr = $_SESSION['pgstr'];

$pgs = unserialize($pgsStr);

	
	
	// Adicionando um produto
$pgs->remover($_GET["id"]);
$_SESSION["pgstr"] = serialize($pgs);

if ($pgs->tamanho() <= 0) {
	$_SESSION["pgstr"] = NULL;
	unset($pgstr);
}




		include ("header.php");

		echo "<br/><br/><table id='tbBtnPagar' width='80%' align='center' ><tr><td>";
		echo "<a href='index.php?evento=".$_SESSION["EVENTO_SESSION"]."&ocorrencia=".$_SESSION["OCORRENCIA_SESSION"]."'><img src='../imagens/add.png' border='0' valign='middle'/> Adicionar mais inscrições</a>";
		echo "</td></tr></table>";
		$pgs->exibeCarrinho();
		echo "<br/><br/><table id='tbBtnPagar' width='80%' align='center' ><tr><td align='right'>";
		$pgs->mostra();
		echo "</td></tr></table>";
		echo "<br/>";
include ("footer.php");