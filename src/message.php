<?php

if (isset($ERROR_MSG)) {

?>
	<div align="center" id="DIV_MSG">
	<div align="left" style="width: 100%; line-height: 22px; background: #f6f6f6;  padding: 5px 5px 5px 5px; font-size: 11px; color:#dd0000; font-weight:bold; border-bottom: #336699 1px solid;">
	<img src="imagens/error.gif" align="absmiddle"> [Erro]<br>
		&nbsp;&nbsp;&nbsp;
		<?php 
		
		echo $ERROR_MSG; 
		
		$ERROR_MSG = "";
		
		?>
		
	</div>
	</div>
	<br>
	
<?php
} else if (isset($INFO_MSG)) {

?>
	<div align="center" id="DIV_MSG">
	<div align="left" style="width: 100%; line-height: 22px; background: #f6f6f6;  padding: 5px 5px 5px 5px; font-size: 11px; color:#009900; font-weight:bold; border-bottom: #336699 1px solid;">
	<img src="imagens/info.gif" align="absmiddle"> [Info]<br>
		&nbsp;&nbsp;&nbsp;
		<?php 
		
		echo $INFO_MSG; 
		$INFO_MSG = "";
		
		?>
		
	</div>
	</div>
	<br>
	
<?php
}

?>