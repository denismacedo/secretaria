<?php include("header.php"); ?>


<tr>
    <td><form name="cadastroForm" method="post" action="doEvento.php"> 
		<input type="hidden" name="SPECIAL_PARAM" id="SPECIAL_PARAM" value="<?php echo $specialParam; ?>"/>
	<table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Mensagem de autoriza&ccedil;&atilde;o </span></td>
        </tr>
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr>
        <td height="10" colspan="2" class="style1"><br />
          Este cadastro deve ser acessado apenas quando tipo de login for EVENTO. Saia do sistema e entre novamente escolhendo o tipo de login correto. <br /></td>
        </tr>
      <tr align="right" bgcolor="#f0f0f0">
        <td colspan="2" height="20">&nbsp;</td>
      </tr>
    </table>
    <br />
    <br />
    <br />
    </form></td>
  </tr>
  
  <?php
  if (isset($resultado) && $resultado != "") {
			
			$numRows = mysql_num_rows($resultado);
			?>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  
  <?php 
  
  }
  ?>
  
<?php include("footer.php"); ?>