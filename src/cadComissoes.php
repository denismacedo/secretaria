<?php include("header.php"); ?>

<script>

	function submitNovo(){
		window.location = 'doComissoes.php?method=init';
	}
	
	function submitInsert() {
		document.cadastroForm.action="doComissoes.php?method=inserir";
		document.cadastroForm.submit();
	}
	
	function submitAlterar() {
		document.cadastroForm.action="doComissoes.php?method=alterar";
		document.cadastroForm.submit();
	}
	
	function submitEditarEvento(codEvento, codOcorrencia, codSub) {
		document.cadastroForm.action="doComissoes.php?method=editar";
		document.cadastroForm.codEvento.value = codEvento;
		document.cadastroForm.codOcorrencia.value = codOcorrencia;
		document.cadastroForm.codSub.value = codSub;
		document.cadastroForm.submit();
	}
	
	function submitExcluirEvento(codEvento, codOcorrencia, codSub) {
		if (confirm("Tem certeza que deseja excluir a comissao " + codEvento + "?")) {
			document.cadastroForm.action="doComissoes.php?method=excluir";
			document.cadastroForm.codEvento.value = codEvento;
			document.cadastroForm.codOcorrencia.value = codOcorrencia;
			document.cadastroForm.codSub.value = codSub;
			document.cadastroForm.submit();
		}
	}
	
</script>

<tr>
    <td><form name="cadastroForm" method="post" action="doComissoes.php"> 
		<input type="hidden" name="SPECIAL_PARAM" id="SPECIAL_PARAM" value="<?php echo $specialParam; ?>"/>
	<table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Cadastro Comiss&otilde;es </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">* Esta tela permite cadastrar/alterar/excluir os cursos do evento <?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?></td>
        </tr>
     
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">C&oacute;digo:</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
					<?php 
					$previousCodEvento = getAltPost(@$objEvento->codigo, 'codEvento', $try);
					
					?>
		<input name="codEvento" id="codEvento" maxlength="20" size="20" value="<?php echo getAltPost(@$objEvento->codigo, 'codEvento', $try); ?>" class="txtNumeroRO" readonly="readonly" type="text">	
					
					<?php
					}
					?>
&nbsp; (Informe o n&uacute;mero do curso/tema) 
					<input type="hidden" name="codSub" id="codSub" value="<?php echo getAltPost(@$objSub->codigo, 'codSub', $try); ?>" />
					<input type="hidden" name="codOcorrencia" id="codOcorrencia" value="<?php echo getAltPost(@$objSub->ocorrencia, 'codOcorrencia', $try); ?>" />
				</td>
				</tr>
			</table>		</td>
      </tr>
      <tr>
        <td height="20">Nome:</td>
        <td valign="middle"><input name="nomeEvento" id="nomeEvento" maxlength="160" size="100" value="<?php echo getAltPost(@$objEvento->nome, 'nomeEvento', $try); ?>" type="text" >
        </td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20" bgcolor="#f9f9f9">Tipo:</td>
        <td valign="middle">
			<select id="qualificacao" name="qualificacao">
				<option></option>
				<?php
					$previousQualif = getAltPost(@$objEvento->qualifEvento, 'qualificacao', $try);
					$totalQualif = mysql_num_rows($qualificacoes);
					for ($i = 0; $i < $totalQualif; $i++) {
						$codigo = mysql_result($qualificacoes, $i, "codigo");
						$nome = mysql_result($qualificacoes, $i, "descricao");
						$qualifSelected = "";
						if ($previousQualif == $codigo) {
							$qualifSelected = "SELECTED";
						}
						?>
						<option value="<?php echo $codigo; ?>" <?php echo $qualifSelected; ?>><?php echo $nome; ?></option>
						<?php
					}
				?>
			</select>
		
		</td>
		</tr>
		<tr>
		<td height="20">Idade m&iacute;nima : </td>
        <td valign="middle"><input name="idadeInicio" maxlength="4" size="10" value="<?php echo getAltPost(@$objEvento->restricaoIdadeInicio, 'idadeInicio', $try); ?>" type="text"  onKeyPress="ehNumerico(this);"> 
          anos </td>
      </tr>
	  <tr>
		<td height="20" bgcolor="#f9f9f9">Idade m&aacute;xima: </td>
        <td valign="middle" bgcolor="#f9f9f9"><input name="idadeFim" maxlength="4" size="10" value="<?php echo getAltPost(@$objEvento->restricaoIdadeFim, 'idadeFim', $try); ?>" type="text"  onKeyPress="ehNumerico(this);" > 
          anos </td>
      </tr>
	  <tr>
		<td height="20">Vagas: </td>
        <td valign="middle"><input name="numeroVagas" maxlength="4" size="10" value="<?php echo getAltPost(@$objSub->capacidade, 'numeroVagas', $try); ?>" type="text"  onKeyPress="ehNumerico(this);"> 
          </td>
      </tr>
      <tr>
        <td colspan="2" height="10">&nbsp;</td>
        </tr>
      <tr align="right" bgcolor="#f0f0f0">
        <td colspan="2" height="20">
		<input name="btNovo" id="btNovo" value="Novo" onclick="submitNovo();" type="button">
          &nbsp;&nbsp;&nbsp;	
			 <input name="btInserir" id="btInserir" value="Inserir" onclick="submitInsert();" type="button" >
