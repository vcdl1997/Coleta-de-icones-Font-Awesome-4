<?php
	//COLETA DE ICONES DINAMICA
	$html = file_get_contents("https://fontawesome.com/v4.7.0/icons/");

	$arquivo = fopen('fontawesome.html','w');
	fwrite($arquivo, $html);
	fclose($arquivo);

	$array = [];
	$linhas = file('fontawesome.html');

	foreach($linhas as $linha){
		if(strpos($linha, "<i class") !== false){
			$comeco = strpos($linha, "fa fa-");
			if($comeco == false) continue;

			$fim = strpos($linha, "/i>");
			$icone = substr($linha, $comeco, $fim);
			$icone = substr($icone, 0, strpos($icone, "aria-hidden"));
			$icone = str_replace(array('\'', '"'), '', $icone);
			$array[] = $icone;
		}
	}

	unlink('fontawesome.html'); 
	$csv = fopen('icones.txt','w');
	$txt = fopen('icones.csv','w');
	fwrite($csv, implode("\n", array_unique($array)));
	fwrite($txt, implode("\n", array_unique($array)));
	fclose($csv);
	fclose($txt);
?>