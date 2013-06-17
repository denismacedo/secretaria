<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="7" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="7" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE CRIAN&Ccedil;AS E RESPONS&Aacute;VEIS POR CURSO</span></td>
		</tr>
  <tr>
  	<td colspan="7" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc" style="font-size:11px;">
			<td height="30" width="20%" class="labelColRel" colspan="2"><span style="font-weight: bold;">NOME DA CRIAN&Ccedil;A</span></td>
			<td height="30" width="10%" class="labelColRel"><span style="font-weight: bold;">CIDADE</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold;">IDADE (anos)</span></td>
			<td height="30" width="10%" class="labelColRel" align="center"><span style="font-weight: bold;">RESPONSAVEL</span></td>
			<td height="30" width="15%" class="labelColRel" align="center"><span style="font-weight: bold;">CURSO RESPONSAVEL</span></td>
			<td height="30" width="10%" class="labelColRel" align="center"><span style="font-weight: bold;">CONTATO RESPONSAVEL</span></td>
			</tr>
<?php 
		
		$sql = "select b.evento, b.codigo, b.nome, e.qualif_evento, pf.nome as nome_pf, ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade, pf.cidade, pf.unidade_da_federacao, resp.codigo as cod_responsavel, resp.nome as nome_responsavel
				from sub_ocorrencia a, participante p, inscricao i, pessoa_fisica pf LEFT OUTER JOIN pessoa_fisica resp ON (pf.responsavel = resp.codigo), ocorrencia b, evento e, ocorrencia x
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
				and ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) < 12
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
					
					$qualif = mysql_result($resultado, $i, "qualif_evento");
					 if ($qualif == "1") {
						$qualif = "ESPEC&Iacute;FICO";
					 } else if ($qualif == "2") {
						 $qualif = "ATUAL";
					 } else {
						$qualif = "";
					 }
					
					?>
					
					<tr bgcolor="#cccccc">
						<td height="30" colspan="7">
							<b>&nbsp;<?php echo $qualif." - ".mysql_result($resultado, $i, "nome"); ?></b>
						</td>
					</tr>
					
					
					<?php

				}
				
				  $cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#F0F0F0";
					} else {
						$bgcolor = "#F9F9F9";
					}
					
					 $responsavel = mysql_result($resultado, $i, "cod_responsavel");
					 if ($responsavel != "") {
							 $sqlTel = "select b.ddd, b.numero as telefone from pessoa_fisica_telefone a, telefone b
									where a.pessoa_fisica = ".$responsavel." 
									and a.ddd = b.ddd 
									and a.numero = b.numero";
						 $resultadoTel = mysql_query($sqlTel);
						 
						 $telefones = "";
						 for ($j = 0; $j < mysql_num_rows($resultadoTel); $j++) {
							$telefones .= "(".mysql_result($resultadoTel, $j, "ddd").")".mysql_result($resultadoTel, $j, "telefone")."<br>";
						 }
				 
						$sqlResp = "select b.nome, e.qualif_evento
							from sub_ocorrencia a, participante p, inscricao i, pessoa_fisica pf, ocorrencia b, evento e
							where a.ocorrencia = b.codigo and a.evento = b.evento 
							and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]." 
							and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
							and b.evento = e.codigo 
							and e.tipo_evento = 1
							and a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia 
							and p.inscricao = i.codigo
							and i.pessoa_fisica = pf.codigo
							and pf.codigo = ".$responsavel."
							order by e.qualif_evento, b.nome, pf.nome";
				
						$resultadoResp = mysql_query($sqlResp);				 
						 
						  $cursosResponsavel = "";
						 for ($j = 0; $j < mysql_num_rows($resultadoResp); $j++) {
							 $qualifResponsavel = mysql_result($resultadoResp, $j, "qualif_evento");
							 if ($qualifResponsavel == "1") {
								$qualifResponsavel = "ESPEC&Iacute;FICO";
							 } else if ($qualifResponsavel == "2") {
								 $qualifResponsavel = "ATUAL";
							 } else {
								$qualifResponsavel = "";
							 }
							$cursosResponsavel .= $qualifResponsavel." - ".mysql_result($resultadoResp, $j, "nome")."<br>";
						 }
					}
				
				?>
						<tr bgcolor="<?php echo $bgcolor; ?>">
						<td height="30">
							
						</td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "nome_pf"); ?></td>
							<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"); ?></td>
							<td height="30" align="center">&nbsp;<?php echo mysql_result($resultado, $i, "idade"); ?></td>
							<td height="30" >&nbsp;<?php echo mysql_result($resultado, $i, "nome_responsavel"); ?></td>
							<td height="30" >&nbsp;<?php echo $cursosResponsavel; ?></td>
							<td height="30" align="center">&nbsp;<?php echo $telefones; ?></td>
						</tr>
					<?php
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="7">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL DE CRIAN&Ccedil;AS: &nbsp; <?php echo $linhas; ?></span>								</td>
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
