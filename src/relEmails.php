<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
  
  <?php 
		
		$sql = "select a.nro_inscricao, b.codigo as codigo, b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao as data, c.pago, count(participantes.inscricao) as cursos
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
				group by a.nro_inscricao, b.codigo , b.nome, b.sexo, b.rua_ou_quadra, b.complemento_ou_conjunto, b.bairro, b.cep, b.data_nasc, b.unidade_da_federacao, b.cidade, b.pais, b.email, b.numero, a.data_insercao, c.pago
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
				 
				?>
                
                <?php echo mysql_result($resultado, $i, "email")."<br>"; ?>
                
                <?php
			}
		}

?>
			
	
	
	</td>
</tr>
</tbody></table>
<?php

include("footerRel.php");

?>
