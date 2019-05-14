<?php 

	//header("Location: manutencao.php");	

require_once("util/comum.php"); 
require_once("util/http.php"); 
include("sessionValidate.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="CSS/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="CSS/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/JavaScript" src="js/popups.js"></script>
<script type="text/JavaScript" src="js/default.js"></script>
<script type="text/JavaScript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/csshorizontalmenu.css" />
<link rel="SHORTCUT ICON" href="imagens/cfas.gif">

<script type="text/javascript" src="js/csshorizontalmenu.js">
</script>
<script>


function handleDivMsg()
{
  setTimeout(hideDivMsg, 4000);
}

function hideDivMsg(){
	var divInsc = document.getElementById("DIV_MSG");
	
	divInsc.style.MozOpacity=0.3; // transparencia FF
	divInsc.style.opacity=0.3; // transparencia  FF, Opera, Safari, Netscape
	divInsc.style.filter="Alpha(Opacity=30)";
	setTimeout(closeDivMsg, 1000);
}

function closeDivMsg(){
	var divInsc = document.getElementById("DIV_MSG");
	divInsc.style.visibility = "HIDDEN";
	divInsc.style.display = "NONE";
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
.style2 {
	color: #00C437;
	font-weight: bold;
	font-size: 14px;
}
.style3 {
	color: #fdb301;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>
</head><body onload="handleDivMsg();">

  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td class="tituloheader" align="center" background="imagens/bg_top.jpg" height="40">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    		<tbody><tr>
    			<td valign="middle" align="left">
    				<img src="imagens/logo_concafras.jpg">
    			</td>
    			<td valign="baseline" align="right">
    				<img src="imagens/logo_inscricao.jpg">
    			</td>
    		</tr>
    	</tbody></table>
    </td>
  </tr>
  
  <tr>
  	<td background="imagens/bg_menu.jpg">
  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
  		<tbody><tr>
  			<td>
			
			<div class="horizontalcssmenu">
<ul id="cssmenu1">
<li style="border-left: 1px solid #336699;"><a href="#">Administra&ccedil;&atilde;o</a>
	<ul>
	<?php if (isset($_SESSION["NOME_EVENTO_SESSION"])) {?>
    	<li><a href="doConfiguracaoCracha.php?method=init">Configurar Crach&aacute;</a></li>
    	<li><a href="doTemas.php?method=init">Cursos/Temas</a></li>
    	<li><a href="doBackup.php?method=init">Gerar arquivo de inscri&ccedil;&otilde;es</a></li>
    	<li><a target="_blank" href="http://www.concafras.com/secretaria/auto/index.php?evento=<?php echo $_SESSION["EVENTO_SESSION"]; ?>&ocorrencia=1">Link para inscri&ccedil;&otilde;es OnLine</a></li>
    	<li><a target="_blank" href="easy/index.php?evento=<?php echo $_SESSION["EVENTO_SESSION"]; ?>&ocorrencia=1">Inscri&ccedil;&atilde;o simplificada</a></li>
		<?php }?>
		<?php if (isset($_SESSION["USER_SESSION"]) && $_SESSION["USER_SESSION"] == "ADMIN") {?>
    	<li><a href="doEvento.php?method=init">Eventos</a></li>
		<?php }?>
    	<!--<li><a href="doEnsalamento.php?method=init">Ensalamento</a></li>-->
    </ul>
</li>
<li style="border-left: 1px solid #003366;"><a href="#">Cadastros</a>
	<ul>
    	<li><a href="cadastroPF.php">Pessoa F&iacute;sica</a></li>
    	<li><a href="cadastroPJ.php">Pessoa Jur&iacute;dica</a></li>
    </ul>
</li>
<?php if (isset($_SESSION["NOME_EVENTO_SESSION"])) {?>
<li style="border-left: 1px solid #003366;"><a href="#">Inscri&ccedil;&atilde;o</a>
	<ul>
    	<li><a href="initControlePresenca.php">Controle de Presen&ccedil;a</a></li>
		<?php if (isset($_SESSION["NIVEL_ACESSO_SESSION"]) && $_SESSION["NIVEL_ACESSO_SESSION"] > 1) {?>
    	<li><a href="controlePagamento.php">Controle de Pagamento</a></li>
		<?php } ?>
    	<li><a href="paramPrintCrachaVarios.php">Impress&atilde;o em Lote de Crach&aacute;s</a></li>
    	<li><a href="ilhaImpressao.php">Ilha de Impress&atilde;o</a></li>
    	<li><a href="painel.php">Acompanhamento de vagas em tempo real</a></li>
    </ul>
</li>
<li style="border-left: 1px solid #003366;"><a href="#">Relat&oacute;rios</a>
	<ul>
    	<li><a href="paramRelInscritos.php">Rela&ccedil;&atilde;o Completa de Inscritos</a></li>
    	<li><a href="doRelatorio.php?method=celularInscritos">Rela&ccedil;&atilde;o de Celulares e E-mails</a></li>
    	<li><a href="doRelatorio.php?method=inscricoesPagas">Rela&ccedil;&atilde;o Completa de Inscri&ccedil;&otilde;es Pagas</a></li>
    	<li><a href="doRelatorio.php?method=inscritosInternet">Rela&ccedil;&atilde;o de Inscritos Pela Internet</a></li>
    	<li><a href="doRelatorio.php?method=inscritosSemCurso">Rela&ccedil;&atilde;o de Inscritos Sem Curso</a></li>
    	<li><a href="doRelatorio.php?method=crachasImpressos">Rela&ccedil;&atilde;o de Crach&aacute;s Impressos</a></li>
    	<li><a href="doRelatorio.php?method=presentes">Rela&ccedil;&atilde;o de Presentes no Evento</a></li>
    	<li><a href="doRelatorio.php?method=vagas">N&uacute;mero de Inscritos/Vagas por Curso</a></li>
    	<li><a href="doRelatorio.php?method=numParticipantesCurso">N&uacute;mero de Participantes por Curso</a></li>
    	<li><a href="doRelatorio.php?method=numParticipantesComissao">N&uacute;mero de Participantes por Comiss&atilde;o</a></li>
    	<li><a href="doRelatorio.php?method=participantesCurso">Rela&ccedil;&atilde;o de Participantes por Curso</a></li>
		<li><a href="doRelatorio.php?method=relParticipantesCursoImp">Rela&ccedil;&atilde;o de Participantes por Curso (impress&atilde;o)</a></li>
    	<li><a href="doRelatorio.php?method=participantesComissao">Rela&ccedil;&atilde;o de Participantes por Comissao</a></li>
    	<li><a href="doRelatorio.php?method=cidades">Quantidade de Pessoas por Cidade</a></li>
    	<li><a href="doRelatorio.php?method=participantesCidade">Rela&ccedil;&atilde;o de Participantes por Cidade</a></li>
    	<li><a href="doRelatorio.php?method=centros">Rela&ccedil;&atilde;o de Centros Participantes</a></li>
    	<li><a href="doRelatorio.php?method=relInscritosTE">Rela&ccedil;&atilde;o de inscritos em TE</a></li>
    	<li><a href="doRelatorio.php?method=relInscritosTA">Rela&ccedil;&atilde;o de inscritos em TA</a></li>
		<li><a href="doRelatorio.php?method=relDirigentesInscritos">Rela&ccedil;&atilde;o de dirigentes inscritos</a></li>
    	<li><a href="doRelatorio.php?method=dadosEvento">Dados do Evento</a></li>
		<li><a href="#"><b>CONCAFRINHAS</b></a>
			<ul>
				<li><a href="doRelatorio.php?method=criancasResponsaveis">Rela&ccedil;&atilde;o Crian&ccedil;as e Respons&aacute;veis</a></li>
				<li><a href="doRelatorio.php?method=criancasResponsaveisCurso">Rela&ccedil;&atilde;o Crian&ccedil;as e Respons&aacute;veis por Curso</a></li>
			    	<li><a href="doRelatorio.php?method=cidadesCriancas">Quantidade de Crian&ccedil;as por Cidade</a></li>
			</ul>
		</li>
    </ul>
</li>
<?php } ?>
</ul>
<br style="clear: left;" />
</div>
  			
  

</td>
  				
  					
  						<td class="labelUsuario" align="right" width="38%" nowrap="nowrap">
  						<img src="imagens/user.gif" align="absmiddle"> &nbsp; <?php echo $_SESSION["USER_SESSION"]; ?> &nbsp;
  						&nbsp;
						<?php
						
							if (isset($_SESSION["NOME_EVENTO_SESSION"])) {
							
							?>
  						
  						-  &nbsp; &nbsp; <?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?> &nbsp;
  						&nbsp;
						
						<?php } ?>
  						
			  			</td>
  						<td class="labelUsuario" align="center" bgcolor="#cc0000" width="3%" nowrap="nowrap">
				  			&nbsp;<a style="text-decoration: none;" href="logout.php" title="CLIQUE AQUI PARA SAIR DO SISTEMA"><span style="color: rgb(255, 255, 255);">SAIR</span></a>&nbsp;
			  			</td>
  					
  				
  				
  		</tr>
  	</tbody></table>
  <div id="divCarregando" style="border: 8px solid #036; overflow: visible; color: #fff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 30%; top: 30%; width: 380px; height: 140px; z-index: 999; background-color: #369; visibility: hidden; padding:20px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;
">
  <p align="center"><br><br>Aguarde!<br><br>Carregando a página... <br></p>
</div>
  	 	
  	</td>
  </tr>
<tr>
  	<td>
	<?php include("message.php"); ?>
	</td>
  </tr>