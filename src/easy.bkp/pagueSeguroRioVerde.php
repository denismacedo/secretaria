<?php 

	include('biblioteca_pagseguro_v0.22/pgs.php');
	
	
	
	// Criando um novo carrinho
	$pgs=new pgs(array('email_cobranca'=>'iamrioverde@hotmail.com'));
	
	
	// Adicionando um produto
$pgs->adicionar(array(
  array(
    "descricao"=>"Inscrição CONCAFRAS 2011 - Rio Verde",
    "valor"=>$objBoleto->valor,
    "peso"=>0,
    "quantidade"=>1,
    "id"=>$objBoleto->nosso_nro
  ),
));

	$endereco1 = $objPF->rua_ou_quadra.", ".$objPF->numero.". ".$objPF->bairro;
	$endereco2 = $objPF->cidade." - ".$objPF->unidade_da_federacao;
	
	
	
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

?>

<html>
	<body onload="document.forms[0].submit();">
	
	<?php 
		// Mostrando o botão de pagamento
		$pgs->mostra();
	?>
	</body>
</html>