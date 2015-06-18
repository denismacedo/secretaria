<?php include("headerPop.php"); ?>
<script language="javascript" type="text/javascript" src="js/inscricao.js"></script>
  <tr>
    <td>
      <form name="inscricaoForm" action="doInscricao.php" method="post">
      <table cellSpacing="3" cellPadding="3" width="580" align="center" border="0">
        <tr bgColor="#333333">
		  <td colSpan="2" height="25"><SPAN style="FONT-WEIGHT: bold; COLOR: #ffffff">&nbsp;Informe os dados abaixo e clique em &quot;Confirmar&quot;. </SPAN></td>
        </tr>
        
		<tr bgColor="#f9f9f9">
          <td width="97"><b>C&oacute;digo: </b></td>
          <td width="462" bgcolor="#f9f9f9">
		  <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
		  <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">
		  	<input name="nroInscricao" id="nroInscricao" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true), 5); ?>" readonly="readonly" class="txtNumeroRO" type="text">			</td>
		</tr>
        <tr bgColor="#f9f9f9">
          <td width="97" bgcolor="#ffffff"><b>Alojamento: </b></td>
          <td width="462" bgcolor="#ffffff">
		      <?php
			  
			  if (isset($selectTipoAlojamento) && $selectTipoAlojamento != "") {
			  	echo $selectTipoAlojamento;
			  }
			  
			  ?>			</td>
		</tr>
		<?php
		if ($objEvento->tipoEvento == 11) {
			?>
        <tr bgColor="#f6f6f6">
          <td width="97" bgcolor="#ffffff"><b>Idioma Tema Central: </b></td>
          <td width="462" bgcolor="#ffffff">
		      <?php
			  
			  if (isset($selectIdioma) && $selectIdioma != "") {
			  	echo $selectIdioma;
			  }
			  
			  ?>			</td>
		</tr>
		<?php } ?>
        <tr bgColor=#f9f9f9>
          <td vAlign="center" bgcolor="#F9f9f9">
		    <strong>Trabalhador: &nbsp;</strong></td>
		  <td bgcolor="#F9f9f9">
		  	<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="14%">
		  <select name="flag_trabalhador" id="flag_trabalhador" onChange="HabilitaComissao();">
			  <option value="N" selected>N&atilde;o</option>
			  <option value="S" <?php  if (@$objInscricao->flag_trabalhador == 'S') echo "SELECTED"; ?> >Sim</option>
		  </select>		  </td>
		  <td width="86%">
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
          <td bgcolor="#ffffff"><B>Tema Atual: </B></td>
          <td bgcolor="#ffffff">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#f9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 1: </strong></div></td>
          <td bgcolor="#f9f9f9"><select name="temasAtuaisOp1" id="temasAtuaisOp1">
		  
		  <?php
			 
			  	echo $selectTemasAtuais1;

			  ?> 
		  
          </select></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff"><div align="right"><strong>Op&ccedil;&atilde;o 2:</strong></div></td>
          <td bgcolor="#ffffff">
		  	<select name="temasAtuaisOp2" id="temasAtuaisOp2">
		  
		  <?php
			  
			  	echo $selectTemasAtuais2;
			  
			  ?> 
          </select>		 </td>
        </tr>
        <tr>
          <td bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 3:</strong></div></td>
          <td bgcolor="#F9f9f9">
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
          <td bgcolor="#ffffff"><B>Tema Espec&iacute;fico: </B></td>
          <td bgcolor="#ffffff">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 1: </strong></div></td>
          <td bgcolor="#F9f9f9">
		  <select name="temasEspecificosOp1" id="temasEspecificosOp1">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos1;
			  
			  ?> 
          </select>		  </td>
        </tr>
        <tr>
          <td bgcolor="#ffffff"><div align="right"><strong>Op&ccedil;&atilde;o 2:</strong></div></td>
          <td bgcolor="#ffffff">
		   <select name="temasEspecificosOp2" id="temasEspecificosOp2">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos2;
			  
			  ?> 
          </select>		  </td>
        </tr>
        <tr>
          <td bgcolor="#F9f9f9"><div align="right"><strong>Op&ccedil;&atilde;o 3:</strong></div></td>
          <td bgcolor="#F9f9f9">
		   <select name="temasEspecificosOp3" id="temasEspecificosOp2">
		  
		  <?php
			  
			  	echo $selectTemasEspecificos3;
			  
			  ?> 
          </select>		  </td>
		</tr>		
 	    <?php
		
		}
		
		?>
        <!--<tr>
            <td colspan="2">
            	<b>Outros:
            </td>
            
        </tr>
        <tr>
            <td colspan="2" style="padding-left:20px;font-weight:bold;" bgColor="#f9f9f9">
            	<input type="checkbox"  name="chkConfirmPresenca" id="chkConfirmPresenca"> Confirmar presen&ccedil;a
                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="checkbox"  name="chkConfirmPagamento" id="chkConfirmPagamento"> Confirmar pagamento
                &nbsp;&nbsp;&nbsp; R$: <input name="valorPago" maxlength="10" size="8" type="text" style="text-align:right;">
            </td>
        </tr>-->
        <tr align="middle" bgColor="#e9e9e9">
          <td colSpan="2" height="25px" align="center" style="padding:10px;">

					<input type="button" value="CONFIRMAR" name="inscreveSub" onClick="submitConfirmarInscricao();" style="font-weight:bold;">
&nbsp;&nbsp;&nbsp;&nbsp;
				 <?php 
				 if (getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true) != "") {
				 ?>

					<input type="button" value="IMPRIMIR CRACH&Aacute;" name="btnPrintCracha" onClick="parent.submitCrachaFromInsc('<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>');">
&nbsp;&nbsp;&nbsp;&nbsp;
				 <?php
				 
				 }
				 
				 ?>
                  <?php 
				 if (getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true) != "") {
				 ?>

					<input type="button" value="EXCLUIR INSCRI&Ccedil;&Atilde;O" name="excluirSub" onClick="if (confirm('Aten&ccedil;&atilde;o: Esta opera&ccedil;&atilde;o é irrevers&iacute;vel!\nDeseja Continuar?')) {submitExcluirInscricao();}">

				 <?php
				 
				 }
				 
				 ?>
			 </td>
		</tr>		
	  </table>
	  </form>
	</td>
  </tr>
  <?php include("footerPop.php"); ?>