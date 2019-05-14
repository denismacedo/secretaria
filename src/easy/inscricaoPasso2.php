<?php 

include ("header.php");

$try = true;

?>
<div class="row" style=" width: 100%; margin: 0 auto;">
<div class="col-md-8 col-xs-12" style=" width: 100%; margin: 0 auto;">
                        <div class="white-box">
							<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
        					  <tr bgcolor="#333333">
								<td height="40" colspan="2" bgcolor="#999999">
								<span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 14px;">&nbsp;Passo 2 de 2: Informe alojamento, cursos e comiss&atilde;o e clique em Confirmar. </span></td>
							  </tr>
							</table>
							<br/>
							<script language="javascript" type="text/javascript" src="../js/auto/inscricao.js"></script>
							<form name="inscricaoForm" action="doInscricao.php" method="post" class="form-horizontal form-material">
							 <input name="codPF" id="codPF" value="<?php echo getAltPost(@$objInscricao->pessoa_fisica, 'codPF', true); ?>" type="hidden">
							 <input name="codInscricao" id="codInscricao" value="<?php echo getAltPost(@$objInscricao->codigo, 'codInscricao', true); ?>" type="hidden">
							 <input name="nome" id="nome" maxlength="80" size="60" value="<?php echo @$objPF->nome; ?>" type="hidden" readonly class="txtRO">
							 <input name="nroInscricao" id="nroInscricao" maxlength="20" size="20" value="<?php echo formatNumber(getAltPost(@$objInscricao->nro_inscricao, 'nroInscricao', true), 5); ?>" readonly="readonly" class="txtNumeroRO" type="hidden">
							 
								<div class="form-group">
                                    <label class="col-md-12">Nome</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" class="form-control form-control-line"  name="nome" id="nome" maxlength="80" size="60" value="<?php echo @$objPF->nome; ?>" readonly STYLE="background-color: #f0f0f9">
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-12">Informe onde ficar&aacute; alojado:</label>
                                    <div class="col-sm-12">
										 <?php
			  
										  if (isset($selectTipoAlojamento) && $selectTipoAlojamento != "") {
											echo $selectTipoAlojamento;
										  }
										  
										  ?>
									 </div>
								</div>
								<div class="form-group" id="divComissao">
                                    <label class="col-sm-12">Informe a Comiss&atilde;o de Trabalho se for trabalhar no evento:</label>
                                    <div class="col-sm-12">
								
									  <?php
									  
									  if (isset($selectComissoes) && $selectComissoes != "") {
										echo $selectComissoes;
									  }
									  
									  ?> 
									</div>
								</div>
								<?php 	
								if (isset($selectTemasAtuais1) && $selectTemasAtuais1 != "") {								
								?>
								<div class="form-group">
                                    <label class="col-sm-12">Selecione o Tema Atual para Estudo:</label>
                                    <div class="col-sm-12">
										<select class="form-control form-control-line" name="temasAtuaisOp1" id="temasAtuaisOp1">
										  <?php
												echo $selectTemasAtuais1;
											  ?> 
										 </select>
									 </div>
								</div>
								<?php 
								} 
								?>
								<?php 	
								if (isset($selectTemasEspecificos1) && $selectTemasEspecificos1 != "") {								
								?>
								<div class="form-group">
                                    <label class="col-sm-12">Selecione o Tema Espec&iacute;fico para Estudo:</label>
                                    <div class="col-sm-12">
										<select class="form-control form-control-line" name="temasEspecificosOp1" id="temasEspecificosOp1">
										  <?php
												echo $selectTemasEspecificos1;
											  ?> 
										 </select>
									 </div>
								</div>
								<?php 
								} 
								?>
								<div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" onClick="submitConfirmarInscricao();">Confirmar</button>
                                    </div>
                                </div>
							</form>
                        </div>
                    </div>
                </div>
<?php include ("footer.php"); ?>