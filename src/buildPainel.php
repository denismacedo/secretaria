<?php
require_once('sql/conexao.php'); 

require_once('util/http.php'); 
require_once('util/comum.php'); 
include("sessionValidate.php"); 
header("Content-Type: text/html; charset=ISO-8859-1");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body style="font-size:10px; font-weight:bold; font-family:Arial, Helvetica, sans-serif">

<?php 

$sql = "select e.qualif_evento, a.nome, a.capacidade, count(c.inscricao) as inscritos, a.capacidade - count(c.inscricao) as vagas from sub_ocorrencia a LEFT OUTER JOIN participante c ON (a.evento= c.evento and a.ocorrencia= c.ocorrencia and a.codigo = c.sub_ocorrencia), ocorrencia b, evento e
where a.evento = b.evento
and a.ocorrencia = b.codigo
and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]."
and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]."
and b.evento = e.codigo
and e.tipo_evento = 1
group by e.qualif_evento, a.nome, a.capacidade
order by nome asc";
		
		
		$resultado = mysql_query($sql);	
?>


<table align="center" width="100%" cellpadding="0" cellspacing="1">
<tr><td valign="top">

<table align="center" width="100%" cellpadding="0" cellspacing="0">
		<tbody>
<tr class="labelColRel" bgcolor="#666699" style="font-size:13px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#FFFF00;">
			<td height="20" class="labelColRel" width="70%"><span style="font-weight: bold;">TEMAS ATUAIS</span></td>
			<!--<td height="30" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">CAPACIDADE</span></td>
			<td height="20" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">INSCRITOS</span></td>-->
			<td height="20" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">VAGAS</span></td>
			</tr>

  
  <?php 
		
		
		
		$totalCap = 0;
		$totalInsc = 0;
		$totalVag = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$pessoa = "";
			for ($i = 0; $i < $linhas; $i++) {
			$qualif = mysql_result($resultado, $i, "qualif_evento");
			if (mysql_result($resultado, $i, "vagas") > 0 && $qualif == "2") {
			
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#ccf0f0";
					} else {
						$bgcolor = "#FFFFFF";
					}
					
					 
					$qualif = "";
					
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="15" style="font-size:10px; font-weight:bold; font-family:Arial, Helvetica, sans-serif">
							<td style="font-size:10px;"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<!--<td align="center"><?php echo mysql_result($resultado, $i, "capacidade"); ?></td>
							<td align="center"><?php echo mysql_result($resultado, $i, "inscritos"); ?></td>-->
							<td align="center" style="font-size:10px;"><?php if (mysql_result($resultado, $i, "vagas") > 0) { echo mysql_result($resultado, $i, "vagas");} else {echo "ESGOTADO!";} ?></td>
						</tr>
					<?php
					
					$totalCap += mysql_result($resultado, $i, "capacidade");
					$totalInsc += mysql_result($resultado, $i, "inscritos");
					$totalVag += mysql_result($resultado, $i, "vagas");
					
					}
			}
		}

?>
			
	</tbody></table>
</td>
<td valign="top">

<table align="center" width="100%" cellpadding="0" cellspacing="0">
		<tbody>
<tr class="labelColRel" bgcolor="#666666" style="font-size:13px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#FFFF00;">
			<td height="20" class="labelColRel" width="70%"><span style="font-weight: bold;">TEMAS ESPECIFICOS</span></td>
			<!--<td height="30" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">CAPACIDADE</span></td>
			<td height="20" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">INSCRITOS</span></td>-->
			<td height="20" class="labelColRel" width="10%" align="center"><span style="font-weight: bold;">VAGAS</span></td>
			</tr>

  
  <?php 
		
		
		
		$totalCap = 0;
		$totalInsc = 0;
		$totalVag = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		
			$cor = false;
			$pessoa = "";
			for ($i = 0; $i < $linhas; $i++) {
			$qualif = mysql_result($resultado, $i, "qualif_evento");
			if (mysql_result($resultado, $i, "vagas") > 0 && $qualif == "1") {
			
					$cor = !$cor;
					
					if ($cor) {
						$bgcolor = "#cccccc";
					} else {
						$bgcolor = "#FFFFFF";
					}
					
					
					$qualif = "";
					
				
					?>
						<tr bgcolor="<?php echo $bgcolor; ?>" height="15" style="font-size:10px; font-weight:bold; font-family:Arial, Helvetica, sans-serif">
							<td style="font-size:10px;"><b>&nbsp;<?php echo mysql_result($resultado, $i, "nome"); ?></b></td>
							<!--<td align="center"><?php echo mysql_result($resultado, $i, "capacidade"); ?></td>
							<td align="center"><?php echo mysql_result($resultado, $i, "inscritos"); ?></td>-->
							<td align="center" style="font-size:10px;"><?php if (mysql_result($resultado, $i, "vagas") > 0) { echo mysql_result($resultado, $i, "vagas");} else {echo "ESGOTADO!";} ?></td>
						</tr>
					<?php
					
					$totalCap += mysql_result($resultado, $i, "capacidade");
					$totalInsc += mysql_result($resultado, $i, "inscritos");
					$totalVag += mysql_result($resultado, $i, "vagas");
					
					}
			}
		}

?>
			
	</tbody></table>
</td>
</tr>
</table>

</body>
</html>