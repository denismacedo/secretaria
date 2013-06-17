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
			<td colspan="8" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">N&Uacute;MERO  DE INSCRI&Ccedil;&Otilde;ES E VAGAS POR CURSO </span></td>
		</tr>
  <tr>
  	<td colspan="8" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" class="labelColRel" width="70%"><span style="font-weight: bold;; font-size: 11px">CURSO</span></td>
			<td height="30" class="labelColRel" width="10%"><span style="font-weight: bold;; font-size: 11px">CAPACIDADE</span></td>
			<td height="30" class="labelColRel" width="10%"><span style="font-weight: bold;; font-size: 11px">INSCRITOS</span></td>
			<td height="30" class="labelColRel" width="10%"><span style="font-weight: bold;; font-size: 11px">VAGAS</span></td>
			</tr>

  
  <?php 
		
		$sql = "select a.nome, a.capacidade, count(c.inscricao) as inscritos, a.capacidade - count(c.inscricao) as vagas from sub_ocorrencia a LEFT OUTER JOIN participante c ON (a.evento= c.evento and a.ocorrencia= c.ocorrencia and a.codigo = c.sub_ocorrencia), ocorrencia b, evento e
where a.evento = b.evento
and a.ocorrencia = b.codigo
and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]."
and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]."
and b.evento = e.codigo
and e.tipo_evento = 1
group by a.nome, a.capacidade
order by nome";
		
		
		$resultado = mysql_query($sql);
		
		$totalCap = 0;
		$totalInsc = 0;
		$totalVag = 0;
		
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
							<td><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td align="center"><?php echo formatNumber(mysql_result($resultado, $i, "capacidade"), 4); ?></td>
							<td align="center"><?php echo formatNumber(mysql_result($resultado, $i, "inscritos"), 4); ?></td>
							<td align="center"><?php echo formatNumber(mysql_result($resultado, $i, "vagas"), 4); ?></td>
						</tr>
					<?php
					
					$totalCap += mysql_result($resultado, $i, "capacidade");
					$totalInsc += mysql_result($resultado, $i, "inscritos");
					$totalVag += mysql_result($resultado, $i, "vagas");
				
			}
		}

?>
			
			<tr bgcolor="#cccccc" height="30">
							<td><b>&nbsp;TOTAIS</b></td>
							<td align="center"><b><?php echo formatNumber($totalCap, 4); ?></b></td>
							<td align="center"><b><?php echo formatNumber($totalInsc, 4); ?></b></td>
							<td align="center"><b><?php echo formatNumber($totalVag, 4); ?></b></td>
			</tr>
	</tbody></table>
	
	
	</td>
</tr>
</tbody></table>
<?php

include("footerRel.php");

?>
