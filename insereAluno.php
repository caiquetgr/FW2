<?php
	
	include "verificaProfessor.php";	
	
	include "conexao.php";
	
	$nomeAluno = $_POST['nomeAluno'];
	$cpfAluno = $_POST['cpfAluno'];
	
	$sqlConfere = "SELECT * FROM Aluno WHERE cpfAluno='$cpfAluno'";
	
	$resultadoConfere = mysql_query($sqlConfere) or die(mysql_error());
	
	if( mysql_num_rows($resultadoConfere) == 0 ){
			
	$sql = "INSERT INTO Aluno values ('$cpfAluno', '$nomeAluno', DEFAULT)";
	
	mysql_query($sql) or die(mysql_error());
	
	echo "<script> alert('Aluno registrado com sucesso!');";
	echo "javascript:window.location='funcProf.php'; </script>";	
	
	} else {
	
	echo "<script> alert('Já existe um aluno registrado com este CPF!');";
	echo "javascript:window.location='registrarAluno.php'; </script>";		
	
	}
	
	
	mysql_close();
	//header("location: funcProf.php");
	
?>