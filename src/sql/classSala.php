<?php
class classSala {
	private $pessoa_juridica;
	private $numero_bloco;
	private $andar;
	private $numero_sala;
	private $capacidade;
	
	public function classSala() {
		//construtor
	}
	
	public function insertSala() {
		$result = mysql_query("insert into sala(pessoa_juridica,numero_bloco,andar,numero_sala,capacidade)
								  values(".$this->pessoa_juridica.",'".$this->numero_bloco."','".$this->andar."','".$this->numero_sala."',".
								  		$this->capacidade.")");
		
		return $result;
	}
	
	public function updateSala() {
		$result = mysql_query("update sala
								  set capacidade = ".$this->getCapacidade()."
								  where pessoa_juridica = ".$this->pessoa_juridica."
								    and numero_bloco = '".$this->getNumero_Bloco()."',
								  	 and andar = '".$this->getAndar()."',
									 and numero_sala = '".$this->getNumero_Sala());
		
		return $result;
	}
	
	public function deleteSala() {
		$result = mysql_query("delete from sala
								  where pessoa_juridica = ".$this->pessoa_juridica."
								    and numero_bloco = '".$this->getNumero_Bloco()."',
								  	 and andar = '".$this->getAndar()."',
									 and numero_sala = '".$this->getNumero_Sala());
		
		return $result;
	}
	
	public function getPessoa_Juridica() {
		return $this->pessoa_juridica;
	}
	public function setPessoa_Juridica($pessoa_juridica) {
		$this->pessoa_juridica = $pessoa_juridica;
	}
	
	public function getNumero_Bloco() {
		return $this->numero_bloco;
	}
	public function setNumero_Bloco($numero_bloco) {
		$this->numero_bloco = $numero_bloco;
	}
	
	public function getAndar() {
		return $this->andar;
	}
	public function setAndar($andar) {
		$this->andar = $andar;
	}
	
	public function getNumero_Sala() {
		return $this->numero_sala;
	}
	public function setNumero_Sala($numero_sala) {
		$this->numero_sala = $numero_sala;
	}
	
	public function getCapacidade() {
		return $this->capacidade;
	}
	public function setCapacidade($capacidade) {
		$this->capacidade = $capacidade;
	}
}
?>