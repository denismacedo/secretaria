<?php
	$user="ocentroespi_2";
	$password="1j2k3n";
	$database="ocentroespi_2";
	mysql_connect('dbmy0040.whservidor.com',$user,$password);
	@mysql_select_db($database) or die( "Erro ao conectar com banco de dados...". mysql_error());
?>
