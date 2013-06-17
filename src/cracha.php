<?php include("headerPop.php"); ?>



<script>

function imprime() {

	var inscricoesSelecionadas = "";
	
	var total = document.inscricaoForm.totalInscricoes.value;
	var found = false;
	var i = 0;
	for (i = 0; i < total; i++) {
		var chk = document.getElementById("chk" + i);
		if (chk.checked) {
			inscricoesSelecionadas += chk.value + ";";
			found = true;
		}
	}
	if (!found) {
		alert("SELECIONE PELO MENOS UMA INSCRICAO!");
	} else {
		document.inscricaoForm.inscricoes.value = inscricoesSelecionadas;
		
		document.inscricaoForm.acao.value = "PRINT";
		
		document.inscricaoForm.target = "_BLANK";
		document.inscricaoForm.submit();
		
		/*var divInsc = window.parent.document.getElementById("divInscricao");
		divInsc.style.visibility = "HIDDEN";
		divInsc.style.display = "NONE";
		
		var divInscInterna = window.parent.document.getElementById("divInscricaoInterna");
		divInscInterna.style.visibility = "HIDDEN";
		divInscInterna.style.display = "NONE";*/
		
		var btnHelper = window.parent.document.getElementById("btnHelper");
		
		btnHelper.click();
	}
	
}
</script>
<tr>
	<td>
	<form action="doInscricao.php?method=printCracha" method="post" name="inscricaoForm">
		<input name="acao" id="acao" value="" type="hidden">
		<input name="inscricoes" id="inscricoes" value="" type="hidden">
		<input name="codInscricao" value="<?php echo $codInscricao; ?>" type="hidden">
		<input name="codPF" value="<?php echo $codPF; ?>" type="hidden">

		 <input name="totalInscricoes" value="<?php echo sizeof($cursos); ?>" type="hidden">
</form>
</td></tr><tr>
	<td>
	
	<table border="0" cellpadding="3" cellspacing="3" width="100%">
			<tbody><tr bgColor="#333333">
				<td style="FONT-WEIGHT: bold; COLOR: #ffffff">
				<b>Selecione as inscri&ccedil;&otilde;es que dever&atilde;o aparecer no Crach&aacute;</b></td>
			</tr>
				
				<tr>
					<td>
						<table border="0" cellpadding="2" cellspacing="1" width="100%">
							<tbody><tr bgcolor="#5676a9">
								<td height="20"><span style="color: rgb(255, 255, 255);"><b>INSCRITO EM</b></span></td>
								<td align="center" width="45"><span style="color: rgb(255, 255, 255);"><b>BLOCO</b></span></td>
								<td align="center" width="45"><span style="color: rgb(255, 255, 255);"><b>ANDAR</b></span></td>
								<td align="center" width="45"><span style="color: rgb(255, 255, 255);"><b>SALA</b></span></td>
								<td width="1"><span style="color: rgb(255, 255, 255);"><b>SELECIONAR</b></span></td>
							</tr>
							
							<?php
							
								$cor = false;
								for ($i = 0; $i < sizeof($cursos); $i++) {
								
									$objCurso = $cursos[$i];
								
									$cor = !$cor;
									
									if ($cor) {
										$bgcolor = "#f0f0f0";
									} else {
										$bgcolor = "#ffffff";
									}
								
								?>
									
										<tr bgcolor="<?php echo $bgcolor; ?>">
											<td height="20"><?php echo $objCurso->tipo." - ".$objCurso->nome; ?></td>
											<td align="center"><?php echo $objCurso->bloco; ?></td>
											<td align="center"><?php echo $objCurso->andar; ?></td>
											<td align="center"><?php echo $objCurso->sala; ?></td>
											<td align="center">
											<input name="chk<?php echo $i; ?>" id="chk<?php echo $i; ?>" value="<?php echo $objCurso->codigo; ?>" type="checkbox">
											</td>
								  		</tr>
										
								<?php
								 }		
									?>
					  </tbody></table>
					</td>
				</tr>
				<tr>
					<td align="center">
						<input value="CONFIRMAR" onclick="imprime();" type="button">
					</td>
				</tr>
		  </tbody></table>
	
	</td>
</tr>
 

<?php include("footerPop.php"); ?>