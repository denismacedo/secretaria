<?php 
	
	require_once("util/http.php");
	require_once('util/comum.php');
	
	if (getPost("POP") == 1)
		include("headerPop.php"); 
	else
		include("header.php"); 

?>



<script language="JavaScript" src="js/cadastroPJ.js">
</script>

<script>

	var req;
	
	function submitConfirmaPagamento(url)
	{
		req = null;
		// Procura por um objeto nativo (Mozilla/Safari)
		if (window.XMLHttpRequest) {
			req = new XMLHttpRequest()
			req.onreadystatechange = processRetornoConfirmaPagamento;
			req.open("GET", url, true);
			req.send(null);
		// Procura por uma versao ActiveX (IE)
		} else if (window.ActiveXObject) {
			req = new ActiveXObject("Microsoft.XMLHTTP");
			if (req) {            		    
				req.onreadystatechange = processRetornoConfirmaPagamento;
				req.open("GET", url, true);			
				req.send();
			}
		}
	}
	
	function processRetornoConfirmaPagamento()
	{
		// apenas quando o estado for "completado"
		if (req.readyState == 4) 
		{
			// apenas se o servidor retornar "OK"
			if (req.status == 200) 
			{
			   alert("Opera��o realizada com sucesso!");
			   loading();
			   document.pesquisaForm.submit();
			} 
			else 
			{
				alert("Houve um problema ao realizar a opera��o:\n" + req.statusText);
			}
		}
	}



	function confirmaPagamento(nroInscricao) {
	
		var txtDataPago = document.getElementById("txtDataPago_" + nroInscricao);
		var txtValorPago = document.getElementById("txtValorPago_" + nroInscricao);
		var txtDocumento = document.getElementById("txtDocumento_" + nroInscricao);
		
		/*if (txtDataPago.value == "") {
			alert("Informe a data do pagamento");
			txtDataPago.focus();
			return false;
		}*/
		if (txtValorPago.value == "") {
			alert("Informe o valor do pagamento");
			txtValorPago.focus();
			return false;
		}
		
		if (txtDocumento.value != "") {
			reDigits = /^\d+$/;
			try {
			if (!(reDigits.test(txtDocumento.value))) {
				alert("Informe apenas n�meros no campo documento!");
				txtDocumento.focus();
				return false;
			}	
			} catch (err) {
				alert(err);
				return false;
			
			}
		}
		
		$sendEmail = "0";
		
		//if (confirm("Deseja enviar e-mail de confirma��o para o caravaneiro?")) {
		//	$sendEmail = "1";
		//}
		
		var url = "doControlePagamento.php?method=confirmar";
		url += "&nroInscricao=" + nroInscricao;
		url += "&dataPago=" + txtDataPago.value;
		url += "&valorPago=" + txtValorPago.value;
		url += "&nossoNro=" + txtDocumento.value;
		url += "&sendEmail=" + $sendEmail;
		
		submitConfirmaPagamento(url);
	}
	
	function corrigePagamento(nroInscricao) {
		
		var url = "doControlePagamento.php?method=corrigir";
		url += "&nroInscricao=" + nroInscricao;
		
		submitConfirmaPagamento(url);
	}

</script>

