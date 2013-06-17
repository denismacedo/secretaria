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
			<td colspan="9" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE INSCRITOS EM TEMA ESPEC&Iacute;FICO</span></td>
		</tr>
  <tr>
  	<td colspan="9" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">NOME</span></td>
			<td height="30" class="labelColRel" width="250px"><span style="font-weight: bold; font-size: 11px">CIDADE</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">TEMA ESPECIFICO</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">BLOCO - SALA</span></td>
			</tr>
  <?php 
  
  	$sql ="select pes.nome, pes.cidade, pes.unidade_da_federacao, pes.pais, sub.nome as nome_curso, sub.numero_bloco, sub.numero_sala
from pessoa_fisica pes, inscricao insc, participante pa, sub_ocorrencia sub, ocorrencia oco, evento eve
where pes.codigo = insc.pessoa_fisica
and insc.codigo = pa.inscricao
and pa.evento = sub.evento
and pa.ocorrencia = sub.ocorrencia
and pa.sub_ocorrencia = sub.codigo
and sub.ocorrencia = oco.codigo
and sub.evento = oco.evento
and oco.evento = eve.codigo
and eve.tipo_evento = 1
and eve.qualif_evento = 1
and insc.evento = ".$_SESSION["EVENTO_SESSION"]."
and insc.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."
order by pes.nome";
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			
			for ($i = 0; $i < $linhas; $i++) {
			
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#F6F6F6";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="30">
							<td width="250"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao")." - ".mysql_result($resultado, $i, "pais"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "nome_curso"); ?></td>
                            <td><?php echo mysql_result($resultado, $i, "numero_bloco")." - ".mysql_result($resultado, $i, "numero_sala"); ?></td>
						</tr>
					<?php
				
			}
		}

?>
	</tbody></table>
	
	
	</td>
</tr>
</tbody></table>
<?php

include("footerRel.php");

?>
