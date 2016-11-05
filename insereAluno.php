<?php
	
	include "conexao.php";
	
	$nomeAluno = $_POST['nomeAluno'];
	$cpfAluno = $_POST['cpfAluno'];
	
	$sql = "INSERT INTO aluno values ('$cpfAluno', '$nomeAluno')";
	
	mysql_query($sql) or die(mysql_error());
	
	mysql_close();
	
	echo "<script> alert('Aluno registrado com sucesso!');</script>";
	
	header("location: funcProf.php");
	
?>