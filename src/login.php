<?php

require("util/http.php");

session_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="CSS/styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="imagens/cfas.gif">
<script language="JavaScript" src="js/popups.js"></script>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.qmclear {font-size:1px;height:0px;width:0px;clear:left;line-height:0px;display:block;}.qmmc {position:relative;}.qmmc a {float:left;display:block;white-space:nowrap;}.qmmc div a {float:none;}.qmmc div {visibility:hidden;position:absolute;}


/*!!!!!!!!!!! QuickMenu Styles [Please Modify!] !!!!!!!!!!!*/


	/* Remove the comments bleow for vertical mains and change the false value to
           true in the qm_create function after the menus structure. */
	/*.qmmc a {float:none}*/

		

	/*"""""""" (MAIN) Container """"""""*/
	#qm0
	{ 
		background-image: url("/img/bg_menu.jpg");
	}


	 /*"""""""" (MAIN) Items """"""""*/
	#qm0 a
	{
		color:#FFFFFF;
		background-image: url("/img/bg_menu.jpg");
		font-family:Arial;
		font-size:8pt;
		text-decoration:none;
		padding:5px 40px 5px 8px;
		border-style:solid;
		border-color:#364886;
		border-width:1px;
	
	}


	/*"""""""" (MAIN) Hover State """"""""*/
	#qm0 a:hover
	{ 
		background-color:#efefef;
		color:#000000;
	}


	/*"""""""" (MAIN) Active State """"""""*/	
	#qm0 .qmactive
	{ 
		/* Note: Add '!important' after each style */

		background-color:#efefef !important;
		text-decoration:underline !important;
		color:#000000;
	}


	/*"""""""" (MAIN) Parent Items """"""""*/
	#qm0 .qmparent
	{
		background-image:url(images/arrow_down.gif);
		background-repeat:no-repeat;
		background-position:95%;
	}


	/*"""""""" [SUB] Containers """"""""*/
	#qm0 div
	{
		color:#000000;
		background-color:#efefef;
		padding:5px;
		border-style:solid;
		border-width:1px;
		border-color:#364886;
		margin-top:-1px;
		
	}

	
	/*"""""""" [SUB] Hover State """"""""*/
	#qm0 div a:hover
	{
		text-decoration:underline;
	}


	/*""""""""[SUB] Active State """"""""*/
	#qm0 div .qmactive
	{
		/* Note: Add '!important' after each style */

		background-color:#ffffff !important;
	}


	/*"""""""" [SUB] Parent Items """"""""*/
	#qm0 div .qmparent 
	{
		background-image: url("/img/bg_menu.jpg");	
	}


	/*"""""""" [SUB] Items """"""""*/
	#qm0 div a
	{		
		color:#000000;
		background-color:#eeeeee;
		padding:2px 40px 2px 5px;
		border-width:0px;
		border-style:none;
		border-color:#000000;
	}
.style1 {font-size: 9pt}

-->
</style>
<script language="JavaScript1.2">
   function alert() {}
</script>

<script type="text/JavaScript" src="js/qm.js"></script>
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
  	<td>
	<?php include("message.php"); ?>
	</td>
  </tr>

<tr>
  	<td><p>&nbsp;</p>
  	  <p class="labelTitRel" align="center">Informe os dados abaixo e clique em <strong>Entrar</strong> para acessar o sistema</p>
	  
	  
	  
  	  <form name="loginForm" method="post" action="doLogin.php">
  	    <table width="400" align="center" bgcolor="#999999" border="0" cellpadding="2" cellspacing="2">
          <tbody><tr bgcolor="#cccccc">
            <td width="21%"><strong>Usu&aacute;rio:</strong></td>
            <td width="79%"><input name="usuario" type="text" size="30" maxlength="28">
            <!--  value="<?php echo getPost("usuario"); ?>" --></td>
          </tr>
          <tr bgcolor="#cccccc">
            <td><strong>Senha:</strong></td>
            <td><input name="senha" type="password" size="30" maxlength="28"></td>
          </tr>
          <tr bgcolor="#cccccc">
            <td><strong>Evento:</strong></td>
            <td><input name="evento" type="text" size="50" maxlength="50">
            <!--value="<?php echo getPost("evento"); ?>" --></td>
          </tr>
          <tr bgcolor="#cccccc">
            <td><strong>Tipo de Login: </strong></td>
            <td><select name="tipoLogin"><option value="E" selected="selected">EVENTO</option>
              <option value="U">USUARIO E SENHA</option></select></td>
          </tr>
          
          <tr align="center" bgcolor="#333333">
            <td colspan="2"><input name="Submit" value="Entrar" type="submit"></td>
          </tr>
      </tbody></table>
      </form>  	  <p>&nbsp;</p>
  	  <p>&nbsp;      </p>
    </td>
  </tr>
 
 

  <tr>
    <td valign="middle" align="center" bgcolor="#333333" height="20"><a style="color: rgb(255, 255, 255);" href="http://www.concafras.com.br/">www.concafras.com.br</a></td>
  </tr>
</tbody></table>
</body></html>