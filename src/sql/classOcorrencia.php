<?php

class classOcorrencia {
  public $codigo;
  public $evento;
  public $nome;
  public $inicio;
  public $termino;
  public $ocorrencia_geradora;
  public $concafras_geradora;
	
	public function classOcorrencia() {
		//construtor
	}
	
	public function insert() {
		$sql = "INSERT INTO ocorrencia (
					codigo,
					evento,
					nome,
					inicio,
					termino,
					ocorrencia_geradora,
					concafras_geradora) VALUES (
					".getNullNumber($this->codigo).",
					".getNullNumber($this->evento).",
					".getNull($this->nome).",
					".getNull(getDbDate($this->inicio)).",
					".getNull(getDbDate($this->termino)).",
					".getNullNumber($this->ocorrencia_geradora).",
					".getNullNumber($this->concafras_geradora).")";
					
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	public function update() {
		
			$sql = "UPDATE ocorrencia SET 
				nome = ".getNull($this->nome).",
				inicio=	".getNull(getDbDate($this->inicio)).",
				termino=	".getNull(getDbDate($this->termino))."
				WHERE codigo = ".$this->codigo." 
				AND evento = ".$this->evento;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	public function delete() {
		$sql = "DELETE from ocorrencia where evento = ".$this->evento." AND codigo = ".$this->codigo;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}

