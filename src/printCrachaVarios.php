<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>CONCAFRAS</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body>
<?php
	foreach ($crachas as $objCracha) {
	
	?>

<table cellpadding="0" cellspacing="0" style="width:<?php echo $objCracha->largura; ?>cm; font-size: <?php echo $objCracha->tamanho_fonte; ?>px; border: 0px solid #666666; padding-top: <?php echo $objCracha->margem_superior; ?>cm; margin: 0cm; padding-left: <?php echo $objCracha->margem_esquerda; ?>cm; font-family: Trebuchet MS, Tahoma, Arial,Verdana,Helvetica;"  >
	<tr>
		<td>
			<?php include("crachaBase.php"); ?>
		</td>
	</tr>
</table>
<div style="page-break-after:always;"></div>
<?php

 }
 
 ?>
</body>
</html>