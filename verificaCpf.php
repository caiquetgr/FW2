<?php

	/*
	Código que armazena a variável de sessão cpf e nome do aluno em variáveis locais, e testa
	  para ver se a verificação do cpf foi feita
	*/

	session_start("aluno");
	
	$nomeAluno = $_SESSION['nomeAluno'];
	$cpfAluno = $_SESSION['cpfAluno'];
	
	if($cpfAluno == null){
		echo "<script> alert('Entre com seu CPF na página inicial do aluno!');";
		echo "javascript:window.location='alunocpf.html'; </script>";		
	}

?>