<?php
class classOrigem {
  public $pf;
  public $evento;
  public $data;
  public $pj;
  public $nomePJ;
  public $cidade;
  public $estado;
  
	public function classOrigem() {
		//construtor
	}
	
	public function insertOrigem() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deleteOrigem() {
		//$result = mysql_query("delete from usuario
		//						  where codigo = ".$this->codigo);
	}
	
	public function findByPK($pf) {
		$query = "SELECT A.pessoa_fisica AS PF, A.evento AS EVENTO, A.data_registro AS DATA, B.codigo AS PJ, B.nome AS NOME_PJ, B.cidade 				
		AS CIDADE, B.unidade_da_federacao AS ESTADO
		FROM origem A, pessoa_juridica B
		WHERE A.pessoa_fisica = $pf
		AND A.pessoa_juridica = B.CODIGO";
						
								
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objOrigem = new classOrigem();
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objOrigem->pf =  mysql_result($resultado,0, "pf");
			$objOrigem->evento =  mysql_result($resultado,0, "evento");
			$objOrigem->data =  mysql_result($resultado,0, "data");
			$objOrigem->pj =  mysql_result($resultado,0, "pj");
			$objOrigem->nomePJ =  mysql_result($resultado,0, "nome_pj");
			$objOrigem->cidade =  mysql_result($resultado,0, "cidade");
			$objOrigem->estado =  mysql_result($resultado,0, "estado");
		}
		
		return $objOrigem;
	}

}

?>