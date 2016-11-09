<?php
	
	include "verificaProfessor.php";	
	
?>

<html lang="en">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel = " stylesheet " href = " https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium & amp; lang = en " >
  <link rel="stylesheet" type="text/css" href="_css/css2.css">
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
			document.getElementById('login').style.marginTop = -5 + '%';
			document.getElementById('titulo-conteudo').innerHTML = "Bem vindo professor!";
		}  
		
	}
  </script>
  
</head>



<body>

<header>

<?php include "botaoSair.php"; ?>

		<div>
			<h1 id="titulo">Sistema de Provas Online</h1>
		</div>
</header>

<div class="container-fluid">
	
	<div class="row" id="centro">
	
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="rectangle">
			
					<div id="texto">
					<h4 id="titulo-conteudo" style="text-align: center">Preencha o formulário com os dados do aluno:</h4><br/>
					
					<form action="insereAluno.php" method="post">
					
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" name="nomeAluno" id="nomeAluno">
							<label class="mdl-textfield__label" for="sample1">Nome</label>
						</div>
						<br/>
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" name="cpfAluno" id="cpfAluno">
							<label class="mdl-textfield__label" for="sample1">CPF</label>
						</div>
 					  					
						<div>
						<input type="button" value="Voltar" onClick="window.location.href='funcProf.php';" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="home">
  						
						<input type="submit" value="Cadastrar" button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="botao">
  						</div>	 					 
  					 	
					</form>
					
					</div>
					
			</div>		
		</div>
		<div class="col-md-3"></div>
		
	</div>
	
</div>

<!-- <footer class="footer"> <br/><p id="txtfooter">2016 - Por Caique Aquino Borges & Vivian Rebeca Brazão</p> </footer> -->

</body>
</html>
