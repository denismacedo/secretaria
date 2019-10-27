<?php 
	
	require_once("util/http.php");
	
	if (getPost("POP") == 1)
		include("headerPop.php"); 
	else
		include("header.php"); 

?>

<?php

	// SETA A VARIAVEL QUE DECIDE SE OS VALORES SUBMETIDOS ANTERIORMENTE PODERAO PERMANECER NOS CAMPOS
	if ((!isset($objPJ->codigo) || @$objPJ->codigo == "" ) || getPost('codigo') == getPost('codFromServer') ) {
		$try = false;
	} else {
		$try = false;
	}

?>


<script language="JavaScript" src="js/cadastroPJ.js">
</script>

<tr>
    <td><form name="cadastroForm" method="post" action="doCadastroPF.php"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Cadastro de Centros Esp&iacute;ritas </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">* Esta tela permite cadastrar/alterar/excluir um centro esp&iacute;rita </td>
        </tr>
      <!--<tr>
        <td width="119" height="20">Tipo de Pessoa F�sica: </td>
        <td width="570">
        	<select name="tipoPF"><option value="" selected="selected"></option>
<option value="1">CARAVANEIRO</option>
<option value="2">CONVIDADO</option>
<option value="3">APOIO</option></select>
&nbsp;&nbsp;          
	
</td>
      </tr>-->
	  <input type="hidden" name="tipoPJ" value="1"/>
	  <input type="hidden" name="POP" id="POP" value="<?php echo getPost("POP"); ?>"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">C&oacute;digo:</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
			<input name="codFromServer" id="codFromServer" value="<?php echo getAltPost(@$objPJ->codigo, 'codFromServer', true); ?>" type="hidden" />
		<input name="codigo" id="codigo" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objPJ->codigo, 'codigo', $try), 5); ?>" readonly="readonly" class="txtNumeroRO" type="text">					</td>
		<?php
		
			if (isset($_SESSION["OCORRENCIA_SESSION"]) && $_SESSION["OCORRENCIA_SESSION"] != "" && getAltPost(@$objPJ->codigo, 'codigo', $try) != "") {
				?>
					<td align="right">&nbsp;</td>
								<?php
			}
		
		?>
				</tr>
			</table>		</td>
      </tr>
      <tr>
        <td height="20">Nome:</td>
        <td valign="middle"><input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->nome, 'nome', $try); ?>" type="text" class="txtAUTO">
         <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">--></td>
      </tr>
      <tr bgcolor="#F9F9F9">
        <td height="20">Rua:</td>
        <td><input name="rua" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->rua_ou_quadra, 'rua', $try); ?>" type="text">
          &nbsp;&nbsp;Nro:&nbsp;&nbsp;
          <input name="nro" maxlength="10" size="15" value="<?php echo getAltPost(@$objPJ->numero, 'nro', $try); ?>" class="txtNumero" type="text"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="20">Complemento:</td>
        <td><input name="complemento" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->complemento_ou_conjunto, 'complemento', $try); ?>" type="text">
          &nbsp;&nbsp;CEP:&nbsp;          <input name="cep" maxlength="10" size="11" value="<?php echo getAltPost(@$objPJ->cep, 'cep', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"> (somente n&uacute;meros)</td>
      </tr>
      <tr bgcolor="#F9F9F9">
        <td height="20">Bairro:</td>
        <td><input name="bairro" maxlength="80" size="60" value="<?php echo getAltPost(@$objPJ->bairro, 'bairro', $try); ?>" type="text"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="20">Cidade:</td>
        <td><input name="codCidade" id="codCidade" value="<?php if (isset($objPJ->objCidade)) { echo @$objPJ->objCidade->nome."/".@$objPJ->objCidade->unidade_da_federacao."/".@$objPJ->objCidade->pais; } else {echo getAltPost('', 'codCidade', $try);} ?>" type="hidden">
            <input name="cidade" id="cidade" maxlength="80" size="50" value="<?php echo getAltPost(@$objPJ->objCidade->nome, 'cidade', $try); ?>" type="text" class="txtAUTO" onBlur="clearField(this, 'codCidade'); clearField(this, 'cidadeComplemento');">
            <input name="cidadeComplemento" id="cidadeComplemento" readonly="readonly" size="40" value="<?php if (isset($objPJ->objCidade)) { echo @$objPJ->objCidade->nomeEstado." - ".@$objPJ->objCidade->nomePais; } else { getAltPost('', 'cidadeComplemento', $try); } ?>" type="text" style="border: 0px; font-style:italic; color:#666666; background-color:#f9f9f9; font-size:9px;" tabindex="-5">        </td>
      </tr>
      <tr bgcolor="#F9F9F9">
	  <td height="20">Telefone:</td>
	  	<td>DDD:&nbsp;&nbsp;
	  	  <input name="ddd" maxlength="2" size="4" value="<?php echo getAltPost(@$objPJ->ddd, 'ddd', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);">	  	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   N&uacute;mero: <input name="telefone" maxlength="9" size="10" value="<?php echo getAltPost(@$objPJ->telefone, 'telefone', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
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
        <td colspan="2" height="20">&nbsp;</td>
        </tr>
      <tr align="center" bgcolor="#f0f0f0">
        <td colspan="2" height="20">
		<input name="btNovo" id="btNovo" value="Novo" onclick="submitNovo('<?php echo getPost("POP"); ?>');" type="button">
          &nbsp;&nbsp;&nbsp;
		
			 
			 <input name="btInserir" id="btInserir" value="Inserir" onclick="submitSalvar();" type="button" <?php if (getAltPost(@$objPJ->codigo, 'codigo', $try) != "") echo "disabled"; ?>>
		
          
         
&nbsp;&nbsp;&nbsp;

	
		<input name="btAlterar" id="btAlterar" value="Alterar" onclick="submitSalvar();"  type="button" <?php if (getAltPost(@$objPJ->codigo, 'codigo', $try) == "") echo "disabled"; ?> >
		&nbsp;&nbsp;&nbsp;
		<input name="btExcluir" id="btExcluir" value="Excluir" onclick="submitExcluir();" disabled="disabled" type="button">		</td>
      </tr>
     
    </table>
    </form></td>
  </tr>
  
  <script type="text/javascript">
		
	var options_xml = {
		script:"doCadastroPJ.php?method=searchNomePJByNome&",
		varname:"nome",
		minchars:4,
		callback: function (obj) { document.getElementById('codigo').value = obj.id; searchPJ();}
	};
	var as_xml = new AutoSuggest('nome', options_xml);
	
	var options4_xml = {
		script:"doCadastro.php?method=searchCidadeByNome&",
		varname:"nome",
		minchars: 3,
 		callback: function (obj) { 
			document.getElementById('codCidade').value = obj.id; 
			document.getElementById('cidadeComplemento').value = obj.info;}
	};
	var as4_xml = new AutoSuggest('cidade', options4_xml);
</script>

  
<?php
if (getPost("POP") == 1)
		include("footerPop.php"); 
	else
		include("footer.php"); 
 ?>