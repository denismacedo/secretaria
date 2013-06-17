<?php
class classParticipanteOpcao {
	private $inscricao;
	private $evento;
	private $ocorrencia;
	private $sub_ocorrencia;
	private $ins_evento;
	private $ins_ocorrencia;
	private $prioridade;
	
	public function classParticipanteOpcao() {
		//construtor
	}
	
	public function insertParticipanteOpcao() {
		$result = mysql_query("insert into participante_opcao(inscricao,evento,ocorrencia,sub_ocorrencia,ins_evento,ins_ocorrencia,prioridade)
								  values(".$this->inscricao.",".$this->evento.",".$this->ocorrencia.",".$this->sub_ocorrencia.",".
								  		$this->ins_evento.",".$this->ins_ocorrencia.",".$this->prioridade.")");
		
		return $result;
	}
	
	public function updateParticipanteOpcao() {
		$result = mysql_query("update participante_opcao
								  set prioridade = ".$this->prioridade."
								  where inscricao = ".$this->inscricao."
								    and evento = ".$this->evento."
								  	 and ocorrencia = ".$this->ocorrencia."
									 and sub_ocorrencia = ".$this->sub_ocorrencia."
									 and ins_evento = ".$this->ins_evento."
									 and ins_ocorrencia = ".$this->ins_ocorrencia);								  
		return $result;
	}
	
	public function deleteParticipanteOpcao() {
		$result = mysql_query("delete from participante_opcao
								  where inscricao = ".$this->inscricao."
								    and evento = ".$this->evento."
								  	 and ocorrencia = ".$this->ocorrencia."
									 and sub_ocorrencia = ".$this->sub_ocorrencia."								  
									 and ins_evento = ".$this->ins_evento."
									 and ins_ocorrencia = ".$this->ins_ocorrencia);
		return $result;	
	}
		
	public function getInscricao() {
		return $this->inscricao;
	}
	public function setInscricao($inscricao) {
		$this->inscricao = $inscricao;
	}

	public function getEvento() {
		return $this->evento;
	}
	public function setEvento($evento) {
		$this->evento = $evento;
	}
	
	public function getOcorrencia() {
		return $this->ocorrencia;
	}
	public function setOcorrencia($ocorrencia) {
		$this->ocorrencia = $ocorrencia;
	}
	
	public function getSubOcorrencia() {
		return $this->sub_ocorrencia;
	}
	public function setSubOcorrencia($sub_ocorrencia) {
		$this->sub_ocorrencia = $sub_ocorrencia;
	}

	public function getInsEvento() {
		return $this->ins_evento;
	}
	public function setInsEvento($ins_evento) {
		$this->ins_evento = $ins_evento;
	}

	public function getInsOcorrencia() {
		return $this->ins_ocorrencia;
	}
	public function setInsOcorrencia($ins_ocorrencia) {
		$this->ins_ocorrencia = $ins_ocorrencia;
	}
	
	public function getPrioridade() {
		return $this->prioridade;
	}
	public function setPrioridade($prioridade) {
		$this->prioridade = $prioridade;
	}
}
?>