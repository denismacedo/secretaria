<?php

include("headerPop.php");

?>
      <FORM name=cadastroForm  action=doInscricao.php?method=getResponsaveis method=post>
	  <INPUT type=hidden name=tipoPF> 
      <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
        <TBODY>
        <TR>
          <TD><B>Nome: </B><INPUT maxLength=80 size=50 name="nome" id="nome" value="<?php echo getPost("nome"); ?>"> <INPUT 
            style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
            type=image src="../imagens/lupa.gif" align=absMiddle> 
            &nbsp;&nbsp;&nbsp; <!--<A title="Inserir novo" 
            style="FONT-WEIGHT: bold; TEXT-DECORATION: none" 
            href="javascript: submitNovaOrigem();"><IMG 
            style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
            alt="Inserir novo" src="../imagens/icon_new.png" 
            align=absMiddle>Inserir novo</A> --> <span style="color:#006666;">Filtre os resultados no campo ao lado</span></TD></TR>
        <TR>
          <TD>
		  
		  <?php
		  
		  	echo $RESPONSAVEIS;
		  
		  ?>
		  
		  
           </TD>
		</TR>
		
		
		
		</TBODY>
		</TABLE>
		</FORM>

<?php

include("footerPop.php");

?>