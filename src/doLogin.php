<?php 
require_once('sql/conexao.php'); 
include("sql/classUsuario.php"); 
include("sql/classUsuarioOcorrencia.php"); 
include("sql/classUsuarioAcesso.php"); 

	// RECUPERA OS PARAMETROS INFORMADOS NO LOGIN
	$USER_SESSION = strtoupper($_POST["usuario"]);
	$senha = $_POST["senha"];
	$tipoLogin = $_POST["tipoLogin"];
	$NOME_EVENTO_SESSION = strtoupper($_POST["evento"]);
	
	
	// VERIFICA SE FORAM INFORMADOS USUARIO E SENHA
	if ($USER_SESSION == "" || $senha == "") {
		$ERROR_MSG = "INFORME USUARIO E SENHA";
		include("login.php");
		
	} else if ($tipoLogin == "E" && $NOME_EVENTO_SESSION == "")  {
	
		$ERROR_MSG = "INFORME O NOME DO EVENTO";
		include("login.php");
	
	} else {
		// CONSULTA USUARIO E SENHA INFORMADOS
		$cUsuario = new classUsuario();
		
		$resultado = $cUsuario->selectUsuario($USER_SESSION, $senha);
		
		// VERIFICA O RETORNO
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$loginOK = false;
		
			// VERIFICA O TIPO DO LOGIN
			if ($tipoLogin == "E") {

				$cUsuarioOcorrencia = new classUsuarioOcorrencia();
				$resultado = $cUsuarioOcorrencia->selectUsuarioOcorrencia($USER_SESSION, $NOME_EVENTO_SESSION);
				
				$cUsuarioAcesso = new classUsuarioAcesso();
				$resultado2 = $cUsuarioAcesso->selectUsuarioAcesso($USER_SESSION);


				if (mysql_num_rows($resultado) > 0) {
					$EVENTO_SESSION = mysql_result($resultado, 0, 0);
					$OCORRENCIA_SESSION = mysql_result($resultado, 0, 1);
					
					if (mysql_num_rows($resultado2) > 0) {
						$NIVEL_ACESSO_SESSION = mysql_result($resultado2, 0, 0);
					}
					
					//echo $NIVEL_ACESSO_SESSION;
					
					// REGISTRA A SESSAO
					session_register($EVENTO_SESSION);
					session_register($OCORRENCIA_SESSION);
					session_register($NOME_EVENTO_SESSION);
					session_register($NIVEL_ACESSO_SESSION);
					$_SESSION["NOME_EVENTO_SESSION"] = $NOME_EVENTO_SESSION;
					$_SESSION["EVENTO_SESSION"] = $EVENTO_SESSION;
					$_SESSION["OCORRENCIA_SESSION"] = $OCORRENCIA_SESSION;
					$_SESSION["NIVEL_ACESSO_SESSION"] = $NIVEL_ACESSO_SESSION;
					
					$loginOK = true;
					
				} else {
				
				// RETORNA ERRO DE EVENTO INVALIDO
				$ERROR_MSG = "EVENTO NAO ENCONTRADO!";
				include("login.php");
				}
			
			} else {
			
				$loginOK = true;
			
			}
			
			if ($loginOK) {
				// REGISTRA A SESSAO DO USUARIO
				session_register($USER_SESSION);
				
				$_SESSION["USER_SESSION"] = $USER_SESSION;
				
				// REDIRECIONA PARA PAGINA DE ENTRADA
				header("Location: index.php");
			}
			
		} else {
			// RETORNA ERRO DE USUARIO OU SENHA INVALIDOS
			$ERROR_MSG = "USUARIO OU SENHA INVALIDOS!";
			include("login.php");
		}
	}

?>