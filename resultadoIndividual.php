<?php
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$idProvaAluno = $_GET['idProvaAluno'];
	
	$sqlProvaAluno = "SELECT * FROM ProvaAluno as p INNER JOIN Aluno ON
	 p.cpfAluno = Aluno.cpfAluno WHERE idProvaAluno=$idProvaAluno";
   	
	$resultadoProvaAluno = mysql_query($sqlProvaAluno) or die(mysql_error());
	
	$ProvaAluno = mysql_fetch_object($resultadoProvaAluno);

		//Dados da prova e aluno	
	$nomeAluno = $ProvaAluno->nomeAluno;
	$cpfAluno = $ProvaAluno->cpfAluno;
	$notaProva = $ProvaAluno->notaProvaAluno;
	$idModeloProva = $ProvaAluno->idModeloProva;
	
	
	
		
	
			
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/index.css">
  <link rel="stylesheet" type="text/css" href="_css/resultadoIndividual.css">
  <link rel="stylesheet" href="_css/material.min.css">
  
  
  <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet">
  <script src="_js/material.min.js"></script>
  <script src="_js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
  window.onload = function mudaH4(){
	var largura = window.innerWidth;
	
	//alert(largura);
	
		if(largura <= 480){
		   document.getElementById('logo').src = "_imagens/logoabrev.png";
		   document.getElementById('logo-alt').style.display = 'inline';
			document.getElementById('titulo-conteudo').style.fontSize = 16 + 'px';
			document.getElementById('txtfooter').style.fontSize = 13 + 'px';
			document.getElementById('texto').style.paddingTop = 0.1 + '%';
					
		}  
		
	}
  </script>
  
</head>

<body>

<div id="jumbo" class="jumbotron">

	<div class="container">  
	
 	 	<img src="_imagens/logo.png" id="logo" alt="Sistema de Provas Online"/>
 	 	<img src="_imagens/logo.png" id="logo-alt" alt="Sistema de Provas Online"/>
 	 	
   </div>
	
</div>


<div class="container-fluid">
	
		<div class='row'>
			<div class='col-md-2'></div>
			<div class='col-md-8' id='titulo-resultado'> Resultado da Prova </div>			
			<div class='col-md-2'></div>
		</div>	<br/>
		 
		
		
	<?php
	
			$corNota = ($notaProva < 6 ? 'red' : '#B2FF59');
	
			echo "<div class='row'>";
				echo "<div class='col-md-2'></div>";
				  
				 	echo "<div class='col-md-4' id='headerProva'> Nome: <strong>$nomeAluno</strong> </div>";
					echo "<div class='col-md-2' id='headerProva' > CPF: <strong>$cpfAluno</strong> </div>";
					echo "<div class='col-md-2' id='headerProva' 
							style='background-color: $corNota'> Nota: <strong>$notaProva</strong> </div>";
					
				echo "<div class='col-md-2'></div>";
			echo "</div>";		
			
		mysql_close();	
	
	?>

</div>


</body>
</html>