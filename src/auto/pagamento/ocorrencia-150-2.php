
  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
				<td>
	
	  <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
        <tbody>
          <tr bgcolor="#333333">
            <td height="40" colspan="2" bgcolor="#999999">
			<span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 14px;">&nbsp;Passo 3 de 3: Finaliza&ccedil;&atilde;o da Inscri&ccedil;&atilde;o  </span></td>
          </tr>
          
         
          <tr bgcolor="#B6FCD1">
            <td height="30" colspan="2" style="font-size:14px;">Nome: &nbsp;&nbsp; <b><?php echo getAltPost(@$objPF->nome, 'nome', $try); ?></b>
              <input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->nome, 'nome', $try); ?>" type="hidden" readonly="readonly" class="txtRO" /></td>
          </tr>
          
      
        <tr bgcolor="#f0f0f0">
          <td colspan="2" height="20" style="font-size:12px;" align="center"><br />
            <p align="center"><strong><span style="color:#009933; font-size:16px;">Inscri&ccedil;&atilde;o enviada com sucesso!</span></strong></p>

            <!--Para finalizar sua inscri&ccedil;&atilde;o, clique no bot&atilde;o abaixo e imprima o boleto banc�rio.<br />-->
            Anote o n&uacute;mero da sua inscri&ccedil;&atilde;o: <span style="font-size:14px; font-weight:bold;"> <?php echo formatNumber(@$objInscricao->nro_inscricao, 5); ?></span><br /></td>
        </tr>
       
	   
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a href="index.php?evento=<?php echo $objCP->evento; ?>&ocorrencia=<?php echo $objCP->ocorrencia; ?>">Clique aqui para fazer nova inscri&ccedil;&atilde;o</a></td>
        </tr>
        <tr>
    <td height="5" colspan="2">&nbsp;</td>
  </tr>
	   
	   
	<!--<tr align="center" bgcolor="#f0f0f0">
          <td colspan="2" height="20"><input type="button" value="IMPRIMIR BOLETO" name="inscreveSub" onClick="submitConfirmarInscricao();"></td>
        </tr>-->
		<?php
		
		if (@$objCP->texto_informativo != "") {
		
		?>
		
		  <tr align="center" bgcolor="#f0f0f0">
          <td height="100" colspan="2" valign="middle" bgcolor="#FFFF66" style="font-size: 14px;">
		  <b> 
		  	<?php echo @$objCP->texto_informativo; ?>		    </b>			</td>
        </tr>
		
		<?php
		
		
		}
		
		if (@$objCP->gera_boleto == "S") {
		
		?>
		
		
		<tr align="center" bgcolor="#f0f0f0">
		  <td colspan="2" height="28">Clique no bot&atilde;o abaixo e gere o boleto para pagamento da inscri&ccedil;&atilde;o. </td>
		  </tr>
		<tr align="center" bgcolor="#f0f0f0">
          <td colspan="2" height="28"><input type="button" value="IMPRIMIR BOLETO" name="inscreveSub" onClick="submitConfirmarInscricao();"></td>
        </tr>
		
		<?php
		
		
		} else if (@$objCP->conta_corrente != "") {
		
		?>
		
		
		   <tr align="center" bgcolor="#f0f0f0">
          <td height="20" colspan="2" bgcolor="#FFFF66" style="font-size:14px;"><strong>Banco: <?php echo @$objCP->banco; ?></strong></td>
        </tr>
        <tr align="center" bgcolor="#f0f0f0">
          <td height="20" colspan="2" bgcolor="#FFFF66" style="font-size:14px;"><strong>Ag&ecirc;ncia: <?php echo @$objCP->agencia; ?></strong></td>
        </tr>
        <tr align="center" bgcolor="#f0f0f0">
          <td height="20" colspan="2" bgcolor="#FFFF66" style="font-size:14px;"><strong>Conta: <?php echo @$objCP->conta_corrente; ?></strong></td>
        </tr>
		
		
		<?php
		
		}
		
		
		?>
      
        
     
				
        <tr align="center" bgcolor="#f0f0f0">
          <td height="20" colspan="2" bgcolor="#FFFFFF"><p><br />
              <strong>Valor da Inscri&ccedil;&atilde;o: </strong></p>
            <table width="600" border="0" cellspacing="2" cellpadding="6">
              <tr>
                <td width="246" bgcolor="#cccccc"><strong>Crian&ccedil;as:</strong></td>
                <td width="217" bgcolor="#e0e0e0"><?php echo $objCP->valor_crianca; ?>&nbsp;&nbsp;(<?php echo $objCP->texto_valor_crianca; ?>)</td>
              </tr>
              <tr>
                <td bgcolor="#cccccc"><strong>Adultos e Jovens a partir de 12 anos </strong></td>
                <td bgcolor="#e0e0e0"><?php echo $objCP->valor_adulto; ?>&nbsp;&nbsp;(<?php echo $objCP->texto_valor_adulto; ?>)   </td>
              </tr>
            </table></td>
        </tr>
      </table>
	  <p><br>
          <br>

	    
      </p></td>


</tr>

</tbody>
</table>

</form>