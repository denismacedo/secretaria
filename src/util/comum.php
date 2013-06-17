<?php

	function getNotNull($valor) {
		if (!$valor || $valor == "") {
			return "";
		} else {
			return $valor;
		}
	}
	
	function getChecked($valor, $comp) {
		if (isset($valor) && $valor == $comp) {
			echo "checked";
		}	
	}
	
	function getSelected($valor, $comp) {
		if (isset($valor) && $valor == $comp) {
			echo "selected";
		}	
	}
	
	function getDisabled($valor, $bol) {
		if (isset($valor) && $bol) {
			echo "disabled";
		}	
	}
	
	function formatNumber($num, $casas) {
		if ($num >= 0) {
			if (isset($num) && $num != "") {
				while (strlen($num) < $casas) {
					$num = "0".$num;
				}
			}
		}
		
		return $num;
	}
	
	function formatCurrency($valor) {
		return number_format($valor, 2, ',', '.');
	}
	

	function formatDate($data) {
		$retorno = "";
		
		if ($data != "" && strlen($data) == 10) {
		
			if (strpos($data, "/") === false) {
		
			$retorno = substr($data, 8, 2)."/".
						substr($data, 5, 2)."/".
						substr($data, 0, 4);
						
			} else {
				$retorno = $data;
			}
			
		}
		
		return $retorno;
	
	}
	
	function getDBDate($data) {
		$retorno = "";
		

		
		if ($data != "" && strlen($data) == 10) {
	
			$dia = substr($data, 0, 2);
			$mes = substr($data, 3, 2);
			$ano = substr($data, 6, 4);
			
			$retorno = $ano."-".$mes."-".$dia;

		}

		return $retorno;
	}
	
	function getDia($data) {
		$retorno = "";
		
		if ($data != "" && strlen($data) == 10) {
		
			if (strpos($data, "/") === false) {
		
			$retorno = substr($data, 8, 2)."/";
						
			} else {
				$retorno = $data;
			}
			
		}
		
		return $retorno;
	
	}
	
	function getMes($data) {
		$retorno = "";
		
		if ($data != "" && strlen($data) == 10) {
		
			if (strpos($data, "/") === false) {
		
			$retorno = substr($data, 5, 2);
						
			} else {
				$retorno = $data;
			}
			
		}
		
		return $retorno;
	
	}
	
	function getAno($data) {
		$retorno = "";
		
		if ($data != "" && strlen($data) == 10) {
		
			if (strpos($data, "/") === false) {
		
			$retorno = substr($data, 0, 4);
						
			} else {
				$retorno = $data;
			}
			
		}
		
		return $retorno;
	
	}
	
	function getNull($value) {
	
		if (isset($value) && $value != "") {
			return "'".$value."'";
		} else {
		
			return "NULL";
		
		}
	}
	
	function getNullNumber($value) {
	
		if (isset($value) && $value != "") {
			return $value;
		} else {
		
			return "NULL";
		
		}
	}
	
	
function dateDiff($sDataInicial, $sDataFinal)
{
  $sDataI = explode("-", $sDataInicial);
  $sDataF = explode("-", $sDataFinal);

  $nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[2], $sDataI[0]);
  $nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[2], $sDataF[0]);
  
  $resultado = floor(($nDataFinal - $nDataInicial) / (365.25 * 24 * 60 * 60));
 
  return $resultado;
	
}

function dateDiffDias($sDataInicial, $sDataFinal)
{
  $sDataI = explode("-", $sDataInicial);
  $sDataF = explode("-", $sDataFinal);

  $nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[2], $sDataI[0]);
  $nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[2], $sDataF[0]);
  
  $resultado = floor(($nDataFinal - $nDataInicial) / (24 * 60 * 60));
 
  return $resultado;
	
}

function dateDiffMinutos($sDataInicial, $sDataFinal)
{
  $sDataI = explode("-", $sDataInicial);
  $sDataF = explode("-", $sDataFinal);

  $nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[2], $sDataI[0]);
  $nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[2], $sDataF[0]);
  
  $resultado = floor(($nDataFinal - $nDataInicial) / (60));
 
  return $resultado;
	
}

function retiraCaracteresEspeciais($string) {
	$p = strtr($string, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC_");
	$p = strtoupper($p);
	return $p;
}

function fillSpaces($str, $len) {

	if (!isset($str)) {
			$str = "";
	}
	if (strlen($str) > $len) {
		$str = substr($str, 0, $len-1);
	} else {
		while (strlen($str) < $len) {
			$str = $str." ";
		}
	}
	
	return $str;
}

function fillSlashes($str, $len) {

	if (!isset($str)) {
			$str = "";
	}
	if (strlen($str) > $len) {
		$str = substr($str, 0, $len-1);
	} else {
		while (strlen($str) < $len) {
			$str = $str."-";
		}
	}
	
	return $str;
}


?>