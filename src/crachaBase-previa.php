<table cellpadding="0" cellspacing="0" align="left" style="padding-left:100px;">
	<tr>
	
		<td align="left" style="font-size: <?php echo $objCracha->fonte_nome; ?>px">
			<b><?php echo $objCracha->nomeCracha; ?></b>
		</td>
	</tr>
	<tr>
	
		<td align="left">
            <span style="font-size:10px;">
            (<?php echo $objCracha->objPF->cidade."-".$objCracha->objPF->unidade_da_federacao; ?>)
            </span>
		</td>
	</tr>
	<!--tr>
		<td align="left" style="font-size: <?php echo $objCracha->fonte_cidade; ?>px">
			<?php echo $objCracha->objPF->cidade."-".$objCracha->objPF->unidade_da_federacao; ?></b>
		</td>
	</tr-->
	<?php 
		if ($objCracha->tipoInscricao == "INFANTIL") { 
	?>
	<tr>
		<td height="3px">
		</td>
	</tr>
	<tr>
		<td align="left" style="font-size: 9px">
			<?php echo "Responsável: ".$objCracha->responsavel; ?></b>
		</td>
	</tr>
	<?php
	
		}
	
	?>

	<tr>
		<td height="4">
		</td>
	</tr>
	<?php

	
		for ($i = 0; $i < sizeof($objCracha->cursos); $i++) {
			echo "<tr><td align='left' style='font-size:9px;'>";
		
			$objCurso = $objCracha->cursos[$i];
		
			if (strlen($objCurso->nome) <= 20){
				$fontSize = "16px;";
			} else if (strlen($objCurso->nome) > 20 && strlen($objCurso->nome) <= 30){
				$fontSize = "14px;";
			} else {
				$fontSize = "10px;";
			}
			
			if ($objCurso->tipo == "COMISSAO") {
				echo "<b><span style='font-size:".$fontSize."'>".$objCurso->nome."</span></b>";
			} else {
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
		}
	
	?>
<tr height="1px">
	<td height="1px"></td>
</tr>
<tr>
	<td align="center">
		<?php
			if ($objCracha->tipoInscricao == "JOVEM" || $objCracha->tipoInscricao == "INFANTIL") {
			?>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="center" valign="top"><!--img src="util/geraCB.php?nroInscricao=<?php echo $objCracha->objInscricao->nro_inscricao; ?>" /--></td>
						<td align="center" width="20%" style="font-size:12px;" valign="middle"><b>[<?php echo $objCracha->tipoInscricao;?>]</b></td>
					</tr>
				</table>
			<?php
			} else {
				?>
				<!--img src="util/geraCB.php?nroInscricao=<?php echo $objCracha->objInscricao->nro_inscricao; ?>" /-->
				<?php 
			}
		
		?>
	</td>
</tr>
</table>
