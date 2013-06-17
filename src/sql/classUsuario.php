<?php
class classUsuario {
	private $codigo;
	private $login;
	private $senha;
	
	public function classUsuario() {
		//construtor
	}
	
	public function insertUsuario() {
		$result = mysql_query("insert into usuario(codigo,login,senha)
								  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		return $result;
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deleteUsuario() {
		$result = mysql_query("delete from usuario
								  where codigo = ".$this->codigo);
	}
	
	public function selectUsuario($login, $senha) {
		$query = "select * from usuario 
						where UPPER(login) = UPPER('".$login."')
						and UPPER(senha) = UPPER('".$senha."')";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
	}
	
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
	}
}

?>