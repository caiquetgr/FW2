<?php

	/*
	Código que armazena a variável de sessão cpf e nome do professor em variáveis locais, e testa
	  para ver se o login foi feito	
	*/

	session_start("professor");
	
	$nomeProf = $_SESSION['nomeProfessor'];
	$cpfProf = $_SESSION['cpfProfessor'];
	
	if($cpfProf == null){
		echo "<script> alert('Faça login para entrar como professor!!');";
		echo "javascript:window.location='proflogin.html'; </script>";			
	}
?>