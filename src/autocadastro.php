<?php
  session_start();
  require_once("sql/conexao.php");
  include_once("sql/consultaPF.php");
  $consulta = new consultaPF();
  if (($_POST['fNome'] != "") and ($_POST['fDataNasc'] != "") and ($_POST['fSexo'] != ""))
  {    
    $result = $consulta->searchByChave(strtoupper($_POST['fNome']),strtoupper($_POST['fDataNasc']),strtoupper($_POST['fSexo']));
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
<TITLE>CONCAFRAS</TITLE>
<LINK href="CSS/estilo.css" type=text/css rel=stylesheet>
<script language="javascript" type="text/javascript" src="templates/script.js"></script>
<script language="javascript" type="text/javascript">
function atribuiDDD(campoDDD)
{
  document.cadastroform.fDDDComerc.value = campoDDD.value;
  document.cadastroform.fDDDCel.value = campoDDD.value;
}
function HabilitaComissao()
{  
  if (document.cadastroform.fTrabalhador.value == "S")
  {
    document.getElementById('divComissao').style.visibility = 'visible';
  }
  else
  {
    document.getElementById('divComissao').style.visibility = 'hidden';
  }
}
function consultaPF()
{
  if ((document.cadastroform.fDataNasc.value != "") && (document.cadastroform.fNome.value != "") && (document.cadastroform.fSexo.value != ""))
  {
    document.cadastroform.submit();
  }    
}
</script>
</HEAD>
<body>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <tr>
    <td class="tituloheader" align=middle  background=imagens/bg_top.jpg>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <tr>
          <td vAlign=center align=left>
		    <img src="imagens/logo_concafras.jpg">
		  </td>
          <td vAlign=baseline align=right>
		    <img src="imagens/logo_inscricao.jpg"> 
      	  </td>
		</tr>
		</tbody>
	  </table>
    </td>
  </tr>
  <tr>
    <td>
      <form name='cadastroform' action='autocadastro.php' method='post'>
	  <input type='hidden' name='fEvento' value="150">
	   <input type='hidden' name='fCodigo'>
		<input type='hidden' value='1' name='fTipoPF'> 
      <TABLE cellSpacing=1 cellPadding=2 width=700 align=center border=0>
        <TBODY>
        <tr bgColor=#333333>
          <td colSpan=2>
		  <SPAN style="FONT-WEIGHT: bold; COLOR: #ffffff">&nbsp; Cadastro </SPAN>
		</td>
		</tr>
        <tr bgColor=#f0f0f0>
          <td class=explicacao colspan="2">
            <TABLE style="FONT-SIZE: 12px; COLOR: #000000" cellSpacing=2 cellPadding=1 width="100%" border=0>
              <TBODY>
              <tr>
                <td>Preencha o formulário abaixo e clique em Confirmar Cadastro</td></tr>
			  </tbody>
			 </table>
		   </td>
		 </tr>
        <tr>
          <td>Nome: </td>
          <td vAlign=center><input maxLength=80 size=60 name="fNome" onBlur="consultaPF();" 
		    value="<?php echo $_POST['fNome']; ?>"></td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td>Data de Nascimento: </td>
          <td vAlign=cente>
		    <input maxLength="10" size="14" name="fDataNasc" onBlur="consultaPF();" 
			  onKeyUp="mascaraData(this);" value="<?php echo $_POST['fDataNasc']; ?>"> (dd/mm/aaaa) 
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			Sexo:
            <select name="fSexo" onBlur="consultaPF();">
			  <option value="M" <?php if ($_POST['fDataNasc'] == 'M') { echo 'selected'; } ?>>Masculino</option>
			  <option value="F" <?php if ($_POST['fDataNasc'] == 'F') { echo 'selected'; } ?>>Feminino</option>
			</select>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td>Rua:</td>
          <td>
		    <input maxLength=80 size=60 name="fRua" value="<?php if (isset($result)) { echo mysql_result($result,0,6); } ?>"> &nbsp;&nbsp;&nbsp;
			Nro: &nbsp; <input class=txtNumero maxLength=10 size=12 
			  name="fNumero" value="<?php if (isset($result)){ echo mysql_result($result,0,8);} ?>">
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td>Complemento:</td>
          <td>
		    <input maxLength=80 size=60 name="fComplemento" value="<?php if (isset($result)){ echo mysql_result($result,0,7);} ?>"> &nbsp;&nbsp;&nbsp; 
			CEP:&nbsp; <input class=txtNumero maxLength=10 size=12 name="fCep" value="<?php if (isset($result)){ echo mysql_result($result,0,10);} ?>"> (somente números)
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td>Bairro:</td>
          <td><input maxLength=80 size=60 name="fBairro" value="<?php if (isset($result)){ echo mysql_result($result,0,9);} ?>"></td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td>
		    País: &nbsp;&nbsp;  		    
		  </td>
          <td>
		    <select onChange="changePais(this.value);" name="fPais">
			  <option value="" selected>---Escolha uma opção---</option>
			  <?php include('sql/consultaPais.php'); ?>
			</select>		    
			<div id="divestados" style="position:absolute; margin-top:0px; margin-left:10px;"></div>
			<div id="divcidades" style="position:absolute; margin-top:0px; margin-left:230px;"></div>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td>E-mail:</td>
          <td>
		    <input name="fEmail" type="text" 
			  style="text-transform:lowercase" value="<?php echo $POST['fEmail']; ?>" size="60" maxLength="80"> 
		    &nbsp; &nbsp; 
			Toca Violão:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
			<select name="fViolao">
			  <option value="N" selected>Não</option>
			  <option value="S">Sim</option>
			</select>
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td>Profissão:</td>
          <td>
		    <input name="fProfissao" value="<?php echo $POST['fProfissao']; ?>" size=60 maxLength=80> 
		    &nbsp; &nbsp; 
			Dirigente de C.E.:&nbsp; 
			<select name="fDirigente">
			  <option value="N" selected>Não</option> 
			  <option value="S">Sim</option> 
			</select>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td>Responsável:</td>
          <td vAlign=center>
		    <input type=hidden name="fResponsavel"> 
			<input class=txtRO readOnly maxLength=80 size=60 name="fNomeResponsavel">
            &nbsp; <img style="CURSOR: hand" onClick="findResponsavel();" height=17 alt=Procurar src="imagens/lupa.gif" width=17 
			align=absMiddle border=0> (para crianças) 
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td>Centro Espírita:</td>
          <td vAlign=center>
		    <input type=hidden name="fCodOrigem">
			 <input class=txtRO readOnly maxLength=80 size=60 name="fNomeOrigem"> 
			 &nbsp; <img style="CURSOR: hand" onClick="findOrigem();" height=17 alt=Procurar src="imagens/lupa.gif" width=17 
            align=absMiddle border=0>
		  </td>
		</tr>
        <tr>
          <td colSpan=2 >
            <TABLE width="100%" border=0>
              <TBODY>
              <tr>
                <td vAlign=top width="50%">
                  <FIELDSET>
				    <LEGEND>
					  <SPAN style="FONT-WEIGHT: bold">Telefones</SPAN>
					</LEGEND>
                  <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                    <TBODY>
                    <tr>
                      <td width="11%" height=26>DDD</td>
                      <td width="14%"><input class=txtNumero maxLength=2 size=4 name="fDDDResid" onBlur="atribuiDDD(this);"></td>
                      <td width="18%">Residencial: </td>
                      <td width="57%"><input class=txtNumero maxLength=8 size=10 name="fResidencial"></td></tr>
                    <tr bgColor=#f6f6f6>
                      <td>DDD</td>
                      <td><input class=txtNumero maxLength=2 size=4 name="fDDDComerc" id="fDDDComerc"></td>
                      <td>Comercial: </td>
                      <td><input class=txtNumero maxLength=8 size=10 name="fComercial"></td></tr>
                    <tr>
                      <td>DDD</td>
                      <td><input class=txtNumero maxLength=2 size=4 name="fDDDCel" id="fDDDCel"></td>
                      <td>Celular: </td>
                      <td height=30><input class=txtNumero maxLength=8 size=10 name="fCelular"></td>
					</tr>
				  </tbody>
				</table>
				</FIELDSET> 
			  </td>
                <td vAlign=top width="50%">
                  <FIELDSET>
				  <LEGEND>
				    <SPAN style="FONT-WEIGHT: bold">Particularidades</SPAN>
				  </LEGEND>
                  <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                    <TBODY>
                    <tr>
                      <td width="11%" height=26>Doença: </td>
                      <td><input maxLength=80 size=60 name="fDoenca"></td></tr>
                    <tr bgColor=#f6f6f6>
                      <td>Medicamento: </td>
                      <td><input maxLength=80 size=60 name="fMedicamento"></td></tr>
                    <tr>
                      <td vAlign=top height=30>Observação:</td>
                      <td><textarea name="fObservacao" cols=40></textarea></td>
					</tr>
				    </tbody>
				  </table>
				  </FIELDSET> 
                </td>
			  </tr>
			</tbody>
		  </table>
		</td>
		</tr>
<?php /*
        <tr bgColor=#f6f6f6>
          <td vAlign="center">
		  Trabalhador: &nbsp;
		    <select name="fTrabalhador" onChange="HabilitaComissao();">
			  <option value="N" selected>Não</option>
			  <option value="S">Sim</option> 
			</select>
		  </td>
		  <td>
			<div id="divComissao" style="visibility:hidden">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Comissão: &nbsp;&nbsp;&nbsp; 
			  <select name="fComissao">
			    <option value="" selected></option> 
			    <?php include('sql/consultaComissao.php'); ?>
              </select> 
			</div>
		  </td>
		</tr>
		*/
?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
		</tr>
        <tr>
          <td colSpan=2>
            <table border=0>
              <tbody>
              <tr>
                <td vAlign=center><font face="Arial, Helvetica, sans-serif" size=1><b>Digite o código ao lado:</b></font></td>
                <td vAlign=center><input style="FONT-WEIGHT: bold; FONT-SIZE: 12px" maxLength="6" size="12" name="captchaCode"> &nbsp; 54632154</td>
              </tr>
			  </tbody>
			</table>
		  </td>
		</tr>
        <tr align=middle>
          <td align=middle colSpan=2 height=30>
            <div id="divConfirmar" style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; WIDTH: 98%; PADDING-TOP: 5px; BACKGROUND-COLOR: #e0e0e0" align=center>
			<input id="btConfirmar" style="FONT-WEIGHT: bold; FONT-SIZE: 12px" onClick="submitConfirmarCadastroPF();" type="button" 
			 value="Confirmar Cadastro" name="btConfirmar">
            </div>
            <div id='divLoading'
            style="BORDER-RIGHT: #666666 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #666666 1px solid; DISPLAY: none; PADDING-LEFT: 5px; 
			VISIBILITY: hidden; PADDING-BOTTOM: 5px; BORDER-LEFT: #666666 1px solid; WIDTH: 50%; PADDING-TOP: 5px; 
			BORDER-BOTTOM: #666666 1px solid; BACKGROUND-COLOR: #ffffff" align=center>
			<img src="imagens/loader.gif" align=absMiddle border=0><BR>Enviando formulário... </div>
		  </td>
		</tr>        
      </tbody>
	</table>
  </form>
</td>
</tr>
  <tr>
    <td vAlign=center align=middle bgColor=#333333 height=20>
	  <a style="COLOR: #ffffff" href="http://www.concafras.com.br/">http://www.concafras.com.br/</a>
	</td>
  </tr>
</TBODY>
</TABLE>
</body>
</html>