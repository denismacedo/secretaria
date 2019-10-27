<?php include("header.php"); ?>

<?php

	// SETA A VARIAVEL QUE DECIDE SE OS VALORES SUBMETIDOS ANTERIORMENTE PODERAO PERMANECER NOS CAMPOS
	if ((!isset($objPF->codigo) || @$objPF->codigo == "" ) || getPost('codigo') == getPost('codFromServer') ) {
		$try = true;
	} else {
		$try = false;
	}

?>


<script language="JavaScript" src="js/cadastro.js">
</script>

<tr>
    <td><form name="cadastroForm" method="post" action="doCadastroPF.php"> 
		<input type="hidden" name="SPECIAL_PARAM" id="SPECIAL_PARAM" value="<?php echo $specialParam; ?>"/>
	<table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Cadastro Pessoa F&iacute;sica</span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">* Esta tela permite cadastrar/alterar/excluir uma pessoa f&iacute;sica, al&eacute;m de inscrev&ecirc;-la em um evento</td>
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
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">C&oacute;digo:</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
			<input name="codFromServer" id="codFromServer" value="<?php echo getAltPost(@$objPF->codigo, 'codFromServer', true); ?>" type="hidden" />
		<input name="codigo" id="codigo" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objPF->codigo, 'codigo', $try), 5); ?>" readonly="readonly" class="txtNumeroRO" type="text">					</td>
		<?php
		
			if (isset($_SESSION["OCORRENCIA_SESSION"]) && $_SESSION["OCORRENCIA_SESSION"] != "" && getAltPost(@$objPF->codigo, 'codigo', $try) != "") {
				?>
					<td align="right">
					<input type="button" style="font-weight:bold; background-color:#369; color:#FFFFFF;" value="Inscri&ccedil;&atilde;o" name="btInscricao" id="btInscricao" onClick="submitInscricao('<?php echo getAltPost(@$objPF->codigo, 'codigo', $try); ?>');" alt="Clique aqui para realizar inscri&ccedil;&atilde;o" title="Clique aqui para realizar inscri&ccedil;&atilde;o"/>
					&nbsp;&nbsp;&nbsp;
					<input type="button" style="font-weight:bold; background-color:#369; color:#FFFFFF;" value="Crach&aacute;" name="btCracha" id="btCracha" onClick="submitCracha('<?php echo getAltPost(@$objPF->codigo, 'codigo', $try); ?>');" alt="Clique aqui para imprimir o crach&aacute;" title="Clique aqui para imprimir o crach&aacute;"/>					</td>
								<?php
			}
		
		?>
				</tr>
			</table>		</td>
      </tr>
      <tr>
        <td height="20">CPF:</td>
        <td valign="middle"><input name="cpf" id="cpf" maxlength="11" size="20" value="<?php echo getAltPost(@$objPF->cpf, 'cpf', $try); ?>" type="text" class="txtNumero" style="font-size:13px;font-weight:bold;" onKeyPress="ehNumerico(this);"> &nbsp;<img title="Procurar por CPF" style="cursor:pointer;" src="imagens/lupa.gif" alt="Procurar por CPF" onclick="searchByCPF();" align="absmiddle" border="0" width="17" height="17">
        </td>
      </tr>
      <tr>
        <td height="20">Nome:</td>
        <td valign="middle"><input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->nome, 'nome', $try); ?>" type="text" class="txtAUTO">
         <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">--></td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Nome para Crach&aacute;:</td>
        <td valign="middle"><input name="apelido" id="apelido" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->apelido, 'apelido', $try); ?>" type="text"></td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Data de Nascimento: </td>
        <td valign="middle"><input name="dataNasc" maxlength="10" size="14" value="<?php echo getAltPost(formatDate(@$objPF->data_nasc), 'dataNasc', $try); ?>" type="text"  onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> (dd/mm/aaaa)          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexo:&nbsp;   
		<input type="radio" name="sexo" value="M" style="border: 0px;" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'M'); ?> > Masculino
		<input type="radio" name="sexo" value="F" style="border: 0px;" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'F'); ?> > Feminino</td>
      </tr>
      <tr>
        <td height="20">Rua:</td>
        <td><input name="rua" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->rua_ou_quadra, 'rua', $try); ?>" type="text">
          &nbsp;&nbsp;Nro:&nbsp;&nbsp;
          <input name="nro" maxlength="10" size="15" value="<?php echo getAltPost(@$objPF->numero, 'nro', $try); ?>" class="txtNumero" type="text"></td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Complemento:</td>
        <td><input name="complemento" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->complemento_ou_conjunto, 'complemento', $try); ?>" type="text">
          &nbsp;&nbsp;CEP:&nbsp;          <input name="cep" maxlength="10" size="11" value="<?php echo getAltPost(@$objPF->cep, 'cep', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"> (somente n&uacute;meros)</td>
      </tr>
      <tr>
        <td height="20">Bairro:</td>
        <td><input name="bairro" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->bairro, 'bairro', $try); ?>" type="text"></td>
      </tr>
      <tr bgcolor="#f9f9f9">
	  <td height="20">Cidade:</td>
	  	<td>
		 <input name="codCidade" id="codCidade" value="<?php if (isset($objPF->objCidade)) { echo @$objPF->objCidade->nome."/".@$objPF->objCidade->unidade_da_federacao."/".@$objPF->objCidade->pais; } else {echo getAltPost('', 'codCidade', $try);} ?>" type="hidden">
          <input name="cidade" id="cidade" maxlength="80" size="50" value="<?php echo getAltPost(@$objPF->objCidade->nome, 'cidade', $try); ?>" type="text" class="txtAUTO" onBlur="clearField(this, 'codCidade'); clearField(this, 'cidadeComplemento');">
		  <input name="cidadeComplemento" id="cidadeComplemento" readonly="readonly" size="40" value="<?php if (isset($objPF->objCidade)) { echo @$objPF->objCidade->nomeEstado." - ".@$objPF->objCidade->nomePais; } else { getAltPost('', 'cidadeComplemento', $try); } ?>" type="text" style="border: 0px; font-style:italic; color:#666666; background-color:#f9f9f9; font-size:9px;" tabindex="-5">		</td>
        <!--<td height="20">Pa�s:</td>
        <td>
        <select name="pais" onchange="submitChangePais();"><option value="" selected="selected"></option>
