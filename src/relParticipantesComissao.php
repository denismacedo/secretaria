<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="5" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="5" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE PARTICIPANTES POR COMISS&Atilde;O</span></td>
		</tr>
  <tr>
  	<td colspan="5" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" colspan="5" class="labelColRel">COMISS&Atilde;O</td>
			</tr>

  
  <?php 
		
		$sql = "select b.evento, b.codigo, b.nome, pf.nome as nome_pf, pf.email, pf.cidade, pf.unidade_da_federacao as estado, pf.pais
				from sub_ocorrencia a, participante p, inscricao i, pessoa_fisica pf, ocorrencia b, evento e
				where a.ocorrencia = b.codigo and a.evento = b.evento 
				and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
				and b.evento = e.codigo 
				and e.tipo_evento = 8
				and a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia 
				and p.inscricao = i.codigo
				and i.pessoa_fisica = pf.codigo
				order by b.nome, pf.nome";
				

		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$eventoOcorrencia = "";
			for ($i = 0; $i < $linhas; $i++) {
			
				 $evtOcoAtual = mysql_result($resultado, $i, "evento")."/".mysql_result($resultado, $i, "codigo");
			
				if ($eventoOcorrencia != $evtOcoAtual) {
					
					$eventoOcorrencia = $evtOcoAtual;
				
				
					?>
						<tr bgcolor="#d0d0d0">
							<td height="30" colspan="5"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
						</tr>
					<?php
				
				}
				$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#e0e0e0";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
				?>
					
						<tr bgcolor="<?php echo $bgcolor; ?>">
							<td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysql_result($resultado, $i, "nome_pf"); ?></td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "email"); ?></td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "cidade"); ?></td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "estado"); ?></td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "pais"); ?></td>
						</tr>
					<?php
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="5">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<!--<span style="font-weight: bold;">TOTAL DE CURSOS: &nbsp; <?php echo $linhas; ?></span>								</td>-->
								<td class="labelColRel" align="right" height="5">
									<!--<span style="font-weight: bold;">TOTAL DE PARTICIPANTES EM CURSOS: &nbsp; <?php echo $totalPart; ?></span>-->								</td>
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
