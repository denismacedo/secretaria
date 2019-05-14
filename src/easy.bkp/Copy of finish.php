<?php 
require_once("../util/comum.php"); 
require_once("../util/http.php"); 

require_once('../sql/conexao.php'); 
include ("../sql/classOcorrencia.php");


$codEvento = getPost("evento");
$codOcorrencia = getPost("ocorrencia");

if ($codEvento != "" && $codOcorrencia != "") {
	
	$objOco = new classOcorrencia();
	
	$objOco = $objOco->findByCodigo($codEvento, $codOcorrencia);

}

if ($objOco != "") {

	session_register($EVENTO_SESSION);
	session_register($OCORRENCIA_SESSION);
	session_register($NOME_EVENTO_SESSION);
	$_SESSION["NOME_EVENTO_SESSION"] = $objOco->nome;
	$_SESSION["EVENTO_SESSION"] = $objOco->evento;
	$_SESSION["OCORRENCIA_SESSION"] = $objOco->codigo;
	
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="../CSS/styles.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript" src="../js/popups.js"></script>
<script type="text/JavaScript" src="../js/default.js"></script>
<script type="text/JavaScript" src="../js/auto/cadastro.js"></script>
<link rel="SHORTCUT ICON" href="../imagens/cfas.gif">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}


</head><body>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 10pt;
}
-->
</style>


  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td class="tituloheader" align="center" background="../imagens/bg_top.jpg" height="40">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    		<tbody><tr>
    			<td valign="middle" align="left">
    				<img src="../imagens/logo_concafras.jpg">
    			</td>
    			<td valign="baseline" align="right">
    				<img src="../imagens/logo_inscricao.jpg">
    			</td>
    		</tr>
    	</tbody></table>
    </td>
  </tr>
  
  <tr>
  	<td background="../imagens/bg_menu.jpg">
  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
  		<tbody><tr>
  			<td>
			
</td>

  						<td class="labelUsuario" align="center" nowrap="nowrap" style="font-size: 14px;"><?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?></td>
  						
  					
  				
  				
  		</tr>
  	</tbody></table>
  <div id="divCarregando" style="border: 8px solid #036; overflow: visible; color: #fff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 30%; top: 25%; width: 380px; height: 140px; z-index: 999; background-color: #369; visibility: hidden; padding:20px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;
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
</tbody>
</table>


<tr>
	<td><p>&nbsp;</p>
	  <table width="500" border="0" align="center" cellpadding="3" cellspacing="0">
	  	<tr bgcolor="#CCCCCC">
			<td align="center" style="font-size:20px; color:#0033CC; font-weight: bold; font-family:'Courier New', Courier, monospace;">
			
			<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>
			
			</td>
		</tr>
        <tr>
          <td height="40" bgcolor="#f6f6f6" align="center"><span style="font-weight: bold; font-size: 14px;">Bem vindo ao sistema de inscri&ccedil;&atilde;o online!</span><br>
          </td>
        </tr>
        <tr>
          <td valign="middle"><div align="center">
            <table width="100%" height="255" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="center" valign="middle"><span class="style1">INSCRI&Ccedil;&Otilde;ES ONLINE ENCERRADAS! </span><br />
                Voc&ecirc; pode realizar sua inscri&ccedil;&atilde;o atrav&eacute;s de contato telef&ocirc;nico ou por e-mail. </td>
              </tr>
            </table>
            </div></td>
        </tr>
        <tr>
          <td bgcolor="#f6f6f6">&nbsp;</td>
        </tr>
      </table>	  
	  <p><br>
          <br>
          <br>
          <br>
          <br>
          <br>
	    
	    
      </p></td>

</tr>


<?php 

	} else {
	
	?>
	
	
	<!--<tr>
	<td><p>&nbsp;</p>
	  <table width="500" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td height="40" bgcolor="#f6f6f6" align="center"><span style="font-weight: bold; font-size: 16px; color:#FF0000;">Entrada inv&aacute;lida!</span></td>
        </tr>
        
        <tr>
          <td bgcolor="#f6f6f6">&nbsp;</td>
        </tr>
      </table>	  
	  <p><br>
          <br>
          <br>

	    
	    
      </p></td>

</tr>-->
	
	
	<?php
	}

include ("footer.php"); 

?>