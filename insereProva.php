<?php

	include "verificaProfessor.php";
	
	include "conexao.php";
	
	$titulo = $_POST['titulo'];
	$qntdPerg = $_POST['qntPerg'];
	$dataInicio = $_POST['inicio'];
	$dataFim = $_POST['fim'];
	
	$di = DateTime::createFromFormat('d/m/Y', $dataInicio);
	$df = DateTime::createFromFormat('d/m/Y', $dataFim);
	
	$dataInicioFormatada = $di->format('Y-m-d');
	$dataFimFormatada = $df->format('Y-m-d');
	
	echo "Data ini formatada: $dataInicioFormatada <br> Data fim formatada: $dataFimFormatada <br>";
	echo "Data ini : $dataInicio<br> Data fim: $dataFim <br>";
	
	$sql = "INSERT INTO ModeloProva values (DEFAULT, '$dataInicioFormatada', '$dataFimFormatada', '$titulo', '$cpfProf', $qntdPerg)";
	
	mysql_query($sql) or die(mysql_error());
		
	$idModeloProva = mysql_insert_id();
	
	
	
	//Percorrendo cada pergunta
	for($i = 1; $i <= $qntdPerg; $i++){
		
		$pergunta = $_POST['perg'.$i.''];
		
		$sqlPergunta = "INSERT INTO Pergunta values (DEFAULT, '$pergunta', $idModeloProva)";
		
		mysql_query($sqlPergunta) or die(mysql_error());
		
		$idPergunta = mysql_insert_id();		
			
			//Percorrendo cada alternativa da pergunta número $i
			for($j = 1; $j <= 5; $j++){
		
				$alt = $_POST['p'.$i.'alt'.$j.''];
		
				$resposta = $_POST['p'.$i.'alt'];
		
				//Se resposta não estiver em branco
				if( strcmp($alt, '') != 0 ){
					//Se resposta for marcada como correta, coloca valor 1 (true) no banco, se não coloca 0 (false)
					if( strcmp($resposta, "$j") == 0 ){
						//Resposta correta!
						$sqlAlt = "INSERT INTO Alternativa values (DEFAULT, '$alt', 1, $idPergunta)";
						mysql_query($sqlAlt) or die(mysql_error());
					} else {
						//Resposta errada!
						$sqlAlt = "INSERT INTO Alternativa values (DEFAULT, '$alt', 0, $idPergunta)";
						mysql_query($sqlAlt) or die(mysql_error());
					}
						
						
				}
				
		
						
		
			 } 
		
		
			
	}
	
	mysql_close();
	
	echo "<script> alert('Prova registrada com sucesso!!');";
	
	
	//echo "javascript:window.location='alunosPermitidos.php?id=$idModeloProva'; </script>";	

?>