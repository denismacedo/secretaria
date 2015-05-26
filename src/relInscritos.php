<?php

include("headerRel.php");

$sql = "SELECT tipo_evento FROM evento where codigo = ".$_SESSION["EVENTO_SESSION"];
$resultado = mysql_query($sql);
$tipoEvento = mysql_result($resultado, 0, "tipo_evento");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="15" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="15" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE TODAS INSCRI&Ccedil;&Otilde;ES</span></td>
		</tr>
  <tr>
  	<td colspan="15" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td width="2" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">COD. PF.</span></td>
			<td width="250" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">NOME</span></td>
			<td width="80" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">CIDADE</span></td>
			<td width="2" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">UF</span></td>
			<td width="2" height="2" class="labelColRel"><span style="font-weight: bold; font-size: 11px">PAÍS</span></td>
			<td width="80" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">E-MAIL</span></td>
			<td height="30" class="labelColRel" width="10%" align="center"><span style="font-weight: bold; font-size: 11px">TELEFONES</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">NRO INSCRI&Ccedil;&Atilde;O</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">DATA INSCRI&Ccedil;&Atilde;O</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">PAGO</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">ESCOLHEU CURSO</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">ALOJAMENTO NO EVENTO</span></td>
			<?php if ($tipoEvento == 11) { ?>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">IDIOMA TEMA CENTRAL</span></td>
			<?php } ?>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">VEGETARIANO</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">PROFISSAO</span></td>
			</tr>

  
  <?php 
		
		$sql = "select a.nro_inscricao, b.codigo as codigo, b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao as data, c.pago, count(participantes.inscricao) as cursos, a.tipo_alojamento, b.vegetariano, b.profissao, a.idioma_tema_central
		 from inscricao a LEFT OUTER JOIN boleto c ON (a.codigo = c.inscricao) LEFT OUTER JOIN (select pa.inscricao 
	from participante pa, sub_ocorrencia sub, ocorrencia oco, evento evt 
	where pa.sub_ocorrencia = sub.codigo
	and pa.ocorrencia = sub.ocorrencia
	and pa.evento = sub.evento
	and sub.ocorrencia = oco.codigo
	and sub.evento = oco.evento
	and oco.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]."  
	and oco.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
	and oco.evento = evt.codigo
	and evt.tipo_evento = 1) as participantes ON (participantes.inscricao = a.codigo)
	, pessoa_fisica b		
				where a.evento = ".$_SESSION["EVENTO_SESSION"]." and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo
				:dataIni :dataFim
				group by a.nro_inscricao, b.codigo , b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao, c.pago, a.tipo_alojamento
				order by b.nome";
		
		if (getPost("dataIni") != "") {
			$sql = str_replace(":dataIni", " AND a.data_insercao >= '".getDBDate(getPost("dataIni"))."' ", $sql);
		} else {
			$sql = str_replace(":dataIni", "", $sql);
		}
		if (getPost("dataFim") != "") {
			$sql = str_replace(":dataFim", " AND a.data_insercao <= '".getDBDate(getPost("dataFim"))."' ", $sql);
		} else {
			$sql = str_replace(":dataFim", "", $sql);
		}
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$pessoa = "";
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
						$bgcolor = "#F6F6F6";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="30">
							<td width="2" align="center" style="color:#000099;"><b><?php echo formatNumber(mysql_result($resultado, $i, "codigo"), 4); ?></b></td>
							<td width="250"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "cidade");?>
							
							</td>
							<td><?php echo mysql_result($resultado, $i, "unidade_da_federacao");?></td>
							<td height="2"><?php echo mysql_result($resultado, $i, "pais"); ?></td>
							<td><?php echo strtolower(mysql_result($resultado, $i, "email")); ?></td>
							<td align="center"><?php echo $telefones; ?></td>
							<td align="center"><b><?php echo formatNumber(mysql_result($resultado, $i, "nro_inscricao"), 4); ?></b></td>
							<td align="center"><?php echo formatDate(mysql_result($resultado, $i, "data")); ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "pago") == 'S') { echo "<span style='color:#009900;font-weight:bold;'>SIM</span>"; } else { echo "<span style='color:#CC0000'>N&Atilde;O</span>";} ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "cursos") > 0) { echo "<span style='color:#009900;font-weight:bold;'>SIM</span>"; } else { echo "<span style='color:#cc0000'>N&Atilde;O</span>";} ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "tipo_alojamento") == '1') { echo "<span style='color:#009900;font-weight:bold;'>SIM</span>"; } else { echo "<span style='color:#CC0000'>N&Atilde;O</span>";} ?></td>
							
							<?php if ($tipoEvento == 11) { ?>
							<td align="center"><?php echo mysql_result($resultado, $i, "idioma_tema_central"); ?></td>
							<?php } ?>

							
							<td align="center"><?php if (mysql_result($resultado, $i, "vegetariano") == 'S') { echo "<span style='color:#009900;font-weight:bold;'>SIM</span>"; } else { echo "<span style='color:#CC0000'>N&Atilde;O</span>";} ?></td>
							<td><?php echo mysql_result($resultado, $i, "profissao");?></td>
						</tr>
					<?php
				
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="15">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL DE INSCRITOS: &nbsp; <?php echo $linhas; ?></span>								</td>
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
