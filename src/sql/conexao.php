<?php
	$user="secretaria_db";
	$password="jesus01";
	$database="secretaria_db";
	mysql_connect('secretaria_db.mysql.dbaas.com.br',$user,$password);
	@mysql_select_db($database) or die( "Erro ao conectar com banco de dados...". mysql_error());
?>
