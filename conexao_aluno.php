<?php

	session_start("aluno");

	include "conexao.php";
		
	$cpf = $_POST['cpf'];
	
	$sql = "SELECT cpfAluno, nomeAluno FROM Aluno WHERE cpfAluno='$cpf'";
	
	
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if($resultado != false && mysql_num_rows($resultado) != false && mysql_num_rows($resultado) > 0 ){
	
		$registro = mysql_fetch_object($resultado);
	
		echo "Bem vindo $registro->nomeAluno".", seu cpf é $registro->cpfAluno"; 
	
	
		$_SESSION['cpfAluno'] = $registro->cpfAluno;
		$_SESSION['nomeAluno'] = $registro->nomeAluno;	
	
		mysql_close();
		
		header("location: funcAluno.php");
	
	} else {
	
		echo "<script> alert('CPF não encontrado!');";
		echo "javascript:window.location='alunocpf.html'; </script>";	
	
	}

?>

