<?php
	
	session_start("aluno");
	
	session_start("professor");
	
	unset($_SESSION['cpfAluno']);
	
	unset($_SESSION['nomeAluno']);
	
	unset($_SESSION['cpfProfessor']);
	
	unset($_SESSION['nomeProfessor']);
	
	session_destroy();
	
	header("location: index.html");
	
?>