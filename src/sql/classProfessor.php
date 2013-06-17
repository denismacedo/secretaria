<?php
class classProfessor {
	private $evento;
	private $ocorrencia;
	private $sub_ocorrencia;
	private $pessoa_fisica;
	
	public function classProfessor() {
		//construtor
	}
	
	public function insertProfessor() {
		$result = mysql_query("insert into professor(evento,ocorrencia,sub_ocorrencia,pessoa_fisica)
								  values(".$this->evento.",".$this->ocorrencia.",".$this->sub_ocorrencia.",".$this->pessoa_fisica.")");
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteProfessor() {
		$result = mysql_query("delete from professor
								  where evento = ".$this->evento.",
								  		  ocorrencia = ".$this->ocorrencia.",
										  sub_ocorrencia = ".$this->sub_ocorrencia.",
										  pessoa_fisica = ".$this->pessoa_fisica);
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
	
	public function getPessoaFisica() {
		return $this->pessoa_fisica;
	}
	public function setPessoa_Fisica($pessoa_fisica) {
		$this->pessoa_fisica = $pessoa_fisica;
	}
}
?>