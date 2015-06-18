<?php 
	
	require_once("util/http.php");
	require_once('util/comum.php');
	
	if (getPost("POP") == 1)
		include("headerPop.php"); 
	else
		include("header.php"); 

?>



<script language="JavaScript" src="js/cadastroPJ.js">
</script>

<tr>
    <td><form name="pesquisaForm" method="post" action="doInscricao.php?method=printCrachaVarios">
		<input type="hidden" name="print" id="print" value="N"/>
	 <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Impress&atilde;o de Crach&aacute;s  - Filtro </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="50">    * Informe os campos abaixo e clique em <strong>Imprimir</strong>. </td>
        </tr>
         <tr>
        <td height="30">N&uacute;mero da Inscri&ccedil;&atilde;o: </td>
        <td valign="middle"><input name="codInscricao" id="codInscricao" maxlength="10" size="15" value="<?php echo $codInscricao; ?>"  type="text" class="txtAUTO" style="height:20px;font-size:14px;font-weigth:bold;text-align:right;" /></td>
      </tr>
      <tr>
        <td height="30">Situa&ccedil;&atilde;o da Inscri&ccedil;&atilde;o: </td>
        <td valign="middle"><select name="situacao" id="situacao">
          <option value="T" <?php echo $situacao == 'T' ? "SELECTED" : "" ?>>TODAS</option>
          <option value="P" <?php echo $situacao == 'P' ? "SELECTED" : "" ?>>APENAS PAGAS</option>
          <option value="N" <?php echo $situacao == 'N' ? "SELECTED" : "" ?>>APENAS N&Atilde;O PAGAS</option>
        </select>        </td>
      </tr>
      <tr>
        <td height="30">Tipo de Participante:</td>
        <td valign="middle"><select name="participante" id="participante">
          <option value="T" <?php echo $participante == 'T' ? "SELECTED" : "" ?>>TODOS</option>
          <option value="B" <?php echo $participante == 'B' ? "SELECTED" : "" ?>>APENAS TRABALHADOR</option>
          <option value="C" <?php echo $participante == 'C' ? "SELECTED" : "" ?>>APENAS CARAVANEIRO</option>
        </select></td>
      </tr>
      <tr>
        <td height="30">Conte&uacute;do do crach&aacute;: </td>
        <td valign="middle"><select name="conteudo" id="conteudo">
          <option value="T" <?php echo $conteudo == 'T' ? "SELECTED" : "" ?>>COMISS&Atilde;O e CURSO</option>
          <option value="C" <?php echo $conteudo == 'C' ? "SELECTED" : "" ?>>APENAS CURSO</option>
          <option value="S" <?php echo $conteudo == 'S' ? "SELECTED" : "" ?>>APENAS COMISS&Atilde;O</option>
                </select></td>
      </tr>
      <tr>
        <td height="30">Imprimir inscri&ccedil;&otilde;es sem curso? </td>
        <td valign="middle"><select name="semCurso" id="semCurso">
          <option value="S" <?php echo $semCurso == 'S' ? "SELECTED" : "" ?>>Sim</option>
          <option value="N" <?php echo $semCurso == 'N' || $semCurso == '' ? "SELECTED" : "" ?>>N&atilde;o</option>
        </select></td>
      </tr>
      <tr>
        <td height="30">Reimprimir crach&aacute;s j&aacute; impressos?</td>
        <td valign="middle"><select name="impressos" id="impressos">
          <option value="S" <?php echo $impressos == 'S' ? "SELECTED" : "" ?>>Sim</option>
          <option value="N" <?php echo $impressos == 'N' || $impressos == '' ? "SELECTED" : "" ?>>N&atilde;o</option>
                </select></td>
      </tr>
      
      <tr>
        <td height="30">Idade:</td>
        <td valign="middle"><select name="idade" id="idade">
          <option value="T" <?php echo $idade == 'T' ? "SELECTED" : "" ?>>TODAS</option>
          <option value="C" <?php echo $idade == 'C' ? "SELECTED" : "" ?>>APENAS CRIAN&Ccedil;AS</option>
          <option value="J" <?php echo $idade == 'J' ? "SELECTED" : "" ?>>APENAS JOVENS</option>
          <option value="A" <?php echo $idade == 'A' ? "SELECTED" : "" ?>>APENAS ADULTOS</option>
                                </select>
          &nbsp;&nbsp;&nbsp;entre          
          <input style="text-align:center" name="idadeIni" id="idadeIni" maxlength="10" size="5" value="<?php echo $idadeIni; ?>"  type="text" class="txtAUTO" onkeypress="ehNumerico(this);" /> 
          e 
          <input style="text-align:center" name="idadeFim" id="idadeFim" maxlength="10" size="5" value="<?php echo $idadeFim; ?>"  type="text" class="txtAUTO" onkeypress="ehNumerico(this); "  /> 
          anos </td>
      </tr>
      <tr>
        <td height="30">Usar crach&aacute; infantil? </td>
        <td valign="middle"><select name="crachaInfantil" id="crachaInfantil">
          <option value="N" selected="selected" <?php echo $crachaInfantil == 'N' || $impressos == '' ? "SELECTED" : "" ?>>N&atilde;o</option>
          <option value="S" <?php echo $crachaInfantil == 'S' ? "SELECTED" : "" ?>>Sim</option>
                </select> 
          (se SIM, o sistema imprimir&aacute; no crach&aacute; de formato reduzido) </td>
      </tr>
      <tr>
        <td height="30">Exibir ensalamento? </td>
        <td valign="middle"><select name="ensalamento" id="ensalamento">
          <option value="S" <?php echo $ensalamento == 'S' ? "SELECTED" : "" ?>>Sim</option>
          <option value="N" <?php echo ($ensalamento == 'N' || $ensalamento == '') ? "SELECTED" : "" ?>>N&atilde;o</option>
                </select></td>
      </tr>
      <tr>
        <td height="30">Pessoas cujo nome come&ccedil;a com: </td>
        <td valign="middle"><input name="nomePF" id="nomePF" maxlength="60" size="40" value="<?php echo $nomePF; ?>"  type="text" class="txtAUTO" /></td>
      </tr>
      <tr>
        <td width="205" height="30">Data de Inscri&ccedil;&atilde;o:</td>
        <td width="434" valign="middle"><input name="dataIni" id="dataIni" maxlength="10" size="14" value="<?php echo $dataIni; ?>"  type="text" class="txtAUTO" onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> 
        a 
          <input name="dataFim" id="dataFim" maxlength="10" size="14" value="<?php echo $dataFim; ?>"  type="text" class="txtAUTO" onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"/></td>
      </tr>
      
      <tr align="center" bgcolor="#f0f0f0">
        <td height="20" colspan="2" align="center">
		  <br />
		  <input name="btBuscar" id="btBuscar" value="Consultar" type="button" style="text-transform:capitalize; font-size:12px; font-weight:bold;" onclick="document.pesquisaForm.print.value='N'; document.pesquisaForm.submit();">
		  <input name="btBuscar2" id="btBuscar2" value="Imprimir" type="button" style="text-transform:capitalize; font-size:12px; font-weight:bold;" onclick="document.pesquisaForm.print.value='S'; document.pesquisaForm.submit();">
		  <br /></td>
      </tr>
    </table>
	<?php
		if (isset($crachas)) {
		?>
			<table width="99%" cellpadding="2" cellspacing="1" align="center">
				<tr height="40px" bgcolor="#e0e0ff">
					<td colspan="5" align="center" style="font-weight:bold; font-size:14px;">
					Encontrados <?php echo sizeof($crachas); ?> crach&aacute;s
					</td>
				</tr>
				<tr bgcolor="#dddddd" style="font-weight:bold; font-size:14px;" height="35px">
					<td>NOME NO CRACHA</td>
					<td>CIDADE</td>
					<td>CURSO/COMISSAO</td>
					<td align="center">NRO INSCRICAO</td>
					<td align="center">TIPO</td>
				</tr>
		
		<?php
		
			$color = false;
			foreach ($crachas as $objCracha) {
				if ($color) {
					$bgcolor = "#FcFcFc";
				} else {
					$bgcolor = "#F0F0F0";
				}
				$color = !$color;
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><b><?php echo $objCracha->nomeCracha; ?></b></td>
					<td><?php echo $objCracha->objPF->cidade."-".$objCracha->objPF->unidade_da_federacao; ?></td>
					<td>
					<?php
					
					for ($i = 0; $i < sizeof($objCracha->cursos); $i++) {
					
						$objCurso = $objCracha->cursos[$i];
					
						if ($objCurso->tipo == "COMISSAO") {
							echo "<b>".$objCurso->nome."</b>";
						} else {
							echo $objCurso->nome;
							echo "<br>";
							$jaEscreveu = false;
							if ($objCurso->bloco != "") {
								echo "BLOCO ".$objCurso->bloco;
								$jaEscreveu = true;
							}
							if ($objCurso->andar != "") {
								if ($jaEscreveu) {
									echo " - ";
								}
								echo "ANDAR ".$objCurso->andar;
								$jaEscreveu = true;
							}
							if ($objCurso->sala != "") {
								if ($jaEscreveu) {
									echo " - ";
								}
								echo "SALA ".$objCurso->sala;
								$jaEscreveu = true;
							}
							if ($jaEscreveu) {
							echo "<br>";
							}
						}
					}

					?>
					</td>
					<td align="center"><?php echo formatNumber($objCracha->objInscricao->nro_inscricao, 4); ?></td>
					<td align="center"><?php echo $objCracha->tipoInscricao; ?></td>
				</tr>
				
				<?php
			}
			?>
			</table><br><br>
			<?php
		}
		
		?>
    </form></td>
</tr>
   
<?php
	include("footer.php"); 
 ?>