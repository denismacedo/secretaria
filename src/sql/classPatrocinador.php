<?php
class classPatrocinador {
	private $promotor;
	private $evento;
	private $ocorrencia;
	
	public function classPatrocinador() {
		//construtor
	}
	
	public function insertPatrocinador() {
		$result = mysql_query("insert into patrocinador(promotor,evento,ocorrencia)
								  values(".$this->promotor.",".$this->evento.",".$this->ocorrencia.")");
								  
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deletePatrocinador() {
		$result = mysql_query("delete from patrocinador
								  where promotor = ".$this->promotor."
								    and evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia);
		
		return $result;	
	}
	
	public function getPromotor() {
		return $this->promotor;
	}
	public function setPromotor($promotor) {
		$this->promotor = $promotor;
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
}
?>