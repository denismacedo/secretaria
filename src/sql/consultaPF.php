<?php
	require_once("conexao.php");
	class consultaPF
	{
		public $result;
		
		public function search()
		{
			$result = mysql_query("select codigo,nome,sexo,data_nasc,cidade,unidade_da_federacao
								from pessoa_fisica
								order by nome");
			$this->result = $result;
			
			if(!$result)
			{
				echo "<h3 align='center'>Não foi possível buscar registros.</h3>";
			}
			return $result;
		}
		
		public function searchByName($nome)
		{
			$result = mysql_query("select codigo,nome,sexo,data_nasc,cidade,unidade_da_federacao
								from pessoa_fisica
								where nome like '%".$nome."%'");
			$this->result = $result;
			
			if(!$result)
			{
				echo "<h3 align='center'>Não foi possível localizar registro.</h3>";
			}
			return $result;
		}

		public function searchByChave($nome,$dataNasc,$sexo)
		{
  		    $dataNasc = substr($dataNasc,3,2).'/'.substr($dataNasc,0,2).'/'.substr($dataNasc,6,4);
										//0     1   2      3         4           5                 6                 7               8
			//9	    10   11 					
			$result = mysql_query("select codigo,nome,sexo,data_nasc,cidade,unidade_da_federacao,rua_ou_quadra,complemento_ou_conjunto,numero,
			bairro,cep,email from pessoa_fisica
								where nome = '".$nome."' and data_nasc = '".$dataNasc."' and sexo = '".$sexo."'");
			$this->result = $result;
			
			if(!$result)
			{
				echo "<h3 align='center'>Não foi possível localizar registro.</h3>";
			}
			return $result;
		}
	}
?>