<option value="AO">ANGOLA</option>
<option value="AR">ARGENTINA</option>
<option value="BR">BRASIL</option></select>
          &nbsp;&nbsp;Estado:&nbsp;
			<select name="uf" onchange="submitChangeEstado();"></select>
          &nbsp;&nbsp;Cidade:&nbsp;
			<select name="cidade"></select>
       </td>-->
      </tr>
      <tr>
        <td height="20">E-mail:</td>
        <td><input name="email" maxlength="80" size="60" value="<?php echo @$objPF->email; ?>" type="text">
          &nbsp;&nbsp;Toca Viol&atilde;o:&nbsp;&nbsp;
          <select name="violao">
		  	<option value=""></option>
          	<option value="S" <?php echo getSelected(getAltPost(@$objPF->alegria_crista, 'violao', $try), 'S'); ?>>Sim</option>
          	<option value="N" <?php echo getSelected(getAltPost(@$objPF->alegria_crista, 'violao', $try), 'N'); ?>>Nao</option></select></td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Profiss&atilde;o:</td>
        <td><input name="profissao" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->profissao, 'profissao', $try); ?>" type="text">
          &nbsp;&nbsp;Dirigente de C.E.:&nbsp;          
		  <select name="dirigente">
		  	<option value=""></option>
          	<option value="S" <?php echo getSelected(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'S'); ?>>Sim</option>
          	<option value="N" <?php echo getSelected(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'N'); ?>>Nao</option></select> </td>
      </tr>
      <tr>
        <td height="20">Vegetariano:</td>
        <td>
		  <select name="vegetariano">
		  	<option value=""></option>
          	<option value="S" <?php echo getSelected(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'S'); ?>>SIM</option>
          	<option value="N" <?php echo getSelected(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'N'); ?>>NAO</option></select> </td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Respons&aacute;vel:</td>
        <td valign="middle">
	        <input name="codResponsavel" id="codResponsavel" value="<?php echo getAltPost(@$objPF->objResponsavel->codigo, 'codResponsavel', $try); ?>" type="hidden">
          <input name="responsavel" id="responsavel" maxlength="80" size="50" value="<?php echo getAltPost(@$objPF->objResponsavel->nome, 'responsavel', $try); ?>" type="text" class="txtAUTO" onBlur="clearField(this, 'codResponsavel'); clearField(this, 'responsavelComplemento');">
		  <input name="responsavelComplemento" id="responsavelComplemento" readonly="readonly" size="40" value="<?php if (isset($objPF->objResponsavel)) { echo @$objPF->objResponsavel->cidade." - ".@$objPF->objResponsavel->unidade_da_federacao; } else { echo getAltPost('', 'responsavelComplemento', $try); } ?>" type="text" style="border: 0px; font-style:italic; color:#666666; font-size:9px;" tabindex="-5">
