<?php
class classComponenteComissao {
	private $comissao;
	private $pessoa_fisica;
	private $inicio;
	
	public function classComponenteComissao() {
		//construtor
	}
	
	public function insertComponenteComissao() {
		$result = mysql_query("insert into componente_comissao(comissao,pessoa_fisica,inicio)
								  values(".$this->comissao.",".$this->pessoa_fisica.",".$this->inicio.")");
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
	
	public function deleteComponenteComissao() {
	
	}
	
	public function getComissao() {
		return $this->comissao;
	}
	public function setComissao($comissao) {
		$this->comissao = $comissao;
	}
	
	public function getPessaoFisica() {
		return $this->pessoa_fisica;
	}
	public function setPessoaFisica($pessoa_fisica) {
		$this->pessoa_fisica = $pessoa_fisica;
	}
	
	public function getInicio() {
		return $this->inicio;
	}
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}
}
?>