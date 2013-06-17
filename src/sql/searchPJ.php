<?php
	require_once("conexao.php");
	
	class searchPJ
	{	
		public $result;
		
		public function search()
		{
			$result = mysql_query("select codigo, nome, rua_ou_quadra, numero, bairro, cep, unidade_da_federacao, cidade, pais
			  						  from pessoa_juridica
									  where tipo_pj in (1,2)
									  order by nome");
			$this->result = $result;
			
			if(!$result){
				echo "<h3 align='center'>Não foi possível buscar registros.</h3>";
			}
			return $result;
		}
		
		public function searchByName($nome)
		{
			$result = mysql_query("select codigo, nome, rua_ou_quadra, numero, bairro, cep, unidade_da_federacao, cidade, pais
									  from pessoa_juridica
									  where tipo_pj in (1,2)
									    and nome like '%".$nome."%'
									  order by nome");
			$this->result = $result;
			
			if(!$result)
			{
				echo "<h3 align='center'>Não foi possível localizar registro.</h3>";
			}
			return $result;
		}
	}
?>