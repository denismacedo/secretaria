<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>CONCAFRAS</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body onload="window.print();">
<table cellpadding="0" cellspacing="0" style="height:<?php echo $objCracha->altura; ?>cm; width:<?php echo $objCracha->largura; ?>cm; font-size: <?php echo $objCracha->tamanho_fonte; ?>px; border: 0px solid #666666; padding-top: <?php echo $objCracha->margem_superior; ?>cm; margin: 0cm; padding-left: <?php echo $objCracha->margem_esquerda; ?>cm; font-family: Trebuchet MS, Tahoma, Arial,Verdana,Helvetica"  >
	<tr>
		<td>
			<table cellpadding="2" cellspacing="2">
				<tr>
				
					<td align="center" style="font-size: <?php echo $objCracha->fonte_nome; ?>px">
						<b><?php echo $objPF->nome; ?></b>
					</td>
				</tr>
				<tr>
				
					<td align="center" style="font-size: <?php echo $cracha->fonte_cidade; ?>px">
						<b><?php echo $objPF->cidade."-".$objPF->unidade_da_federacao; ?></b>
					</td>
				</tr>
				<tr>
					<td height="10">
					</td>
				</tr>
				<?php
				
					for ($i = 0; $i < sizeof($cursos); $i++) {
						echo "<tr><td align='center'>";
					
						$objCurso = $cursos[$i];
					
						if ($objCurso->tipo == "COMISSAO") {
							echo "<b>".$objCurso->nome."</b>";
						} else {
							echo $objCurso->nome;
							echo "<br>";
							$jaEscreveu = false;
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
						}
						
						echo "</td></tr>";
					}
				
				?>
				
			
			</table>
			<br><br>
			<img src="util/geraCB.php?nroInscricao=<?php echo $objInscricao->nro_inscricao; ?>" />
		</td>
	</tr>
	
</table>
</body>
</html>