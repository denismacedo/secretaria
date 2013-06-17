<?php 
require_once("util/comum.php"); 
require_once("util/http.php"); 
include("sessionValidate.php"); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="CSS/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="CSS/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link rel="shortcut icon" href="imagens/cfas.gif">
<script type="text/JavaScript" src="js/popups.js"></script>
<script type="text/JavaScript" src="js/default.js"></script>
<script type="text/JavaScript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/csshorizontalmenu.css" />

<script type="text/javascript" src="js/csshorizontalmenu.js">
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body onLoad="document.getElementById('txtCodigoBarra').focus();">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
  
 <tr>
  	<td>
			  <div id="divCarregando" style="border: 8px solid #036; overflow: visible; color: #fff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 30%; top: 30%; width: 380px; height: 140px; z-index: 999; background-color: #369; visibility: hidden; padding:20px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;
">
  <p align="center"><br><br>Aguarde!<br><br>Carregando a página... <br></p>
</div>

	</td>
  </tr>
<script language="javascript" type="text/javascript" src="js/inscricao.js"></script>
  <tr>
    <td>
      <form name="inscricaoForm" action="doInscricao.php?method=confirmPresenca" method="post">
      <table cellSpacing="3" cellPadding="3" width="580" align="center" border="0">
        <tr bgColor="#333333">
		  <td height="25"><SPAN style="FONT-WEIGHT: bold; COLOR: #ffffff">&nbsp;Posicione o cursor no campo abaixo antes de efetuar a leitura &oacute;ptica </SPAN></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" align="center"><br>
            <br>
          <input name="txtCodigoBarra" type="text" id="txtCodigoBarra" size="30" maxlength="50" style="font-size:20px; color:#003366; text-align:center; font-weight:bold; border-color:#000000; border-style:double;">
            <br>
            <br>
            <br></td></tr>
        <tr align="middle" bgColor="#f0f0f0">
          <td height="25px">
		    <div align="right"></div></td>
		</tr>		
	  </table>
	  </form>
	  <br>
	  <?php

if (isset($ERROR_MSG)) {

?>
	<div align="center">
	<div align="left" style="width: 100%; line-height: 22px; background: #f6f6f6;  padding: 5px 5px 5px 5px; font-size: 11px; color:#dd0000; font-weight:bold; border-bottom: #336699 1px solid;">
	<img src="imagens/error.gif" align="absmiddle"> [Erro]<br>
		&nbsp;&nbsp;&nbsp;
		<span style="font-size: 18px;">
		<?php 
		
		echo $ERROR_MSG; 
		
		$ERROR_MSG = "";
		
		?>
		</span>
		
	</div>
	</div>
	<br>
	
<?php
} else if (isset($INFO_MSG)) {

?>
	<div align="center">
	<div align="left" style="width: 100%; line-height: 22px; background: #f6f6f6;  padding: 5px 5px 5px 5px; font-size: 11px; color:#009900; font-weight:bold; border-bottom: #336699 1px solid;">
	<img src="imagens/info.gif" align="absmiddle"> [Info]<br>
		&nbsp;&nbsp;&nbsp;
		<span style="font-size: 18px;">
		
		<?php 
		
		echo $INFO_MSG; 
		
		$INFO_MSG = "";
		
		?>
		</span>
	</div>
	</div>
	<br>
	
<?php
}

?>
	</td>
  </tr>

</tbody></table>
</body></html>