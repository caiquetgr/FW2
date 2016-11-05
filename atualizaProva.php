<?php

	include "verificaProfessor.php";
	
	include "conexao.php";	
	
	$idModeloProva = $_POST['idModeloProva'];
	
		//Perguntas
	 $sqlPerguntas = "SELECT idPergunta, questaoPergunta from Pergunta WHERE idModeloProva=$idModeloProva";
	 
	 $resultadoPerguntas = mysql_query($sqlPerguntas) or die(mysql_error());
	 
	 
	 
	 while ( $pergunta = mysql_fetch_object($resultadoPerguntas) ){
	 
			//Alternativas
	 $sqlQntdAternativas = "SELECT COUNT(*) FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";
	 $resultadoQntdAlternativas = mysql_query($sqlQntdAternativas) or die(mysql_error());	
	 $qntdAlternativas = mysql_fetch_object($resultadoQntdAlternativas);
	 $numAlternativas = $qntdAlternativas->COUNT(*);
	 
	 $sqlAlternativas = "SELECT * FROM Alternatia WHERE idPergunta=$pergunta->idPergunta";
	 $resultadoAlternativas = mysql_query($sqlAlternativas) or die(mysql_error());	
	 
		$i = 1;	 
	 
	 	while( $alternativa = mysql_fetch_object($resultadoAlternativas) ){
	 	
			$sqlUpdate = "UPDATE Alternativa SET alternativa
	 	
	 	
	 	}
			 
	 
	 }

?>