<!--&nbsp;<img src="imagens/lupa.gif" alt="Procurar" style="" onclick="javascript:findResponsavel();" align="absmiddle" border="0" width="17" height="17">--></td>
      </tr>
      <tr>
        <td height="20"><a alt="Clique para cadastar um Centro Esp&iacute;rita" title="Clique para cadastar um Centro Esp&iacute;rita" href="javascript:cadastrarPJ();">Centro Esp&iacute;rita:</a></td>
        <td valign="middle">
        <input name="codOrigem" id="codOrigem" value="<?php echo getAltPost(@$objPF->objOrigem->pj, 'codOrigem', $try); ?>" type="hidden">
        <input name="origem" id="origem" maxlength="80" size="50" value="<?php echo getAltPost(@$objPF->objOrigem->nomePJ, 'origem', $try); ?>"  type="text" class="txtAUTO" onBlur="clearField(this, 'codOrigem'); clearField(this, 'origemComplemento');">
		 <input name="origemComplemento" id="origemComplemento" readonly="readonly" size="40" value="<?php if (isset($objPF->objOrigem)) { echo @$objPF->objOrigem->cidade." - ".@$objPF->objOrigem->estado; } else { echo getAltPost('', 'origemComplemento', $try); } ?>" type="text" style="border: 0px; font-style:italic; color:#666666; background-color:#f9f9f9; font-size:9px;" tabindex="-10">
<!--&nbsp; <img style="" src="imagens/lupa.gif" alt="Procurar" onclick="javascript:findOrigem();" align="absmiddle" border="0" width="17" height="17">--></td>
      </tr>
      <tr>
        <td colspan="2" height="20">
		<table border="0" width="100%">
			<tbody><tr>
				<td valign="top" width="50%">
				
				<fieldset><legend><span style="font-weight: bold;">Telefones</span></legend>
		<table border="0" cellpadding="3" cellspacing="1" width="100%">
			<tbody><tr>
				<td width="11%" height="26">DDD</td>
				<td width="14%"><input name="ddd" maxlength="2" size="4" value="<?php echo getAltPost(@$objPF->ddd, 'ddd', $try); ?>" class="txtNumero" type="text" onKeyUp="document.cadastroForm.ddd2.value = this.value; document.cadastroForm.ddd3.value = this.value;" onKeyPress="ehNumerico(this);"></td>
				<td width="18%">Residencial: </td>
				<td width="57%"><input name="residencial" maxlength="9" size="10" value="<?php echo getAltPost(@$objPF->telRes, 'residencial', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
			</tr>
			<tr>
				<td>DDD</td>
				<td><input name="ddd3" maxlength="2" size="4" value="<?php echo getAltPost(@$objPF->ddd, 'ddd3', $try); ?>" readonly="readonly" class="txtNumeroRO" type="text"></td>
				<td>Celular: </td>
				<td height="30"><input name="celular" maxlength="9" size="10" value="<?php echo getAltPost(@$objPF->telCel, 'celular', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
			</tr>
			<tr bgcolor="#f9f9f9">
				<td>DDD</td>
				<td><input name="ddd2" maxlength="2" size="4" value="<?php echo getAltPost(@$objPF->ddd, 'ddd2', $try); ?>" readonly="readonly" class="txtNumeroRO" type="text"></td>
				<td>Comercial: </td>
				<td><input name="comercial" maxlength="9" size="10" value="<?php echo getAltPost(@$objPF->telCom, 'comercial', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
			</tr>
		</tbody></table>
        </fieldset>				</td>
				<td valign="top" width="50%">
				
				<fieldset>
        <legend><span style="font-weight: bold;">Particularidades</span></legend>
		<table border="0" cellpadding="3" cellspacing="1" width="100%">
			<tbody><tr>
				<td width="11%" height="26">Doen&ccedil;a: </td>
				<td><input name="doenca" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->objParticularidade->doenca, 'doenca', $try); ?>" type="text"></td>
				</tr>
			<tr bgcolor="#f9f9f9">
				<td>Medicamento: </td>
				<td><input name="medicamento" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->objParticularidade->medicamento, 'medicamento', $try); ?>" type="text"></td>
				</tr>
			<tr>
				<td valign="top" height="30">Observa&ccedil;&atilde;o:</td>
				<td><textarea name="obs" cols="40" rows="2"><?php echo getAltPost(@$objPF->objParticularidade->observacao, 'obs', $try); ?></textarea></td>
				</tr>
		</tbody></table>
        </fieldset>				</td>
			</tr>
		</tbody></table>
		
          �</td>
        </tr>
      <tr align="center" bgcolor="#f0f0f0">
        <td colspan="2" height="20">
		<input name="btNovo" id="btNovo" value="Novo" onclick="submitNovo();" type="button">
          &nbsp;&nbsp;&nbsp;
		
			 
			 <input name="btInserir" id="btInserir" value="Inserir" onclick="this.disabled=true;submitSalvar();" type="button" <?php if (getAltPost(@$objPF->codigo, 'codigo', $try) != "") echo "disabled"; ?>>
		
          
         
