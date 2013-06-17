<?php
class classParcela {
	private $parcela;
	private $inscricao;
	private $vencimento;
	private $pagamento;
	private $valor;
	private $documento;
	private $forma;
	
	public function classParcela() {
		//construtor
	}
	
	public function insertParcela() {
		$result = mysql_query("insert into parcela(parcela,inscricao,vencimento,pagamento,valor,documento,forma)
								  values(".$this->parcela.",".$this->inscricao.",'".$this->vencimento."',".$this->pagamento.",".
								  		$this->valor.",'".$this->documento."','".$this->forma."')");
		return $result;
	}
	
	public function updateParcela() {
		$result = mysql_query("update parcela
								  set vencimento = ".$this->getVencimento().",
								  		pagamento = ".$this->pagamento.",
										valor = ".$this->valor.",
										documento = ".$this->getDocumento().",
										forma = ".$this->getForma()."
								  where inscricao = ".$this->inscricao."
									 and evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia."
									 and parcela = ".$this->parcela);
		return $result;
	}
	
	public function deleteParcela() {
		$result = mysql_query("delete from parcela
								  where inscricao = ".$this->inscricao."
									 and evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia."
									 and parcela = ".$this->parcela);
		return $result;
	
	}
	
	public function getParcela() {
		return $this->parcela;
	}
	public function setParcela($parcela) {
		$this->parcela = $parcela;
	}
	
	public function getInscricao() {
		return $this->inscricao;
	}
	public function setInscricao($inscricao) {
		$this->inscricao = $inscricao;
	}
	
	public function getVencimento() {
		return $this->vencimento;
	}
	public function setVencimento($vencimento) {
		$this->vencimento= $vencimento;
	}
	
	public function getPagamento() {
		return $this->pagamento;
	}
	public function setPagamento($pagamento) {
		$this->pagamento = $pagamento;
	}
	
	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
	}
	
	public function getDocumento() {
		return $this->documento;
	}
	public function setDocumento($documento) {
		$this->documento = $documento;
	}
	
	public function getForma() {
		return $this->forma;
	}
	public function setForma($forma) {
		$this->forma = $forma;
	}
}
?>