<?php 

include ("header.php");

$try = true;

?>

<form name="cadastroForm" method="post" action="doInscricao.php?metodo=salvar">

  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		
		<tr>
				<td>
	
	  <table align="center" border="0" cellpadding="2" cellspacing="1" width="800">
        
          <tr bgcolor="#333333">
            <td height="40" colspan="2" bgcolor="#999999">
			<span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 14px;">&nbsp;Passo 1 de 3: Informe os dados abaixo e clique no bot&atilde;o Confirmar. </span></td>
          </tr>
          
        <input type="hidden" name="tipoPF" value="1"/>
        
        <tr>
          <td height="30">CPF:</td>
          <td valign="middle"><input name="cpf" id="cpf" maxlength="15" size="20" value="<?php echo getAltPost(@$objPF->cpf, 'cpf', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"> (somente n&uacute;meros)
              <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">--></td>
        </tr>
        <tr bgcolor="#f9f9f9">
          <td height="30">Nome:</td>
          <td valign="middle"><input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->nome, 'nome', $try); ?>" type="text" class="txt">
              <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">--></td>
        </tr>
		<tr>
          <td height="30">Nome para Crach&aacute;:</td>
          <td valign="middle"><input name="apelido" id="apelido" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->apelido, 'apelido', $try); ?>" type="text" class="txt">
           </td>
        </tr>
        <tr bgcolor="#f9f9f9">
          <td height="30">Data de Nascimento: </td>
          <td valign="middle"><input name="dataNasc" maxlength="10" size="14" value="<?php echo getAltPost(formatDate(@$objPF->data_nasc), 'dataNasc', $try); ?>" type="text"  onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);">
            (dd/mm/aaaa)          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexo:&nbsp;
            <input type="radio" name="sexo" value="M" style="border: 0px;" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'M'); ?> >
            Masculino
            <input type="radio" name="sexo" value="F" style="border: 0px;" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'F'); ?> >
            Feminino </td>
        </tr>
       
        <tr>
          
          <td height="30">Pa&iacute;s:</td>
        <td>
		<div id="divPais" style="float:left;">
        <select name="pais" id="pais" onchange="changePais(this.value);"><option selected></option><?php echo $paises; ?></select>
		</div>
		<?php 
		
			if (isset($estados) && $estados != "") {
				?>
				
				<div id="divEstado" style="float:left;">
          &nbsp;&nbsp;Estado:&nbsp;
			</div>
			<div id="divUF" style="float:left;">
				<?php echo $estados; ?>
			</div>
				
				<?php
			} else {
			
				?>
				
				<div id="divEstado" style="display:none; visibility:hidden; float:left;">
          &nbsp;&nbsp;Estado:&nbsp;
			</div>
			<div id="divUF" style="display: none; visibility: hidden;  float:left;"></div>
				
				<?php
			}
		
		?>
		
		<?php 
		
			if (isset($cidades) && $cidades != "") {
				?>
				
				<div id="divCid" style="float:left;">
          &nbsp;&nbsp;Cidade:&nbsp;
			</div>
			<div id="divCidade" style="float:left;">
				<?php echo $cidades; ?>
			</div>
				
				<?php
			} else {
			
				?>
				
				<div id="divCid" style="display:none; visibility:hidden; float:left;">
          &nbsp;&nbsp;Cidade:&nbsp;
			</div>
			<div id="divCidade" style="display: none; visibility: hidden;  float:left;"></div>
				
				
				<?php
			}
		
		?>

       </td>
        </tr>
        <tr bgcolor="#f9f9f9">
          <td height="30">E-mail:</td>
          <td><input name="email" id="email" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->email, 'email', $try); ?>" type="text">
           </td>
        </tr>
        <tr>
          <td height="30">Dirigente de C. Esp&iacuterita:</td>
          <td>
            <select name="dirigente">
              <option value=""></option>
              <option value="S" <?php echo getSelected(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'S'); ?>>SIM</option>
              <option value="N" <?php echo getSelected(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'N'); ?>>NAO</option>
            </select>          </td>
        </tr>
         <tr bgcolor="#f9f9f9">
        <td height="20">Vegetariano:</td>
        <td>
		  <select name="vegetariano">
		  	<option value=""></option>
          	<option value="S" <?php echo getSelected(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'S'); ?>>SIM</option>
          	<option value="N" <?php echo getSelected(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'N'); ?>>NAO</option></select> </td>
      </tr>

       <tr bgcolor="#ffffff">
          <td height="30">Respons&aacute;vel:</td>
          <td valign="middle"><input name="codResponsavel" id="codResponsavel" value="<?php echo getAltPost(@$objPF->codResponsavel, 'codResponsavel', $try); ?>" type="hidden">
              <input name="responsavel" id="responsavel" maxlength="80" size="50" value="<?php echo getPost('responsavel'); ?>"  type="text" class="txtRO" readonly>
              &nbsp; <a href="#" title="Procurar Respons&aacute;vel"><img style="cursor:hand;" src="../imagens/lupa.gif" alt="Procurar Respons&aacute;vel" onclick="javascript:findResponsavel();" align="absmiddle" border="0" width="17" height="17"></a> &nbsp;&nbsp;&nbsp;(apenas crian&ccedil;as)</td>
        </tr>
        <tr bgcolor="#f9f9f9">
          <td height="30"><!--<a alt="Clique para cadastar um Centro Esp&iacute;rita" title="Clique para cadastar um Centro Esp&iacute;rita" href="javascript:cadastrarPJ();">-->Centro Esp&iacute;rita:<!--</a>--></td>
          <td valign="middle"><input name="codOrigem" id="codOrigem" value="<?php echo getAltPost(@$objPF->objOrigem->pj, 'codOrigem', $try); ?>" type="hidden">
              <input name="origem" id="origem" maxlength="80" size="50" value="<?php echo getAltPost(@$objPF->objOrigem->nomePJ, 'origem', $try); ?>"  type="text" class="txtRO" readonly>
              <!--<input name="origemComplemento" id="origemComplemento" readonly="readonly" size="40" value="<?php if (isset($objPF->objOrigem)) { echo @$objPF->objOrigem->cidade." - ".@$objPF->objOrigem->estado; } else { echo getAltPost('', 'origemComplemento', $try); } ?>" type="text" style="border: 0px; font-style:italic; color:#666666; background-color:#f9f9f9; font-size:9px;" tabindex="-10">-->
              &nbsp; <a href="#" title="Procurar Centro Esp&iacute;rita"><img style="cursor:hand;" src="../imagens/lupa.gif" alt="Procurar Centro Esp&iacute;rita" onclick="javascript:findOrigem();" align="absmiddle" border="0" width="17" height="17"></a> <b>&nbsp;&nbsp;&nbsp;&nbsp;N&atilde;o encontrou seu centro? <a href="#" onClick="javascript:exibeCadCentro();">Clique aqui!</a></b></td>
        </tr>
        <tr>
          <td colspan="2" height="20"><table border="0" width="100%">
              
                <tr>
                  <td valign="top" width="50%"><fieldset>
                    <legend><span style="font-weight: bold;">Telefones</span></legend>
                    <table border="0" cellpadding="4" cellspacing="2" width="100%">
                      
                        <tr bgcolor="#f9f9f9">
                          <td width="11%" height="26">DDD</td>
                          <td width="14%"><input name="ddd" maxlength="2" size="4" value="<?php echo getAltPost(@$objPF->ddd, 'ddd', $try); ?>" class="txtNumero" type="text" onKeyUp="document.cadastroForm.ddd2.value = this.value; document.cadastroForm.ddd3.value = this.value;" onKeyPress="ehNumerico(this);"></td>
                          <td width="20%">Telefone 1: </td>
                          <td width="55%"><input name="residencial" maxlength="9" size="12" value="<?php echo getAltPost(@$objPF->telRes, 'residencial', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
                        </tr>
                        <tr>
                          <td>DDD</td>
                          <td><input name="ddd3" maxlength="2" size="4" value="<?php echo getAltPost(@$objPF->ddd, 'ddd3', $try); ?>" readonly="readonly" class="txtNumeroRO" type="text"></td>
                          <td>Telefone 2: </td>
                          <td height="30"><input name="celular" maxlength="9" size="12" value="<?php echo getAltPost(@$objPF->telCel, 'celular', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);"></td>
                        </tr>
                    </table>
                  </fieldset></td>
                  <td valign="top" width="50%"><fieldset>
                    <legend><span style="font-weight: bold;">Cuidados / Necessidades Especiais</span></legend>
                    <table border="0" cellpadding="4" cellspacing="1" width="100%">

                        <tr>
                          <td><textarea name="obs" cols="60" rows="5"><?php echo getAltPost(@$objPF->objParticularidade->observacao, 'obs', $try); ?></textarea></td>
                        </tr>
                      
                    </table>
                  </fieldset></td>
                </tr>
              
          </table>             </td>
		  
        </tr>
        <tr align="center" bgcolor="#f0f0f0">
          <td colspan="2" height="20"><input name="btInserir" id="btInserir" value="Confirmar" onclick="submitSalvar();" type="button" <?php if (getAltPost(@$objPF->codigo, 'codigo', $try) != "") echo "disabled"; ?>></td>
        </tr>
		
      </table>
	  <p><br>
          <br>
          <br>
          <br>
          <br>
          <br>
	    
	    
      </p></td>


</tr>


</table>
</form>

<?php include ("footer.php"); ?>