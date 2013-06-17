<?php
class classParticipante {
	public $inscricao;
	public $evento;
	public $ocorrencia;
	public $sub_ocorrencia;
	public $ins_evento;
	public $ins_ocorrencia;
	public $condicao_pagamento;
	public $valor;
	public $tipo_evento;
	public $qualif_evento;
	public $prioridade;
	public $nome_evento;
	public $nome_qualif;
	
	public function classParticipante() {
		//construtor
	}
	
	public function insertParticipante() {
		$result = mysql_query("insert into participante(evento,ocorrencia,sub_ocorrencia,inscricao,condicao_pagamento,valor)
								  values(".$this->inscricao.",".$this->evento.",".$this->ocorrencia.",".$this->sub_ocorrencia.",".
								  		$this->ins_evento.",".$this->ins_ocorrencia.",".$this->condicao_pagamento.",".$this->valor.")");
		return $result;
	}
	
	public function updateParticipante() {
		$result = mysql_query("update participante
								  set condicao_pagamento = ".$this->condicao_pagamento.",
										valor = ".$this->valor."
								  where inscricao = ".$this->inscricao."
								    and evento = ".$this->evento."
								  	 and ocorrencia = ".$this->ocorrencia."
									 and sub_ocorrencia = ".$this->sub_ocorrencia."
									 and ins_evento = ".$this->ins_evento."
									 and ins_ocorrencia = ".$this->ins_ocorrencia);
		return $result;
	}
	
	public function deleteParticipante() {
		$result = mysql_query("delete from participante
								  where inscricao = ".$this->inscricao."
								    and evento = ".$this->evento."
								  	 and ocorrencia = ".$this->ocorrencia."
									 and sub_ocorrencia = ".$this->sub_ocorrencia."
									 and ins_evento = ".$this->ins_evento."
									 and ins_ocorrencia = ".$this->ins_ocorrencia);
		return $result;
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
	
	public function getSub_Ocorrencia() {
		return $this->sub_ocorrencia;
	}
	public function setSub_Ocorrencia($sub_ocorrencia) {
		$this->sub_ocorrencia = $sub_ocorrencia;
	}
	
	public function getInscricao() {
		return $this->inscricao;
	}
	public function setInscricao($inscricao) {
		$this->inscricao = $inscricao;
	}
	
	public function getCondicao_Pagamento() {
		return $this->codicao_pagamento;
	}
	public function setCondicao_Pagamento($condicao_pagamento) {
		$this->condicao_pagamento = $condicao_pagamento;
	}
	
	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
	}
}
?>