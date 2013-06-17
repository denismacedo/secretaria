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
			<td colspan="7" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE INSCRITOS SEM CURSO</span></td>
		</tr>
  <tr>
  	<td colspan="7" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" align="center" class="labelColRel" width="5%"><span style="font-weight: bold;">COD. PF</span></td>
			<td height="30" class="labelColRel" width="40%"><span style="font-weight: bold;">NOME</span></td>
			<td height="30" class="labelColRel" width="5%"><span style="font-weight: bold;">IDADE</span></td>
			<td height="30" class="labelColRel" width="15%"><span style="font-weight: bold;">CIDADE</span></td>
			<td height="30" class="labelColRel" width="15%"><span style="font-weight: bold;">E-MAIL</span></td>
			<td height="30" class="labelColRel" width="15%"><span style="font-weight: bold;">TELEFONE</span></td>
			<td height="30" class="labelColRel" width="5%"><span style="font-weight: bold;">INSCRI&Ccedil;&Atilde;O</span></td>
			</tr>
 
  <?php 
		
		$sql = "select p.codigo, p.nome,p.cidade, p.unidade_da_federacao, p.email, i.codigo, i.nro_inscricao, count(pa.inscricao)
				from pessoa_fisica p, inscricao i LEFT OUTER JOIN participante pa ON ( i.codigo = pa.inscricao ) LEFT OUTER JOIN evento e ON (pa.evento = e.codigo and e.tipo_evento = 1)
				where p.codigo = i.pessoa_fisica 
				and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
				and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
				group by p.codigo, p.nome,p.cidade, p.unidade_da_federacao, p.email, i.codigo, i.nro_inscricao
				 having count(pa.inscricao) = 0
				order by p.nome, p.cidade, p.unidade_da_federacao, p.email";
				
	//echo $sql;
	
	$sql = "select pf.codigo, pf.nome,pf.cidade, pf.unidade_da_federacao, pf.email, i.codigo, i.nro_inscricao, ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade
from pessoa_fisica pf, inscricao i, ocorrencia x
where pf.codigo = i.pessoa_fisica
and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." and i.evento= ".$_SESSION["EVENTO_SESSION"]."
and i.evento = x.evento
and i.ocorrencia = x.codigo
and i.codigo not in 
(select pa.inscricao 
	from participante pa, sub_ocorrencia sub, ocorrencia oco, evento evt 
	where pa.sub_ocorrencia = sub.codigo
	and pa.ocorrencia = sub.ocorrencia
	and pa.evento = sub.evento
	and sub.ocorrencia = oco.codigo
	and sub.evento = oco.evento
	and oco.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]."  
	and oco.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
	and oco.evento = evt.codigo
	and evt.tipo_evento = 1)
order by pf.nome, pf.cidade";
	
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$eventoOcorrencia = "";
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
				
				?>					
				<tr bgcolor="<?php echo $bgcolor; ?>">
				<td align="center" style="color:#000099;"><b><?php echo formatNumber(mysql_result($resultado, $i, "codigo"), 4); ?></b></td>
							<td><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td align="center"><?php echo mysql_result($resultado, $i, "idade"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "email"); ?></td>
							<td align="center"><?php echo $telefones; ?></td>
							<td align="center"><b><?php echo formatNumber(mysql_result($resultado, $i, "nro_inscricao"), 4); ?></b></td>
				</tr>
		<?php
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="7">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="30">
									<span style="font-weight: bold;">TOTAL DE INSCRITOS SEM CURSO: &nbsp; <?php echo $linhas; ?></span>								</td>
								
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
