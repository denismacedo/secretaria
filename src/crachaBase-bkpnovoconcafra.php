<table cellpadding="0" cellspacing="2" align="center" border="0" width="100%">
	<tr><td align='center' height="32px">
	<?php
		for ($i = 0; $i < sizeof($objCracha->cursos); $i++) {
			$objCurso = $objCracha->cursos[$i];
			
			if (strlen($objCurso->nome) <= 20){
				$fontSize = "18px;";
			} else if (strlen($objCurso->nome) > 20 && strlen($objCurso->nome) <= 30){
				$fontSize = "16px;";
			} else {
				$fontSize = "12px;";
			}
		
			if ($objCurso->tipo == "COMISSAO") {
				echo "<b><span style='font-size:".$fontSize."'>".$objCurso->nome."</span></b>";
			}
		}
	?>
	</td></tr>
</table>
<table cellpadding="0" cellspacing="2" align="let" border="0" width="100%">
	<tr>
	
		<td align="left" style="padding-left:92px; font-size: 27px" height="66px">
			<b><?php echo $objCracha->nomeCracha; ?></b>
		</td>
	</tr>
	<tr>
		<td height="5">
		</td>
	</tr>
	<tr>
		<td align="center" style="font-size: 9px" height="39px">
		<?php 
		if ($objCracha->tipoInscricao == "INFANTIL") { 
			echo "Responsável: ".$objCracha->responsavel;
		}
	
	?>
		</td>
	</tr>

	<tr>
		<td height="77px" align="left" style="padding-left:110px; font-weight:bold; font-size: <?php echo $objCracha->fonte_cidade; ?>px">
			<?php echo $objCracha->objPF->cidade."-".$objCracha->objPF->unidade_da_federacao; ?></b>
		</td>
	</tr>
	<?php

	
		for ($i = 0; $i < sizeof($objCracha->cursos); $i++) {
			
		
			$objCurso = $objCracha->cursos[$i];
			
			if (strlen($objCurso->nome) <= 20){
				$fontSize = "18px;";
			} else if (strlen($objCurso->nome) > 20 && strlen($objCurso->nome) <= 30){
				$fontSize = "16px;";
			} else {
				$fontSize = "12px;";
			}
		
			if ($objCurso->tipo == "COMISSAO") {
				//echo "<b><span style='font-size:".$fontSize."'>".$objCurso->nome."</span></b>";
			} else {
			echo "<tr><td height='45px;' align='left' style='padding-left:95px; font-size:".$fontSize."'>";
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
				echo "</td></tr>";
			}
			
			
		}
	
	?>
<tr height="1px">
	<td height="1px"></td>
</tr>
</table>
