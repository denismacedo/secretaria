<?php
class classBloco {
	private $pessoa_juridica;
	private $numero_bloco;
	
	public function classBloco() {
		//construtor
	}
	
	public function insertBloco() {
		$result = mysql_query("insert into bloco(pessoa_juridica,numero_bloco)
								  values(".$this->pessoa_juridica.",".$this->numero_bloco.")");
		
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteSala() {
		$result = mysql_query("delete from sala
								  where pessoa_juridica = ".$this->pessoa_juridica."
								    and numero_bloco = '".$this->getNumero_Bloco()."',
								  	 and andar = '".$this->getAndar()."',
									 and numero_sala = '".$this->getNumero_Sala()."',
									 and capacidade = ".$this->getCapacidade());
		
		return $result;
	}
	
	public functin getPessoa_Juridica() {
		return $this->pessoa_juridica;
	}
	public function setPessoa_Juridica($pessoa_juridica) {
		$this->pessoa_juridica = $pessoa_juridica;
	}
	
	public functin getNumero_Bloco() {
		return $this->numero_bloco;
	}
	public function setNumero_Bloco($numero_bloco) {
		$this->numero_bloco = $numero_bloco;
	}
}
?>