<?php

	session_start("aluno");

	include "conexao.php";
		
	$cpf = $_POST['cpf'];
	
	$sql = "SELECT cpfAluno, nomeAluno FROM Aluno WHERE cpfAluno='$cpf'";
	
	
	$resultado = mysql_query($sql) or die(mysql_error());
	
	$registro = mysql_fetch_object($resultado);
	
	echo "Bem vindo $registro->nomeAluno".", seu cpf é $registro->cpfAluno"; 
	
	
	$_SESSION['cpfAluno'] = $registro->cpfAluno;
	$_SESSION['nomeAluno'] = $registro->nomeAluno;	
	
	

?>

