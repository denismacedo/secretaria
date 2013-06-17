<?php include("header.php"); ?>

<script>

	function submitNovo(){
		window.location = 'doEvento.php?method=init';
	}
	
	function submitInsert() {
		document.cadastroForm.action="doEvento.php?method=inserir";
		document.cadastroForm.submit();
	}
	
	function submitAlterar() {
		document.cadastroForm.action="doEvento.php?method=alterar";
		document.cadastroForm.submit();
	}
	
	function submitEditarEvento(codEvento) {
		document.cadastroForm.action="doEvento.php?method=editar";
		document.cadastroForm.codEvento.value = codEvento;
		document.cadastroForm.submit();
	}
	
	function submitExcluirEvento(codEvento) {
		if (confirm("Tem certeza que deseja excluir o evento " + codEvento + "? Esta acao tambem vai excluir todos os cursos associados!")) {
			document.cadastroForm.action="doEvento.php?method=excluir";
			document.cadastroForm.codEvento.value = codEvento;
			document.cadastroForm.submit();
		}
	}
	
</script>

<tr>
    <td><form name="cadastroForm" method="post" action="doEvento.php"> 
		<input type="hidden" name="SPECIAL_PARAM" id="SPECIAL_PARAM" value="<?php echo $specialParam; ?>"/>
	<table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Cadastro Evento </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">* Esta tela permite cadastrar/alterar/excluir um evento </td>
        </tr>
     
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">C&oacute;digo:</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
					
					<input name="codEvento" id="codEvento" maxlength="20" size="20" value="<?php echo getAltPost(@$objEvento->codigo, 'codEvento', $try); ?>" class="txtNumeroRO" readonly="readonly" type="text">	

		</td>
				</tr>
			</table>		</td>
      </tr>
      <tr>
        <td height="20">Nome:</td>
        <td valign="middle"><input name="nomeEvento" id="nomeEvento" maxlength="80" size="60" value="<?php echo getAltPost(@$objOcorrencia->nome, 'nomeEvento', $try); ?>" type="text" >
        </td>
      </tr>
      <tr bgcolor="#f9f9f9">
        <td height="20">Tipo:</td>
        <td valign="middle">
			<select id="tipoEvento" name="tipoEvento">
				<option></option>
				<?php
					$previousTipo = getAltPost(@$objEvento->tipoEvento, 'tipoEvento', $try);
					$totalTipoEventos = mysql_num_rows($tipoEventos);
					for ($i = 0; $i < $totalTipoEventos; $i++) {
						$codigo = mysql_result($tipoEventos, $i, "codigo");
						$nome = mysql_result($tipoEventos, $i, "descricao");
						$tipoSelected = "";
						if ($previousTipo == $codigo) {
							$tipoSelected = "SELECTED";
						}
						?>
						<option value="<?php echo $codigo; ?>" <?php echo $tipoSelected; ?>><?php echo $nome; ?></option>
						<?php
					}
				?>
			</select>
		
		</td>
		</tr>
		<tr>
		<td height="20">In&iacute;cio: </td>
        <td valign="middle"><input name="inicioEvento" maxlength="10" size="14" value="<?php echo getAltPost(formatDate(@$objOcorrencia->inicio), 'inicioEvento', $try); ?>" type="text"  onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> (dd/mm/aaaa)</td>
      </tr>
	  <tr>
		<td height="20">T&eacute;mino: </td>
        <td valign="middle"><input name="terminoEvento" maxlength="10" size="14" value="<?php echo getAltPost(formatDate(@$objOcorrencia->termino), 'terminoEvento', $try); ?>" type="text"  onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> (dd/mm/aaaa)</td>
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
				<td width="20%" class="tableHeader">Tipo</td>
				<td width="10%" class="tableHeader">In&iacute;cio</td>
				<td width="10%" class="tableHeader">T&eacute;rmino</td>
				<td width="5%" class="tableHeader"></td>
				<td width="5%" class="tableHeader"></td>
			</tr>
			<?php
			if ($numRows > 0) {
		
				$cor = false;
				for ($i = 0; $i < $numRows; $i++) {
					$codigo = mysql_result($resultado, $i, "codigo");
					$nome = mysql_result($resultado, $i, "nome");
					$tipo = mysql_result($resultado, $i, "tipo");
					$inicio = mysql_result($resultado, $i, "inicio");
					$termino = mysql_result($resultado, $i, "termino");
									
					$cor = !$cor;
					if ($cor) {	$bgcolor = "#F0F0F0"; } else { $bgcolor = "#FFFFFF";	}
					
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>">
						  <td height="26" style="color:#0000FF; font-weight:bold;" align="center"><?php echo $codigo; ?></td>
						  <td ><?php echo $nome; ?></td>
						  <td ><?php echo $tipo; ?></td>
						  <td align="center"><?php echo $inicio; ?></td>
						  <td align="center"><?php echo $termino; ?></td>
					  	  <td><a href="#" onclick="submitEditarEvento('<?php echo $codigo; ?>')">Editar</a></td>
						  <td><a href="#" onclick="submitExcluirEvento('<?php echo $codigo; ?>')">Excluir</a></td>
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