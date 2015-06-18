<?php

require_once("classCidade.php");
require_once("classOrigem.php");
require_once("classParticularidade.php");

class classPF {
  public $nome;
  public $sexo;
  public $rua_ou_quadra;
  public $complemento_ou_conjunto;
  public $numero;
  public $bairro;
  public $cep;
  public $data_nasc;
  public $alegria_crista;
  public $dirigente_centro;
  public $profissao;
  public $codigo;
  public $responsavel;
  public $nome_mae;
  public $unidade_da_federacao;
  public $cidade;
  public $pais;
  public $data_insercao;
  public $usuario_insercao;
  public $data_atualizacao;
  public $usuario_atualizacao;
  public $tipo_pf;
  public $email;
  public $objCidade;
  public $objResponsavel;
  public $origem;
  public $objOrigem;
  public $ddd;
  public $telRes;
  public $telCel;
  public $telCom;
  public $objParticularidade;
  public $apelido;
  public $cpf;
  public $vegetariano;
	
	public function classPF() {
		//construtor
	}
	
	public function save() {
		//$result = mysql_query("insert into usuario(codigo,login,senha)
		//						  values(".$this->codigo.",'".$this->login."','".$this->senha."')");
		//return $result;
		
		if ($this->apelido == "") {
			$this->apelido = $this->nome;
		}
		
		if ($this->codigo == "") {

			$sql = "SELECT ifnull(max(codigo),0) + 1 from pessoa_fisica";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			$this->codigo = mysql_result($result, 0, 0);
			
			if ($this->responsavel == "") {
				$resp = "NULL";
			} else {
				$resp = $this->responsavel;			
			}
		
			$sql = "INSERT INTO pessoa_fisica (
				sexo,
				rua_ou_quadra,
				complemento_ou_conjunto,
				numero,
				bairro,
				cep,
				data_nasc,
				alegria_crista,
				dirigente_centro,
				profissao,
				codigo,
				responsavel,
				nome,
				unidade_da_federacao,
				cidade,
				pais,
				data_insercao,
				usuario_insercao,
				data_atualizacao,
				usuario_atualizacao,
				email,
				tipo_pf,
				apelido,cpf, vegetariano) VALUES (
				".getNull($this->sexo).",
				".getNull($this->rua_ou_quadra).",
				".getNull($this->complemento_ou_conjunto).",
				".getNull($this->numero).",
				".getNull($this->bairro).",
				".getNull($this->cep).",
				".getNull(getDbDate($this->data_nasc)).",
				".getNull($this->alegria_crista).",
				".getNull($this->dirigente_centro).",
				".getNull($this->profissao).",
				".$this->codigo.",
				".getNullNumber($this->responsavel).",
				".getNull($this->nome).",
				".getNull($this->unidade_da_federacao).",
				".getNull($this->cidade).",
				".getNull($this->pais).",
				current_date,
				'1',
				current_date,
				'1',
				".getNull($this->email).",
				1,
				".getNull($this->apelido).",
				".getNull($this->cpf).",
				".getNull($this->vegetariano)."
				)";
		} else {
		
			$sql = "UPDATE pessoa_fisica SET 
				sexo = ".getNull($this->sexo).",
				rua_ou_quadra =	".getNull($this->rua_ou_quadra).",
				complemento_ou_conjunto	= ".getNull($this->complemento_ou_conjunto).",
				numero=	".getNull($this->numero).",
				bairro=	".getNull($this->bairro).",
				cep=	".getNull($this->cep).",
				data_nasc=	".getNull($this->getDbDate($this->data_nasc)).",
				alegria_crista=	".getNull($this->alegria_crista).",
				dirigente_centro=	".getNull($this->dirigente_centro).",
				profissao=	".getNull($this->profissao).",
				responsavel =	".getNullNumber($this->responsavel).",
				nome=	".getNull($this->nome).",
				unidade_da_federacao=	".getNull($this->unidade_da_federacao).",
				cidade=	".getNull($this->cidade).",
				pais=	".getNull($this->pais).",
				email=	".getNull($this->email).",
				apelido=	".getNull($this->apelido).",
				cpf=	".getNull($this->cpf).",
				vegetariano=	".getNull($this->vegetariano).",
				data_atualizacao=	current_date
				WHERE codigo = ".$this->codigo;
		}
		//echo $sql;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		
		/***
		 *** ORIGEM
		 ***/			
		
		if (isset($this->origem) && $this->origem != "") {
			$sql = "DELETE FROM origem WHERE pessoa_fisica = ".$this->codigo;
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			$sql = "INSERT INTO origem 
				(pessoa_fisica, data_registro, pessoa_juridica)
				VALUES 
				(".$this->codigo.", current_date, ".$this->origem.")";
				
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		}
		
		/***
		 *** TELEFONES
		 ***/
		
