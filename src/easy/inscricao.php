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
								<span style="color: rgb(255, 255, 255); font-weight: bold; font-size: 14px;">&nbsp;Passo 1 de 2: Informe os dados abaixo e clique no bot&atilde;o Confirmar. </span></td>
							  </tr>
							</table><br/>
                            <form name="cadastroForm" method="post" action="" class="form-horizontal form-material">
								<input type="hidden" name="tipoPF" value="1"/>
								<input type="hidden" name="evento" value="<?php echo $_SESSION["EVENTO_SESSION"]; ?>"/>
								<input type="hidden" name="ocorrencia" value="<?php echo $_SESSION["OCORRENCIA_SESSION"]?>"/>
								<div class="form-group">
                                    <label class="col-md-12">CPF</label>
                                    <div class="col-md-12">
                                        <input type="number" placeholder="INFORME O CPF SE HOUVER" class="form-control form-control-line" name="cpf" id="cpf" maxlength="15" size="20" value="<?php echo getAltPost(@$objPF->cpf, 'cpf', $try); ?>">
									</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Nome Completo</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="INFORME O NOME SEM ACENTOS" class="form-control form-control-line"  name="nome" id="nome" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->nome, 'nome', $try); ?>" >
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Nome para Crach&aacute;</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="DEIXE EM BRANCO PARA USAR O NOME" class="form-control form-control-line"  name="apelido" id="apelido" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->apelido, 'apelido', $try); ?>" >
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Data de Nascimento</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="DD/MM/AAAA" class="form-control form-control-line" name="dataNasc" maxlength="10" size="14" value="<?php echo getAltPost(formatDate(@$objPF->data_nasc), 'dataNasc', $try); ?>" onKeyPress="ehNumerico(this); mascaraData(this)" onBlur="validaData(this);"> 
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Sexo</label>
                                    <div class="col-md-12">
										<input type="radio" name="sexo" value="M" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'M'); ?> >
										Masculino
										&nbsp;<input type="radio" name="sexo" value="F" <?php echo getChecked(getAltPost(@$objPF->sexo, 'sexo', $try), 'F'); ?> >
										Feminino
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-12">Selecione o Pa&iacute;s</label>
                                    <div class="col-sm-12">
										<select class="form-control form-control-line" name="pais" id="pais" onchange="changePais(this.value);" placeholder="SELECIONE O PAIS NA LISTA">
											<option selected></option>
											<?php echo $paises; ?>
										</select>
									 </div>
								</div>
								<?php if (isset($estados) && $estados != "") { ?>
								<div class="form-group" id="divEstado" >
                                    <label class="col-sm-12">Selecione o Estado</label>
                                    <div class="col-sm-12" id="divUF" >
										<?php echo $estados; ?>
									</div>
								</div>
								<?php } else {	?>
								<div class="form-group" id="divEstado" style="display:none; visibility:hidden;">
                                    <label class="col-sm-12">Selecione o Estado</label>
                                    <div class="col-sm-12" id="divUF" style="display:none; visibility:hidden;">
									</div>
								</div>
								<?php } ?>
								<?php if (isset($cidades) && $cidades != "") { ?>
								<div class="form-group" id="divCid" >
                                    <label class="col-sm-12">Selecione a Cidade</label>
                                    <div class="col-sm-12" id="divCidade" >
										<?php echo $cidades; ?>
									</div>
								</div>
								<?php } else {	?>
								<div class="form-group" id="divCid" style="display:none; visibility:hidden;">
                                    <label class="col-sm-12">Selecione a Cidade</label>
                                    <div class="col-sm-12" id="divCidade" style="display:none; visibility:hidden;">
									</div>
								</div>
								<?php } ?>
                                <div class="form-group">
                                    <label class="col-md-12">E-mail</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="INFORME UM E-MAIL DE CONTATO" class="form-control form-control-line" name="email" id="email" maxlength="80" size="60" value="<?php echo getAltPost(@$objPF->email, 'email', $try); ?>">
									</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12">Telefones para contato</label>
                                    <div class="col-md-12">
                                        Telefone 1:  
										(<input style"text-align:right;" placeholder="" name="ddd" maxlength="2" size="3" value="<?php echo getAltPost(@$objPF->ddd, 'ddd', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);">)
                                        <input placeholder="" name="residencial" maxlength="9" size="12" value="<?php echo getAltPost(@$objPF->telRes, 'residencial', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);">
										&nbsp; Telefone 2: 
										(<input style"text-align:right;" placeholder="" name="ddd2" maxlength="2" size="3" value="<?php echo getAltPost(@$objPF->ddd, 'ddd2', $try); ?>" class="txtNumero" type="text">)
                                        <input placeholder="" name="celular" maxlength="9" size="12" value="<?php echo getAltPost(@$objPF->telCel, 'celular', $try); ?>" class="txtNumero" type="text" onKeyPress="ehNumerico(this);">
										
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Centro Esp&iacute;rita</label>
                                    <div class="col-md-12">
                                        <input name="codOrigem" id="codOrigem" value="<?php echo getAltPost(@$objPF->objOrigem->pj, 'codOrigem', $try); ?>" type="hidden">
										<input placeholder="Selecione na lupa" name="origem" id="origem" maxlength="80" size="50" value="<?php echo getAltPost(@$objPF->objOrigem->nomePJ, 'origem', $try); ?>"  type="text" class="txtRO" readonly>
										&nbsp; <a href="#" title="Procurar Centro Esp&iacute;rita"><img style="cursor:hand;" src="../imagens/lupa.gif" alt="Procurar Centro Esp&iacute;rita" onclick="javascript:findOrigem();" align="absmiddle" border="0" width="17" height="17"></a>&nbsp;&nbsp;&nbsp;&nbsp;N&atilde;o encontrou seu centro? <a href="#" onClick="javascript:exibeCadCentro();">Clique aqui!</a>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-12">Voc&ecirc; &eacute; Dirigente de Centro Esp&iacuterita?</label>
                                    <div class="col-sm-12">
										<input type="radio" name="dirigente" value="S" <?php echo getChecked(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'S'); ?>>Sim
										&nbsp;<input type="radio" name="dirigente" value="N" <?php echo getChecked(getAltPost(@$objPF->dirigente_centro, 'dirigente', $try), 'N'); ?>>N&atilde;o
									 </div>
								</div>
								<div class="form-group">
                                    <label class="col-sm-12">Voc&ecirc; &eacute; Vegetariano?</label>
                                    <div class="col-sm-12">
										<input type="radio" name="vegetariano" value="S" <?php echo getChecked(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'S'); ?>>Sim
										&nbsp;<input type="radio" name="vegetariano" value="N" <?php echo getChecked(getAltPost(@$objPF->vegetariano, 'vegetariano', $try), 'N'); ?>>N&atilde;o
									 </div>
								</div>
								<div class="form-group">
                                    <label class="col-md-12">Nome/Contato do Respons&aacute;vel (para crian&ccedil;as)</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Informe o nome e o telefone" class="form-control form-control-line"  name="contato_responsavel" id="contato_responsavel" maxlength="98" size="60" value="<?php echo getAltPost(@$objInsc->contato_responsavel, 'contato_responsavel', $try); ?>" >
									</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Cuidados/Necessidades Especiais</label>
                                    <div class="col-md-12">
                                        <textarea name="obs" rows="2" class="form-control form-control-line"><?php echo getAltPost(@$objPF->objParticularidade->observacao, 'obs', $try); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" onclick="submitSalvar();">Confirmar</button>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<!--button class="btn btn-default" onclick="window.locaton.href='../concafras2018/'; return false;">Limpar</button-->
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

<script>
document.cadastroForm.cpf.focus();
</script>
<?php include ("footer.php"); ?>