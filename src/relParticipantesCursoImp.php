<?php

header("Content-Type: text/plain");


		
		$sql = "select b.evento, b.codigo, b.nome, e.qualif_evento, pf.nome as nome_pf, ((YEAR(x.inicio)-YEAR(pf.data_nasc)) - (RIGHT(x.inicio,5)<RIGHT(pf.data_nasc,5))) as idade, pf.cidade, pf.unidade_da_federacao
				from sub_ocorrencia a, participante p, inscricao i, pessoa_fisica pf, ocorrencia b, evento e, ocorrencia x
				where a.ocorrencia = b.codigo and a.evento = b.evento 
				and b.ocorrencia_geradora = ".$_SESSION["OCORRENCIA_SESSION"]." 
				and b.concafras_geradora = ".$_SESSION["EVENTO_SESSION"]." 
				and x.codigo = b.ocorrencia_geradora
				and x.evento = b.concafras_geradora
				and b.evento = e.codigo 
				and e.tipo_evento = 1
				and a.evento = p.evento and a.ocorrencia = p.ocorrencia and a.codigo = p.sub_ocorrencia 
				and p.inscricao = i.codigo
				and i.pessoa_fisica = pf.codigo
				order by e.qualif_evento, b.nome, pf.nome";
		
		$resultado = mysql_query($sql);
		
		$totalPart = 0;
		
		$linhas = mysql_num_rows($resultado);
		
		if ($linhas > 0) {
		

			$eventoOcorrencia = "";
			for ($i = 0; $i < $linhas; $i++) {
			
				 $evtOcoAtual = mysql_result($resultado, $i, "evento")."/".mysql_result($resultado, $i, "codigo");
			
				if ($eventoOcorrencia != $evtOcoAtual) {
					
					echo "\n"."\n";
					
					$eventoOcorrencia = $evtOcoAtual;

					 $qualif = mysql_result($resultado, $i, "qualif_evento");
					 if ($qualif == "1") {
						$qualif = "ESPECIFICO";
					 } else if ($qualif == "2") {
						 $qualif = "ATUAL";
					 } else {
						$qualif = "";
					 }
					 echo fillSlashes("", 80)."\n";
					 echo "#".$qualif." - ".mysql_result($resultado, $i, "nome")."\n";
					 echo fillSlashes("", 80)."\n";
				}
				
				
				echo fillSpaces(mysql_result($resultado, $i, "nome_pf"), 40)." ";
				echo fillSpaces(mysql_result($resultado, $i, "cidade")." - ".mysql_result($resultado, $i, "unidade_da_federacao"), 50)."\n";
					
			}
		}

?>
