<?php
   require_once('conexao.php'); 
?>

Estado:
<select name="fEstados" onChange="changeEstados(this.value);">
<option value="">---Escolha uma opcao---</option>
<?php
	$sql = "SELECT sigla, nome FROM estado where pais = '{$_GET['fPais']}' ORDER BY nome ";	
	$result = mysql_query($sql);
	$linhas = mysql_num_rows($result);
	for($x=0; $x < $linhas; $x++)
	{
	  echo "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option><br>";
	}
?>
</select>