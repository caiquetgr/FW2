<style>

#botaosair{
	
	color: #FFFFFF;
	background-color: #FF3D00;
	padding: 3px 10px 3px 10px;
	border: 1px solid;
	border-radius: 7px;
	text-decoration: none;
	box-shadow: 1px 1px 5px black;
	
	
}

#botaosair:hover{
	background-color: yellow;
	font-weight: bold;
	text-decoration: none;
}

#nome_botao{
	padding-right: 10px;
	position: absolute;
	top: 5px;
	right: 0;
	
}

#nome{
	color: #FFFFFF;
	font-size: 12px;
	padding-right: 5px;
	text-shadow: 1px 1px 1px black;
}

</style>



<?php
 
  $nome; 
 
 if( isset($_SESSION['cpfAluno']) ){
	 $nome = $_SESSION['nomeAluno'];
 } else if ( isset($_SESSION['nomeProfessor']) ) {
	 $nome =  $_SESSION['nomeProfessor'];
 } else {
	 $nome = "";
 }
 
 echo "<span id='nome_botao'> <span id='nome'>$nome</span> <a href='logoff.php'><span id='botaosair'>Sair</span></a> </span>";	

?>