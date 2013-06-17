<?php
include_once("classTelefone.php");
include_once("classConsultaTelefone.php");

class classTelefonePF {
	private $ddd;
	private $numero;
	private $tipo_telefone;
	private $pessoa_fisica;
	private $telefone;
	private $consTelefone;
	
	public function classTelefonePF() 
	{
		//construtor
	}

	public function insertTelefonePF() 
	{ 
		$telefone = new classTelefone();
		$consTelefone = new classConsultaTelefone();

		$consTelefone->setDDD($this->ddd);
		$consTelefone->setNumero($this->numero);
		
		$result = $consTelefone->consultaTelefone();
		
		if ($result == 0) {	
			$telefone->setDDD($this->ddd);
			$telefone->setNumero($this->numero);
			$telefone->setTipoTelefone($this->tipo_telefone);
			$telefone->setPessoaJuridica(''); //para a classe poder colocar null
			$result = $telefone->insertTelefone();
		}
		
		$result = mysql_query("insert into pessoa_fisica_telefone(pessoa_fisica,ddd,numero)
			values(".$this->pessoa_fisica.",'".$this->ddd."','".$this->numero."')");
			
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteTelefonePF() {
		$result = mysql_query("delete from pessoa_fisica_telefone
								  where pessoa_fisica = ".$this->pessoa_fisica."
								    and ddd = ".$this->ddd."
								    and numero = ".$this->numero);
		return $result;
	}
	
	public function getDDD() {
		return $this->ddd;
	}
	public function setDDD($ddd) {
		$this->ddd = $ddd;
	}	
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
	}		
	public function getTipoTelefone() {
		return $this->tipo_telefone;
	}
	public function setTipoTelefone($tipo_telefone) {
		$this->tipo_telefone = $tipo_telefone;
	}
	
	public function getPessoaFisica() {
		return $this->pessoa_fisica;
	}
	public function setPessoaFisica($pessoa_fisica) {
		$this->pessoa_fisica = $pessoa_fisica;
	}
}
?>