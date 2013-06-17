<?php
class classSubOcorrencia {
	public $evento;
	public $ocorrencia;
	public $codigo;
	public $nome;
	public $pessoa_juridica;
	public $numero_bloco;
	public $andar;
	public $numero_sala;
	public $capacidade;
	public $inico;
	public $termino;
	
	public function classSubOcorrencia() {
		//construtor
	}
	
	public function insertSubOcorrencia() {
		$sql = "INSERT INTO sub_ocorrencia (
					codigo,
					evento,
					ocorrencia,
					nome,
					inicio,
					termino,
					capacidade,
					pessoa_juridica,
					numero_bloco,
					andar,
					numero_sala) VALUES (
					".getNullNumber($this->codigo).",
					".getNullNumber($this->evento).",
					".getNullNumber($this->ocorrencia).",
					".getNull($this->nome).",
					".getNull(getDbDate($this->inicio)).",
					".getNull(getDbDate($this->termino)).",
					".getNullNumber($this->capacidade).",
					".getNullNumber($this->pessoa_juridica).",
					".getNull($this->numero_bloco).",
					".getNull($this->andar).",
					".getNull($this->numero_sala).")";
					
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	}
	
	public function updateSubOcorrencia() {
		$result = mysql_query("update sub_ocorrencia
								  set nome = ".getNull($this->nome).",
								  		pessoa_juridica = ".getNullNumber($this->pessoa_juridica).",
										numero_bloco = ".getNull($this->numero_bloco).",
										andar = ".getNull($this->andar).",
										numero_sala = ".getNull($this->numero_sala).",
										capacidade = ".getNullNumber($this->capacidade)."
								  where evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia."
									 and codigo = ".$this->codigo);
		return $result;
	}
	
	public function deleteSubOcorrencia() {
		$result = mysql_query("delete from sub_ocorrencia
								  where evento = ".$this->evento."
								    and ocorrencia = ".$this->ocorrencia."
									 and codigo = ".$this->codigo);
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
	
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getPessoaJuridica() {
		return $this->pessoa_juridica;
	}
	public function setPessoaJuridica($pessoa_juridica) {
		$this->pessoa_juridica = $pessoa_juridica;
	}
	
	public function getNumeroBloco() {
		return $this->numero_bloco;
	}
	public function setNumeroBloco($numero_bloco) {
		$this->numero_bloco = $numero_bloco;
	}
	
	public function getAndar() {
		return $this->andar;
	}
	public function setAndar($andar) {
		$this->andar = $andar;
	}
	
	public function getNumeroSala() {
		return $this->numero_sala;
	}
	public function setNumeroSala($numero_sala) {
		$this->numero_sala = $numero_sala;
	}
	
	public function getCapacidade() {
		return $this->capacidade;
	}
	public function setCapacidade($capacidade) {
		$this->capacidade = $capacidade;
	}
	
	public function getInicio() {
		return $this->inicio;
	}
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}
	
	public function getTermino() {
		return $this->termino;
	}
	public function setTermino($termino) {
		$this->termino = $termino;
	}
	
	public function findSubOcorrenciaByPK($evento, $ocorrencia, $codigo) {
		$sql = "SELECT * from sub_ocorrencia where evento = ".$evento."
		AND  ocorrencia = ".$ocorrencia." AND codigo = ".$codigo;
		
		 $result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		 
		 if (mysql_num_rows($result) > 0) {
		
			$objSub = new classSubOcorrencia();

			$objSub->codigo =  mysql_result($result,0,"codigo");
			$objSub->evento = mysql_result($result,0,"evento");
			$objSub->ocorrencia = mysql_result($result,0,"ocorrencia");
			$objSub->nome = mysql_result($result,0,"nome");
			$objSub->pessoa_juridica = mysql_result($result,0,"pessoa_juridica");
			$objSub->numero_bloco = mysql_result($result,0,"numero_bloco");
			$objSub->andar = mysql_result($result,0,"andar");
			$objSub->numero_sala = mysql_result($result,0,"numero_sala");
			$objSub->capacidade = mysql_result($result,0,"capacidade");
			
			return $objSub;
		} else {
		
			return "";
		
		}
	}
	
	public function findTemasByEventoOcorrencia($evento, $ocorrencia) {
		$sql = "SELECT sub.codigo, sub.numero_bloco, sub.andar, sub.numero_sala, sub.capacidade, sub.nome, oco.codigo as ocorrencia, eve.codigo as evento, tipo.codigo as tipo_evento, qualif.codigo as codQualif, qualif.descricao as descQualif, eve.restricao_idade_inicio, eve.restricao_idade_fim
		 		FROM sub_ocorrencia sub, ocorrencia oco, evento eve, tipo_evento tipo, qualificacao_de_evento qualif
			 where sub.ocorrencia = oco.codigo AND sub.evento = oco.evento AND oco.evento = eve.codigo AND eve.tipo_evento = tipo.codigo AND eve.qualif_evento = qualif.codigo and tipo.codigo = 1
			 AND oco.concafras_geradora = ".$evento." AND oco.ocorrencia_geradora = ".$ocorrencia."
			 ORDER BY eve.codigo ASC";
			 
			 $result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			 
			 return $result;
	}
	
	public function existsAssociacaoSubOcorrencia($evento, $ocorrencia, $codigo) {
		$sql = "SELECT count(1) as participantes FROM participante WHERE evento = ".$evento. " AND ocorrencia = ".$ocorrencia." 
		 AND sub_ocorrencia = ".$codigo;
		 
	   $result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	   
	   $participantes = mysql_result($result,0,"participantes");
	   
	   if ($participantes > 0) {
	   		return participantes;
	   }
	   
	   $sql = "SELECT count(1) as participantes FROM participante_opcao WHERE evento = ".$evento. " AND ocorrencia = ".$ocorrencia." 
		 AND sub_ocorrencia = ".$codigo;
		 
	   $result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
	   
	   $participantes = mysql_result($result,0,"participantes");
	   if ($participantes > "0") {
	   		
	   		return participantes;
	   }
	   
	   return 0;
	}
}
?>