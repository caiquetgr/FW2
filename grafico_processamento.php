<?php

	include "conexao_mysqli.php";
	
	

	$sqlPerguntas = "SELECT idPergunta, questaoPergunta, tituloModeloProva FROM ModeloProva as m JOIN Pergunta as p
   ON m.idModeloProva = p.idModeloProva WHERE m.idModeloProva=$idModeloProva";
  
  $resultadoPerguntas = $mysqli->query($sqlPerguntas) or die(mysql_error());
  
  //Arrays para contagem de acertos/erros, e quantidade de Perguntas
	$arrayAcertos = array();
	$arrayErradas = array();	  
   $qntdPerguntas = 0;
   $nomeProva;
   
   $relatorioTexto = "";
   $numPergunta = 1;
  
  //Percorrendo as perguntas
  while( $pergunta = $resultadoPerguntas->fetch_object() ){
		
		$nomeProva = $pergunta->tituloModeloProva;
		$certas = 0;
		$erradas = 0;

	  $sqlAlterRespondida = "SELECT idAlternativa, alternativa, respostaAlternativa FROM
	  Alternativa as a JOIN ProvaAlunoRespondeu as r ON a.idAlternativa = r.Alternativa_idAlternativa
	  WHERE a.idPergunta = $pergunta->idPergunta"; 
	  
		  
	  
	  $resultadoAlterRespondida = $mysqli->query($sqlAlterRespondida) or die(mysql_error());
	  
	  //Percorrendo alternativas
	  while ( $alternativaResp = $resultadoAlterRespondida->fetch_object() ){
	  
			if( strcmp($alternativaResp->respostaAlternativa, "1") == 0 ){
				$certas++;
				
				
			 } else { 
			   $erradas++;
			   
			}
	  
	  }
	  
	  $arrayAcertos[] = $certas;
	  $arrayErradas[] = $erradas;
  	  $qntdPerguntas++;
  	  
  	  $relatorioTexto .= "Pergunta ".$numPergunta.") $pergunta->questaoPergunta <br/> Acertos: $certas / Erros: $erradas |";
  		
  		$numPergunta++;
  }  
  	 	
	mysqli_close( $mysqli ); 
	
	
?>