<?php

class classConfiguracaoPagamento {
  public $evento;
  public $ocorrencia;
  public $agencia;
  public $conta_corrente;
  public $titular;
  public $valor_adulto;
  public $valor_crianca;
  public $convenio;
  public $gera_boleto;
  public $texto_informativo;
  public $banco;
  public $texto_valor_crianca;
  public $texto_valor_adulto;
  public $forma_pagamento;
  public $detalhe_forma_pagamento;
	
	public function classConfiguracaoPagamento() {
		//construtor
	}

	
	public function findByEventoOcorrencia($evento, $ocorrencia) {
		
		$query = "select *
					from configuracao_pagamento p
					where p.evento = ".$evento.
					" AND p.ocorrencia = ".$ocorrencia;

					
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		
		
		if (mysql_num_rows($resultado) > 0) {
			$objCP = new classConfiguracaoPagamento();
			$objCP->evento =  mysql_result($resultado,0,"evento");
			$objCP->ocorrencia = mysql_result($resultado,0,"ocorrencia");
			$objCP->banco = mysql_result($resultado,0,"banco");
			$objCP->agencia = mysql_result($resultado,0,"agencia");
			$objCP->conta_corrente = mysql_result($resultado,0,"conta_corrente");
			
			$objCP->titular = mysql_result($resultado,0,"titular");
			$objCP->valor_adulto = mysql_result($resultado,0,"valor_adulto");
			$objCP->valor_crianca = mysql_result($resultado,0,"valor_crianca");
			$objCP->convenio = mysql_result($resultado,0,"convenio");
			$objCP->gera_boleto = mysql_result($resultado,0,"gera_boleto");
			$objCP->texto_informativo = mysql_result($resultado,0,"texto_informativo");
			$objCP->texto_valor_adulto = mysql_result($resultado,0,"texto_valor_adulto");
			$objCP->texto_valor_crianca = mysql_result($resultado,0,"texto_valor_crianca");
			
			$objCP->forma_pagamento = mysql_result($resultado,0,"forma_pagamento");
			$objCP->detalhe_forma_pagamento = mysql_result($resultado,0,"detalhe_forma_pagamento");
			
			return $objCP;
		} else {
			return "";
		}
		
		
		
	
	}
}

?>