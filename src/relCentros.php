<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="8" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="8" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE CENTROS ESP&Iacute;RITAS PARTICIPANTES DO EVENTO </span></td>
		</tr>
  <tr>
  	<td colspan="8" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td width="5%" height="30" align="center" class="labelColRel"><span style="font-weight: bold;; font-size: 11px">COD. PJ</span></td>
			<td height="30" class="labelColRel" width="30%"><span style="font-weight: bold;; font-size: 11px">NOME</span></td>
			<td height="30" class="labelColRel" width="30%"><span style="font-weight: bold;; font-size: 11px">ENDERE&Ccedil;O</span></td>
			<td height="30" class="labelColRel" width="25%"><span style="font-weight: bold;; font-size: 11px">CIDADE</span></td>
			<td width="5%" height="30" align="center" class="labelColRel"><span style="font-weight: bold;; font-size: 11px">POSSUI CFAS</span></td>
			<td height="30" class="labelColRel" width="5%"><span style="font-weight: bold;; font-size: 11px">PARTICIPANTES</span></td>
			</tr>

  
  <?php 
		
		$sql = "select d.codigo, d.nome, d.rua_ou_quadra, d.numero, d.bairro, d.cep, d.cidade, d.unidade_da_federacao, d.pais, d.possui_cfas, count(a.codigo) as participantes
from pessoa_fisica a, inscricao b, origem c, pessoa_juridica d
where a.codigo = b.pessoa_fisica
and b.evento= ".$_SESSION["EVENTO_SESSION"]."  and b.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
and a.codigo = c.pessoa_fisica
and c.pessoa_juridica = d.codigo
and d.tipo_pj = 1
group by d.codigo, d.nome, d.rua_ou_quadra, d.numero, d.bairro, d.cep, d.cidade, d.unidade_da_federacao, d.pais, d.possui_cfas
order by d.nome";
		
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$pessoa = "";
			for ($i = 0; $i < $linhas; $i++) {
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#F6F6F6";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="30">
							<td align="center" style="color:#000099;"><b><?php echo formatNumber(mysql_result($resultado, $i, "codigo"), 4); ?></b></td>
							<td><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "rua_ou_quadra")." - ".mysql_result($resultado, $i, "numero")." - ".mysql_result($resultado, $i, "bairro")." - ".mysql_result($resultado, $i, "cep"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao")." - ".mysql_result($resultado, $i, "pais"); ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "possui_cfas") == 'S') { echo "<span style='color:#009900;font-weight:bold;'>SIM</span>"; } else { echo "<span style='color:#990000'>N&Atilde;O</span>";} ?></td>
							<td align="center"><b><?php echo formatNumber(mysql_result($resultado, $i, "participantes"), 4); ?></b></td>
						</tr>
					<?php
				
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="8">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL DE CENTROS ESP&Iacute;RITAS: &nbsp; <?php echo $linhas; ?></span>								</td>
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
