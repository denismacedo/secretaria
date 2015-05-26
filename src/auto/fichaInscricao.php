<?php

require_once('../util/http.php'); 
require_once('../util/comum.php'); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="../CSS/styles.css" rel="stylesheet" type="text/css">

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
.colLabel {
	font-weight: bold;
	padding-left:20px;
	font-size:12px;
}

.colValue {
font-size:12px;
}

.colTitulo {
	font-weight: bold;
	font-size:14px;
	padding-top:10px;
}
.colValueExpan {
	font-weight: normal;
	font-size:12px;
	padding-left:20px;
}
.tabela {
	background-image:url(../imagens/fundo_ficha.jpg);
}

-->
</style>

</head><body>





<table border="0" cellpadding="0" cellspacing="0" width="700" align="center"  class="tabela">
  <tbody><tr>
    <td class="tituloheader" align="center" height="40">
    	<table border="0" cellpadding="0" cellspacing="0" width="700">
    		<tbody><tr class="tituloheader" bgcolor="#666666">
    			<td align="left" valign="middle" width="351"><strong>
CONCAFRAS-PSE</strong></td>
    			<td align="right" valign="baseline" width="349"><strong>
   				  Secretaria
    			</strong></td>
    		</tr>
   	  </tbody></table>
    </td>
  </tr>
  <tr>
  	<td align="center">
  		<img src="../imagens/barra_rel.jpg">  	</td>
  </tr><tr>
  
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="4" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="4" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">FICHA DE INSCRI&Ccedil;&Atilde;O</span></td>
		</tr>
  <tr>
  	<td colspan="4" align="center">
  		<img src="../imagens/barra_rel.jpg">  	</td>
  </tr>
  <tr>	<td colspan="4" align="center">
  
  <table width="100%" border="0" cellpadding="3" cellspacing="2" align="center">
  	<colgroup>
    	<col width="25%"/>
        <col width="75%"/>
    </colgroup>
   	 <tr>
        <td class="colTitulo" colspan="2">Dados Pessoais:</td>
        </tr>
  		<tr>
    	<td class="colLabel">Nome:</td>
        <td class="colValue"><?php echo $objPF->nome; ?></td>
        </tr>
         <tr>
        <td class="colLabel">Data de Nascimento:</td>
        <td class="colValue"><?php echo formatDate($objPF->data_nasc); ?></td>
        </tr>
         <tr>
        <td class="colLabel">Sexo:</td>
        <td class="colValue"><?php echo ($objPF->sexo == "F" ? "Feminino" : "Masculino"); ?></td>
        </tr>
         <tr>
        <td class="colLabel">Cidade/UF:</td>
        <td class="colValue"><?php echo $objPF->cidade."/".$objPF->unidade_da_federacao; ?></td>
        </tr>
        <tr>
        <td class="colTitulo" colspan="2">Cursos Escolhidos:</td>
        </tr>
         
         <?php
		 	$cursosEscolhidos = 0;
			 for ($i = 0; $i < count($participantes); $i++) {
			 	$objParticipante=$participantes[$i];
				if ($objParticipante->nome_qualif != ""){
					$cursosEscolhidos++;
			 ?>
             
              <tr>
                <td class="colValueExpan" colspan="2"><?php echo $objParticipante->nome_qualif.": ".$objParticipante->nome_evento; ?></td>
                </tr>
			 
             <?php
				 }
			 }
			 
			 if ($cursosEscolhidos <= 0) {
			 ?>
             <tr>
                <td class="colValueExpan" colspan="2">-</td>
                </tr>
             <?php
			 }
		 ?>
         
         <tr>
        <td class="colTitulo" colspan="2">Outras opções de curso (caso não ocorra o curso escolhido):</td>
        </tr>
         
         <?php
			 $cursosEscolhidos = 0;
			 for ($i = 0; $i < count($participantesOpcao); $i++) {
			 	$objParticipante=$participantesOpcao[$i];
				if ($objParticipante->nome_qualif != ""){
					$cursosEscolhidos++;
			 ?>
             
              <tr>
                <td class="colValueExpan" colspan="2"><?php echo $objParticipante->nome_qualif.": ".$objParticipante->nome_evento; ?></td>
                </tr>
			 
             <?php
			 	}
			 }
			 if ($cursosEscolhidos <= 0) {
			 ?>
             <tr>
                <td class="colValueExpan" colspan="2">-</td>
                </tr>
             <?php
			 }
		 ?>
         
         <tr>
        <td class="colTitulo" colspan="2">Situação da Inscrição:</td>
        </tr>
        <tr>
  		<td class="colValueExpan" colspan="2"><?php echo ($objBoleto != NULL && $objBoleto->pago == "S" ? "PAGAMENTO CONFIRMADO" : "PAGAMENTO PENDENTE"); ?></td>
        </tr>
        
        <tr>
        	<td colspan="2" align="center"><br><br>A inscrição somente é válida mediante confirmação do pagamento. Entre em contato com a secretaria da CONCAFRAS-PSE para obter mais informações.</td>
        </tr>
        
  </table>
  </td>
  </tr>
  
</tbody></table>



<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tbody><tr>
		<td height="30" class="labelData" align="right">Gerado em <?php echo date("d/m/Y"); ?>&nbsp;<br></td>
	</tr>
</tbody></table>
</body></html>