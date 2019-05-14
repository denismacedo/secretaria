<?php

include("headerRel.php");

?>
</tr><tr>
	<td>
	<table align="center" width="700">
		<tbody><tr>
		  <td width="10%" height="30" align="center" class="labelTitRel">
		  	<?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?>		  </td>
	    </tr>
		<tr>
			<td class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">DADOS DO EVENTO </span></td>
		</tr>
  <tr>
  	<td align="center">
  		<p><img src="imagens/barra_rel.jpg">		  </p>
		
		<?php
		
			// SELECIONA A QUANTIDADE DE CRIANCAS
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) < 12";
			
			$resultado = mysql_query($sql);
			
			$numCriancas = mysql_result($resultado, 0, 0);
			
			
			
			// SELECIONA A QUANTIDADE DE JOVENS
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 12 
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) < 14";
			
			$resultado = mysql_query($sql);
			
			$numJovens = mysql_result($resultado, 0, 0);
			
			
			// SELECIONA A QUANTIDADE DE ADULTOS
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 14";
			
			$resultado = mysql_query($sql);
			
			$numAdultos = mysql_result($resultado, 0, 0);
			
			// SELECIONA A QUANTIDADE DE HOMENS
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 12
			and p.sexo = 'M'";
			
			$resultado = mysql_query($sql);
			
			$numHomens = mysql_result($resultado, 0, 0);
			
			
			// SELECIONA A QUANTIDADE DE HOMENS EM ALOJAMENTO
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 12
			and p.sexo = 'M' and i.tipo_alojamento = 1";
			
			$resultado = mysql_query($sql);
			
			
			$numHomensAlojamento = mysql_result($resultado, 0, 0);
			
			
			// SELECIONA A QUANTIDADE DE MULHERES
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 12
			and p.sexo = 'F'";
			
			$resultado = mysql_query($sql);
			
			$numMulheres = mysql_result($resultado, 0, 0);

		// SELECIONA A QUANTIDADE DE MULHERES EM ALOJAMENTO
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and ((YEAR(o.inicio)-YEAR(data_nasc)) - (RIGHT(o.inicio,5)<RIGHT(data_nasc,5))) >= 12
			and p.sexo = 'F' and i.tipo_alojamento = 1";
			
			$resultado = mysql_query($sql);
			
			$numMulheresAlojamento = mysql_result($resultado, 0, 0);			
			
			// SELECIONA A QUANTIDADE DE VEGETARIANOS
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo
			and p.vegetariano = 'S'";
			
			$resultado = mysql_query($sql);
			
			$numVegetarianos = mysql_result($resultado, 0, 0);			
			
			
			// SELECIONA TOTAL CIDADES
			$sql = "select count(DISTINCT p.cidade, p.unidade_da_federacao, p.pais)
			from inscricao i, pessoa_fisica p
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"];
			
			$resultado = mysql_query($sql);
			
			$numCidades = mysql_result($resultado, 0, 0);
			
			
			// SELECIONA TOTAL ESTADOS
			$sql = "select count(DISTINCT p.unidade_da_federacao, p.pais)
			from inscricao i, pessoa_fisica p
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"];
			
			$resultado = mysql_query($sql);
			
			$numEstados = mysql_result($resultado, 0, 0);
			
			// SELECIONA TOTAL PAISES
			$sql = "select count(DISTINCT p.pais)
			from inscricao i, pessoa_fisica p
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"];
			
			$resultado = mysql_query($sql);
			
			$numPais = mysql_result($resultado, 0, 0);
			
			// SELECIONA TOTAL PAISES
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."
			and p.pais <> 'BR'";
			
			$resultado = mysql_query($sql);
			
			$numEstrangeiros = mysql_result($resultado, 0, 0);
			
			
			// SELECIONA ULTIMA DATA DE INSCRICAO
			$sql = "select i.data_insercao
					from inscricao i
					where i.evento = ".$_SESSION["EVENTO_SESSION"]." 
					and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."
					and i.codigo = (select max(codigo) from inscricao
					where evento = ".$_SESSION["EVENTO_SESSION"]."
					and ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"].")";
			
			$resultado = mysql_query($sql);

			if (mysql_num_rows($resultado) > 0) {
				$ultimaInscricao = formatDate(mysql_result($resultado, 0, 0));
			}
			
			// SELECIONA TOTAL DE PRESENCAS CONFIRMADAS
			$sql = "select count(1)
			from inscricao i
			where i.flag_presente = 'S'
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"];
			
			$resultado = mysql_query($sql);
			
			$numPresentes = mysql_result($resultado, 0, 0);
			
			$sql = "select count(i.codigo)
			from inscricao i, pessoa_fisica p, ocorrencia o
			where i.pessoa_fisica = p.codigo
			and i.evento = ".$_SESSION["EVENTO_SESSION"]." 
			and i.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]."  
			and i.evento = o.evento
			and i.ocorrencia = o.codigo";
			
			$resultado = mysql_query($sql);
			
			$totalInscritos = mysql_result($resultado, 0, 0);
		
		//$totalInscritos = $numCriancas + $numJovens + $numAdultos;
		
		
		?>
		
  		<table width="510" cellpadding="4" cellspacing="2">
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> TOTAL DE INSCRITOS:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 14px"><b> <?php echo formatNumber($totalInscritos, 4); ?> </b></span></td>
          </tr>
  		  <tr>
  		    <td width="313" height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px">QTDE DE CRIAN&Ccedil;AS:</span></td>
  		    <td width="173" height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <b><?php echo formatNumber($numCriancas, 4); ?></b>&nbsp; (<?php if ($totalInscritos>0) echo number_format(($numCriancas / $totalInscritos ) * 100, 2)."%"; ?>)</span></td>
		    </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE JOVENS (12 e 13 anos):</span></td>
           <td width="173" height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <b><?php echo formatNumber($numJovens, 4); ?></b>&nbsp; (<?php if ($totalInscritos>0) echo number_format(($numJovens / $totalInscritos ) * 100, 2)."%"; ?>)</span></td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE ADULTOS:</span></td>
             <td width="173" height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <b><?php echo formatNumber($numAdultos, 4); ?></b>&nbsp; (<?php if ($totalInscritos>0) echo number_format(($numAdultos / $totalInscritos ) * 100, 2)."%"; ?>)</span></td>
          </tr>
		  <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE MULHERES (incluindo jovens de 12 e 13 anos): </span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numMulheres, 4); ?> </span></td>
          </tr>
		  <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE MULHERES EM ALOJAMENTO: </span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numMulheresAlojamento, 4); ?> </span></td>
          </tr>
		  <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE HOMENS (incluindo jovens de 12 e 13 anos):</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numHomens, 4); ?> </span></td>
          </tr>
		  <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE HOMENS EM ALOJAMENTO: </span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numHomensAlojamento, 4); ?> </span></td>
          </tr>
		  <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE VEGETARIANOS: </span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numVegetarianos, 4); ?> </span></td>
          </tr>

          <!--<tr>
            <td height="30" bgcolor="#e0e0e0"><span style="font-weight: bold; font-size: 12px"> INSCRITOS SEM CURSO </span></td>
            <td height="30" align="center" bgcolor="#f6f6f6"><span style="font-size: 12px">  <?php //echo formatNumber($numInscritosSemCurso, 4); ?>  </span></td>
          </tr>-->
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px">TOTAL DE PRESENTES:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numPresentes, 4); ?> </td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE CIDADES:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numCidades, 3); ?> </span></td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE ESTADOS:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px">  <?php echo formatNumber($numEstados, 2); ?> </span></td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE PAISES:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numPais, 2); ?> </span></td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px"> QTDE DE ESTRANGEIROS:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"> <?php echo formatNumber($numEstrangeiros, 3); ?> </span></td>
          </tr>
          <tr>
            <td height="30" align="left" bgcolor="#cccccc"><span style="font-weight: bold; font-size: 12px">&Uacute;LTIMA INSCRI&Ccedil;&Atilde;O:</span></td>
            <td height="30" align="right" bgcolor="#e0e0e0"><span style="font-size: 12px"><?php echo $ultimaInscricao; ?> </span></td>
          </tr>
         <!-- <tr>
            <td height="30" bgcolor="#e0e0e0"><span style="font-weight: bold; font-size: 12px"> BOLETOS PAGOS </span></td>
            <td height="30" align="center" bgcolor="#f6f6f6"><span style="font-size: 12px"> 0 </span></td>
          </tr> -->
		  </table>
  		<p>&nbsp;</p>
  		<p>&nbsp;    </p></td>
  </tr>

  
  <?php 
	
		$sql = "select pais.nome as pais, estado.nome as estado, cidade.nome as cidade, count(insc.codigo) as inscritos
				from cidade cidade, estado estado, pais pais, pessoa_fisica pf, inscricao insc
				where cidade.unidade_da_federacao = estado.sigla 
				AND estado.pais = pais.sigla and cidade.pais = pf.pais AND cidade.unidade_da_federacao = pf.unidade_da_federacao AND cidade.nome = pf.cidade
				 AND pf.codigo = insc.pessoa_fisica AND insc.evento = ".$_SESSION["EVENTO_SESSION"]." AND insc.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				group by pais.nome, estado.nome, cidade.nome
				order by pais.nome, estado.nome, cidade.nome";
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			for ($i = 0; $i < $linhas; $i++) {
			
				$cor = !$cor;
				
				if ($cor) {
					$bgcolor = "#F9F9F9";
				} else {
					$bgcolor = "#FFFFFF";
				}
			
				
				?>
				
				<?php
				
				$totalPart += mysql_result($resultado, $i, "inscritos");
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
