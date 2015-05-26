<?php
	$user="secretaria";
	$password="concafras";
	$database="secretaria";
	mysql_connect('localhost',$user,$password);
	@mysql_select_db($database) or die( "Erro ao conectar com banco de dados...". mysql_error());
?>
