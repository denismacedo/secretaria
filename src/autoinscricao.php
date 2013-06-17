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
</script>
</HEAD>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <tr>
    <td class="tituloheader" align=middle 
    background=imagens/bg_top.jpg height=40>
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
      <form name='cadastroform' action='sql/insertautoinscricao.php' method='post'>
	    <input type='hidden' name='fCodigo'>
		<input type='hidden' value='1' name='fTipoPF'> 
      <TABLE cellSpacing=1 cellPadding=2 width=700 align=center border=0>
        <TBODY>
        <tr bgColor=#333333>
          <td colSpan=2 height=25>
		  <SPAN style="FONT-WEIGHT: bold; COLOR: #ffffff">&nbsp;Inscrição para CONCAFRAS 2009 - CATALAO </SPAN></td></tr>
        <tr bgColor=#f0f0f0>
          <td class=explicacao colspan="2" height=20>
            <TABLE style="FONT-SIZE: 12px; COLOR: #000000" cellSpacing=2 
            cellPadding=1 width="100%" border=0>
              <TBODY>
              <tr>
                <td>Preencha o formulário abaixo e clique em Confirmar Inscrição</td></tr>
			  </tbody>
			 </table>
		   </td>
		 </tr>
        <tr>
          <td height=20>Nome:</td>
          <td vAlign=center><input maxLength=80 size=60 name="fNome"></td></tr>
        <tr bgColor=#f6f6f6>
          <td height=20>Data de Nascimento: </td>
          <td vAlign=center colspan="2">
		    <input maxLength=10 size=14 name="fDataNasc" onKeyUp="mascaraData(this);"> 
            (dd/mm/aaaa) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexo:&nbsp; 
            <select name="fSexo">
			  <option value="M" selected>Masculino</option>
			  <option value="F">Feminino</option>
			</select>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td height=20>Rua:</td>
          <td>
		    <input maxLength=80 size=60 name="fRua"> &nbsp;&nbsp;Nro:&nbsp;&nbsp; 
			<input class=txtNumero maxLength=10 size=12 name="fNro">
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td height=20>Complemento:</td>
          <td>
		    <input maxLength=80 size=60 name="fComplemento"> &nbsp;&nbsp;CEP:&nbsp; 
		    <input class=txtNumero maxLength=10 size=12 name="fCep"> (somente números)
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td height=20>Bairro:</td>
          <td><input maxLength=80 size=60 name="fBairro"></td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td height=20>País:</td>
          <td>
		    <select onChange="changePais(this.value);" name="fPais">
			  <option value="" selected>---Escolha uma opção---</option>
			  <?php include('sql/consultaPais.php'); ?>
			</select>
			<div id="divestados"></div>
			<div id="divcidades"></div>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td height=20>E-mail:</td>
          <td>
		    <input maxLength=80 size=60 name="fEmail">
			&nbsp;&nbsp;Toca Violão:&nbsp;&nbsp; 
			<select name="fViolao">
			  <option value="N" selected>Não</option>
			  <option value="S">Sim</option>
			</select>
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td height=20>Profissão:</td>
          <td>
		    <input maxLength=80 size=60 name="fProfissao"> 
            &nbsp;&nbsp;Dirigente de C.E.:&nbsp; 
			<select name="fDirigente">
			  <option value="N" selected>Não</option> 
			  <option value="S">Sim</option> 
			</select>
		  </td>
		</tr>
        <tr bgColor=#ffffff>
          <td height=20>Responsável:</td>
          <td vAlign=center>
		    <input type=hidden name="fCodResponsavel"> 
			<input class=txtRO readOnly maxLength=80 size=60 name="fResponsavel">
            &nbsp; <img style="CURSOR: hand" onclick="findResponsavel();" height=17 alt=Procurar src="imagens/lupa.gif" width=17 
			align=absMiddle border=0> (para crianças) 
		  </td>
		</tr>
        <tr bgColor=#f6f6f6>
          <td height=20>Centro Espírita:</td>
          <td vAlign=center>
		    <input type=hidden name="fCodOrigem"> 
			<input class=txtRO readOnly maxLength=80 size=60 name="fOrigem"> 
			&nbsp; <img style="CURSOR: hand" onclick="findOrigem();" height=17 alt=Procurar src="imagens/lupa.gif" width=17 
            align=absMiddle border=0>
		  </td>
		</tr>
        <tr>
          <td colSpan=2 height=20>
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
                      <td><input class=txtNumeroRO readOnly maxLength=2 size=4 name="fDDDComerc" id="fDDDComerc"></td>
                      <td>Comercial: </td>
                      <td><input class=txtNumero maxLength=8 size=10 name="fComercial"></td></tr>
                    <tr>
                      <td>DDD</td>
                      <td><input class=txtNumeroRO readOnly maxLength=2 size=4 name="fDDDCel" id="fDDDCel"></td>
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
                      <td><textarea name="fObs" cols=40></textarea></td>
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
        <tr bgColor=#f6f6f6>
          <td height=20>Trabalhador:</td>
          <td vAlign=center>
		    <select name="fTrabalhador">
			  <option value="N" selected>Não</option>
			  <option value="S">Sim</option> 
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Comissão: &nbsp;&nbsp;&nbsp; 
			<select name="fComissao">
			  <option value="" selected></option> 
			  <?php include('sql/consultaComissao.php'); ?>
            </select> </td></tr>
        <tr>
          <td height=20>Alojamento:</td>
          <td vAlign=center>
		    <select name="fAlojamento">
			  <option value="1" selected>DO EVENTO</option> 
			  <option value="2">EM HOTEL OU POUSADA</option>
			  <option value="3">EM CASA PROPRIA, DE AMIGOS OU PARENTES</option>
			</select>
		  </td>
		</tr>
        <tr>
          <td height=10></td>
          <td></td></tr>
        <tr>
          <td colSpan=2>
            <table border=0>
              <tbody>
              <tr>
                <td vAlign=center><font face="Arial, Helvetica, sans-serif" size=1><b>Digite o código ao lado:</b></font></td>
                <td vAlign=center><input style="FONT-WEIGHT: bold; FONT-SIZE: 12px" maxLength=6 size=12 name="captchaCode"></td>
              </tr>
			  </tbody>
			</table>
		  </td>
		</tr>
        <tr align=middle>
          <td align=middle colSpan=2 height=30>
            <div id=divConfirmar style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; WIDTH: 98%; PADDING-TOP: 5px; BACKGROUND-COLOR: #e0e0e0" align=center>
			<input id="btConfirmar" style="FONT-WEIGHT: bold; FONT-SIZE: 12px" onClick="loading();" type="submit" 
			  value="Confirmar Inscrição" name="btConfirmar">
            </div>
            <div id=divLoading 
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
</BODY>
</HTML>