<?php

require_once('util/http.php'); 
require_once('util/comum.php'); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>CONCAFRAS</title>
<link href="CSS/styles.css" rel="stylesheet" type="text/css">

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
</head><body>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
.style2 {
	color: #00C437;
	font-weight: bold;
	font-size: 14px;
}
.style3 {
	color: #fdb301;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>

<script type="text/javascript">


    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

</script>




<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td class="tituloheader" align="center" height="40">
    	<table border="0" cellpadding="0" cellspacing="0" width="700">
    		<tbody><tr class="tituloheader" bgcolor="#666666">
    			<td align="left" valign="middle" width="351"><strong>
CONCAFRAS-PSE</strong></td>
    			<td align="right" valign="baseline" width="349"><strong>
   				  Secretaria
    			</strong></td>
    		</tr>
   	  </tbody></table>
    </td>
  </tr>
  <tr>
  	<td align="center">
  		<img src="imagens/barra_rel.jpg">
  	</td>
  </tr><tr>
  