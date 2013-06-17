<?php

class classTipoAlojamento {
  public $codigo;
  public $descricao;


	public function classTipoAlojamento() {
		//construtor
	}
	
	
	public function findAll() {
		$query = "SELECT * FROM tipo_alojamento";
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
}

?>