<?php 

include ("header.php");

$try = true;

?>

<script language="javascript" type="text/javascript" src="../js/auto/inscricao.js"></script>

<form name="inscricaoForm" action="doInscricao.php" method="post">
 <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
 <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">

  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
				<td>
	
	  <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
        <tbody>
          <tr bgcolor="#333333">
            <td height="40" colspan="2" bgcolor="#999999">
			<span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 14px;">&nbsp;Passo 2 de 3: Informe alojamento, cursos e comiss&atilde;o e clique em Confirmar. </span></td>
          </tr>
          
         
        <tr bgcolor="#B6FCD1">
          <td height="30" colspan="2" style="font-size:14px;">Nome: &nbsp;&nbsp;
		  <b><?php echo @$objPF->nome; ?></b>
		  
		  <input name="nome" id="nome" maxlength="80" size="60" value="<?php echo @$objPF->nome; ?>" type="hidden" readonly class="txtRO">
              <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">--></td>
        </tr>
      
        <tr bgcolor="#f0f0f0">
          <td colspan="2" height="20" style="font-size:12px;" align="center"><br />
            <p align="center"><strong><span style="color:#009933; font-size:16px;">Dados enviados com sucesso!</span></strong></p>

            Para continuar sua inscri&ccedil;&atilde;o, escolha o alojamento, os temas<br />
 e a comiss&atilde;o de trabalho (caso seja um colaborador do evento)</strong><br />
            <br /></td>
        </tr>
       
	   
  <tr>
    <td colspan="2">
      
      <table cellSpacing="3" cellPadding="3" width="580" align="center" border="0">
        
		<tr bgColor="#f9f9f9">
          <td width="97" colspan="2">
		  
		  <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
		  <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">
		  	<input name="nroInscricao" id="nroInscricao" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true), 5); ?>" readonly="readonly" class="txtNumeroRO" type="hidden">			</td>
		</tr>
        <tr bgColor="#f9f9f9">
          <td width="97" height="28" bgcolor="#ffffff"><b>Alojamento: </b></td>
          <td width="462" height="28" bgcolor="#ffffff">
		      <?php
			  
			  if (isset($selectTipoAlojamento) && $selectTipoAlojamento != "") {
			  	echo $selectTipoAlojamento;
			  }
			  
			  ?>			</td>
		</tr>
		<?php if (isset($selectIdioma) && $selectIdioma != "") {?>
        <tr bgColor="#f9f9f9">
          <td width="97" height="28" bgcolor="#ffffff"><b>Idioma Tema Central: </b></td>
          <td width="462" height="28" bgcolor="#ffffff">
		      <?php
			     echo $selectIdioma;
			 
			  ?>			</td>
		</tr>
		
		<?php } ?>
		
        <tr bgColor=#f6f6f6>
          <td height="28" valign="middle" bgcolor="#F9f9f9">
		    <strong>Trabalhador: </strong></td>
		  <td height="28" bgcolor="#F9f9f9" valign="middle">
		  	<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="14%" valign="middle">
		  <select name="flag_trabalhador" id="flag_trabalhador" onChange="HabilitaComissao();">
			  <option value="N" selected>N&atilde;o</option>
			  <option value="S" <?php  if (@$objInscricao->flag_trabalhador == 'S') echo "SELECTED"; ?> >Sim</option>
		  </select> </td>
		  <td width="86%" valign="middle">
			<div id="divComissao" style="visibility:<?php  if (@$objInscricao->flag_trabalhador == 'S') { echo "VISIBLE;"; } else { echo "HIDDEN"; } ?>">
			<strong>

&nbsp;Comiss&atilde;o:</strong> &nbsp;&nbsp;&nbsp; 
			  <?php
			  
			  if (isset($selectComissoes) && $selectComissoes != "") {
			  	echo $selectComissoes;
			  }
			  
			  ?> 
			</div>			</td>
			</tr>
			</table>		</td>
		</tr>
		<?php 
		
			if (isset($selectTemasAtuais1) && $selectTemasAtuais1 != "") {
			
			?>
		
        <tr>
          <td height="28" colspan="2" bgcolor="#CCCCCC" style="font-size:14px;"><B>Tema Atual: </B></td>
          </tr>
        <tr>
          <td height="28" bgcolor="#f9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 1: </strong></div></td>
          <td height="28" bgcolor="#f9f9f9"><select name="temasAtuaisOp1" id="temasAtuaisOp1">
		  
		  <?php
			 
			  	echo $selectTemasAtuais1;

			  ?> 
		  
          </select></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#ffffff"><div align="right"><strong>Op&ccedil;&atilde;o 2:</strong></div></td>
          <td height="28" bgcolor="#ffffff">
		  	<select name="temasAtuaisOp2" id="temasAtuaisOp2">
		  
		  <?php
			  
			  	echo $selectTemasAtuais2;
			  
			  ?> 
          </select>		 </td>
        </tr>
        <tr>
          <td height="28" bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 3:</strong></div></td>
          <td height="28" bgcolor="#F9f9f9">
		  <select name="temasAtuaisOp3" id="temasAtuaisOp3">
		  
		  <?php
			  
			  	echo $selectTemasAtuais3;
			  
			  ?> 
          </select></td>
        </tr>
		<?php
		
		} 
		
		if (isset($selectTemasEspecificos1) && $selectTemasEspecificos1 != "") {
		
		?>
        <tr>
          <td height="28" bgcolor="#CCCCCC" style="font-size:14px;" colspan="2"><B>Tema Espec&iacute;fico: </B></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 1: </strong></div></td>
          <td height="28" bgcolor="#F9f9f9">
		  <select name="temasEspecificosOp1" id="temasEspecificosOp1">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos1;
			  
			  ?> 
          </select>		  </td>
        </tr>
        <tr>
          <td height="28" bgcolor="#ffffff"><div align="right"><strong>Op&ccedil;&atilde;o 2:</strong></div></td>
          <td height="28" bgcolor="#ffffff">
		   <select name="temasEspecificosOp2" id="temasEspecificosOp2">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos2;
			  
			  ?> 
          </select>		  </td>
        </tr>
        <tr>
          <td height="28" bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 3:</strong></div></td>
          <td height="28" bgcolor="#F9f9f9">
		   <select name="temasEspecificosOp3" id="temasEspecificosOp2">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos3;
			  
			  ?> 
          </select>		  </td>
		</tr>		
 	    <?php
		
		}
		
		?>
	  </table>
	 
	</td>
  </tr>
	   
	   
        <tr align="center" bgcolor="#f0f0f0">
          <td colspan="2" height="20"><input type="button" value="CONFIRMAR" name="inscreveSub" onClick="submitConfirmarInscricao();"></td>
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