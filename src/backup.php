<?php include("header.php"); ?>

<tr>
    <td><form name="cadastroForm" method="post" action="doBackup.php?method=execute"> <table align="center" border="0" cellpadding="2" cellspacing="1" width="700">
      <tbody><tr bgcolor="#333333">
        <td colspan="2" height="25"><span style="color: rgb(255, 255, 255)">Arquivo de inscri&ccedil;&otilde;es para envio </span></td>
        </tr>
      <tr bgcolor="#f0f0f0">
        <td colspan="2" class="explicacao" height="20">Clique no bot&atilde;o abaixo para gerar o arquivo </td>
        </tr>
	  <input type="hidden" name="tipoPF" value="1"/>
	  
      <tr bgcolor="#f9f9f9">
        <td height="20">&nbsp;</td>
        <td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
		<?php
		
			if (isset($_SESSION["OCORRENCIA_SESSION"]) && $_SESSION["OCORRENCIA_SESSION"] != "") {
				?>
					<td align="center">
					  <p><br/>
					    <input type="submit" style="font-weight:bold; background-color:#336699; font-size:16px; color:#FFFFFF;" value="Gerar Arquivo" name="btIniciar" id="btIniciar" alt="Clique aqui para iniciar o backup" title="Clique aqui para iniciar o backup"/>
				        <br/>
					    <br/>
			        </p>
				    <p class="labelTitRel"><span class="style1">Aten&ccedil;&atilde;o:</span><br />
			          <span class="labelCurso">&Eacute; muito importante que ap&oacute;s a gera&ccedil;&atilde;o do arquivo o mesmo seja enviado para o seguinte e-mail</span>: <span class="style2">bancodedados@concafras.com</span><br />
			              <br />
		                <br />
				      <br />
				    </p></td>
								<?php
			}
		
		?>
				</tr>
			</table>		</td>
      </tr>
      

    </table>
    </form></td>
  </tr>
  

  
<?php include("footer.php"); ?>