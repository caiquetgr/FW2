<?php

	include "verificaProfessor.php";
	

	
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/index.css">
  <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet">
  <link rel="stylesheet" href="_css/material.min.css">
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
			document.getElementById('footer').style.display = 'none';			
		}  
		
	}
  </script>
  
</head>

<body>

<div id="jumbo" class="jumbotron">

<?php include "botaoSair.php"; ?>

	<div class="container">  
	
 	 	<img src="_imagens/logo.png" id="logo" alt="Sistema de Provas Online"/>
 	 	<img src="_imagens/logo.png" id="logo-alt" alt="Sistema de Provas Online"/>
 	 	
   </div>
  
	
</div>


<div class="container-fluid">

	
	
	<div class="row" id="centro">
	
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="rectangle">
			
					<div id="texto">
					<h4 id="titulo-conteudo" style="text-align: center">Seja bem vindo(a) Prof. <a style="color: #FF5722"><?php echo strtok($nomeProf,' ')?></a>!
					<br/>Escolha a funcionalidade que deseja utilizar:</h4>
					
					<form>
  					 
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="botaoFuncProf" formaction="registrarAluno.php">
					Cadastrar Aluno
					</button> 	 					 
  					</br> 
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="botaoFuncProf" formaction="CadastroProva.php" >
					Cadastrar Prova
					</button>
					</br>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="botaoFuncProf" formaction="ProvasProfLista.php">
					Listar Provas
					</button>
					
					</form>
					
					</div>
					
			</div>		
		</div>
		<div class="col-md-3"></div>
		
	</div>
	
</div>


<footer id="footer" class="footer"> <br/><p id="txtfooter">2016 - Por Caique Aquino Borges & Vivian Rebeca Brazão<p> </footer>


</body>
</html>