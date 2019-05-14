<?php

include("headerRel.php");

?>
</tr><tr valign="top">
	<td>
	
  
<?php 
		
		$sql = "select b.evento, b.codigo, b.nome, e.qualif_evento, pf.nome as nome_pf, ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade, pf.cidade, pf.unidade_da_federacao, c.pago
				from sub_ocorrencia a, participante p, inscricao i, pessoa_fisica pf, ocorrencia b, evento e, ocorrencia x, boleto c
				where a.ocorrencia = b.codigo and a.evento = b.evento 
				and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
				and x.codigo = b.ocorrencia_geradora
				and x.evento = b.concafras_geradora
				and b.evento = e.codigo 
				and e.tipo_evento = 1
				and a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia 
				and p.inscricao = i.codigo
				and i.pessoa_fisica = pf.codigo
				and p.inscricao = c.inscricao
				order by e.qualif_evento, b.nome, pf.nome";
		
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
				
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#e0e0e0";
					} else {
						$bgcolor = "#e0e0e0";
					}
				
					 $qualif = mysql_result($resultado, $i, "qualif_evento");
					 if ($qualif == "1") {
						$qualif = "ESPEC&Iacute;FICO";
					 } else if ($qualif == "2") {
						 $qualif = "ATUAL";
					 } else {
						$qualif = "";
					 }
					 
					 if($i > 0){
					 // completa linhas vazias
					 for($j = ($totalPartCurso + 1); $j <= 40; $j++){
					 
					 $cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#e0e0e0";
					} else {
						$bgcolor = "#ffffff";
					}
					 
					 ?>
					 <tr bgcolor="<?php echo $bgcolor; ?>" >
						    <td height="20" align="center" style="border-bottom:solid 1px black; border-left:solid 1px black;">&nbsp;<?php echo $j; ?></td>
							<td height="20" style="border-bottom:solid 1px black; border-left:solid 1px black;">&nbsp;</td>
							<td height="20" style="border-bottom:solid 1px black; border-left:solid 1px black;">&nbsp;</td>
							<td height="20" align="center" style="border-bottom:solid 1px black; border-left:solid 1px black;border-right:solid 1px black;">&nbsp;</td>
						</tr>
					 <?php
					 }
					 }
					 // imprime rodape
					 if($i > 0){
					 ?>
					 
					 
					 <tr bgcolor="#cccccc">
					<td colspan="4">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<!--<span style="font-weight: bold;">TOTAL DE CURSOS: &nbsp; <?php echo $linhas; ?></span>								</td>-->
								<td class="labelColRel" align="right" height="5">
									<span style="font-size: 10px;">TOTAL DE PARTICIPANTES INSCRITOS: &nbsp; <?php echo $totalPartCurso; ?></span>								</td>
							</tr>
						</tbody></table>					</td>
				</tr>
	</tbody></table>
	
					<?php
					}
					
					$totalPartCurso = 0;
					
					?>
					 <br/>
	<table align="center" width="100%" cellspacing="0" style="page-break-before: always;">
		<tbody><tr>
		  <td colspan="4" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="4" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O DE PARTICIPANTES CURSO <?php echo $qualif." - ".mysql_result($resultado, $i, "nome"); ?></span></td>
		</tr>
  <tr>

  </tr>
					 
			<tr class="labelColRel" bgcolor="#cccccc">
				<td height="20" width="5%" class="labelColRel" align="center" style="border:solid 1px black;"><span style="font-weight: bold;">&nbsp; N&uacute;m.</span></td>
				<td height="20" width="45%" class="labelColRel" style="border:solid 1px black;"><span style="font-weight: bold;">&nbsp; NOME</span></td>
				<td height="20" width="25%" class="labelColRel" style="border:solid 1px black;"><span style="font-weight: bold;">&nbsp; CIDADE</span></td>
				<td height="20" width="25%" class="labelColRel" align="center" style="border:solid 1px black;"><span style="font-weight: bold;">&nbsp; Assinatura</span></td>            
			</tr>
					 
					
					 <?php
				}
				
				  $cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#e0e0e0";
					} else {
						$bgcolor = "#ffffff";
					}
					
					$totalPartCurso++;
				
				?>
					
						<tr bgcolor="<?php echo $bgcolor; ?>" >
						    <td height="20" align="center" style="border-bottom:solid 1px black;border-left:solid 1px black;">&nbsp;<?php echo $totalPartCurso; ?></td>
							<td height="20" style="border-bottom:solid 1px black;border-left:solid 1px black;">&nbsp;<?php echo mysql_result($resultado, $i, "nome_pf"); ?></td>
							<td height="20" style="border-bottom:solid 1px black;border-left:solid 1px black;">&nbsp;<?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"); ?></td>
							<td height="20" align="center" style="border-bottom:solid 1px black;border-left:solid 1px black;border-right:solid 1px black;">&nbsp;</td>
						</tr>
					<?php
			}
		}

?>
		<tr bgcolor="#cccccc">
					<td colspan="4">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<!--<span style="font-weight: bold;">TOTAL DE CURSOS: &nbsp; <?php echo $linhas; ?></span>								</td>-->
								<td class="labelColRel" align="right" height="5">
									<span style="font-size: 10px;">TOTAL DE PARTICIPANTES NO CURSO: &nbsp; <?php echo $totalPartCurso; ?></span>								</td>
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
