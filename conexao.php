<?php

	$servidor = "localhost";
	$user = "root";
	$senha = "";
	$banco = "SistemaProvasOnline";
	
	$conexao = mysql_connect($servidor, $user, $senha);

	if( $conexao != null ){

		mysql_set_charset('UTF8', $conexao);
		
		$bd = mysql_select_db($banco);
		
		
		if($bd == null){

			echo "Falha na conexão com o banco de dados.";	

		}		
		
	} else {
			
		echo "Falha na conexão com o servidor";
			
	}
		
		


?>