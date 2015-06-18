<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="9" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="10" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE CRIAN&Ccedil;AS E RESPONS&Aacute;VEIS </span></td>
		</tr>
  <tr>
  	<td colspan="9" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc" style="font-size:11px;">
			<td height="30" width="20%" class="labelColRel"><span style="font-weight: bold;">NOME</span></td>
			<td height="30" width="10%" class="labelColRel"><span style="font-weight: bold;">CIDADE</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold;">IDADE (anos)</span></td>
			<td height="30" width="10%" class="labelColRel" align="center"><span style="font-weight: bold;">RESPONSAVEL</span></td>
			<td height="30" width="15%" class="labelColRel" align="center"><span style="font-weight: bold;">CURSO RESPONSAVEL</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold;">CONTATO RESPONSAVEL</span></td>
			<td width="2%" class="labelColRel" align="center"><span style="font-weight: bold;">DOEN&Ccedil;A</span></td>
			<td width="3%" class="labelColRel" align="center"><span style="font-weight: bold;">MEDICAMENTO</span></td>
			<td width="5%" class="labelColRel" align="center"><span style="font-weight: bold;">OBSERVA&Ccedil;&Atilde;O</span></td>
			</tr>
<?php 
		
/*		$sql = "select pf.nome as nome_pf, ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade, pf.cidade, pf.unidade_da_federacao, resp.codigo as cod_responsavel, resp.nome as nome_responsavel
				from  inscricao i, pessoa_fisica pf LEFT OUTER JOIN pessoa_fisica resp ON (pf.responsavel = resp.codigo), ocorrencia x
				where pf.codigo = i.pessoa_fisica
					and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
					and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
					and i.ocorrencia = x.codigo
					and i.evento = x.evento	
					and ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) < 12
					order by pf.nome";*/

$sql = "select pf.nome as nome_pf,
		((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade,
		pf.cidade, 
		pf.unidade_da_federacao, 
		resp.codigo as cod_responsavel, 
		resp.nome as nome_responsavel, 
		part.doenca, 
		part.medicamento, 
		part.observacao 
				from  inscricao i
				LEFT JOIN pessoa_fisica pf ON pf.codigo = i.pessoa_fisica
				LEFT JOIN ocorrencia x ON i.ocorrencia = x.codigo and i.evento = x.evento
				LEFT JOIN particularidade part ON part.pessoa_fisica = pf.codigo
				LEFT JOIN pessoa_fisica resp ON (pf.responsavel = resp.codigo)
				where i.evento = ".$_SESSION["EVENTO_SESSION"]." 
					and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
					and ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) < 12									
					order by pf.nome";	
									
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			for ($i = 0; $i < $linhas; $i++) {
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
							and a.evento = p.evento 
							and a.ocorrencia = p.ocorrencia 
							and a.codigo = p.sub_ocorrencia 
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
						 
						 if ($responsavel != "") {
							 $sqlTel = "select b.ddd, b.numero as telefone from pessoa_fisica_telefone a, telefone b
									where a.pessoa_fisica = ".$responsavel." 
									and a.ddd = b.ddd 
									and a.numero = b.numero";
						 }
					}
				
				?>
						<tr bgcolor="<?php echo $bgcolor; ?>">
							<td height="30"><?php echo mysql_result($resultado, $i, "nome_pf"); ?></td>
							<td height="30"><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"); ?></td>
							<td height="30" align="center"><?php echo mysql_result($resultado, $i, "idade"); ?></td>
							<td height="30"  ><?php echo mysql_result($resultado, $i, "nome_responsavel"); ?></td>
							<td height="30" ><?php echo $cursosResponsavel; ?></td>
							<td height="30" align="center"><?php echo $telefones; ?></td>
							<td height="30" align="center"><?php echo mysql_result($resultado, $i, "doenca"); ?></td>
							<td height="30" align="center"><?php echo mysql_result($resultado, $i, "medicamento"); ?></td>
							<td height="30" align="center"><?php echo mysql_result($resultado, $i, "observacao"); ?></td> 
						</tr>
					<?php
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="9">
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