<tr>
    <td><form name="pesquisaForm" method="post" action="doControlePagamento.php?method=buscar">
      <?php
	
		if (isset($resultado) && $resultado != "") {
			
			$numRows = mysql_num_rows($resultado);
			
			?>
      <br />
        <table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
          <tbody>
            
            <tr bgcolor="#f0f0f0">
              <td height="10" colspan="7" bgcolor="#FFFFFF" class="explicacao"></td>
            </tr>
            <tr bgcolor="#f0f0f0" style="font-size:12px;">
              <td width="10%" height="28" bgcolor="#999999" ><div align="center"><strong>C&oacute;digo</strong></div></td>
              <td width="30%" bgcolor="#999999" ><strong>Nome</strong></td>
              <td width="20%" bgcolor="#999999" ><strong>Tipo</strong></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Data Pag. <br />
              </strong>(dd/mm/aaaa)</div></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Valor Pag. </strong></div></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Documento</strong> (boleto, cheque, etc) </div></td>
              <td width="10%" height="20" bgcolor="#999999" ><div align="center"><strong>Pagamento</strong></div></td>
            </tr>
			
			<?php

		if ($numRows > 0) {
		
			$cor = false;
			for ($i = 0; $i < $numRows; $i++) {
				$numeroInscricao = mysql_result($resultado, $i, "nro_inscricao");
				$nomePessoaFisica = mysql_result($resultado, $i, "nome_pf");
				$cidade = mysql_result($resultado, $i, "cidade")."/".mysql_result($resultado, $i, "unidade_da_federacao")."/".mysql_result($resultado, $i, "pais");
				$valorPago = mysql_result($resultado, $i, "valor_pago");
				$nossoNro = mysql_result($resultado, $i, "nosso_nro");
				$dataPago = mysql_result($resultado, $i, "data_pago");
				$pago = mysql_result($resultado, $i, "pago");
				
				$cor = !$cor;
				if ($cor) {	$bgcolor = "#F0F0F0"; } else { $bgcolor = "#FFFFFF";	}
				
				if ($pago == "S") {
				?>
				
					<tr bgcolor="#FFFFCC">
					  <td height="26" style="color:#0000FF; font-weight:bold;" align="center"><?php echo formatNumber($numeroInscricao, 5); ?></td>
					  <td ><?php echo $nomePessoaFisica; ?></td>
					  <td ><?php echo $cidade; ?></td>
					  <td align="center"><?php echo formatDate($dataPago); ?></td>
					  <td align="center"><?php echo $valorPago; ?></td>
					  <td align="center"><?php echo $nossoNro; ?></td>
					  <td style="color:#009933; font-weight:bold;" align="center">CONFIRMADO <input type="image" src="imagens/undo.gif" name="btnCorrigirPagamento_<?php echo $numeroInscricao; ?>" id="btnCorrigirPagamento_<?php echo $numeroInscricao; ?>" onClick="corrigePagamento(<?php echo $numeroInscricao; ?>)" style="vertical-align:middle; border:0px; padding-left:2px;" alt="Corrigir pagamento" title="Corrigir pagamento"></td>
					</tr>
				
				<?php
				
				} else {
				
				?>
					<tr bgcolor="<?php echo $bgcolor; ?>">
					  <td height="26" style="color:#0000FF; font-weight:bold;" align="center"><input type="hidden" name="numInsc" id="numInsc" value="<?php echo $numeroInscricao; ?>" /><?php echo formatNumber($numeroInscricao, 5); ?></td>
					  <td ><?php echo $nomePessoaFisica; ?></td>
					  <td ><?php echo $cidade; ?></td>
					  <td  align="center"><input type="text" size="12" maxlength="10" name="txtDataPago_<?php echo $numeroInscricao; ?>" id="txtDataPago_<?php echo $numeroInscricao; ?>" style="text-align:center;" onKeyUp="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);" value="<?php echo formatDate($dataPago); ?>"></td>
					  <td  align="center"><input type="text" size="12" maxlength="15" name="txtValorPago_<?php echo $numeroInscricao; ?>" id="txtValorPago_<?php echo $numeroInscricao; ?>" value="<?php echo $valorPago; ?>" style="text-align:center;"></td>
					  <td  align="center"><input type="text" size="12" maxlength="30" name="txtDocumento_<?php echo $numeroInscricao; ?>" id="txtDocumento_<?php echo $numeroInscricao; ?>" value="<?php echo $nossoNro; ?>" style="text-align:center;" onKeyUp="ehNumerico(this);"></td>
					  <td  align="center"><input type="button" value="Confirmar" name="btnConfirmarPagamento_<?php echo $numeroInscricao; ?>" id="btnConfirmarPagamento_<?php echo $numeroInscricao; ?>" onClick="confirmaPagamento(<?php echo $numeroInscricao; ?>)"></td>
					</tr>
				
				<?php
				
				}
				}
				}
				
				?>
          </tbody>
          <tr align="center" bgcolor="#f0f0f0">
            <td height="20" colspan="7" align="right" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        </table>
					
			<?php
			
		}
		
		?>
		
		
    </form></td>
</tr>
   
<?php
	include("footer.php"); 
 ?>