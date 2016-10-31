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
  <script src="_js/jquery-3.1.1.js"></script>
  <script src="_js/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="_css/jquery-ui.css">
  
  
  
   
<script>
$( function() {
$("#data").datepicker({dateFormat: "dd/mm/yy", changeYear: true, changeMonth: true, yearRange: "1950:*",
 dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
 monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]});
 
 $("#dataF").datepicker({dateFormat: "dd/mm/yy", changeYear: true, changeMonth: true, yearRange: "1950:*",
 dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
 monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]});
} );
</script>
  
  
  
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
  
  <script>
  
  
  
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
	
	<div class="row" id="centro">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="rectangle">
			
				<div id="texto">
				<h4 id="titulo-conteudo" style="text-align: center">Cadastro de Prova</h4>
										
					<form action="CadastroProva2.php" method="post">
					
					<div id="perguntasCadastroProva">Título da prova: <input class="mdl-textfield__input" type="text" name="titulo" id="titulo"></div><br/>
					<div id="perguntasCadastroProva">Quantas questões deseja cadastrar?<input class="mdl-textfield__input" name="qntPerg" type="text" id="qntPerg"></div><br/>
					<div id="perguntasCadastroProva">Data de Início: <input class="mdl-textfield__input"  name="inicio" type="text" id="data"></div><br/>
					<div id="perguntasCadastroProva">Data de Término: <input class="mdl-textfield__input"  name="fim" type="text" id="dataF"></div>

					</br>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
					Próxima
					</button>
					</div>
					
					</form>
								
			</div>		
		</div>		
		</div>
		<div class="col-md-3"></div>
	
</div>





</body>
</html>
	
</body>

</html>