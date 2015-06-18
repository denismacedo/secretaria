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
			<td colspan="9" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE TODAS INSCRI&Ccedil;&Otilde;ES PAGAS </span></td>
		</tr>
  <tr>
  	<td colspan="8" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" class="labelColRel"><span style="font-weight: bold;">NOME</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">CIDADE</span></td>
			<td height="30" class="labelColRel">UF</td>
			<td height="30" class="labelColRel">País</td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">E-MAIL</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">TELEFONES</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">INSCRI&Ccedil;&Atilde;O</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">VALOR PAG.</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">DATA PAG.</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">Centro</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">Comissão</span></td>            
			</tr>

  
  <?php 
		
		/*$sql = "Select a.nro_inscricao, b.codigo as codigo, b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao as data, c.valor_pago, c.data_pago, e.nome as nome_pj, f.nome as comissao 
		From inscricao a, pessoa_fisica b, boleto c, origem d, pessoa_juridica e, ocorrencia f, sub_ocorrencia g, participante h, evento i 
		Where a.evento = ".$_SESSION["EVENTO_SESSION"]." 
				and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo 
				and a.codigo = c.inscricao
				and c.pago = 'S'
				and b.codigo = d.pessoa_fisica
				and d.pessoa_juridica = e.codigo
				
				and g.ocorrencia = f.codigo 
				and g.evento = f.evento 

				and f.evento = i.codigo 
				and i.tipo_evento = 8
				and g.evento = h.evento 
				and g.ocorrencia = h.ocorrencia 
				and g.codigo = h.sub_ocorrencia 
				and h.inscricao = a.codigo
				and h.inscricao = c.inscricao
				
				Order by b.nome";*/
		
		$sql = "Select a.nro_inscricao, b.codigo as codigo, b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao as data, c.valor_pago, c.data_pago, e.nome as nome_pj, f.nome as comissao 
		From inscricao a, pessoa_fisica b, boleto c, origem d, pessoa_juridica e, ocorrencia f, sub_ocorrencia g, participante h, evento i 
		Where a.evento = ".$_SESSION["EVENTO_SESSION"]." 
				and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo 
				and a.codigo = c.inscricao
				and c.pago = 'S'
				and b.codigo = d.pessoa_fisica
				and d.pessoa_juridica = e.codigo
				
				and g.ocorrencia = f.codigo 
				and g.evento = f.evento 

				and f.evento = i.codigo 
				
				and g.evento = h.evento 
				and g.ocorrencia = h.ocorrencia 
				and g.codigo = h.sub_ocorrencia 
				and h.inscricao = a.codigo
				and h.inscricao = c.inscricao
				Group by b.codigo
				
				Order by b.nome";
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$pessoa = "";
			$totalPago = 0;
			$numInscricoesPagas = 0;
			for ($i = 0; $i < $linhas; $i++) {
			
				 $pessoaAtual = mysql_result($resultado, $i, "codigo");
				 
				 $sqlTel = "select b.ddd, b.numero as telefone from pessoa_fisica_telefone a, telefone b
							where a.pessoa_fisica = ".$pessoaAtual." 
							and a.ddd = b.ddd 
							and a.numero = b.numero";
				 $resultadoTel = mysql_query($sqlTel);
				 
				 $telefones = "";
				 for ($j = 0; $j < mysql_num_rows($resultadoTel); $j++) {
					$telefones .= "(".mysql_result($resultadoTel, $j, "ddd").")".mysql_result($resultadoTel, $j, "telefone")."<br>";
				 
				 }
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#e0e0e0";
					} else {
						$bgcolor = "#FFFFFF";
					}
					
					$totalPago += mysql_result($resultado, $i, "valor_pago");
					if ( mysql_result($resultado, $i, "valor_pago") > 0) {
						$numInscricoesPagas++;
					}
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="30">
							<td width="250"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "cidade");?></td>
							<td><?php echo mysql_result($resultado, $i, "unidade_da_federacao");?></td>
							<td><?php echo mysql_result($resultado, $i, "pais"); ?></td>
                            
							<td><?php echo strtolower(mysql_result($resultado, $i, "email")); ?></td>
							<td align="center"><?php echo $telefones; ?></td>
							<td align="center"><b><?php echo formatNumber(mysql_result($resultado, $i, "nro_inscricao"), 4); ?></b></td>
							<td align="center"><?php echo number_format(mysql_result($resultado, $i, "valor_pago"), 2, ',', '.'); ?></td>
							<td align="center"><?php echo formatDate(mysql_result($resultado, $i, "data_pago")); ?></td>
							<td align="left"><?php echo mysql_result($resultado, $i, "nome_pj"); ?></td>
							<td align="left"><?php echo mysql_result($resultado, $i, "comissao"); ?></td>                         
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
									<span style="font-weight: bold;">TOTAL DE INSCRI&Ccedil;&Otilde;ES PAGAS: &nbsp; <?php echo $numInscricoesPagas; ?></span>								</td>
									<td class="labelColRel" align="RIGHT" height="5">
										<span style="font-weight: bold;">VALOR TOTAL PAGO: &nbsp; <?php echo number_format($totalPago, 2, ',', '.'); ?></span>								</td>
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
