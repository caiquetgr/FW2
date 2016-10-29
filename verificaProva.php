<?php

	/*
		Código que verifica se há uma prova com o mesmo tituloProva e o mesmo CPF do professor.
		Neste sistema é permitido que haja provas com o mesmo nome, porém apenas de professores diferentes.
		Não é permitido provas com o mesmo nome, sendo do mesmo professor.	
	*/

	include "verificaProfessor.php";
	
	include "conexao.php";
	
	$tituloProva = $_POST['titulo'];
	$cpfProf = $_SESSION['cpfProfessor'];
	
	
	$sql = "SELECT * FROM ModeloProva WHERE tituloModeloProva='$tituloProva' and cpfProfessor='$cpfProf'";
	
	$resultado = mysql_query($sql) or die(mysql_error()); 
	
	
	//Se resultado for diferente de false, significa que foi encontrado no banco de dados uma prova com o
	//mesmo título de prova, e do mesmo professor
	
	if($resultado != false){
		
		$nomeProf = $_SESSION['nomeProfessor'];		
		
		echo "<script> alert('Já existe uma prova com este mesmo\n título, cadastrada por você ".strtok($nomeProf, ' ')."!');";
		echo "<script> alert('Coloque um título diferente ou apague a prova que já existe')";
		echo "javascript:window.location='CadastroProva.php'; </script>";	
		
	}

	mysql_close();
	
?>