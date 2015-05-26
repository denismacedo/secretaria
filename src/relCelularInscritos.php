<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="6" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="9" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O CELULARES e EMAILS DOS INSCRITOS</span></td>
		</tr>
  <tr>
  	<td colspan="6" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">NOME</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">PRIMEIRO NOME</span></td>
			<td height="30" class="labelColRel" width="10%" align="center"><span style="font-weight: bold; font-size: 11px">DDD</span></td>
			<td height="30" class="labelColRel" width="10%" align="center"><span style="font-weight: bold; font-size: 11px">CELULAR</span></td>
			<td height="30" class="labelColRel" width="250px"><span style="font-weight: bold; font-size: 11px">CIDADE</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">E-MAIL</span></td>
			</tr>

  
  <?php 
  
  $sql = "select b.nome,substring_index(ltrim(b.nome), ' ', 1) as primeiro_nome, t.ddd, t.numero, b.cidade, b.unidade_da_federacao, b.email
from inscricao a, ocorrencia x, pessoa_fisica b, pessoa_fisica_telefone ft, telefone t
							where ft.pessoa_fisica = b.codigo
							and ft.ddd = t.ddd 
							and ft.numero = t.numero
							and substr(t.numero, 1, 1) in (9,8,7)
				and a.evento = ".$_SESSION["EVENTO_SESSION"]."  and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo
				and a.ocorrencia = x.codigo
				and a.evento = x.evento
				and ((YEAR(x.inicio)-YEAR(b.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(b.data_nasc,5))) > 12
				order by b.nome";
  
  
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
							<td width="150"><b>&nbsp;<?php echo mysql_result($resultado, $i, "primeiro_nome"); ?></b></td>
							<td align="center"><?php echo mysql_result($resultado, $i, "ddd"); ?></td>
							<td align="center"><?php echo mysql_result($resultado, $i, "numero") ?></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "email"); ?></td>
						</tr>
					<?php
				
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="6">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL: &nbsp; <?php echo $linhas; ?></span>								</td>
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
