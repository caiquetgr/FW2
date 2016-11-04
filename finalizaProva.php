<?php
	
	include "verificaCpf.php";
	
	include "conexao.php";
	
		
	$numeroPergunta = $_POST['numeroPergunta'];
	
	$idModeloProva = $_POST['idModeloProva'];
	
	$perguntasCorretas = 0;	
	
	$notaProva = 0;	
	
		//Verificando se resposta está correta e adicionando nota na prova	
	for($i = 1; $i < $numeroPergunta; $i++){
	
    	$idRespAluno = $_POST['respPerg'.$i.''];
    	
    
    	$sqlAltEscolhida = "SELECT respostaAlternativa FROM Alternativa WHERE idAlternativa=$idRespAluno";
    	
    	$resultadoAltEscolhida = mysql_query( $sqlAltEscolhida ) or die(mysql_error());
    	
    	$correta = mysql_fetch_object($resultadoAltEscolhida);
    	
    	
    	//Verificando a resposta
    	if( $correta->respostaAlternativa != 0)
    		$perguntasCorretas++;		
    		
     		
	
	}	
	
		
	
	$notaProva = ($perguntasCorretas / ($numeroPergunta - 1)) * 10;
	
	$notaProva = number_format($notaProva, 2);
	
	
	
		//Inserindo dados da prova feita pelo aluno
	$sqlInsereProva = "INSERT INTO ProvaAluno (notaProvaAluno, cpfAluno, idModeloProva) values ( $notaProva ,
	 $cpfAluno , $idModeloProva )";
	 
	mysql_query( $sqlInsereProva ) or die( mysql_error() ); 
		//ID da prova que acabou de ser inserida
	$idProvaAluno = mysql_insert_id();
	
	
		//Inserindo alternativas que o aluno respondeu
	for($i = 1; $i < $numeroPergunta; $i++){
	
    	$idRespAluno = $_POST['respPerg'.$i.''];	
		
		$sqlInsereAlt = "INSERT INTO ProvaAlunoRespondeu VALUES ( $idProvaAluno , $idRespAluno )";
		
		mysql_query($sqlInsereAlt) or die(mysql_error());
			
	}
	
	
	
	echo "<script>
			alert('Prova finalizada com sucesso!');
			javascript:window.location='resultadoIndividual.php?idProvaAluno=".$idProvaAluno."&prova=true'; 
			</script>";
				
	
	mysql_close();

?>