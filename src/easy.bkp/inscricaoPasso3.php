<?php 

include ("header.php");

$try = true;

?>

<script language="javascript" type="text/javascript" src="../js/auto/inscricao.js"></script>

<form method="post" name="inscricaoForm" id="inscricaoForm" action="doInscricao.php">

	<input type="hidden" name="codInscricao" id="codInscricao" value="<?php echo @$objInscricao->codigo; ?>" />

  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
				<td>
	
	  <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
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

            <!--Para finalizar sua inscri&ccedil;&atilde;o, clique no bot&atilde;o abaixo e imprima o boleto bancário.<br />-->
            Anote o n&uacute;mero da sua inscri&ccedil;&atilde;o: <span style="font-size:14px; font-weight:bold;"> <?php echo formatNumber(@$objInscricao->nro_inscricao, 5); ?></span><br /></td>
        </tr>
       
	   
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a NAME="NEW" href="index.php?evento=<?php echo $_SESSION["EVENTO_SESSION"]; ?>&ocorrencia=<?php echo $_SESSION["OCORRENCIA_SESSION"]; ?>">Clique aqui para fazer nova inscri&ccedil;&atilde;o</a></td>
        </tr>
        <tr>
    <td height="5" colspan="2">&nbsp;</td>
  </tr>
	   
	   
      </table>
	  <p><br>
          <br>

	    
      </p></td>


</tr>

</tbody>
</table>

</form>

<?php include ("footer.php"); ?>