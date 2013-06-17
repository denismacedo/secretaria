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
  <tbody>
  
 <tr>
  	<td>
			  <div id="divCarregando" style="border: 8px solid #036; overflow: visible; color: #fff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 30%; top: 30%; width: 380px; height: 140px; z-index: 999; background-color: #369; visibility: hidden; padding:20px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;
">
  <p align="center"><br><br>Aguarde!<br><br>Carregando a página... <br></p>
</div>
	
	<?php include("message.php"); ?>
	</td>
  </tr>