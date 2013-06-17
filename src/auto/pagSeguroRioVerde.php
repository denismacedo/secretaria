<?php 
	session_start();
	
	include('biblioteca_pagseguro_v0.22/pgs.php');


//$_SESSION['pgs'] = NULL;
//unset($_SESSION['pgs']);
  
// pegando o parceiro via get
$pgsStr = $_SESSION['pgstr'];

$evento = $_SESSION["EVENTO_SESSION"];
$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];

// isset verifica se a sessão chamada Parceiro já existe
	if(!isset($pgsStr)) {

		//echo "PGS NAO ENCONTRADO";
		// Criando um novo carrinho
		$pgs=new pgs(array('email_cobranca'=>'iamrioverde@hotmail.com'));
		
		$pgs->cliente(
		  array (
		   'nome'   => $objPF->nome,
		   'cep'    => $objPF->cep,
		   'end'    => $objPF->rua_ou_quadra,
		   'num'    => $objPF->numero,
		   'compl'  => $objPF->complemento_ou_conjunto,
		   'bairro' => $objPF->bairro,
		   'cidade' => $objPF->cidade,
		   'uf'     => $objPF->unidade_da_federacao,
		   'pais'   => $objPF->pais,
		   'ddd'    => $objPF->ddd,
		   'tel'    => $objPF->telRes,
		   'email'  => $objPF->email,
		  )
		);
		$pgs->evento = $evento;
		$pgs->ocorrencia = $ocorrencia;
		//session_register($pgstr);
		$_SESSION["pgstr"] = serialize($pgs);
		
		//echo "PGS SERIALIZADO=".$_SESSION["pgs"];
	} else {
		$pgs = unserialize($pgsStr);
		
		
		if ($pgs->evento != $evento || $pgs->ocorrencia != $ocorrencia) {
			$pgs=new pgs(array('email_cobranca'=>'iamrioverde@hotmail.com'));
		
			$pgs->cliente(
			  array (
			   'nome'   => $objPF->nome,
			   'cep'    => $objPF->cep,
			   'end'    => $objPF->rua_ou_quadra,
			   'num'    => $objPF->numero,
			   'compl'  => $objPF->complemento_ou_conjunto,
			   'bairro' => $objPF->bairro,
			   'cidade' => $objPF->cidade,
			   'uf'     => $objPF->unidade_da_federacao,
			   'pais'   => $objPF->pais,
			   'ddd'    => $objPF->ddd,
			   'tel'    => $objPF->telRes,
			   'email'  => $objPF->email,
			  )
			);
			$pgs->evento = $evento;
			$pgs->ocorrencia = $ocorrencia;
			
			//session_register($pgstr);
			$_SESSION["pgstr"] = serialize($pgs);
		}
	}
	
	
	// Adicionando um produto
$pgs->adicionar(array(
  array(
    "descricao"=>"Inscrição CONCAFRAS 2011 - Rio Verde - ".$objPF->nome,
    "valor"=>$objBoleto->valor,
    "peso"=>0,
    "quantidade"=>1,
    "id"=>$objBoleto->nosso_nro,
	"extra"=>$objInsc->nro_inscricao
  ),
));


$_SESSION["pgstr"] = serialize($pgs);


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