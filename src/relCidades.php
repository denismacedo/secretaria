<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="3" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>
		  </td>
	    </tr>
		<tr>
			<td colspan="3" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O DE CIDADES PARTICIPANTES </span></td>
		</tr>
  <tr>
  	<td colspan="3" align="center">
  		<img src="imagens/barra_rel.jpg">
  	</td>
  </tr><tr>
		
		</tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" width="20%" class="labelColRel"><span style="font-weight: bold;"> ESTADO <a href="doRelatorio.php?method=cidades&sortBy=f3" title="Ordenar"><img src="imagens/ordenar.png" alt="Ordenar" width="11" height="10" border="0" align="absmiddle"></a></span></td>
			<td width="40%" height="30" class="labelColRel"><span style="font-weight: bold;"> CIDADE <a href="doRelatorio.php?method=cidades&sortBy=f1" title="Ordenar"><img src="imagens/ordenar.png" alt="Ordenar" width="11" height="10" border="0" align="absmiddle"></a></span></td>
			<td class="labelColRel" width="14%"><span style="font-weight: bold;"> PARTICIPANTES <a href="doRelatorio.php?method=cidades&sortBy=f2" title="Ordenar"><img src="imagens/ordenar.png" alt="Ordenar" width="11" height="10" border="0" align="absmiddle"></a></span></td>
		</tr>

  
  <?php 
		 if (strtoupper(getPost("sortBy")) == "F3") {
			$sortBy = "order by estado.nome asc, cidade.nome, pais.nome";
   		} else if (strtoupper(getPost("sortBy")) == "F2") {
			$sortBy = "order by inscritos desc";
		} else {
			$sortBy = "order by cidade.nome, estado.nome, pais.nome";
		}
	
		$sql = "select cidade.nome as cidade, estado.nome as estado, pais.nome as pais, count(insc.codigo) as inscritos
				from cidade cidade, estado estado, pais pais, pessoa_fisica pf, inscricao insc
				where cidade.unidade_da_federacao = estado.sigla 
				AND estado.pais = pais.sigla and cidade.pais = pf.pais AND cidade.unidade_da_federacao = pf.unidade_da_federacao AND cidade.nome = pf.cidade
				 AND pf.codigo = insc.pessoa_fisica AND insc.evento = ".$_SESSION["EVENTO_SESSION"]." AND insc.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				group by estado.nome, cidade.nome, pais.nome ".$sortBy;
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$totalEstado = 0;
			$estadoAtual = "";
			for ($i = 0; $i < $linhas; $i++) {
				$totalEstado++;
				$cor = !$cor;
				
				if ($cor) {
					$bgcolor = "#f0f0f0";
				} else {
					$bgcolor = "#FFFFFF";
				}
			
				?>
				
					<tr bgcolor="<?php echo $bgcolor; ?>">
						<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "estado"); ?></td>
						<td height="30">&nbsp;<?php echo mysql_result($resultado, $i, "cidade"); ?></td>
						<td style="font-size: 14px;" align="right"><b><?php echo mysql_result($resultado, $i, "inscritos"); ?>&nbsp;&nbsp;</b></td>
					</tr>
				
						<?php
				$totalPart += mysql_result($resultado, $i, "inscritos");
			}
		}

?>
				<tr bgcolor="#cccccc">
					<td colspan="3">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="35">
									<span style="font-weight: bold;">TOTAL DE CIDADES: &nbsp; <?php echo $linhas; ?></span>
								</td>
								<td class="labelColRel" align="right" height="35">
									<span style="font-weight: bold;">TOTAL DE PARTICIPANTES: &nbsp; <?php echo $totalPart; ?></span>
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
