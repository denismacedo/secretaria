<?php
class classCidade {
  public $unidade_da_federacao;
  public $nome;
  public $pais;
  public $nomeEstado;
  public $nomePais;
  
	
	public function classCidade() {
		//construtor
	}
	
	public function insertCidade() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deleteCidade() {
		//$result = mysql_query("delete from usuario
		//						  where codigo = ".$this->codigo);
	}
	
	public function searchCidadeByNome($nome) {
		$query = "select a.nome, b.sigla, b.nome, a.pais, c.nome from cidade a, estado b, pais c where a.unidade_da_federacao = b.sigla AND a.pais = b.pais AND a.pais = c.sigla AND b.pais = c.sigla AND UPPER(a.nome) like UPPER('".$nome."%')";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	
	public function findByPK($pais, $estado, $cidade) {
		$query = "select a.nome as cidade, b.sigla as estado, b.nome as nome_estado, a.pais as pais, c.nome as nome_pais from cidade a, estado b, pais c where a.unidade_da_federacao = b.sigla AND a.pais = b.pais AND a.pais = c.sigla AND b.pais = c.sigla AND a.nome = '$cidade' AND a.unidade_da_federacao = '$estado' AND a.pais = '$pais'";

		//ECHO $query;
								
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objCidade = new classCidade();
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objCidade->nome =  mysql_result($resultado,0, "cidade");
			$objCidade->unidade_da_federacao =  mysql_result($resultado,0, "estado");
			$objCidade->pais =  mysql_result($resultado,0, "pais");
			$objCidade->nomeEstado =  mysql_result($resultado,0, "nome_estado");
			$objCidade->nomePais =  mysql_result($resultado,0, "nome_pais");
		}
		
		return $objCidade;
	}

}

?>