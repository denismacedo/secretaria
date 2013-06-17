<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="2" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>
		  </td>
	    </tr>
		<tr>
			<td colspan="2" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">N&Uacute;MERO DE PARTICIPANTES POR CURSO</span></td>
		</tr>
  <tr>
  	<td colspan="2" align="center">
  		<img src="imagens/barra_rel.jpg">
  	</td>
  </tr><tr>
		
		</tr><tr class="labelColRel" bgcolor="#cccccc">
			<td class="labelColRel" height="30"><span style="font-weight: bold;">CURSO</span></td>
			<td class="labelColRel" width="10%"><span style="font-weight: bold;">PARTICIPANTES</span></td>
		</tr>

  
  <?php 
  $sql = "select b.evento, b.codigo, b.nome, e.qualif_evento, count(p.inscricao) as inscritos 
		from sub_ocorrencia a LEFT OUTER JOIN participante p ON (a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia), 
		ocorrencia b, evento e
		where a.ocorrencia = b.codigo and a.evento = b.evento 
		and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]." 
		and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
		and b.evento = e.codigo 
		and e.tipo_evento = 1 
		group by b.evento, b.codigo, b.nome, e.qualif_evento
		order by e.qualif_evento, b.nome";
		
		$resultado = mysql_query($sql);
		
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			for ($i = 0; $i < $linhas; $i++) {
			
				$cor = !$cor;
				
				if ($cor) {
					$bgcolor = "#e0e0e0";
				} else {
					$bgcolor = "#FFFFFF";
				}
			
				 $qualif = mysql_result($resultado, $i, "qualif_evento");
				 if ($qualif == "1") {
				 	$qualif = "TEMA ESPEC&Iacute;FICO";
				 } else if ($qualif == "2") {
					 $qualif = "TEMA ATUAL";
				 } else {
				 	$qualif = "";
				 }
				
				?>
				
					<tr bgcolor="<?php echo $bgcolor; ?>">
						<td height="30">&nbsp;<b><?php echo $qualif."</b> - ".mysql_result($resultado, $i, "nome") ?></td>
						<td style="font-size: 16px; font-weight:bold; padding-right:8px;" align="right"><?php echo mysql_result($resultado, $i, "inscritos"); ?>&nbsp;</td>
					</tr>
				
				<?php
				
				$totalPart += mysql_result($resultado, $i, "inscritos");
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="2">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="35">
									<span style="font-weight: bold;">TOTAL DE CURSOS: &nbsp; <?php echo $linhas; ?></span>
								</td>
								<td class="labelColRel" align="right" height="35">
									<!--<span style="font-weight: bold;">TOTAL DE PARTICIPANTES EM CURSOS: &nbsp; <?php echo $totalPart; ?></span>-->
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			
		
	</tbody></table>
	
	
	</td>
</tr>
</tbody></table>
<?php

include("footerRel.php");

?>
