<?php
class classBoleto {
	public $inscricao;
	public $codigo;
	public $nosso_nro;
	public $data;
	public $valor;
	public $pago;
	public $data_pago;
	public $valor_pago;
	public $data_vencimento;
	public $sacado;
	
	public function classBoleto() {
		//construtor
	}
	
	public function save() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
		
		if ($this->codigo == "") {
		
			$sql = "SELECT max(codigo) + 1 from boleto";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$this->codigo = mysql_result($result, 0, 0);
			
			if ($this->codigo == "" || $this->codigo == 0) {
				$this->codigo = 1;
			}

			$sql = "INSERT INTO boleto (
					inscricao,
					codigo,
					nosso_nro,
					data, 
					valor,
					pago,
					data_pago,
					valor_pago,
					data_vencimento) VALUES (
				".getNullNumber($this->inscricao).",
				".$this->codigo.",
				".getNullNumber($this->nosso_nro).",
				current_date,
				".getNull($this->valor).",
				'N',
				NULL,
				NULL,
				current_date + 5)";
		}

		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error(). ' QUERY => '.$sql);
	
		return $this->findByInscricao($this->inscricao);
		
	}
	
	
	public function savePago() {
		
		if ($this->codigo == "") {
		
			$this->codigo = 1;
			$sql = "SELECT max(codigo) + 1 from boleto";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$tempCod = mysql_result($result, 0, 0);
			
			if (!($tempCod > $this->codigo)) {
				$this->codigo = 1;
			} else {
				$this->codigo = $tempCod;
			}
			
			$sql = "INSERT INTO boleto (
					inscricao,
					codigo,
					nosso_nro,
					data, 
					valor,
					pago,
					data_pago,
					valor_pago,
					data_vencimento) VALUES (
				".getNullNumber($this->inscricao).",
				".$this->codigo.",
				".getNullNumber($this->nosso_nro).",
				current_date,
				".getNull($this->valor).",
				'S',
				".getNull($this->data_pago).",
				".getNull($this->valor_pago).",
				current_date + 5)";
		}
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $this->findByInscricao($this->inscricao);
		
	}
	
	public function findByNroInscricaoAndEvento($nroInscricao, $evento, $ocorrencia) {
		$query = "SELECT b.*
				FROM boleto b, inscricao i
				WHERE b.inscricao = i.codigo 
				 and i.nro_inscricao = ".$nroInscricao." 
				 and i.evento = ".$evento." 
				 and i.ocorrencia = ".$ocorrencia." ";
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		return $this->buildObjetoBoleto($result);
	}
	
	
	public function findByInscricao($codInscricao) {
		$query = "select *
				from boleto b
				where b.inscricao = ".$codInscricao;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		return $this->buildObjetoBoleto($result);
	}
	
	public function findByCodigo($codBoleto) {
		$query = "select *
				from boleto b
				where b.codigo = ".$codBoleto;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		return $this->buildObjetoBoleto($result);
	}
	
	public function buildObjetoBoleto($result) {
	
		if (mysql_num_rows($result) > 0) {
		
			$objBoleto = new classBoleto();
			$objBoleto->codigo = mysql_result($result, 0, "codigo");
			$objBoleto->inscricao = mysql_result($result, 0, "inscricao");
			$objBoleto->nosso_nro = mysql_result($result, 0, "nosso_nro");
			$objBoleto->data = mysql_result($result, 0, "data");
			$objBoleto->valor = mysql_result($result, 0, "valor");
			$objBoleto->pago = mysql_result($result, 0, "pago");
			$objBoleto->data_pago = mysql_result($result, 0, "data_pago");
			$objBoleto->valor_pago = mysql_result($result, 0, "valor_pago");
			$objBoleto->data_vencimento = mysql_result($result, 0, "data_vencimento");
		
			return $objBoleto;
		} else {
			return NULL;
		}
	}
	
	public function atualizaDataVencimento() {
		$query = "update boleto set data_vencimento = current_date + 5
				where codigo = ".$this->codigo;
						
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
		
		return $this->findByCodigo($this->codigo);
	}
	
	public function confirmaPagamento() {
	
		$sql = "update boleto set pago = 'S', data_pago = '".$this->data_pago."', valor_pago = ".$this->valor_pago.", nosso_nro = ".$this->nosso_nro." WHERE codigo = ".$this->codigo;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
	
	}
	
	public function corrigePagamento() {
	
		$sql = "update boleto set pago = 'N' WHERE codigo = ".$this->codigo;
		
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: <br>QUERY: <br> '.$query.'<br> ' . mysql_error());
	
	}
	
}
?>