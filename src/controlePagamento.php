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
			   //alert("Operação realizada com sucesso!");
			   alert(req.responseText);
			   loading();
			   document.pesquisaForm.submit();
			} 
			else 
			{
				alert("Houve um problema ao realizar a operação:\n" + req.statusText);
			}
		}
	}



	function confirmaPagamento(nroInscricao) {
		
		//alert(nroInscricao);
		
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
				alert("Informe apenas números no campo documento!");
				txtDocumento.focus();
				return false;
			}	
			} catch (err) {
				alert(err);
				return false;
			
			}
		}
		
		
		var sendEmail = "0";
		
		//if (confirm("Deseja enviar e-mail de confirmação para o caravaneiro?")) {
		//	$sendEmail = "1";
		//}
		
		var url = "doControlePagamento.php?method=confirmar";
		url += "&nroInscricao=" + nroInscricao;
		url += "&dataPago=" + txtDataPago.value;
		url += "&valorPago=" + txtValorPago.value;
		url += "&nossoNro=" + txtDocumento.value;
		url += "&sendEmail=" + sendEmail;
		
		
		var senha = document.getElementById("senha").value;
		
		url += "&senha=" + senha;;
		
		submitConfirmaPagamento(url);
	}
	
	function corrigePagamento(nroInscricao) {
		
		
		var senha = document.getElementById("senha").value;
		
		var url = "doControlePagamento.php?method=corrigir";
		url += "&nroInscricao=" + nroInscricao + "&senha=" + senha;
		
		loading();
		document.pesquisaForm.action = url;
		document.pesquisaForm.submit();
		
		submitConfirmaPagamento(url);
	}
	
	function submitCracha(codigo) {

	
		document.pesquisaForm.target = '_blank';
		document.pesquisaForm.action = 'doInscricao.php?method=printCracha&codPF=' + codigo;
		document.pesquisaForm.submit();
		
		document.pesquisaForm.target = '_self';
		document.pesquisaForm.action = 'doControlePagamento.php?method=buscar';
	}
	
	
function showDivPassword(codigo) {
	
	showFundo();
	
	var divInsc = document.getElementById("divPassword");
	divInsc.style.visibility = "VISIBLE";
	divInsc.style.display = "";
	divInsc.style.MozOpacity=1; // transparencia FF
	divInsc.style.opacity=1; // transparencia  FF, Opera, Safari, Netscape
	divInsc.style.filter="Alpha(Opacity=100)";
	
	var divInscInterna = document.getElementById("divPasswordInterna");
	divInscInterna.style.visibility = "VISIBLE";
	divInscInterna.style.display = "";
	divInscInterna.style.MozOpacity=1; // transparencia FF
	divInscInterna.style.opacity=100; // transparencia  FF, Opera, Safari, Netscape
	divInscInterna.style.filter="Alpha(Opacity=100)";
}



function closedivPassword() {
	
	hideFundo();
	
	var divInsc = document.getElementById("divPassword");
	divInsc.style.visibility = "HIDDEN";
	divInsc.style.display = "NONE";
	
	var divInscInterna = document.getElementById("divPasswordInterna");
	divInscInterna.style.visibility = "HIDDEN";
	divInscInterna.style.display = "NONE";
	
}

function executaAcao() {
	closedivPassword();
	var acao = document.getElementById("hdnAcao").value;	
	//alert(acao);
	if (acao == "CORRIGIR") {

		corrigePagamento(document.getElementById("hdnInsc").value);
	} else {
		confirmaPagamento(document.getElementById("hdnInsc").value);
	}
}

	


</script>


<div id="divPassword" style="border: 8px solid #036; overflow: visible;font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 20%; top: 8%; width: 470px; height: 180px; z-index: 980; background-color: #369; visibility: hidden; padding:2px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;">
	<div align="right" style="padding:2px;">
		<a href="#" onClick="closedivPassword();" title="Fechar"><img src="imagens/close.gif" border="0"></a>
	</div>

	<div id="divPasswordInterna" style="border: 0px; width: 460px; height: 150px; z-index: 985; background-color: #FFF; visibility: visible; padding:1px;visibility: hidden;filter:alpha(opacity=100);-moz-opacity:1;opacity:1; vertical-align:middle;">
		<br/><br><br>&nbsp;&nbsp;&nbsp;Senha: <input type="password" id="senha" name="senha" maxlength="8" style="width: 100px;font-size:16px;padding:2px;"/>
		<input type="button" value=" OK " name="btnSenhaOK" id="btnSenhaOK" onclick="executaAcao();" style="width:30px;font-size:16px;padding:2px;"/>
		<input type="hidden" id="hdnInsc" name="hdnInsc" value=""/>
		<input type="hidden" id="hdnAcao" name="hdnAcao" value=""/>
	</div>

</div>
<div id="divHelper" style="visibility: hidden; display: none;">
<input type="button" onClick="executeHelper()" name="btnHelper" id="btnHelper"/>
</div>


