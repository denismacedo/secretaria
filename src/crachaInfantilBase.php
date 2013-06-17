<table cellpadding="0" cellspacing="1" align="center">
	<tr>
		<td align="center" style="font-size: 18px">
			<b><?php echo $objCracha->nomeCracha; ?></b>
		</td>
	</tr>
	<tr>
		<td align="center" style="font-size: 14px">
			<?php echo $objCracha->objPF->cidade."-".$objCracha->objPF->unidade_da_federacao; ?></b>
		</td>
	</tr>
	<tr>
		<td align="center" style="font-size: 9px">
			<?php echo "Responsável: ".$objCracha->responsavel; ?></b>
		</td>
	</tr>
	<tr>
		<td height="5">
		</td>
	</tr>
	<?php
	
		for ($i = 0; $i < sizeof($objCracha->cursos); $i++) {
			echo "<tr><td align='center' style='font-size:9px;'>";
		
			$objCurso = $objCracha->cursos[$i];
		
				echo $objCurso->nome;
				echo "<br>";
				$jaEscreveu = false;
				if ($objCurso->bloco != "" || $objCurso->andar != "" || $objCurso->sala != "") {
					echo "(";
				}
				if ($objCurso->bloco != "") {
					echo "BLOCO ".$objCurso->bloco;
					$jaEscreveu = true;
				}
				if ($objCurso->andar != "") {
					if ($jaEscreveu) {
						echo " - ";
					}
					echo "ANDAR ".$objCurso->andar;
					$jaEscreveu = true;
				}
				if ($objCurso->sala != "") {
					if ($jaEscreveu) {
						echo " - ";
					}
					echo "SALA ".$objCurso->sala;
					$jaEscreveu = true;
				}
				
				if ($jaEscreveu) {
					echo ")";
				}
			}
			
			echo "</td></tr>";
	?>
<tr height="1px">
	<td height="1px"></td>
</tr>
<tr>
	<td align="center">
		<img src="util/geraCB.php?nroInscricao=<?php echo $objCracha->objInscricao->nro_inscricao; ?>" />
	</td>
</tr>
</table>
