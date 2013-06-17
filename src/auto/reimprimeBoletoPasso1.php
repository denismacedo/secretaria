<?php 

include ("header.php");

$try = true;

?>

<script language="javascript" type="text/javascript" src="../js/auto/inscricao.js"></script><form name="inscricaoForm" action="doInscricao.php?method=buscaInscricao" method="post">
 <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
 <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">
 <input type="hidden" name="paginaRetorno" id="paginaRetorno" value="reimprimeBoletoPasso1.php" />
  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
				<td>
	
	  <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
        <tbody>
          <tr bgcolor="#333333">
            <td height="54" colspan="2" bgcolor="#999999">
			  <div align="center"><span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 16px;"><br />
			    Informe abaixo o n&uacute;mero da sua inscri&ccedil;&atilde;o.<br />
			    <br /> 
			    <span style="font-size:13px;">
			    Caso n&atilde;o lembre esse n&uacute;mero, envie e-mail para secretaria@concafras.com informando os seus dados para receber o n&uacute;mero da inscri&ccedil;&atilde;o como resposta. </span><br />
			    <br />
			    <br />
			    </span></div></td>
          </tr>

  <tr>
    <td colspan="2">
      
      <table cellSpacing="3" cellPadding="3" width="580" align="center" border="0">
        
		<tr bgColor="#f9f9f9">
          <td colspan="2">
		  
		  <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
		  <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">
		  		</td>
		</tr>
        <tr bgColor="#f9f9f9">
          <td width="145" height="28" bgcolor="#ffffff"><b>N&uacute;mero da Inscri&ccedil;&atilde;o: </b></td>
          <td width="414" height="28" bgcolor="#ffffff"><input type="text" name="nroInscricao" id="nroInscricao" size="7" maxlength="7" style="font-size:14px; font-weight:bold;" value="<?php echo formatNumber(getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true), 5); ?>""/></td>
		</tr>
		
	  </table>	</td>
  </tr>
	   
	   
        <tr align="center" bgcolor="#f0f0f0">
          <td colspan="2" height="40"><input type="submit" value="VERIFICAR INSCRI&Ccedil;&Atilde;O" name="inscreveSub" ></td>
        </tr>
		
		<?php
		
			if ((isset($objInscricao->codigo) || @$objInscricao->codigo != "" )) {
				?>
				 <tr bgColor="#f9f9f9">
				  <td height="28" bgcolor="#f9f9ff" colspan="2" align="center">
				    <p>&nbsp;</p>
				    <p>Inscri&ccedil;&atilde;o encontrada:<br />
				      <br /> 
				      <span style="font-size:14px;" ><b><?php echo $objPF->nome; ?></b></span>
				      <br>
				      <br>
				      <!--<input type="button" value="REIMPRIMIR BOLETO" name="inscreveSub" onClick="document.forms[0].action='doInscricao.php?method=geraBoleto'; document.forms[0].submit();">-->
                      <input type="button" value="VISUALIZAR FICHA DE INSCRIÇÃO" name="inscreveSub" onClick="document.forms[0].action='doInscricao.php?method=verFichaInscricao'; document.forms[0].submit();">
				      </p>
			       <p>&nbsp;</p>
				   <?php 
				   
				   $evento = $_SESSION["EVENTO_SESSION"];
					$ocorrencia = $_SESSION["OCORRENCIA_SESSION"];
				   ?>
						<p align="center">Clique na imagem abaixo para efetuar pagamento utilizando boleto bancário, cartão de crédito ou cartão de crédito</P>
						<p align="center"><a style="cursor:hand" onclick="javascript:document.forms[0].action='doInscricao.php?method=pagSeguro'; document.forms[0].submit();" title="Clique para efetuar o pagamento pelo PagSeguro" target="_blank"><img src="imagens/205x30-pagar.gif"></a></p>
				   
			   
				   </td>
			  </tr>
				
				<?php
			}
		
		?>
      </table>
	  <p><br>
          <br>

	    
      </p></td>


</tr>

</tbody>
</table>

</form>
<?php include ("footer.php"); ?>