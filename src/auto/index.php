<?php 
require_once("../util/comum.php"); 
require_once("../util/http.php"); 
require_once('../sql/conexao.php'); 
include ("../sql/classOcorrencia.php");
require_once("../sql/classConfiguracaoPagamento.php"); 

//$fim = mktime (0, 0, 0, "06"  , "17", "2016");


//if ($agora > $fim && ($_GET["evento"]== "204291" || $_GET["evento"]== "203662" || $_GET["evento"]== "203661" || $_GET["evento"]== "202491" || $_GET["evento"]== "202492"|| $_GET["evento"]== "202493" || $_GET["evento"]== "202494" || $_GET["evento"]== "203005")) {
//header("Location: finish.php");
//}

$codEvento = getPost("evento");
$codOcorrencia = getPost("ocorrencia");

if ($codEvento != "" && $codOcorrencia != "") {
	
	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($codEvento, $codOcorrencia);

//	echo "datafim:".$objOco->fim_inscricao;
//	echo "<br>fiminsc:".substr($objOco->fim_inscricao,8,2)."-".substr($objOco->fim_inscricao,5,2)."-".substr($objOco->fim_inscricao,0,4);
	
	$agora = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
	$fim = mktime (0, 0, 0, substr($objOco->fim_inscricao,5,2)  , substr($objOco->fim_inscricao,8,2), substr($objOco->fim_inscricao,0,4));
	
	//$fimTeste = mktime (0, 0, 0, "06"  , "17", "2016");
	
//	echo "<br>agora: ".$agora;
//	echo "<br>fim: ".$fim;

	if ($agora > $fim) {
		//header("Location: finish.php");
		$encerrado = true;
	} else {
		$encerrado = false;
	}
	
	//echo "ecerrado=".$encerrado;
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


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2070436726548088');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2070436726548088&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>
<body>
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
                
				<?php if (!$encerrado) { ?>
				<td align="center" valign="middle">
					<span style="font-size: 12px">Clique na imagem a seguir e fa&ccedil;a uma nova inscri&ccedil;&atilde;o.</span><br><br><br><br>
                  <a href="doInscricao.php?method=init"><img src="../imagens/btn_nova.png" alt="Realizar Nova Inscri&ccedil;&atilde;o" width="142" height="120" border="0"></a>
				  </td>
				  <td width="250" align="center" valign="middle"><span style="font-size: 12px"> Se voc&ecirc; j&aacute; realizou sua inscri&ccedil;&atilde;o, clique na imagem abaixo para imprimir sua ficha ou efetuar o pagamento.
                </span><br>
                <br>                  <a href="doInscricao.php?method=acompanhaInscricaoInit"><img src="../imagens/btn_acompanhar.png" alt="Reimprimir Boleto" width="138" height="120" border="0"></a></td>
				<?php } else { ?>
				<td align="center" valign="top">
				<table width="100%" height="255" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="center" valign="middle"><span class="style1">INSCRI&Ccedil;&Otilde;ES ONLINE ENCERRADAS! </span><br />
                <br />
                SE O EVENTO AINDA N&Atilde;O OCORREU, SUA INSCRI&Ccedil;&Atilde;O TAMB&Eacute;M PODER&Aacute; SER REALIZADA NO DIA.
                <br/><br/><br/>
                Se voc&ecirc; efetuou a colabora&ccedil;&atilde;o financeira nesta &uacute;ltima semana, ent&atilde;o lembre-se de levar o comprovante do mesmo para apresenta&ccedil;&atilde;o no ato do credenciamento do evento.
                </td>
              </tr>
            </table>
			</td>
				<?php } ?>
				
                
              </tr>
            </table>
            </div></td>
        </tr>
        <?php 
		
			if ($objCP->valor_crianca != "") { ?>
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
			<?php } ?>
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