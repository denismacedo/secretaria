<?php
$conexao= pg_pconnect("host=127.0.0.1 port=5432 dbname=concafra_concafras user=concafra password=n4w8afxv");

if (!$conexao)
{  
  echo mysql_error($conexao);  
}
?>
