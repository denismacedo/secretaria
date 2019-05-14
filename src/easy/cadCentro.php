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
        <td height="25" valign="middle"><input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->nome, 'nome', $try); ?>" type="text" class="txt">
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="25">Rua:</td>
        <td height="25"><input name="rua" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->rua_ou_quadra, 'rua', $try); ?>" type="text">
          &nbsp;&nbsp;Nro:&nbsp;&nbsp;
          <input name="nro" maxlength="10" size="15" value="<?php echo getAltPost(@$objPJ->numero, 'nro', $try); ?>" class="txtNumero" type="text"></td>
      </tr>
      <tr bgcolor="#ffffff">
        <td height="25">Complemento:</td>
        <td height="25"><input name="complemento" maxlength="80" size="50" value="<?php echo getAltPost(@$objPJ->complemento_ou_conjunto, 'complemento', $try); ?>" type="text">
          &nbsp;&nbsp;CEP:&nbsp;          <input name="cep" maxlength="10" size="11" value="<?php echo getAltPost(@$objPJ->cep, 'cep', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"> (somente n&uacute;meros)</td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="25">Bairro:</td>
        <td height="25"><input name="bairro" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->bairro, 'bairro', $try); ?>" type="text"></td>
      </tr>
      <tr bgcolor="#ffffff">
        
          <td height="25">Pa&iacute;s:</td>
        <td height="25">
		<div id="divPais" style="float:left;">
        <select name="pais" id="pais" onchange="changePais(this.value);"><option selected></option><?php echo $paises; ?></select>
		</div>
		<div id="divEstado" style="display:none; visibility:hidden; float:left;">
          &nbsp;&nbsp;Estado:&nbsp;
			</div>
			<div id="divUF" style="display: none; visibility: hidden;  float:left;"></div>
			<div id="divCid" style="display: none; visibility: hidden;  float:left;">
          &nbsp;&nbsp;Cidade:&nbsp;
			</div>
			<div id="divCidade" style="display: none; visibility: hidden;  float:left;"></div>
			
       </td>
        </tr>
      
      <tr bgcolor="#f9f9f9">
	  <td height="25">Telefone:</td>
	  	<td height="25">DDD:&nbsp;&nbsp;
	  	  <input name="ddd" maxlength="2" size="4" value="<?php echo getAltPost(@$objPJ->ddd, 'ddd', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);">	  	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   N&uacute;mero: <input name="telefone" maxlength="8" size="10" value="<?php echo getAltPost(@$objPJ->telefone, 'telefone', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
      
      </tr>
	   <tr  bgcolor="#FFFFFF">
        <td height="20" >Possui CFAS: </td>
        <td >&nbsp;
		<?php 
			$cfasSim = "";
			$cfasNao = "";
			if (getAltPost(@$objPJ->possui_cfas, 'possui_cfas', $try) == 'S') {
				$cfasSim = "CHECKED";
			} else {
				$cfasNao = "CHECKED";
			}
		?>
		
          <input type="radio" name="possui_cfas" id="possui_cfas" value="S" <?php echo $cfasSim; ?> />SIM &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="possui_cfas" id="possui_cfas" value="N"  <?php echo $cfasNao; ?> />N&Atilde;O</td>
      </tr>
      <tr>
        <td colspan="2" height="5">&nbsp;</td>
        </tr>
      <tr align="center" bgcolor="#f0f0f0">
        <td colspan="2" height="20"><input name="btInserir" id="btInserir" value="Confirmar" onclick="submitSalvarPJ();" type="button" <?php if (getAltPost(@$objPJ->codigo, 'codigo', $try) != "") echo "disabled"; ?>>
		
          
         
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
     
    </table>
    </form></td>
  </tr>
  
  
<?php
		include("footerPop.php"); 
 ?>