<?php
   require_once('conexao.php'); 
?>
Cidade:
<select name="fCidades">
<option>---Escolha uma opcao---</option>
<?php
  $sql = "SELECT unidade_da_federacao, nome FROM cidade WHERE unidade_da_federacao = '{$_GET['fEstados']}' ORDER BY nome";
  $result = mysql_query($sql);
  $linhas = mysql_num_rows($result);
  for($x=0; $x < $linhas; $x++)
  {
    echo "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option><br>";
  }
?>   
</select>