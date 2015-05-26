<?php 
require_once("../util/comum.php"); 
require_once("../util/http.php"); 

//$fim = mktime (0, 0, 0, "07"  , "11", "2013");
//$agora = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));

//if (($agora > $fim && $_GET["evento"]== "202222") || $_GET["evento"]=="202397") {
//	header("Location: finish.php");
//}

//echo "evento: (".$_GET["evento"].")";

if ($_GET["evento"]== "202948" || $_GET["evento"]== "202824" || $_GET["evento"]== "202949") {
	header("Location: finish.php");	
}



require_once('../sql/conexao.php'); 
include ("../sql/classOcorrencia.php");
require_once("../sql/classConfiguracaoPagamento.php"); 


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
	
	
	$objCPFinder = new classConfiguracaoPagamento();
	$objCP = $objCPFinder->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	

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
			
			<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>			</td>
		</tr>
        <tr>
          <td height="40" bgcolor="#f6f6f6" align="center"><span style="font-weight: bold; font-size: 14px;">Bem vindo ao sistema de inscri&ccedil;&atilde;o online!</span><br>          </td>
        </tr>
        <tr>
          <td valign="middle"><div align="center">
            <table width="100%" height="255" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="center" valign="middle"><span style="font-size: 12px">Clique na imagem a seguir e fa&ccedil;a uma nova inscri&ccedil;&atilde;o.</span><br><br>
                  <a href="doInscricao.php?method=init"><img src="../imagens/btn_nova.png" alt="Realizar Nova Inscri&ccedil;&atilde;o" width="142" height="120" border="0"></a></td>
                <td width="250" align="center" valign="middle"><span style="font-size: 12px"> Se voc&ecirc; j&aacute; realizou sua inscri&ccedil;&atilde;o, clique na imagem abaixo para imprimir sua ficha ou efetuar o pagamento.
                </span><br>
                <br>                  <a href="reimprimeBoletoPasso1.php"><img src="../imagens/btn_acompanhar.png" alt="Reimprimir Boleto" width="138" height="120" border="0"></a></td>
              </tr>
            </table>
            </div></td>
        </tr>
        
          <tr align="center" bgcolor="#f0f0f0">
          <td height="20" colspan="2" bgcolor="#FFFFFF"><p><br />
              <strong>Valor da Inscri&ccedil;&atilde;o: </strong></p>
            <table width="600" border="0" cellspacing="2" cellpadding="6">
              <tr>
                <td width="246" bgcolor="#cccccc"><strong>Crian&ccedil;as:</strong></td>
                <td width="217" bgcolor="#e0e0e0"><?php echo $objCP->valor_crianca; ?>&nbsp;&nbsp;(<?php echo $objCP->texto_valor_crianca; ?>)</td>
              </tr>
              <tr>
                <td bgcolor="#cccccc"><strong>Adultos e Jovens a partir de 12 anos </strong></td>
                <td bgcolor="#e0e0e0"><?php echo $objCP->valor_adulto; ?>&nbsp;&nbsp;(<?php echo $objCP->texto_valor_adulto; ?>)   </td>
              </tr>
            </table></td>
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