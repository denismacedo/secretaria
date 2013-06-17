<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="100%">
		<tbody><tr>
		  <td colspan="5" class="labelTitRel" align="center" height="30">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td colspan="5" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">RELA&Ccedil;&Atilde;O  DE CRACH&Aacute;S IMPRESSOS </span></td>
		</tr>
  <tr>
  	<td colspan="5" align="center">
  		<img src="imagens/barra_rel.jpg">  	</td>
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td height="30" class="labelColRel"><span style="font-weight: bold;">NOME</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">CIDADE</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">E-MAIL</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">TELEFONES</span></td>
			<td height="30" class="labelColRel"><span style="font-weight: bold;">INSCRI&Ccedil;&Atilde;O</span></td>
			</tr>

  
  <?php 
		
		$sql = "select a.nro_inscricao, b.codigo as codigo, b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao as data from inscricao a, pessoa_fisica b
				where a.evento = ".$_SESSION["EVENTO_SESSION"]." and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.cracha_impresso ='S' 
				and a.pessoa_fisica = b.codigo 
				order by b.nome";
		
		
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
							<td width="250"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao")." - ".mysql_result($resultado, $i, "pais"); ?></td>
							<td><?php echo mysql_result($resultado, $i, "email"); ?></td>
							<td align="center"><?php echo $telefones; ?></td>
							<td align="center"><b><?php echo formatNumber(mysql_result($resultado, $i, "nro_inscricao"), 4); ?></b></td>
						</tr>
					<?php
				
			}
		}

?>
			
				<tr bgcolor="#cccccc">
					<td colspan="5">
						<table width="100%">
							<tbody><tr>
								<td class="labelColRel" align="left" height="5">
									<span style="font-weight: bold;">TOTAL DE CRACH&Aacute;S IMPRESSOS: &nbsp; <?php echo $linhas; ?></span>								</td>
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
