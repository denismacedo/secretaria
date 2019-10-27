<?php include("header.php"); ?>

<script language="JavaScript" src="js/cadastro.js">
</script>

<tr>
    <td><form name="cadastroForm" method="post" action=""> <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255)">Controle de presen&ccedil;a do evento </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">Clique no bot&atilde;o abaixo para inicar o processo </td>
        </tr>
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">&nbsp;</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
		<?php
		
			if (isset($_SESSION["OCORRENCIA_SESSION"]) && $_SESSION["OCORRENCIA_SESSION"] != "") {
				?>
					<td align="center">
					<input type="button" style="font-weight:bold; background-color:#336699; font-size:16px; color:#FFFFFF;" value="Iniciar" name="btIniciar" id="btIniciar" onClick="submitControlePresenca();" alt="Clique aqui para iniciar o controle de presen&ccedil;a do evento" title="Clique aqui para iniciar o controle de presen&ccedil;a do evento"/>
					</td>
								<?php
			}
		
		?>
				</tr>
			</table>		</td>
      </tr>
      

    </table>
    </form></td>
  </tr>
  
  <script type="text/javascript">
		
	var options_xml = {
		script:"doCadastro.php?method=searchNomePFByNome&",
		varname:"nome",
		minchars:4,
		callback: function (obj) { document.getElementById('codigo').value = obj.id; searchPF();}
	};
	var as_xml = new AutoSuggest('nome', options_xml);
	
	var options2_xml = {
		script:"doCadastro.php?method=searchResponsavelByNome&",
		varname:"nome",
		minchars:4,
 		callback: function (obj) { 
			document.getElementById('codResponsavel').value = obj.id; 
			document.getElementById('responsavelComplemento').value = obj.info;}
	};
	var as2_xml = new AutoSuggest('responsavel', options2_xml);
	
	var options3_xml = {
		script:"doCadastro.php?method=searchNomePJByNome&",
		varname:"nome",
		minchars:4,
 		callback: function (obj) { 
			document.getElementById('codOrigem').value = obj.id; 
			document.getElementById('origemComplemento').value = obj.info;}
	};
	var as3_xml = new AutoSuggest('origem', options3_xml);
	
	var options4_xml = {
		script:"doCadastro.php?method=searchCidadeByNome&",
		varname:"nome",
		minchars:4,
 		callback: function (obj) { 
			document.getElementById('codCidade').value = obj.id; 
			document.getElementById('cidadeComplemento').value = obj.info;}
	};
	var as4_xml = new AutoSuggest('cidade', options4_xml);
</script>

<div id="divInscricao" style="border: 8px solid #036; overflow: visible;font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 20%; top: 8%; width: 670px; height: 510px; z-index: 980; background-color: #369; visibility: hidden; padding:2px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;">
	<div align="right" style="padding:2px;">
		<a href="#" onClick="closeDivInscricao();" title="Fechar"><img src="imagens/close.gif" border="0"></a>
	</div>

	<div id="divInscricaoInterna" style="border: 0px; width: 668px; height: 480px; z-index: 985; background-color: #FFF; visibility: visible; padding:1px;visibility: hidden;filter:alpha(opacity=100);-moz-opacity:1;opacity:1; vertical-align:middle;">
		<iframe name="ifInscricao" id="ifInscricao" scrolling="auto" width="668px" height="480px" align="middle" marginheight="0" marginwidth="0" style="border: 0px;">
		</iframe>
	</div>

</div>
<div id="divHelper" style="visibility: hidden; display: none;">
<input type="button" onClick="executeHelper()" name="btnHelper" id="btnHelper"/>
</div>

  
<?php include("footer.php"); ?>