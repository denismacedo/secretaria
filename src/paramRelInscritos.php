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

<tr>
    <td><form name="pesquisaForm" method="post" action="doRelatorio.php?method=inscritos"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Relat&oacute;rio de Inscritos - Filtro </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="50">          * Para exibir todos os registros basta deixar os campos abaixo em branco e clicar em <strong>Pesquisar</strong>. </td>
        </tr>
      <tr>
        <td width="133" height="30">Data de Inscri&ccedil;&atilde;o:</td>
        <td width="506" valign="middle"><input name="dataIni" id="dataIni" maxlength="10" size="14" value="<?php echo getPost("dataIni"); ?>"  type="text" class="txtAUTO" onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> 
        a 
          <input name="dataFim" id="dataFim" maxlength="10" size="14" value="<?php echo getPost("dataFim"); ?>"  type="text" class="txtAUTO" onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"/></td>
      </tr>
      
      <tr align="center" bgcolor="#f0f0f0">
        <td height="20" colspan="2" align="center">
		  <br />
		  <input name="btBuscar" id="btBuscar" value="Pesquisar" type="submit" style="text-transform:capitalize; font-size:12px; font-weight:bold;">
		  <br /></td>
      </tr>
    </table>
	<?php
	
		if (isset($resultado) && $resultado != "") {
			
			$numRows = mysql_num_rows($resultado);
			
			?>
		
        <br />
        <?php
			
		}
		
		?>
    </form></td>
</tr>
   
<?php
	include("footer.php"); 
 ?>