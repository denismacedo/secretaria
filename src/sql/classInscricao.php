<?php

class classInscricao {
  public $evento;
  public $ocorrencia;
  public $codigo;
  public $pessoa_fisica;
  public $data_insercao;
  public $tipo_alojamento;
  public $flag_trabalhador;
  public $flag_presente = 'N';
  public $data_nasc;
  public $nro_inscricao;
  public $comissao;
  public $temaAtual1;
  public $temaAtual2;
  public $temaAtual3;
  public $temaEspecifico1;
  public $temaEspecifico2;
  public $temaEspecifico3;
  public $usuario_insercao;
  public $cracha_impresso;  

	
	public function classInscricao() {
		//construtor
	}
	
	public function save() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
		
		
		
		if ($this->codigo == "") {
		
			$sql = "SELECT max(codigo) + 1 from inscricao";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$this->codigo = mysql_result($result, 0, 0);
			
			if ($this->codigo == "" || $this->codigo == 0) {
				$this->codigo = 1;
			}
			
			$sql = "select max(nro_inscricao) + 1 
					from inscricao
					where evento = ".$this->evento."
					and ocorrencia = ".$this->ocorrencia;
					
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$this->nro_inscricao = mysql_result($result, 0, 0);
			if ($this->nro_inscricao == "") {
				$this->nro_inscricao = 1;
			}

		
			$sql = "INSERT INTO inscricao (
					evento,
					ocorrencia,
					pessoa_fisica,
					codigo,
					data_insercao,
					usuario_insercao,
					tipo_alojamento,
					flag_trabalhador,
					nro_inscricao,
					flag_presente) VALUES (
				".getNullNumber($this->evento).",
				".getNullNumber($this->ocorrencia).",
				".getNullNumber($this->pessoa_fisica).",
				".$this->codigo.",
				 current_date,
				".getNull($this->usuario_insercao).",
				".getNull($this->tipo_alojamento).",
				".getNull($this->flag_trabalhador).",
				".getNullNumber($this->nro_inscricao).",
				".getNull($this->flag_presente).")";
		} else {
		
			$sql = "UPDATE inscricao SET 
				tipo_alojamento = ".getNull($this->tipo_alojamento).",
				flag_trabalhador =	".getNull($this->flag_trabalhador).",
				data_atualizacao = current_date
				WHERE codigo = ".$this->codigo;
				
			// LIMPA OS DADOS DE PARTICIPANTE CASO SEJA UMA ALTERACAO
			$sqlDel = "DELETE FROM participante WHERE inscricao = ".$this->codigo;
			$result = mysql_query($sqlDel) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	
			$sqlDel = "DELETE FROM participante_opcao WHERE inscricao = ".$this->codigo;
			$result = mysql_query($sqlDel) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

		}
		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		

		
		/***
		 *** COMISSAO
		 ***/
		
		

		
		if (isset($this->comissao) && $this->comissao != "") {
			list($comEvento, $comOcorrencia) = split('[/]', $this->comissao);
			
			// SELECIONA A SUBOCORRENCIA QUE TIVER VAGA
			
			$codSub = $this->findSubComVaga($comOcorrencia, $comEvento);
			
			if ($codSub > 0) {
			
				$sql = "INSERT INTO participante 
						(ocorrencia, evento, sub_ocorrencia, inscricao)
						VALUES 
						(".$comOcorrencia.", ".$comEvento.", ".$codSub.", ".$this->codigo.")";
				
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
			} else {
				return array(-1, "N&Atilde; H&Aacute; VAGAS PARA A COMISS&Atilde;O SELECIONADA!");
			}
		}
		
		/***
		 *** TEMA ESPECIFICO
		 ***/
		
		if (isset($this->temaEspecifico1) && $this->temaEspecifico1 != "") {
			list($evt, $oco) = split('[/]', $this->temaEspecifico1);
			
			// SELECIONA A SUBOCORRENCIA QUE TIVER VAGA
			$codSub = $this->findSubComVaga($oco, $evt);
			
			if ($codSub > 0) {
			
				$sql = "INSERT INTO participante 
						(ocorrencia, evento, sub_ocorrencia, inscricao)
						VALUES 
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.")";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
			} else {
				return array(-1, "N&Atilde; H&Aacute; VAGAS PARA A PRIMEIRA OP&Ccedil;&Atilde;O DO TEMA ESPECIFICO!");
			}
		}
		
		/***
		 *** TEMA ATUAL
		 ***/
		
		if (isset($this->temaAtual1) && $this->temaAtual1 != "") {
			list($evt, $oco) = split('[/]', $this->temaAtual1);
			
			// SELECIONA A SUBOCORRENCIA QUE TIVER VAGA
			$codSub = $this->findSubComVaga($oco, $evt);
			
			if ($codSub > 0) {
			
				$sql = "INSERT INTO participante 
						(ocorrencia, evento, sub_ocorrencia, inscricao)
						VALUES 
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.")";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
			} else {
				return array(-1, "N&Atilde; H&Aacute; VAGAS PARA A PRIMEIRA OP&Ccedil;&Atilde;O DO TEMA ATUAL!");
			}
		}
		
		/***
		 *** TEMA ESPECIFICO OPCAO 2
		 ***/
		
		if (isset($this->temaEspecifico2) && $this->temaEspecifico2 != "") {
			list($evt, $oco) = split('[/]', $this->temaEspecifico2);
			
			// SELECIONA A SUBOCORRENCIA QUALQUER
			$codSub = $this->findSubOcorrenciaSemOpcao($oco, $evt, $this->codigo);
			if ($codSub > 0) {
				$sql = "INSERT INTO participante_opcao
						(ocorrencia, evento, sub_ocorrencia, inscricao, prioridade)
						VALUES 
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.", 2)";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			} 
		}
		
		/***
		 *** TEMA ESPECIFICO OPCAO 3
		 ***/
		
		if (isset($this->temaEspecifico3) && $this->temaEspecifico3 != "") {
		
			list($evt, $oco) = split('[/]', $this->temaEspecifico3);
			
			// SELECIONA A SUBOCORRENCIA QUALQUER
			$codSub = $this->findSubOcorrenciaSemOpcao($oco, $evt, $this->codigo);
			if ($codSub > 0) {
				$sql = "INSERT INTO participante_opcao
						(ocorrencia, evento, sub_ocorrencia, inscricao, prioridade)
						VALUES 
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.", 3)";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			} 
		}
		
		/***
		 *** TEMA ATUAL OPCAO 2
		 ***/
		
		if (isset($this->temaAtual2) && $this->temaAtual2 != "") {
			list($evt, $oco) = split('[/]', $this->temaAtual2);
			
			// SELECIONA A SUBOCORRENCIA QUALQUER
			$codSub = $this->findSubOcorrenciaSemOpcao($oco, $evt, $this->codigo);
			if ($codSub > 0) {
				$sql = "INSERT INTO participante_opcao
						(ocorrencia, evento, sub_ocorrencia, inscricao, prioridade)
						VALUES
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.", 2)";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			} 
		}
		
		/***
		 *** TEMA ATUAL OPCAO 3
		 ***/
		
		if (isset($this->temaAtual3) && $this->temaAtual3 != "") {
			list($evt, $oco) = split('[/]', $this->temaAtual3);
			
			// SELECIONA A SUBOCORRENCIA QUALQUER
			$codSub = $this->findSubOcorrenciaSemOpcao($oco, $evt, $this->codigo);
			if ($codSub > 0) {
				$sql = "INSERT INTO participante_opcao
						(ocorrencia, evento, sub_ocorrencia, inscricao, prioridade)
						VALUES 
						(".$oco.", ".$evt.", ".$codSub.", ".$this->codigo.", 3)";
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			} 
		}
		
		return array(0, $this);
		
	}
	
	public function delete() {
	
				$sql = "DELETE FROM participante 
						  WHERE inscricao = ".$this->codigo;
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
	
			
				$sql = "DELETE FROM participante_opcao
						  WHERE inscricao = ".$this->codigo;
					
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		
		// EXCLUI BOLETO
		$sql = "DELETE FROM boleto
				  WHERE inscricao = ".$this->codigo;

		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
				
		$sql = "DELETE FROM inscricao
				  WHERE codigo = ".$this->codigo;

		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

		
		return array(0, $this);
		
	}	
	
	public function findSubComVaga($codOcorrencia, $codEvento) {
	
		$sql = "select a.evento, a.ocorrencia, a.codigo
					from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia)
					where a.evento = ".$codEvento." and a.ocorrencia = ".$codOcorrencia."
					group by a.evento, a.ocorrencia, a.codigo, a.capacidade
					having (a.capacidade - count(p.inscricao)) > 0";
					
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$sql.'<br> ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
		
			return mysql_result($result, 0, "codigo");
		
		} else {
		
			return -1;
		}
	
	}
	
	public function findSubOcorrenciaSemOpcao($codOcorrencia, $codEvento, $inscricao) {
	
		$sql = "select a.evento, a.ocorrencia, a.codigo
				from sub_ocorrencia a LEFT OUTER JOIN participante_opcao p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and 			
				a.codigo = p.sub_ocorrencia and p.inscricao = ".$inscricao.")
				where a.evento = ".$codEvento." and a.ocorrencia = ".$codOcorrencia."
				group by a.evento, a.ocorrencia, a.codigo
				having count(p.inscricao) = 0";
					
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$sql.'<br> ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
		
			return mysql_result($result, 0, "codigo");
		
		} else {
		
			return -1;
		}
	
	}
	
	public function findInscricaoByPFEvento($codPF, $ocorrencia, $evento) {
		$query = "select a.evento, a.ocorrencia, a.pessoa_fisica, a.codigo, a.data_insercao, a.tipo_alojamento, 			
				a.flag_trabalhador, a.nro_inscricao, a.flag_presente
				from inscricao a
				where a.ocorrencia = ".$ocorrencia." and a.evento = ".$evento."
				and a.pessoa_fisica = ".$codPF;
				
				//echo $query;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		return $this->buildObjetoInscricao($result);
		
	}
	
	public function findInscricaoByCodigo($codInscricao) {
		$query = "select a.evento, a.ocorrencia, a.pessoa_fisica, a.codigo, a.data_insercao, a.tipo_alojamento, 			
				a.flag_trabalhador, a.nro_inscricao, a.flag_presente
				from inscricao a
				where a.codigo = ".$codInscricao;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		return $this->buildObjetoInscricao($result);
	}
	
	public function buildObjetoInscricao($result) {
	
		if (mysql_num_rows($result) > 0) {
		
			$objInsc = new classInscricao();
			$objInsc->evento = mysql_result($result, 0, "evento");
			$objInsc->ocorrencia = mysql_result($result, 0, "ocorrencia");
			$objInsc->pessoa_fisica = mysql_result($result, 0, "pessoa_fisica");
			$objInsc->codigo = mysql_result($result, 0, "codigo");
			$objInsc->data_insercao = mysql_result($result, 0, "data_insercao");
			$objInsc->tipo_alojamento = mysql_result($result, 0, "tipo_alojamento");
			$objInsc->flag_trabalhador = mysql_result($result, 0, "flag_trabalhador");
			$objInsc->nro_inscricao = mysql_result($result, 0, "nro_inscricao");
			$objInsc->flag_presente = mysql_result($result, 0, "flag_presente");
		
			return $objInsc;
		} else {
			return NULL;
		}
	}

	
	
	public function findCodInscricaoByPFEvento($codPF, $ocorrencia, $evento) {
		$query = "select a.codigo
				from inscricao a
				where a.ocorrencia = ".$ocorrencia." and a.evento = ".$evento."
				and a.pessoa_fisica = ".$codPF;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
			return mysql_result($result, 0, "codigo");
			
		} else {
			return -1;
		}
	}
	
	public function findCodInscricaoByNroInscricaoEvento($nroInscricao, $ocorrencia, $evento) {
		$query = "select a.codigo
				from inscricao a
				where a.ocorrencia = ".$ocorrencia." and a.evento = ".$evento."
				and a.nro_inscricao = ".$nroInscricao;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
			return mysql_result($result, 0, "codigo");
			
		} else {
			return -1;
		}
	}
	
	
	public function findParticipantes($codInscricao) {
	
		$query = "select a.ocorrencia, a.evento, a.sub_ocorrencia , b.tipo_evento, b.qualif_evento, b.nome, c.descricao as nome_qualif
				from participante a, evento b left outer join qualificacao_de_evento c on b.qualif_evento = c.codigo 
				where a.inscricao = ".$codInscricao."
				and a.evento = b.codigo";
			
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	
	public function findParticipantesCracha($codInscricao) {
	
		$query = "select a.ocorrencia, a.evento, a.sub_ocorrencia, c.nome, c.numero_bloco, c.andar, c.numero_sala , q.descricao as 	
				qualificacao, t.descricao as tipo, t.codigo as cod_tipo_evento
				from participante a, 
				evento b left outer join qualificacao_de_evento q on (b.qualif_evento = q.codigo) 
				left outer join tipo_evento t on (b.tipo_evento = t.codigo), 
				sub_ocorrencia c
				where a.inscricao = ".$codInscricao."
				and a.ocorrencia = c.ocorrencia
				and a.evento = c.evento
				and a.sub_ocorrencia = c.codigo
				and a.evento = b.codigo
				order by c.nome";
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	
	public function findParticipante($codInscricao, $codEvento, $codOcorrencia, $codSubOcorrencia) {
	
		$query = "select a.ocorrencia, a.evento, a.sub_ocorrencia, c.nome, c.numero_bloco, c.andar, c.numero_sala , q.descricao as 	
				qualificacao, t.descricao as tipo
				from participante a, 
				evento b left outer join qualificacao_de_evento q on (b.qualif_evento = q.codigo) 
				left outer join tipo_evento t on (b.tipo_evento = t.codigo), 
				sub_ocorrencia c
				where a.inscricao = ".$codInscricao."
				and a.ocorrencia = ".$codOcorrencia."
				and a.evento = ".$codEvento."
				and a.sub_ocorrencia = ".$codSubOcorrencia."
				and a.ocorrencia = c.ocorrencia
				and a.evento = c.evento
				and a.sub_ocorrencia = c.codigo
				and a.evento = b.codigo
				order by c.nome";
			
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br> Query: <br>  '. $query ."<br>". mysql_error());
		
		return $result;
	}
	
	public function findOpcoes($codInscricao) {
	
		$query = "select a.ocorrencia, a.evento, a.sub_ocorrencia , b.tipo_evento, b.qualif_evento, a.prioridade, b.nome, c.descricao as nome_qualif
				from participante_opcao a, evento b left outer join qualificacao_de_evento c on b.qualif_evento = c.codigo 
				where a.inscricao = ".$codInscricao."
				and a.evento = b.codigo";
			
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	public function confirmPresenca($codInscricao) {
		$sql = "UPDATE inscricao SET flag_presente = 'S' where codigo = ".$codInscricao;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	
	public function confirmCrachaImpresso($codInscricao) {
		$sql = "UPDATE inscricao SET cracha_impresso = 'S' where codigo = ".$codInscricao;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	public function findByNroInscricaoAndNome($nroInscricao, $nomePF, $evento, $ocorrencia) {
		$sql = "select pf.codigo as cod_pf, i.nro_inscricao, pf.cidade, pf.unidade_da_federacao, pf.pais, pf.nome as nome_pf, b.nosso_nro, b.valor_pago, b.data_pago, b.pago
			from pessoa_fisica pf, inscricao i LEFT OUTER JOIN boleto b ON (i.codigo = b.inscricao)
			where i.evento = ".$evento." 
			and i.ocorrencia = ".$ocorrencia." 
			and i.pessoa_fisica = pf.codigo ";
			
		if ($nroInscricao != "") {
			$sql .= " and i.nro_inscricao = ".$nroInscricao;
		}
		if ($nomePF != "") {
			$sql .= " and pf.nome like '%".$nomePF."%' ";
		}
	
		$sql .= " order by pf.nome, pf.cidade, pf.unidade_da_federacao, pf.pais";
		
		//echo $sql;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	public function findTotalInscricoesByEvento($evento, $ocorrencia) {
		$sql = "SELECT count(1) as inscricoes from inscricao WHERE evento = ".$evento." AND ocorrencia = ".$ocorrencia;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		if (mysql_num_rows($result) > 0) {
			return mysql_result($result, 0, "inscricoes");
			
		} else {
			return -1;
		}
	}

}

?>