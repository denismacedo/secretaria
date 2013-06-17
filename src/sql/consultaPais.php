<?php
  require_once("conexao.php");
  $result = mysql_query("select sigla, nome from pais order by nome");
  $linhas=mysql_num_rows($result);
  for($x=0; $x < $linhas; $x++)
  {
    echo "<option value='".mysql_result($result,$x,0)."'>".mysql_result($result,$x,1)."</option><br>";
  }
?>