&nbsp;&nbsp;&nbsp;	
		<input name="btAlterar" id="btAlterar" value="Alterar" onclick="submitAlterar()"  type="button">
		</td>
      </tr>
    </table>
    </form></td>
  </tr>
  
  <?php
  if (isset($resultado) && $resultado != "") {
			
			$numRows = mysql_num_rows($resultado);
			?>
  <tr>
  	<td>
	<br>
		<table width="700" align="center">
			
			<tr >
				<td width="10%" class="tableHeader">C&oacute;digo</td>
				<td class="tableHeader">Nome</td>
				<td width="15%" class="tableHeader">Tipo</td>
				<td width="10%" class="tableHeader">Idade min </td>
				<td width="10%" class="tableHeader">Idade m&aacute;x </td>
				<td width="5%" class="tableHeader">Vagas </td>
				<td width="5%" class="tableHeader"></td>
				<td width="5%" class="tableHeader"></td>
			</tr>
			<?php
			if ($numRows > 0) {
				$cor = false;
				for ($i = 0; $i < $numRows; $i++) {
					$codigo = mysql_result($resultado, $i, "evento");
					$codOcorrencia = mysql_result($resultado, $i, "ocorrencia");
					$codSub = mysql_result($resultado, $i, "codigo");
					$nome = mysql_result($resultado, $i, "nome");
					$qualif = mysql_result($resultado, $i, "descQualif");
					$inicio = mysql_result($resultado, $i, "restricao_idade_inicio");
					$termino = mysql_result($resultado, $i, "restricao_idade_fim");
					$vagas = mysql_result($resultado, $i, "capacidade");
									
					$cor = !$cor;
					if ($cor) {	$bgcolor = "#F0F0F0"; } else { $bgcolor = "#FFFFFF";	}
					
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>">
						  <td height="26" style="color:#0000FF; font-weight:bold;" align="center"><?php echo $codigo; ?></td>
						  <td ><?php echo $nome; ?></td>
						  <td ><?php echo $qualif; ?></td>
						  <td align="center"><?php echo $inicio; ?></td>
						  <td align="center"><?php echo $termino; ?></td>
						  <td align="center"><?php echo $vagas; ?></td>
					  	  <td><a href="#" onclick="submitEditarEvento('<?php echo $codigo; ?>', '<?php echo $codOcorrencia; ?>', '<?php echo $codSub; ?>')">Editar</a></td>
						  <td><a href="#" onclick="submitExcluirEvento('<?php echo $codigo; ?>', '<?php echo $codOcorrencia; ?>', '<?php echo $codSub; ?>')">Excluir</a></td>
						</tr>
				<?php
				}
			}
				
				?>
			
		</table>
		<br><br />

	</td>
  </tr>
  
  <?php 
  
  }
  ?>
  
<?php include("footer.php"); ?>