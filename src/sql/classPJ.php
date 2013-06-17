<?php
require_once("classCidade.php");

class classPJ {
  public $cgc;
  public $tipo_pj;
  public $razao_social;
  public $nome;
  public $rua_ou_quadra;
  public $complemento_ou_conjunto;
  public $numero;
  public $bairro;
  public $cep;
  public $codigo;
  public $unidade_da_federacao;
  public $cidade;
  public $pais;
  public $email;
  public $objCidade;
  public $ddd;
  public $telefone;
  public $possui_cfas;
	
	public function classPJ() {
		//construtor
	}
	
	public function save() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
		
		if ($this->codigo == "") {
		
			$sql = "select max(codigo)+1 from pessoa_juridica";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$this->codigo = mysql_result($result, 0, 0);
			
			$sql = "INSERT INTO pessoa_juridica (
				rua_ou_quadra,
				complemento_ou_conjunto,
				numero,
				bairro,
				cep,
				codigo,
				nome,
				unidade_da_federacao,
				cidade,
				pais,
				email,
				tipo_pj,
				possui_cfas) VALUES (
				".getNull($this->rua_ou_quadra).",
				".getNull($this->complemento_ou_conjunto).",
				".getNull($this->numero).",
				".getNull($this->bairro).",
				".getNull($this->cep).",
				".$this->codigo.",
				".getNull($this->nome).",
				".getNull($this->unidade_da_federacao).",
				".getNull($this->cidade).",
				".getNull($this->pais).",
				".getNull($this->email).",
				1,
				".getNull($this->possui_cfas).")";
		} else {
		
			$sql = "UPDATE pessoa_juridica SET 
				rua_ou_quadra =	".getNull($this->rua_ou_quadra).",
				complemento_ou_conjunto	= ".getNull($this->complemento_ou_conjunto).",
				numero=	".getNull($this->numero).",
				bairro=	".getNull($this->bairro).",
				cep=	".getNull($this->cep).",
				nome=	".getNull($this->nome).",
				unidade_da_federacao=	".getNull($this->unidade_da_federacao).",
				cidade=	".getNull($this->cidade).",
				pais=	".getNull($this->pais).",
				email=	".getNull($this->email).",
				possui_cfas=	".getNull($this->possui_cfas)."
				WHERE codigo = ".$this->codigo;
		}
		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

		
		/***
		 *** TELEFONE
		 ***/
		
		$sql = "UPDATE telefone SET pessoa_juridica = NULL WHERE pessoa_juridica = ".$this->codigo;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

		if (isset($this->telefone) && $this->telefone != "") {
			
				$sql = "SELECT 1 FROM telefone WHERE ddd = '".$this->ddd."' AND numero = '".$this->telefone."'";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
				if (mysql_num_rows($result) > 0) {
					
					$sql = "UPDATE telefone SET pessoa_juridica = ".$this->codigo."
						WHERE ddd = '".$this->ddd."' AND numero = '".$this->telefone."'";
						
						
					$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

				} else {
					
					$sql = "INSERT INTO telefone
						(ddd, numero, tipo_telefone, pessoa_juridica)
						VALUES
						('".$this->ddd."', '".$this->telefone."', 1, ".$this->codigo.")";
						
					$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
				
				}
		}
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinserí-lo
		com os devidos valores */
		
	public function deletePF() {
		//$result = mysql_query("delete from usuario
		//						  where codigo = ".$this->codigo);
	}
	
	public function searchNomePJByNome($nome) {
		$query = "select codigo, nome, cidade, unidade_da_federacao from pessoa_juridica where UPPER(nome) like UPPER('%".$nome."%') order by nome";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	public function findByCodigo($codigo) {
		
		$query = "select  *
					from pessoa_juridica p
					where p.codigo = ".$codigo;
					
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objPJ = new classPJ();
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objPJ->codigo = mysql_result($resultado,0,"codigo");
			$objPJ->nome = mysql_result($resultado,0,"nome");

			$objPJ->rua_ou_quadra = mysql_result($resultado,0,"rua_ou_quadra");
			$objPJ->complemento_ou_conjunto = mysql_result($resultado,0,"complemento_ou_conjunto");
			$objPJ->numero = mysql_result($resultado,0,"numero");
			$objPJ->bairro = mysql_result($resultado,0,"bairro");
			$objPJ->cep = mysql_result($resultado,0,"cep");
			
			$objPJ->unidade_da_federacao = mysql_result($resultado,0,"unidade_da_federacao");
			$objPJ->cidade = mysql_result($resultado,0,"cidade");
			$objPJ->pais = mysql_result($resultado,0,"pais");
			
			$objPJ->email = mysql_result($resultado,0,"email");
			$objPJ->possui_cfas = mysql_result($resultado,0,"possui_cfas");
			
			// RECUPERA OS DETALHES DA CIDADE
			if (isset($objPJ->cidade)) {
				$cCid = new classCidade();
				$objPJ->objCidade = $cCid->findByPK($objPJ->pais, $objPJ->unidade_da_federacao, $objPJ->cidade);
			}
			
			// RECUPERA OS TELEFONES DA PJ
			$selectTelefones = "select b.ddd, b.numero, b.tipo_telefone
			FROM telefone b
			WHERE b.pessoa_juridica = ".$objPJ->codigo;
			
			$resultado = mysql_query($selectTelefones) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($resultado) > 0) {
				$objPJ->ddd = mysql_result($resultado, 0, 0);
				$objPJ->telefone = mysql_result($resultado, 0, 1);
			}
			
		}
		
		
		return $objPJ;
	
	}

}

?>