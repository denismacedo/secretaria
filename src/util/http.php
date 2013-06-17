<?php

	/**
	* RECUPERA UMA VARIAVEL POSTADA PELA PAGINA, SEJA VIA POST OU VIA GET.
	*
	*/
	function getPost($varName) {
		$valor = "";
		
		if (isset($_POST[$varName])) {
			$valor = strtoupper($_POST[$varName]);
		}
		
		if (!isset($valor) || ($valor == "")) {
			if (isset($_GET[$varName])) {
				$valor = strtoupper($_GET[$varName]);
			}
		}
				
		return $valor;
	}
	
	function getAltPost($valor, $varName, $try) {
	
		if ((!isset($valor) || $valor == "") && $try) {
			$valor = getPost($varName);
		}
				
		return $valor;
	}


?>