<?php

	session_start("professor");
	
	include "conexao.php";
	
	$user = $_POST['user'];
	$senha = $_POST['senha'];	
	
	$sql = "SELECT cpfProfessor, nomeProfessor FROM Professor WHERE loginProfessor='$user' AND senhaProfessor='$senha'";
	
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if($resultado != false && mysql_num_rows($resultado) != false && mysql_num_rows($resultado) > 0 ){	
	
		$registro = mysql_fetch_object($resultado);
	
		$_SESSION['cpfProfessor'] = $registro->cpfProfessor;
		
		$_SESSION['nomeProfessor'] = $registro->nomeProfessor;
		
		mysql_close();
		
		header("location: funcProf.php");
	
	} else {
	
	echo "<script> alert('Usuário ou senha inválidos!');";
	echo "javascript:window.location='proflogin.html'; </script>";

	

	}
?>