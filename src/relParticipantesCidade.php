<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="2" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="2" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE PARTICIPANTES POR CIDADE </span></td>
		</tr>
  <tr>
  	<td colspan="2" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" colspan="2" class="labelColRel">CIDADE</td>
			</tr>

  
  <?php 
		
		$sql = "select pf.cidade, pf.unidade_da_federacao, pf.pais, pf.nome as nome_pf
		from inscricao i, pessoa_fisica pf
		where i.evento = ".$_SESSION["EVENTO_SESSION"]." 
		and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
		and i.pessoa_fisica = pf.codigo
		order by pf.cidade, pf.unidade_da_federacao, pf.pais, pf.nome";
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);

		
		if ($linhas > 0) {
		
			$cor = false;
			$cidadeEstadoPais = "";
			$totalCidade = 0;
			$totalCidades = 0;
			
			for ($i = 0; $i < $linhas; $i++) {
			
				 $cidadeAtual = mysql_result($resultado, $i, "cidade")."/".mysql_result($resultado, $i, "unidade_da_federacao")."/".mysql_result($resultado, $i, "pais");
			
				if ($cidadeEstadoPais != $cidadeAtual) {
					$totalCidades++;
					if ($i > 0) {
					?>
					
						<tr bgcolor="#cccccc">
							<td height="10" align="right"><b>&nbsp;<?php echo $totalCidade; ?> participante(s)</b></td>
						</tr>
						<tr bgcolor="#ffffff">
							<td height="3"></td>
						</tr>
					<?php
					}
				
					$totalCidade = 0;
					
					$cidadeEstadoPais = $cidadeAtual;
				
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#F9F9F9";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
				
					?>
					
						<tr bgcolor="#e0e0e0">
							<td height="30"><b>&nbsp;<?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao")." - ".mysql_result($resultado, $i, "pais"); ?></b></td>
							
						</tr>
					<?php
				
				}
				
				?>
					
						<tr bgcolor="<?php echo $bgcolor; ?>">
							<td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysql_result($resultado, $i, "nome_pf"); ?></td>
						</tr>
					<?php
					
					$totalCidade++;
			}
			?>
					
						<tr bgcolor="#cccccc">
							<td height="10" align="right"><b>&nbsp;<?php echo $totalCidade; ?> participante(s)</b></td>
						</tr>
						<tr bgcolor="#ffffff">
							<td height="3"></td>
						</tr>
					<?php
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="2">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL DE CIDADES: &nbsp; <?php echo $totalCidades; ?></span>								</td>
								<td class="labelColRel" align="right" height="5">
									<span style="font-weight: bold;">TOTAL DE PARTICIPANTES: &nbsp; <?php echo $linhas; ?></span>						</td>
							</tr>
						</tbody></table>					</td>
				</tr>
	</tbody></table>
	
	
	</td>
</tr>
</tbody></table>
<?php

include("footerRel.php");

?>
