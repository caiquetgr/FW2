<?php

	$servidor = "localhost";
	$user = "root";
	$senha = "";
	$banco = "SistemaProvasOnline";
	
	$conexao = mysql_connect( $servidor, $login, $senha );

	$if( $conexao != null ){

		$bd = mysql_select_db( $banco );	
		
		if($bd == null)
		echo "Falha na conexão com o banco de dados.";	
	
	} else {
	
		echo "Falha na conexão com o servidor.";
	
	}

?>