<?php
	
	include "verificaProfessor.php";
	
	include "conexao.php";	
	
	$idModeloProva = $_GET['idModeloProva'];
	
	$sql = "SELECT tituloModeloProva FROM ModeloProva WHERE idModeloProva = $idModeloProva";
	
	$resultado = mysql_query($sql) or die(mysql_error());
	
	$ModeloProva = mysql_fetch_object($resultado);	 	
	
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/css2.css">
  <link rel = " stylesheet " href = " https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium & amp; lang = en " >
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
					<h4 id="titulo-conteudo" style="text-align: center"><a style="color: #FF5722"><?php echo $ModeloProva->tituloModeloProva?></a>
					<br/>Escolha a funcionalidade que deseja utilizar:</h4>
					
					
					
  					<?php 
  					
  					echo " 
  					<form action='resultados.php' method='get'>
  					<input type='hidden' name='idModeloProva' value='$idModeloProva' />
					<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' id='botaoFuncProf'>
					Resultados
					</button> 
					</form>	 					 
  					 
  					
  					<form action='alunosPermitidos.php' method='get'>
  					<input type='hidden' name='idModeloProva' value='$idModeloProva' />
					<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' id='botaoFuncProf'>
					Alunos Permitidos
					</button>
					</form>	
					";
					
					echo "
					<form action='editarProva.php' method='get'>
					<input type='hidden' name='idModeloProva' value='$idModeloProva' />
					<button type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' id='botaoFuncProf'>
					Editar Prova
					</button>
					";
					
					?>
					<div align='center'>
		  		   <button style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored' formaction='javascript:history.back()'>
					Voltar
					</button> 
      		   </div>
					
					</form>
					
					</div>
					
			</div>		
		</div>
		<div class="col-md-3"></div>
		
	</div>
	
</div>





</body>
</html>
	
</body>

</html>