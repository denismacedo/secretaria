<?php 
require_once("../util/comum.php"); 
require_once("../util/http.php"); 

$fim = mktime (0, 0, 0, "02"  , "06", "2013");
$agora = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));

if ($agora > $fim) {
//	header("Location: finish.php");
}

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