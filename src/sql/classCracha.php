<?php
class classCracha {
	public $evento;
	public $ocorrencia;
	public $tamanho_fonte;
	public $largura;
	public $altura;
	public $margem_superior;
	public $margem_esquerda;
	public $fonte_nome;
	public $fonte_cidade;
	public $cursos;
	public $objPF;
	public $objInscricao;
	public $nomeCracha;
	public $tipoInscricao;
	public $idade;
	public $responsavel;
	public $objCidade;
	
	public function classCracha() {
		//construtor
	}
	
	public function insertCracha() {
		$result = mysql_query("insert into configuracao_cracha(evento,codigo,tamanho_fonte,largura,altura,margem_superior,margem_esquerda)
			values(".$this->getEvento().",".$this->getOcorrencia().",".$this->getTamanho_Fonte().",".$this->getLargura().",".
				$this->getAltura().",".$this->getMargem_Superior().",".$this->getMargem_Esquerda().")");
		
		return $result;
	}
	
	public function updateCracha() {
		$result = mysql_query("update configuracao_cracha
								  set tamanho_fonte = ".$this->getTamanho_Fonte().",
										largura = ".$this->getLargura().",
										altura = ".$this->getAltura().",
										margem_superior = ".$this->getMargem_Superior().",
										margem_esquerda = ".$this->getMargem_Esquerda()."
								  where evento = ".$this->getEvento()."
								  	 and codigo = ".$this->getOcorrencia());
		return $result;
	}

	public function deleteCracha() {
		$result = mysql_query("delete from configuracao_cracha
								  where evento = ".$this->getEvento()."
								  	 and codigo = ".$this->getOcorrencia());
		return $result;
	}
	
	public function findCrachaByEvento($codEvento, $codOcorrencia) {
		$sql = "select * from configuracao_cracha where evento = ".$codEvento." and codigo = ".$codOcorrencia;

		$result = mysql_query($sql);
		
		$objCracha = new classCracha();
		
		if (mysql_num_rows($result) > 0) {
		
			
			$objCracha->evento = mysql_result($result, 0, "evento");
			$objCracha->ocorrencia = mysql_result($result, 0, "codigo");
			$objCracha->tamanho_fonte = mysql_result($result, 0, "tamanho_fonte");
			$objCracha->largura = mysql_result($result, 0, "largura");
			$objCracha->altura = mysql_result($result, 0, "altura");
			$objCracha->margem_superior = mysql_result($result, 0, "margem_superior");
			$objCracha->margem_esquerda = mysql_result($result, 0, "margem_esquerda");
			$objCracha->fonte_nome = $objCracha->tamanho_fonte + 8;
			$objCracha->fonte_cidade = $objCracha->tamanho_fonte-2;
			
			
		} else {
		
			//$objCracha->evento = $codEvento;
			//$objCracha->ocorrencia = $codOcorrencia;
			//$objCracha->tamanho_fonte = "12";
			//$objCracha->largura = "12";
			//$objCracha->altura = "12";
			//$objCracha->margem_superior = "2.5";
			//$objCracha->margem_esquerda = "4";
			//$objCracha->fonte_nome = $objCracha->tamanho_fonte + 6;
			//$objCracha->fonte_cidade = $objCracha->tamanho_fonte-1;
		}
		
		return $objCracha;
	}
	
	public function clone_cracha() {
		
		$objCracha = new classCracha();
		
		
			$objCracha->evento = $this->evento;
			$objCracha->ocorrencia = $this->ocorrencia;
			$objCracha->tamanho_fonte = $this->tamanho_fonte;
			$objCracha->largura = $this->largura;
			$objCracha->altura = $this->altura;
			$objCracha->margem_superior = $this->margem_superior;
			$objCracha->margem_esquerda = $this->margem_esquerda;
			$objCracha->fonte_nome = $this->fonte_nome;
			$objCracha->fonte_cidade = $this->fonte_cidade;
		
		
		return $objCracha;
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
	
	public function getTamanho_Fonte() {
		return $this->tamanho_fonte;
	}
	public function setTamanho_Fonte($tamanho_fonte) {
		$this->tamanho_fonte = $tamanho_fonte;
	}
	
	public function getLargura() {
		return $this->largura;
	}
	public function setLargura($largura) {
		$this->largura = $largura;
	}
	
	public function getAltura() {
		return $this->altura;
	}
	public function setAltura($altura) {
		$this->altura = $altura;
	}
	
	public function getMargem_Superior() {
		return $this->margem_superior;
	}
	public function setMargem_Superior($margem_superior) {
		$this->margem_superior = $margem_superior;
	}
	
	public function getMargem_Esquerda() {
		return $this->margem_esquerda;
	}
	public function setMargem_Esquerda($margem_esquerda) {
		$this->margem_esquerda = $margem_esquerda;
	}
}
?>