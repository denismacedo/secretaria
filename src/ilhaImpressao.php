<?php 
	
	require_once("util/http.php");
	require_once('util/comum.php');
	require_once('sql/conexao.php'); 

	include("header.php"); 

?>



<script language="JavaScript" src="js/cadastroPJ.js">
</script>
<style>
.lineHover:hover {
	background-color: yellow;
}
</style>

<tr>
    <td>
	
		<table align="center" width="100%">
		<tbody>
		<tr>
			<td colspan="7" class="labelTitRel" align="center" height="30"><span style="font-weight: bold;">Inscri&ccedil;&otilde;es para Impress&atilde;o </span>&nbsp;&nbsp;&nbsp;<a title="Clique para atualizar" href="ilhaImpressao.php">Atualizar <img src="imagens/refresh.png" border="0" align="absmiddle" /></a></td>
		</tr>
  <tr>
  	
  </tr><tr class="labelColRel" bgcolor="#cccccc">
			<td width="2" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">NRO INSCRI&Ccedil;&Atilde;O</span></td>
			<td width="200" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">NOME</span></td>
			<td width="80" height="30" class="labelColRel"><span style="font-weight: bold; font-size: 11px">CIDADE</span></td>
			<td height="30" width="15%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">DATA INSCRI&Ccedil;&Atilde;O</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">CRACH&Aacute; IMPRESSO</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px">OBS</span></td>
			<td height="30" width="5%" class="labelColRel" align="center"><span style="font-weight: bold; font-size: 11px"></span></td>
		</tr>

  
  <?php 
		
		$sql = "select a.nro_inscricao, b.codigo as codigo, b.nome, b.unidade_da_federacao, b.cidade, b.pais, a.data_hora_insercao as data, a.cracha_impresso, b.vegetariano
		 from inscricao a, pessoa_fisica b		
				where a.evento = ".$_SESSION["EVENTO_SESSION"]." and a.ocorrencia = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and a.pessoa_fisica = b.codigo
				order by a.nro_inscricao desc";
		
		
		$resultado = mysql_query($sql);
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			for ($i = 0; $i < $linhas; $i++) {
			
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#F6F6F6";
					} else {
						$bgcolor = "#FFFFFF";
					}
				
					?>
						<tr class="lineHover" bgcolor="<?php echo $bgcolor; ?>" height="30">
							<td width="10" align="center" style="color:#000099;font-size:12px;"><b><?php echo formatNumber(mysql_result($resultado, $i, "nro_inscricao"), 4); ?></b></td>
							<td width="200"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<td><?php echo mysql_result($resultado, $i, "cidade")." / ".mysql_result($resultado, $i, "unidade_da_federacao");?></td>
							<td align="center"><?php echo formatDateTime(mysql_result($resultado, $i, "data")); ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "cracha_impresso") == 'S') { echo "SIM"; } else { echo "NAO"; }; ?></td>
							<td align="center"><?php if (mysql_result($resultado, $i, "vegetariano") == 'S') { echo "<span style='color:#fff;background-color:#00cc33'>VEGETARIANO</span>"; } else { echo "-"; }; ?></td>
							<td align="center"><a target="_blank" href="doInscricao.php?method=printCracha&codPF=<?php echo mysql_result($resultado, $i, "codigo");?>"><b>Imprimir</b></a></td>
						</tr>
					<?php
				
			}
		}

?>
		<tr class="labelColRel" bgcolor="#FFFFFF">
			<td height="30" class="labelColRel" colspan="7" style="text-align:right;"><span style="font-weight: bold; font-size: 14px">Total de inscri&ccedil;&otilde;es: <?php echo $linhas; ?></td>
		</tr>
	</tbody></table>
	</td>
</tr>
   
<?php
	include("footer.php"); 
 ?>