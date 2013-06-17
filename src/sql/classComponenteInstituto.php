<?php
class classComponenteInstituto {
	private $instituto;
	private $pessoa_fisica;
	private $pessoa_juridica;
	private $inicio;
	
	public function classComponenteInstituto() {
		//construtor
	}
	
	public function insertComponenteInstituto() {
		$result = mysql_query("insert into componente_instituto(instituto,pessoa_fisica,pessoa_juridica,inicio)
								  values(".$this->instituto.",".$this->pessoa_fisica.",".$this->pessoa_juridica.",".$this->inicio.")");
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteComponenteInstituto() {
		$result = mysql_query("delete from componente_instituto
								  where instituto = ".$this->instituto."
								    and pessoa_fisica = ".$this->pessoa_fisica."
								    and pessoa_juridica = ".$this->pessoa_juridica."
								    and inicio = ".$this->inicio);
		return $result;
	}
	
	public function getInstituto() {
		return $this->instituto;
	}
	public function setInstituto($instituto) {
		$this->instituto = $instituto;
	}
	
	public function getPessoaFisica() {
		return $this->pessoa_fisica;
	}
	public function setPessoaFisica($pessoa_fisica) {
		$this->pessoa_fisica = $pessoa_fisica;
	}
	
	public function getPessoaJuridica() {
		return $this->pessoa_juridica;
	}
	public function setPessoaJuridica($pessoa_juridica) {
		$this->pessoa_juridica = $pessoa_juridica;
	}
	
	public function getInicio() {
		return $this->inicio;
	}
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}
}
?>