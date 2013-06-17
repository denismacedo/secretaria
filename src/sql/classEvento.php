<?php

//require_once("classTipoEvento.php");
//require_once("classQualifEvento.php");

class classEvento {
  public $codigo;
  public $nome;
  public $tipoEvento;
  public $qualifEvento;
  public $restricaoIdadeInicio;
  public $restricaoIdadeFim;
	
	public function classEvento() {
		//construtor
	}
	
	public function insert() {
		$sql = "INSERT INTO evento (
			codigo, nome, tipo_evento, qualif_evento, restricao_idade_inicio, restricao_idade_fim) VALUES (
			".$this->codigo.",
			".getNull($this->nome).",
			".getNullNumber($this->tipoEvento).",
			".getNullNumber($this->qualifEvento).",
			".getNullNumber($this->restricaoIdadeInicio).",
			".getNullNumber($this->restricaoIdadeFim).")";
				
				//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	public function update() {
		
			$sql = "UPDATE evento SET
				nome = ".getNull($this->nome).",
				tipo_evento =	".getNullNumber($this->tipoEvento).",
				qualif_evento	= ".getNullNumber($this->qualifEvento).",
				restricao_idade_inicio =	".getNullNumber($this->restricaoIdadeInicio).",
				restricao_idade_fim =	".getNullNumber($this->restricaoIdadeFim)."
				WHERE codigo = ".$this->codigo;
		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
		
	public function delete() {
		$result = mysql_query("delete from evento
								  where codigo = ".$this->codigo);
	}
	
	public function findAllEventos() {
		$query = "select * from evento";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		return $result;
	}

	public function findMasterEventos() {
		$query = "select eve.codigo, oco.nome, tipo.codigo, tipo.descricao as tipo, oco.codigo as ocorrencia, oco.inicio, oco.termino from evento eve, tipo_evento tipo, ocorrencia oco where eve.tipo_evento in (6,7,9) and eve.tipo_evento = tipo.codigo and eve.codigo = oco.evento";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		return $result;
	}
	
	public function findComissoes() {
		$query = "select * from evento where tipo_evento = 8";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		return $result;
	}
	
	public function findMasterTipoEventos() {
		$query = "select * from tipo_evento where codigo in (6,7,9) order by descricao";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		return $result;
	}
	
	public function findEventoByCodigo($codEvento) {
		$query = "select * from evento where codigo = $codEvento";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objEvento = new classEvento();
		
		if (mysql_num_rows($result) > 0) {
		
			$objEvento->codigo =  mysql_result($result,0,"codigo");
			$objEvento->nome = mysql_result($result,0,"nome");
			$objEvento->tipoEvento = mysql_result($result,0,"tipo_evento");
			$objEvento->qualifEvento = mysql_result($result,0,"qualif_evento");
			$objEvento->restricaoIdadeInicio = mysql_result($result,0,"restricao_idade_inicio");
			$objEvento->restricaoIdadeFim = mysql_result($result,0,"restricao_idade_fim");
			
			return $objEvento;
		} else {
			return null;
		}
	} 
	
	public function findQualificacaoEventoByTipoEvento($tipoEvento) {
		$sql = "SELECT codigo, descricao FROM qualificacao_de_evento WHERE tipo_evento = ".$tipoEvento;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	public function findNextCodigoEvento() {
		$sql = "SELECT ifnull(max(codigo),0) + 1 from evento";
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		return mysql_result($result, 0, 0);
	}
}

?>