<tr>
    <td><form name="pesquisaForm" method="post" action="doControlePagamento.php?method=buscar"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Controle de Pagamento </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="50">* Esta tela permite controlar os pagamentos de inscri&ccedil;&atilde;o de um determinado evento;<br />
          * Para exibir todos os registros basta deixar os campos abaixo em branco e clicar em <strong>Pesquisar</strong>. </td>
        </tr>
      <tr>
        <td height="30">Nome:</td>
        <td valign="middle"><input name="nomePF" id="nomePF" maxlength="80" size="60" value="<?php echo getPost("nomePF"); ?>"  type="text" class="txtAUTO">
        </td>
      </tr>
      <tr>
        <td height="34">Inscri&ccedil;&atilde;o:</td>
        <td><input name="nroInscricao" id="nroInscricao" maxlength="10" size="20" value="<?php echo formatNumber(getPost("nroInscricao"), 5); ?>" type="text" onKeyUp="ehNumerico(this);"> (apenas números)</td>
      </tr>
      
      <tr align="center" bgcolor="#f0f0f0">
        <td height="20" colspan="2" align="center">
		  <input name="btBuscar" id="btBuscar" value="Pesquisar" type="submit" style="text-transform:capitalize; font-size:12px; font-weight:bold;"></td>
      </tr>
     
    </table>
	<?php
	
		if (isset($resultado) && $resultado != "") {
			
			$numRows = mysql_num_rows($resultado);
			
			?>
		
        <br />
        <table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
          <tbody>
            
            <tr bgcolor="#f0f0f0">
              <td height="20" colspan="8" align="center" class="explicacao">
			    <strong>
			    <?php
			  	if ($numRows <= 0) {
					echo "Não foram encontrados registros para a pesquisa realizada!";
				} else {
					echo "Foram encontrados ".$numRows." registros";
				}
			   ?>
		        </strong> </td>
            </tr>
            <tr bgcolor="#f0f0f0">
              <td height="10" colspan="8" bgcolor="#FFFFFF" class="explicacao"></td>
            </tr>
            <tr bgcolor="#f0f0f0" style="font-size:12px;">
              <td width="10%" height="28" bgcolor="#999999" ><div align="center"><strong>Inscri&ccedil;&atilde;o</strong></div></td>
              <td width="30%" bgcolor="#999999" ><strong>Nome</strong></td>
              <td width="20%" bgcolor="#999999" ><strong>Cidade/UF</strong></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Data Pag. <br />
              </strong>(dd/mm/aaaa)</div></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Valor Pag. </strong></div></td>
              <td width="10%" bgcolor="#999999" ><div align="center"><strong>Documento</strong> (boleto, cheque, etc) </div></td>
              <td width="10%" height="20" bgcolor="#999999" ><div align="center"><strong>Pagamento</strong></div></td>
              <td width="10%" height="20" bgcolor="#999999" ><div align="center"><strong>Crach&aacute;</strong></div></td>
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
				$cod_pf = mysql_result($resultado, $i, "cod_pf");
				
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
					  <td style="color:#009933; font-weight:bold;" align="center">CONFIRMADO <input type="image" src="imagens/undo.gif" name="btnCorrigirPagamento_<?php echo $numeroInscricao; ?>" id="btnCorrigirPagamento_<?php echo $numeroInscricao; ?>" onclick="document.getElementById('hdnInsc').value = '<?php echo $numeroInscricao; ?>'; document.getElementById('hdnAcao').value ='CORRIGIR'; showDivPassword(); return false;" style="vertical-align:middle; border:0px; padding-left:2px;" alt="Corrigir pagamento" title="Corrigir pagamento"></td>
					   <td  align="center"><input type="button" value="Imprimir" name="btnImprimeCracha_<?php echo $numeroInscricao; ?>" id="btnImprimeCracha_<?php echo $numeroInscricao; ?>" onclick="submitCracha(<?php echo $cod_pf; ?>)"></td>
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
					  <td  align="center"><input type="button" value="Confirmar" name="btnConfirmarPagamento_<?php echo $numeroInscricao; ?>" id="btnConfirmarPagamento_<?php echo $numeroInscricao; ?>" onclick="document.getElementById('hdnInsc').value = '<?php echo $numeroInscricao; ?>';  document.getElementById('hdnAcao').value ='CONFIRMAR'; showDivPassword();"></td>
					  <td  align="center"><input type="button" value="Imprimir" name="btnImprimeCracha_<?php echo $numeroInscricao; ?>" id="btnImprimeCracha_<?php echo $numeroInscricao; ?>" onclick="submitCracha(<?php echo $cod_pf; ?>)"></td>
					  
					</tr>
				
				<?php
				
				}
				}
				}
				
				?>
          </tbody>
          <tr align="center" bgcolor="#f0f0f0">
            <td height="20" colspan="8" align="right" bgcolor="#CCCCCC">&nbsp;</td>
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