&nbsp;&nbsp;&nbsp;

	
		<input name="btAlterar" id="btAlterar" value="Alterar" onclick="this.disabled=true;submitSalvar();"  type="button" <?php if (getAltPost(@$objPF->codigo, 'codigo', $try) == "") echo "disabled"; ?> >
		&nbsp;&nbsp;&nbsp;
		<input name="btExcluir" id="btExcluir" value="Excluir" onclick="submitExcluir();" disabled="disabled" type="button">		</td>
      </tr>
     
    </table>
    </form></td>
  </tr>
  
  <script type="text/javascript">
		
	var options_xml = {
		script:"doCadastro.php?method=searchNomePFByNome&",
		varname:"nome",
		minchars:4,
		callback: function (obj) { document.getElementById('codigo').value = obj.id; searchPF();}
	};
	var as_xml = new AutoSuggest('nome', options_xml);
	
	var options2_xml = {
		script:"doCadastro.php?method=searchResponsavelByNome&",
		varname:"nome",
		minchars:4,
 		callback: function (obj) { 
			document.getElementById('codResponsavel').value = obj.id; 
			document.getElementById('responsavelComplemento').value = obj.info;}
	};
	var as2_xml = new AutoSuggest('responsavel', options2_xml);
	
	var options3_xml = {
		script:"doCadastro.php?method=searchNomePJByNome&",
		varname:"nome",
		minchars:4,
 		callback: function (obj) { 
			document.getElementById('codOrigem').value = obj.id; 
			document.getElementById('origemComplemento').value = obj.info;}
	};
	var as3_xml = new AutoSuggest('origem', options3_xml);
	
	var options4_xml = {
		script: "doCadastro.php?method=searchCidadeByNome&",
		varname: "nome",
		minchars: 3,
 		callback: function (obj) { 
			document.getElementById('codCidade').value = obj.id; 
			document.getElementById('cidadeComplemento').value = obj.info;}
	};
	var as4_xml = new AutoSuggest('cidade', options4_xml);
</script>

<div id="divInscricao" style="border: 8px solid #036; overflow: visible;font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 20%; top: 8%; width: 670px; height: 510px; z-index: 980; background-color: #369; visibility: hidden; padding:2px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;">
	<div align="right" style="padding:2px;">
		<a href="#" onClick="closeDivInscricao();" title="Fechar"><img src="imagens/close.gif" border="0"></a>
	</div>

	<div id="divInscricaoInterna" style="border: 0px; width: 668px; height: 480px; z-index: 985; background-color: #FFF; visibility: visible; padding:1px;visibility: hidden;filter:alpha(opacity=100);-moz-opacity:1;opacity:1; vertical-align:middle;">
		<iframe name="ifInscricao" id="ifInscricao" scrolling="auto" width="668px" height="480px" align="middle" marginheight="0" marginwidth="0" style="border: 0px;">
		</iframe>
	</div>

</div>
<div id="divHelper" style="visibility: hidden; display: none;">
<input type="button" onClick="executeHelper()" name="btnHelper" id="btnHelper"/>
</div>

  
<?php include("footer.php"); ?>