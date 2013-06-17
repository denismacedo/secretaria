<?php 
	
	require_once("util/http.php");
	
	include("header.php"); 

?>

<tr>
    <td><form name="crachaForm" method="post" action="doConfiguracaoCracha.php?method=save"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="650">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255); font-weight: bold;">&nbsp;Configura&ccedil;&atilde;o do Crach&aacute; </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">* Esta tela permite configurar as medidas de impress&atilde;o de crach&aacute;s </td>
        </tr>
      <tr>
        <td width="120" height="20">Altura do Crach&aacute; :</td>
        <td width="519" valign="middle"><label>
          <input name="altura" type="text" id="altura" size="5" maxlength="5"  value="<?php echo $altura; ?>"/>
        </label>
		(cm)</td>
      </tr>
      <tr bgcolor="#F9F9F9">
        <td height="20">Largura do Crach&aacute;: </td>
        <td><label>
          <input name="largura" type="text" id="largura" size="5" maxlength="5" value="<?php echo $largura; ?>" />
        </label>
          (cm)</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="20">Margem Superior: </td>
        <td><label>
          <input name="margem_superior" type="text" id="margem_superior" size="5" maxlength="5" value="<?php echo $margem_superior; ?>" />
        </label>
          (cm)</td>
      </tr>
      <tr bgcolor="#F9F9F9">
        <td height="20">Margem Esquerda: </td>
        <td><label>
          <input name="margem_esquerda" type="text" id="margem_esquerda" size="5" maxlength="5" value="<?php echo $margem_esquerda; ?>" />
        </label>
          <!-- &nbsp;<img style="" src="imagens/lupa.gif" alt="Procurar" onclick="findPF();" align="absmiddle" border="0" width="17" height="17">-->
          (cm)</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="20">Tamanho da Fonte: </td>
        <td><label>
          <input name="tamanho_fonte" type="text" id="tamanho_fonte" size="5" maxlength="5" value="<?php echo $tamanho_fonte; ?>" />
        </label>
          (px)</td>
      </tr>
      

      <tr>
        <td colspan="2" height="20">&nbsp;</td>
        </tr>
      <tr align="center" bgcolor="#f0f0f0">
        <td colspan="2" height="20"><input name="btAlterar" id="btAlterar" value="Alterar" type="submit" ></td>
      </tr>
     
    </table>
    </form></td>
  </tr>
  
<?php
	include("footer.php"); 
 ?>