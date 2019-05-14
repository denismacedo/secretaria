<?php
class classUsuarioAcesso {
	public $acesso;
	public $usuario;
	
	public function classUsuarioAcesso() {
		//construtor
	}
	
	public function insertUsuarioAcesso() {
		$result = mysql_query("insert into usuario_acesso(usuario, acesso)
								  values(".$this->usuario.",".$this->acesso.")");
		return $result;
	}

	
	public function selectUsuarioAcesso($login) {
		$query = "select MAX(acesso)  from usuario_acesso a, usuario b 
						where UPPER(b.login) = UPPER('".$login."')
						and a.usuario = b.codigo";
						
	    //echo $query;
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function getAcesso() {
		return $this->acesso;
	}
	public function setAcesso($acesso) {
		$this->acesso = $acesso;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
}
?>