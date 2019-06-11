<?php
	if(getenv("AMBIENTE") == DEV) {
		$user="secretaria_db";
		$password="secretaria_db";
		$database="secretaria_db";
		$address="mysqldb";
	} else {
		$user="secretaria";
		$password="concafras";
		$database="secretaria";
		$address="localhost";
	}
	mysql_connect($address,$user,$password);
	@mysql_select_db($database) or die( "Erro ao conectar com banco de dados...". mysql_error());
?>