		$sql = "DELETE FROM pessoa_fisica_telefone WHERE pessoa_fisica = ".$this->codigo;
		$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());

		if (isset($this->telRes) && $this->telRes != "") {
			$sql = "SELECT 1 FROM telefone WHERE ddd = '".$this->ddd."' AND numero = '".$this->telRes."'";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($result) <= 0) {
				$sql = "INSERT INTO telefone
					(ddd, numero, tipo_telefone)
					VALUES
					('".$this->ddd."', '".$this->telRes."', 1)";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			}
			
			$sql = "INSERT INTO pessoa_fisica_telefone
				(pessoa_fisica, ddd, numero)
				VALUES
				(".$this->codigo.", '".$this->ddd."', '".$this->telRes."')";
				//echo "INSERT TEL RES => $sql";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
		}
		
		if (isset($this->telCel) && $this->telCel != "") {
			$sql = "SELECT 1 FROM telefone WHERE ddd = '".$this->ddd."' AND numero = '".$this->telCel."'";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($result) <= 0) {
				$sql = "INSERT INTO telefone
					(ddd, numero, tipo_telefone)
					VALUES
					('".$this->ddd."', '".$this->telCel."', 3)";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			}
			
			$sql = "SELECT 1 FROM pessoa_fisica_telefone WHERE pessoa_fisica =".$this->codigo." AND ddd = '".$this->ddd."' AND numero = '".$this->telCel."'";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($result) <= 0) {
			
				//echo "INSERT TEL CEL => $sql";
				$sql = "INSERT INTO pessoa_fisica_telefone
					(pessoa_fisica, ddd, numero)
					VALUES
					(".$this->codigo.", '".$this->ddd."', '".$this->telCel."')";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			}
			
		}
		
		if (isset($this->telCom) && $this->telCom != "") {
			$sql = "SELECT 1 FROM telefone WHERE ddd = '".$this->ddd."' AND numero = '".$this->telCom."'";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($result) <= 0) {
				$sql = "INSERT INTO telefone
					(ddd, numero, tipo_telefone)
					VALUES
					('".$this->ddd."', '".$this->telCom."', 2)";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			}
			$sql = "SELECT 1 FROM pessoa_fisica_telefone WHERE pessoa_fisica =".$this->codigo." AND ddd = '".$this->ddd."' AND numero = '".$this->telCom."'";
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			if (mysql_num_rows($result) <= 0) {

				//echo "INSERT TEL COM => $sql";			
				$sql = "INSERT INTO pessoa_fisica_telefone
					(pessoa_fisica, ddd, numero)
					VALUES
					(".$this->codigo.", '".$this->ddd."', '".$this->telCom."')";
				$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			}
		}
		
		/***
		 *** PARTICULARIDADES
		 ***/			
		
		if (isset($this->objParticularidade) && $this->objParticularidade != "") {
			$sql = "DELETE FROM particularidade WHERE pessoa_fisica = ".$this->codigo;
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			$sql = "INSERT INTO particularidade 
				(pessoa_fisica, doenca, medicamento, observacao, codigo)
				VALUES 
				(".$this->codigo.", 
				".getNull($this->objParticularidade->doenca).", 
				".getNull($this->objParticularidade->medicamento).", 
				".getNull($this->objParticularidade->observacao).", 
				1)";
				
			$result = mysql_query($sql) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
		}
	}
	
	/*	Uma vez que todos os campos dessa tabela fazem parte da PK, para se atualizar um registro deve-se excluir-lo e reinser�-lo
		com os devidos valores */
		
	public function deletePF() {
		//$result = mysql_query("delete from usuario
		//						  where codigo = ".$this->codigo);
	}
	
	public function searchNomePFByNome($nome) {
		$query = "select codigo, nome, cidade, unidade_da_federacao from pessoa_fisica where UPPER(nome) like UPPER('".$nome."%') order by nome";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
	}
	
	
	public function searchPFByUniqueKey($nome, $sexo, $dataNasc) {
		$query = "select codigo from pessoa_fisica where UPPER(nome) = UPPER('".$nome."') AND sexo = '".$sexo."' AND data_nasc = '".$this->getDbDate($dataNasc)."'";
						
								
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		if (mysql_num_rows($resultado) > 0) {
		
			return $this->findByCodigo(mysql_result($resultado,0,"codigo"));
		
		} else {
		
			return "";
			
		}
		
	}

	public function findByCPF($cpf) {
		
		$query = "select codigo from pessoa_fisica where cpf = '".$cpf."'";

		
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		if (mysql_num_rows($resultado) > 0) {
		
			return $this->findByCodigo(mysql_result($resultado,0,"codigo"));
		
		} else {
		
			return "";
			
		}
	}

	
	public function findByCodigo($codigo) {
		
		$query = "select p.codigo, 
					p.nome, 
					p.data_nasc, 
					p.sexo, 
					p.rua_ou_quadra, 
					p.complemento_ou_conjunto, 
					p.numero, 
				 	p.bairro, 
					p.cep, 
					p.alegria_crista, 
					p.dirigente_centro, 
					p.profissao, 
					p.unidade_da_federacao, 
					p.cidade, 
					p.pais, 
					p.email ,
					p.responsavel,
					p.apelido,
					p.cpf,
					p.vegetariano
					from pessoa_fisica p
					where p.codigo = ".$codigo;

					
		$resultado = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		$objPF = new classPF();
		
		if (mysql_num_rows($resultado) > 0) {
		
			$objPF->codigo =  mysql_result($resultado,0,"codigo");
			$objPF->nome = mysql_result($resultado,0,"nome");
			$objPF->sexo = mysql_result($resultado,0,"sexo");
			$objPF->data_nasc = mysql_result($resultado,0,"data_nasc");
			
			$objPF->rua_ou_quadra = mysql_result($resultado,0,"rua_ou_quadra");
			$objPF->complemento_ou_conjunto = mysql_result($resultado,0,"complemento_ou_conjunto");
			$objPF->numero = mysql_result($resultado,0,"numero");
			$objPF->bairro = mysql_result($resultado,0,"bairro");
			$objPF->cep = mysql_result($resultado,0,"cep");
			
			$objPF->alegria_crista = mysql_result($resultado,0,"alegria_crista");
			$objPF->dirigente_centro = mysql_result($resultado,0,"dirigente_centro");
			$objPF->profissao = mysql_result($resultado,0,"profissao");

			$objPF->unidade_da_federacao = mysql_result($resultado,0,"unidade_da_federacao");
			$objPF->cidade = mysql_result($resultado,0,"cidade");
			$objPF->pais = mysql_result($resultado,0,"pais");
			
			$objPF->email = mysql_result($resultado,0,"email");
			
			$objPF->responsavel = mysql_result($resultado,0,"responsavel");
			
			$objPF->apelido = mysql_result($resultado,0,"apelido");
			$objPF->cpf = mysql_result($resultado,0,"cpf");
			$objPF->vegetariano = mysql_result($resultado,0,"vegetariano");			
			
			// RECUPERA OS DETALHES DA CIDADE
			if (isset($objPF->cidade)) {
				$cCid = new classCidade();
				$objPF->objCidade = $cCid->findByPK($objPF->pais, $objPF->unidade_da_federacao, $objPF->cidade);
			}
			
			
			// RECUPERA OS DETALHES DO RESPONSAVEL
			if (isset($objPF->responsavel)) {
				$cResp = new classPF();
				$objPF->objResponsavel = $cResp->findByCodigo($objPF->responsavel);
			}
			
			
			// RECUPERA A ORIGEM DA PF
			$cOrig = new classOrigem();
			$objPF->objOrigem = $cOrig->findByPK($objPF->codigo);
			
			
			
			// RECUPERA AS PARTICULARIDADES DA PF
			$cPart = new classParticularidade();
			$objPF->objParticularidade = $cPart->findByPK($objPF->codigo);
			
			
			
			// RECUPERA OS TELEFONES DA PF
			$selectTelefones = "select b.ddd, b.numero, b.tipo_telefone
			from pessoa_fisica_telefone a, telefone b
			where a.pessoa_fisica = $objPF->codigo
			and a.ddd = b.ddd
			and a.numero = b.numero";
			
			$resultado = mysql_query($selectTelefones) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
			
			$linhas = mysql_num_rows($resultado);
			for($x=0; $x < $linhas; $x++) 	{
			
				$objPF->ddd = mysql_result($resultado,$x,0);
				
				if (mysql_result($resultado,$x,2) == "1") {
					$objPF->telRes = mysql_result($resultado,$x,1);
				} elseif (mysql_result($resultado,$x,2) == "3") {
					$objPF->telCel = mysql_result($resultado,$x,1);
				} else {
					$objPF->telCom = mysql_result($resultado,$x,1);
				}
			}
		}
		
		
		return $objPF;
	
	}
	
	
	public function searchResponsavelByNome($nome) {
		$query = "select codigo, nome, cidade, unidade_da_federacao from pessoa_fisica where UPPER(nome) like UPPER('".$nome."%')
		and ((YEAR(current_date)-YEAR(data_nasc)) - (RIGHT(current_date,5)<RIGHT(data_nasc,5))) >= 12 order by nome";
						
								
		$result = mysql_query($query) or die('ERRO AO ACESSAR O BANCO DE DADOS: ' . mysql_error());
		
		return $result;
		
	}
	
	public function getDbDate($data) {
	$retorno = "";
		

		
		if ($data != "" && strlen($data) == 10) {
	
			$dia = substr($data, 0, 2);
			$mes = substr($data, 3, 2);
			$ano = substr($data, 6, 4);
			
			$retorno = $ano."-".$mes."-".$dia;

		}

		return $retorno;
	}
}

?>