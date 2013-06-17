<?php
class classTelefone {
	private $ddd;
	private $numero;
	private $tipo_telefone;
	private $pessoa_juridica;
	
	public function classTelefone() 
	{
		//construtor
	}
	
	public function insertTelefone() 
	{ 	//ORIGINAL, TA DANDO ERRO DE CONVERSAO DO THIS.PESSOA_JURIDICA, talves por causa do 'null' adicionado no metodo set
//		$result = mysql_query("insert into telefone(ddd,numero,tipo_telefone,pessoa_juridica)
//			values('".$this->ddd."','".$this->numero."',".$this->tipo_telefone.",".$this.pessoa_juridica.")");

		$result = mysql_query("insert into telefone(ddd,numero,tipo_telefone,pessoa_juridica)
			values('".$this->ddd."','".$this->numero."',".$this->tipo_telefone.",null)");
			
		return $result; 
	}
	
	public function updateTelefone() {
		$result = mysql_query("update telefone
								  set tipo_telefone = ".$this->tipo_telefone."
								  where ddd = ".$this->ddd."
								    and numero = ".$this->numero);
		return $result;	
	}
	
	public function deleteTelefone() {
		$result = mysql_query("delete from telefone
								  where ddd = ".$this->ddd."
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
	
	public function getPessoaJuridica() 
	{
	  if ($this->pessoa_juridica == '')
	  {
	    return 'null';
	  }
	  else
	  {
		return $this->pessoa_juridica;
	  }	
	}
	public function setPessoaJuridica($pessoa_juridica) 
	{	
	  if ($pessoa_juridica == '')
	  {
	    $this->pessoa_juridica = 'null';
	  }
	  else
	  {
		$this->pessoa_juridica = $pessoa_juridica;
	  }				
	}
}
?>