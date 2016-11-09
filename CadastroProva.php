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
  <link rel="stylesheet" type="text/css" href="_css/css2.css">
  <link rel = " stylesheet " href = " https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium & amp; lang = en " >
  <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet">
  <link rel="stylesheet" href="_css/material.min.css">
  <script src="_js/material.min.js"></script>
  <script src="_js/bootstrap.min.js"></script>
  <script src="_js/jquery-3.1.1.js"></script>
  <script src="_js/jquery-ui.js"></script>
  <script src="_js/spdo.js"></script>
  <link rel="stylesheet" type="text/css" href="_css/jquery-ui.css">
  
  
<style>
	.row{ background-color: white;	}
	#perguntasCadastroProva { font-size: 16px }
</style>  
   
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

<header>

<?php include "botaoSair.php"; ?>

		<div>
			<h1 id="titulo">Sistema de Provas Online</h1>
		</div>
</header>

<div class="container-fluid">
	
	<div class="row" id="centro">
			<div class='col-md-4'></div>
			<div class='col-md-4'>
			<h4 id="titulo-conteudo" style="text-align: center">Cadastro de Prova</h4>
			</div>
			<div class='col-md-4'></div>
	</div>								
					<form onsubmit='return validaCamposCadastro()' action="CadastroProva2.php" method="post">
		
		<div class="row" id="centro">	
			<div class='col-md-2'></div>	
					<div class='col-md-8'>	
					<div id="perguntasCadastroProva">Título da prova: <input class="mdl-textfield__input" type="text" name="titulo" id="titulo"></div><br/>
					</div>
			<div class='col-md-2'></div>
      </div>	
      
      <div class="row" id="centro" >	
			<div class='col-md-2'></div>	
					<div class='col-md-8' align='center' style='margin-top: -15px;'>	
						 	<div id="perguntasCadastroProva">Quantas questões deseja cadastrar? &nbsp;
							<div class="mdl-textfield mdl-js-textfield">						 	
						 	<input class="mdl-textfield__input" 
							pattern="-?[0-9]*(\.[0-9]+)?" name="qntPerg" type="text" id="qntPerg"></div>
							<span class="mdl-textfield__error"><br/>Insira apenas números, sem pontuação!</span>
							</div>
					</div>
			<div class='col-md-2'></div>
      </div>	
      
      <div class="row" id="centro">	
			<div class='col-md-2'></div>	
					<div class='col-md-8'>	
					<div id="perguntasCadastroProva">Data de Início: <input class="mdl-textfield__input" 
						 name="inicio" type="text" maxlength='10' id="data" onkeyup="formatacaoData(this)"></div><br/>
					</div>
			<div class='col-md-2'></div>
      </div>
		
		<div class="row" id="centro">	
			<div class='col-md-2'></div>	
					<div class='col-md-8'>	
					<div id="perguntasCadastroProva">Data de Término: <input class="mdl-textfield__input"
					     name="fim" type="text" maxlength='10' id="dataF" onkeyup="formatacaoData(this)"></div>
					</div>
			<div class='col-md-2'></div>
      </div>
		
	
		<div class="row" id="centro" >	
			<div class='col-md-2'></div>				
				<div class='col-md-8' align='center'>					
					<button style="margin-top: 25px;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
					Próxima
					</button>
				</div>
			<div class='col-md-2'></div>		
		</div>			
					</form>
								
					
	
		
	
</div>





</body>
</html>
	
</body>

</html>