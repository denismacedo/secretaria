<?php
class classUsuarioOcorrencia {
	public $evento;
	public $ocorrencia;
	public $usuario;
	
	public function classUsuarioOcorrencia() {
		//construtor
	}
	
	public function insertUsuarioOcorrencia() {
		$result = mysql_query("insert into usuario_ocorrencia(evento,ocorrencia,usuario)
								  values(".$this->evento.",".$this->ocorrencia.",".$this->usuario.")");
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deleteUsuarioOcorrencia() {
		$result = mysql_query("delete from usuario_ocorrencia
								  where evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia."
									 and usuario = ".$this->usuario);
	}
	
	public function deleteTodasOcorrencias() {
		$result = mysql_query("delete from usuario_ocorrencia
								  where evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia);
	}
	
	public function selectUsuarioOcorrencia($login, $ocorrencia) {
		$query = "select a.evento, a.ocorrencia  from usuario_ocorrencia a, usuario b, ocorrencia c 
						where UPPER(b.login) = UPPER('".$login."')
						and UPPER(c.nome) = UPPER('".$ocorrencia."')
						and a.usuario = b.codigo
						and a.ocorrencia = c.codigo
						and a.evento = c.evento";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
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
	
	public function getUsuario() {
		return $this->usuario;
	}
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
}
?>