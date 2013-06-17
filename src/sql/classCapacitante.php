<?php
class classCapacitante {
	private $evento;
	private $pessoa_fisica;
	
	public function classCapacitante() {
		//construtor
	}
	
	public function insertCapacitante() {
		$result = mysql_query("insert into capacitante(evento,pessoa_fisica)
								  values(".$this->evento.",".$this->pessoa_fisica.")");
		
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteCapacitante() {
		$result = mysql_query("delete from capacitante
								  where evento = ".$this->evento."
								    and pessoa_fisica = ".$this->pessoa_fisica);
		
		return $result;
	}
	
	public function getEvento() {
		return $this->evento;
	}
	public function setEvento($evento) {
		$this->evento = $evento;
	}
	
	public function getPessoa_Fisica() {
		return $this->pessoa_fisica;
	}
	public function setPessoa_Fisica($pessoa_fisica) {
		$this->pessoa_fisica = $pessoa_fisica;
	}
}
?>