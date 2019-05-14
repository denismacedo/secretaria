<?php 
	
	require_once("../util/http.php");
	require_once("../util/comum.php");

	include("headerPop.php"); 

?>

<?php

	// SETA A VARIAVEL QUE DECIDE SE OS VALORES SUBMETIDOS ANTERIORMENTE PODERAO PERMANECER NOS CAMPOS
	if ((!isset($objPJ->codigo) || @$objPJ->codigo == "" ) || getPost('codigo') == getPost('codFromServer') ) {
		$try = false;
	} else {
		$try = false;
	}

?>


<script language="JavaScript" src="../js/cadastroPJ.js">
</script>

<tr>
    <td><form name="cadastroForm" method="post" action="doInscricao.php"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Cadastro de Centros Esp&iacute;ritas </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="30">* Informe os dados abaixo e clique em Confirmar </td>
        </tr>
      <!--<tr>
        <td width="119" height="20">Tipo de Pessoa Física: </td>
        <td width="570">
        	<select name="tipoPF"><option value="" selected="selected"></option>
<option value="1">CARAVANEIRO</option>
<option value="2">CONVIDADO</option>
<option value="3">APOIO</option></select>
&nbsp;&nbsp;          
	
</td>
      </tr>-->
	  <input type="hidden" name="tipoPJ" value="1"/>
	  
<input name="codFromServer" id="codFromServer" value="<?php echo getAltPost(@$objPJ->codigo, 'codFromServer', true); ?>" type="hidden" />
		<input name="codigo" id="codigo" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objPJ->codigo, 'codigo', $try), 5); ?>" readonly="readonly" type="hidden">
	  
      <tr>
        <td height="25">Nome:</td>
        <td height="25" valign="middle"><input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->nome, 'nome', $try); ?>" type="text" readonly class="txtRO">      </tr>
      <tr>
        <td colspan="2" height="5">&nbsp;</td>
        </tr>
      <tr align="center" bgcolor="#f0f0f0">
        <td colspan="2" height="20"><input name="btInserir" id="btInserir" value="Voltar" onclick="colaPJ('<?php getAltPost(@$objPJ->codigo, 'codFromServer', true) ?>', '<?php echo getAltPost(@$objPJ->nome, 'nome', $try); ?>');" type="button" >
		
          
         
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
     
    </table>
    </form></td>
  </tr>
  
  
<?php
		include("footerPop.php"); 
 ?>