	public function findByCodigo($evento, $codigo) {
		
		$query = "select o.*
					from ocorrencia o, evento e
					where o.evento = e.codigo AND o.evento = '".$evento."' AND o.codigo = ".$codigo;

		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objOco = new classOcorrencia();
			
			$objOco->codigo =  mysql_result($resultado,0,"codigo");
			$objOco->evento = mysql_result($resultado,0,"evento");
			$objOco->nome = mysql_result($resultado,0,"nome");
			$objOco->inicio = mysql_result($resultado,0,"inicio");
			$objOco->termino = mysql_result($resultado,0,"termino");
			
			return $objOco;
		} else {
		
			return "";
		
		}
		
	}
	
	public function findComissoes($ocorrencia_concafras, $evento_concafras) {
		$query = "select a.evento, a.ocorrencia, a.nome, a.capacidade, count(p.inscricao) as inscritos
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
					ocorrencia b, evento e
					where a.ocorrencia = b.codigo
					and a.evento = b.evento
					and b.ocorrencia_geradora = ".$ocorrencia_concafras."
					and b.concafras_geradora = ".$evento_concafras."
					and b.evento = e.codigo
					and e.tipo_evento = 8
					group by a.evento, a.ocorrencia, a.nome, a.capacidade
					order by a.nome";
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function findTemasAtuais($ocorrencia_concafras, $evento_concafras) {
		$query = "select a.evento, a.ocorrencia, a.nome, a.capacidade, count(p.inscricao) as inscritos
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
					ocorrencia b, evento e
					where a.ocorrencia = b.codigo
					and a.evento = b.evento
					and b.ocorrencia_geradora = ".$ocorrencia_concafras."
					and b.concafras_geradora = ".$evento_concafras."
					and b.evento = e.codigo
					and e.tipo_evento = 1
					and e.qualif_evento = 2
					group by a.evento, a.ocorrencia, a.nome, a.capacidade
					order by a.nome";
					
					//echo $query;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function findTemasAtuaisForInscricao($ocorrencia_concafras, $evento_concafras, $idadePF) {
		$query = "select a.evento, a.ocorrencia, a.nome, a.capacidade, count(p.inscricao) as inscritos
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
					ocorrencia b, evento e
					where a.ocorrencia = b.codigo
					and a.evento = b.evento
					and b.ocorrencia_geradora = ".$ocorrencia_concafras."
					and b.concafras_geradora = ".$evento_concafras."
					and b.evento = e.codigo
					and e.tipo_evento = 1
					and e.qualif_evento = 2
					and (e.restricao_idade_inicio is null or ".$idadePF." between e.restricao_idade_inicio AND e.restricao_idade_fim)
					group by a.evento, a.ocorrencia, a.nome, a.capacidade
					order by a.nome";
					
					//echo $query;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function findTemasEspecificos($ocorrencia_concafras, $evento_concafras) {
		$query = "select a.evento, a.ocorrencia, a.nome, a.capacidade, count(p.inscricao) as inscritos
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
					ocorrencia b, evento e
					where a.ocorrencia = b.codigo
					and a.evento = b.evento
					and b.ocorrencia_geradora = ".$ocorrencia_concafras."
					and b.concafras_geradora = ".$evento_concafras."
					and b.evento = e.codigo
					and e.tipo_evento = 1
					and e.qualif_evento = 1
					group by a.evento, a.ocorrencia, a.nome, a.capacidade
					order by a.nome";
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function findTemasEspecificosForInscricao($ocorrencia_concafras, $evento_concafras, $idadePF) {
		$query = "select a.evento, a.ocorrencia, a.nome, a.capacidade, count(p.inscricao) as inscritos
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
					ocorrencia b, evento e
					where a.ocorrencia = b.codigo
					and a.evento = b.evento
					and b.ocorrencia_geradora = ".$ocorrencia_concafras."
					and b.concafras_geradora = ".$evento_concafras."
					and b.evento = e.codigo
					and e.tipo_evento = 1
					and e.qualif_evento = 1
					and (e.restricao_idade_inicio is null or ".$idadePF." between e.restricao_idade_inicio AND e.restricao_idade_fim)
					group by a.evento, a.ocorrencia, a.nome, a.capacidade
					order by a.nome";
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function findLastOcorrenciaByEvento($evento) {
		$sql = "SELECT max(codigo) as max_codigo FROM ocorrencia WHERE evento = ".$evento;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return mysql_result($result,0,"max_codigo");
	}
	
	public function findOcorrenciaByOcorrenciaGeradora($evento, $concafrasGeradora, $ocorrenciaGeradora) {
		$sql = "SELECT count(1) as ocorrencias FROM ocorrencia WHERE evento = ".$evento."
		 AND concafras_geradora = ".$concafrasGeradora." AND ocorrencia_geradora = ".$ocorrenciaGeradora;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return mysql_result($result,0,"ocorrencias");
	}
	
	public function getMaxCodigoComissoes() {
		$sql = "select max(codigo) as max_comissao from ocorrencia where evento = 1";
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return mysql_result($result,0, "max_comissao");
	}
	
	public function insereComissoes($evento, $ocorrencia, $nextCodigoComissao) {
		$sql = "insert into ocorrencia (codigo, evento, nome, concafras_geradora, ocorrencia_geradora) 
select ".$nextCodigoComissao.", codigo, nome, ".$evento.", ".$ocorrencia." from evento where codigo between 1 and 28 order by codigo";
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$sql = "insert into sub_ocorrencia (codigo, ocorrencia, evento, nome, capacidade) 
select 1, ".$nextCodigoComissao.", codigo, nome, 500 from evento where codigo between 1 and 28 order by codigo";
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
	}
	
	public function deleteComissoes($evento, $ocorrencia) {
		$sql = "delete sub_ocorrencia from sub_ocorrencia, ocorrencia where sub_ocorrencia.evento = ocorrencia.evento
and sub_ocorrencia.ocorrencia = ocorrencia.codigo
and ocorrencia.concafras_geradora = ".$evento." and ocorrencia.ocorrencia_geradora = ".$ocorrencia."
and sub_ocorrencia.evento between 1 and 28";
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$sql = "delete from ocorrencia where evento between 1 and 28 and concafras_geradora = ".$evento." and ocorrencia_geradora = ".$ocorrencia;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
	}
	
	public function deleteOcorrenciasByEvento($evento, $ocorrencia) {
		$sql = "delete sub_ocorrencia from sub_ocorrencia, ocorrencia where sub_ocorrencia.evento = ocorrencia.evento
and sub_ocorrencia.ocorrencia = ocorrencia.codigo
and ocorrencia.concafras_geradora = ".$evento." and ocorrencia.ocorrencia_geradora = ".$ocorrencia;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$sql = "delete from ocorrencia where concafras_geradora = ".$evento." and ocorrencia_geradora = ".$ocorrencia;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
	}

}
?>