<?php
	
	$mysqli = new mysqli("localhost", "root", "", "SistemaProvasOnline");
	if ($mysqli->connect_errno) {
    echo "Falha ao conectar do MySqli: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}	
	
	$mysqli->set_charset("utf8");
?>