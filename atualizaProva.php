<?php

	include "verificaProfessor.php";
	
	include "conexao.php";	
	
	$idModeloProva = $_POST['idModeloProva'];
	
	$i = 1;	 
	
		
		//Perguntas
	 $sqlPerguntas = "SELECT idPergunta, questaoPergunta from Pergunta WHERE idModeloProva=$idModeloProva";
	 
	 $resultadoPerguntas = mysql_query($sqlPerguntas) or die(mysql_error());
	 
	 
	 
	 while ( $pergunta = mysql_fetch_object($resultadoPerguntas) ){
	 	
	 $perguntaForm = addslashes($_POST['perg'.$i.'']);
	 
	 
	 
	 $sqlAtualizaPerg = "UPDATE Pergunta SET questaoPergunta='$perguntaForm' WHERE idPergunta=$pergunta->idPergunta";
	 mysql_query($sqlAtualizaPerg) or die(mysql_error());	 
	 
			//Alternativas
	 /*$sqlQntdAternativas = "SELECT COUNT(*) FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";
	 $resultadoQntdAlternativas = mysql_query($sqlQntdAternativas) or die(mysql_error());	
	 $qntdAlternativas = mysql_fetch_object($resultadoQntdAlternativas);
	 
	 $numAlternativas = $qntdAlternativas->COUNT(*);*/
	 
	 $sqlAlternativas = "SELECT * FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";
	 $resultadoAlternativas = mysql_query($sqlAlternativas) or die(mysql_error());	
	 
		$j = 1;
	 
	 	while( $alternativa = mysql_fetch_object($resultadoAlternativas) ){
	 	
		      $alt = addslashes($_POST['p'.$i.'alt'.$j.'']);
		
				$resposta = $_POST['p'.$i.'alt'];
		
				//Se resposta não estiver em branco
				if( strcmp($alt, '') != 0 ){
					//Se resposta for marcada como correta, coloca valor 1 (true) no banco, se não coloca 0 (false)
					if( strcmp($resposta, "$alternativa->idAlternativa") == 0 ){
						//Resposta correta!
						$sqlAlt = "UPDATE Alternativa SET alternativa='$alt' , respostaAlternativa=1 WHERE 
						idAlternativa=$alternativa->idAlternativa";
						mysql_query($sqlAlt) or die(mysql_error());
					} else {
						//Resposta errada!
						$sqlAlt = "UPDATE Alternativa SET alternativa='$alt' , respostaAlternativa=0 WHERE 
						idAlternativa=$alternativa->idAlternativa";
						mysql_query($sqlAlt) or die(mysql_error());
					}	 	
	 	
			
	 	
	 	
	 	    }
			 
			 $j++;
	 
	  }
	  
	  while ( $j <= 5 ){
	  
				$alt = addslashes($_POST['p'.$i.'alt'.$j.'']);
		
				$resposta = $_POST['p'.$i.'alt'];
		
				//Se resposta não estiver em branco
				if( strcmp($alt, '') != 0 ){
					//Se resposta for marcada como correta, coloca valor 1 (true) no banco, se não coloca 0 (false)
					if( strcmp($resposta, "$j") == 0 ){
						//Resposta correta!
						$sqlAlt = "INSERT INTO Alternativa values (DEFAULT, '$alt', 1, $pergunta->idPergunta )";
						mysql_query($sqlAlt) or die(mysql_error());
					} else {
						//Resposta errada!
						$sqlAlt = "INSERT INTO Alternativa values (DEFAULT, '$alt', 0, $pergunta->idPergunta )";
						mysql_query($sqlAlt) or die(mysql_error());
					}
						
						
				}	  
	  
		$j++;	  
	  
	  
	  }
	  
	  $i++;
	 
}


	mysql_close();
	
	echo "<script> alert('Prova atualizada com sucesso!!');";
	echo "javascript:window.location='ProvasMenu.php?idModeloProva=$idModeloProva'; </script>";	

?>