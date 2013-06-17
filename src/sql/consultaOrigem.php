<?php
   require_once('conexao.php'); 
   include_once("searchPJ.php");
?>
<html>
<head>
<script>
function colaPJ(cod, nome) 
{
	window.opener.document.cadastroform.fCodOrigem.value = cod;
	window.opener.document.cadastroform.fNomeOrigem.value = nome;
	window.close();
}
</script>
<TITLE>..:: CONCAFRAS - Consulta de Centro Espírita ::..</TITLE>
<LINK href="../CSS/estilo.css" type=text/css rel=stylesheet>
</head>
<body>
<form name="formConsultaPJ">
  <table border="1" width="99%" height="100%" cellspacing="0" cellpadding="0"> 
    <tr>
	  <td class="labelColRel" align='center' width="20">(x)</td>
	  <td class="labelColRel">Nome</td>
	  <td class="labelColRel">Bairro</td>
	  <td class="labelColRel">Cidade / Estado</td>
	</tr>
<?php
  $consulta = new searchPJ();
  $result = $consulta->search();
  $linhas = mysql_num_rows($result);  
  for($x=0; $x < $linhas; $x++)
  { 
  	echo "<tr>";
    echo "<td class='txt'><a href=javascript:colaPJ(".mysql_result($result,$x,"codigo").",'".mysql_result($result,$x,"nome")."');><img src='../imagens/voltar.gif' border='0'></a></td>";
	echo "<td class='txt'>".mysql_result($result,$x,"nome")."</td>";
	echo "<td class='txt'>".mysql_result($result,$x,"bairro")."</td>";
	echo "<td class='txt'>".mysql_result($result,$x,"cidade")." / ".mysql_result($result,$x,"unidade_da_federacao")."</td>";
	echo "</tr>";
  }
?> 
  </table>
<br /><br />
<?php echo $linhas."  Registros encontrados "; ?>
</form>
</body>
</html>