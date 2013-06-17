<?php
class classConsultaTelefone {
	private $DDD;
	private $Numero;
	
	public function classConsultaTelefone()
	{
		//construtor
	}
	
	public function consultaTelefone() 
	{   
		$sql = mysql_query("select count(1) from telefone where ddd ='".$this->DDD."' and numero ='".$this->Numero."'");
		$result = mysql_result($sql,0,0);
		
		return $result;
	}
	
	public function getDDD()
	{
		return $this->DDD;
	}
	public function setDDD($ddd)
	{
		$this->DDD = $ddd;
	}	
	public function getNumero() 
	{
		return $this->Numero;
	}
	public function setNumero($numero) 
	{
		$this->Numero = $numero;
	}
}
?>