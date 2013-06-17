<?php
class classParticularidade {
  public $pf;
  public $doenca;
  public $medicamento;
  public $observacao;
  public $codigo;
  
	public function classParticularidade() {
		//construtor
	}
	
	public function insertParticularidade() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deleteParticularidade() {
		//$result = mysql_query("delete from usuario
		//						  where codigo = ".$this->codigo);
	}
	
	public function findByPK($pf) {
		$query = "select * from particularidade
		where pessoa_fisica = $pf";
						
								
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objParticularidade = new classParticularidade();
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objParticularidade->pf =  mysql_result($resultado,0, "pessoa_fisica");
			$objParticularidade->codigo =  mysql_result($resultado,0, "codigo");
			$objParticularidade->doenca =  mysql_result($resultado,0, "doenca");
			$objParticularidade->medicamento =  mysql_result($resultado,0, "medicamento");
			$objParticularidade->observacao =  mysql_result($resultado,0, "observacao");
		}
		
		return $objParticularidade;
	}

}

?>