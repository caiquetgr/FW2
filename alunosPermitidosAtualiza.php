<?php

	include "verificaProfessor.php";
	
	include "conexao.php";
	
	$idModeloProva = $_POST['idModeloProva'];	
	
	$contador = $_POST['contador'];
	
	//Apagando alunos permitidos antigos, para atualizar com todos os novos permitidos	
	$sql = "DELETE FROM Aluno_PodeFazer_Prova WHERE idModeloProva = $idModeloProva" ;
	
	mysql_query($sql) or die(mysql_error());
	
	for($i = 1; $i < $contador; $i++){
	
		if(isset($_POST['caixa'.$i.''])){
		
		$cpfPermitido = $_POST['caixa'.$i.'']; 
		
		$sqlInsert = "INSERT INTO Aluno_PodeFazer_Prova values ($cpfPermitido, $idModeloProva )";
		
		mysql_query($sqlInsert) or die(mysql_error());		
		
		}
		
	
	}

	mysql_close();
	
	echo "<script> alert('Alunos atualizados com sucesso!');";
	echo "javascript:window.location='funcProf.php'; </script>";	

?>