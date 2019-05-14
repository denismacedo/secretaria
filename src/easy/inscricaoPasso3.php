<?php 

include ("header.php");

$try = true;

?>
<div class="row" style=" width: 100%; margin: 0 auto;">
<div class="col-md-8 col-xs-12" style=" width: 100%; margin: 0 auto;">
                        <div class="white-box">
							<br/>
							<script language="javascript" type="text/javascript" src="../js/auto/inscricao.js"></script>
							<form method="post" name="inscricaoForm" id="inscricaoForm" class="form-horizontal form-material">

							<p align="center"><strong><span style="color:#009933; font-size:24px;">Prontinho!</span></strong></p>
							
	<input type="hidden" name="codInscricao" id="codInscricao" value="<?php echo @$objInscricao->codigo; ?>" />
<br/><br/>
  	Nome: &nbsp;&nbsp; <b><?php echo getAltPost(@$objPF->nome, 'nome', $try); ?></b>
              <input name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->nome, 'nome', $try); ?>" type="hidden" readonly="readonly" class="txtRO" />
         
         <br />
            

            
            Anote o n&uacute;mero da sua inscri&ccedil;&atilde;o: <span style="font-size:26px; font-weight:bold;"> <?php echo formatNumber(@$objInscricao->nro_inscricao, 5); ?></span>
			
			<br /><br>
			<?php if (isset($_SESSION["USER_SESSION"])) {?>
			<!--div class="form-group">
				<div class="col-sm-12">
					<button class="btn btn-success" onclick="document.inscricaoForm.target='_blank'; document.inscricaoForm.action='../doInscricao.php?method=printCracha&codPF=<?php echo @$objPF->codigo;?>';">Imprimir Crach&aacute;</button>
				</div>
			</div-->
		<?php }?>
			<br><br>

       
	<p align="center" ><a NAME="NEW" href="doInscricao.php?method=init"><b>Clique aqui</b> para fazer nova inscri&ccedil;&atilde;o</a>
	</p>
       
</form>
 </div>
                    </div>
                </div>

<?php include ("footer.php"); ?>