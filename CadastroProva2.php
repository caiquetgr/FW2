<?php
	$titulo = $_POST['titulo'];
	$qntPerg = $_POST['qntPerg'];
	$inicio = $_POST['inicio'];
	$fim = $_POST['fim'];
	
	
?>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/index.css">
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

<style type="css">
	input#pergunta{
		border-width: 1px;
		border-color: #42A5F5;
	}
	
	.col-md-8{
		padding-top: 2%;
		padding-bottom: 2%;
		height: 100%;
	}
</style>

<div id="jumbo" class="jumbotron">
	

	<div class="container">  
	
 	 	<img src="_imagens/logo.png" id="logo" alt="Sistema de Provas Online"/>
 	 	<img src="_imagens/logo.png" id="logo-alt" alt="Sistema de Provas Online"/>
 	 	
   </div>
   
</div>


<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="mdl-grid portfolio-max-width">
	<div align="center">
	<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp" style="align: center">
		
		<h3 id="titulo-conteudo" style="text-align: center">Cadastro de Prova</h3>
		<form action="insereProva.php" method="post">
			<h4>Instruções</h4>
			<p>O preenchimento de todos os campos de alternativas <strong>não</strong> é necessário, coloque a quantidade de alternativas que desejar.</br>
			Para marcar qual é a alternativa correta da questão, basta checar a caixinha que há ao lado da alternativa.</br>
			Cada questão deverá ter apenas <strong>uma</strong> alternativa correta.</p></br>
			
						
			
			<?php
			
			//título da prova
			echo "<h5>".$titulo."</h5></br>";
				for($i=1; $i<=$qntPerg; $i++){
					
					//questão
					echo "<div class='row' style='font-weight: bold;'>";
					echo "<div class='input-container'>";
					echo "<label>Questão".$i."</label>";
					echo "</div>";
					echo "<textarea class='mdl-textfield__input' type='text' rows='5' cols='10' name='perg".$i."' id='pergunta' style='border-color: #42A5F5'></textarea></td>";
					echo "</div>";
					
					//alternativas
					echo "<div class='row' class='input-container'>";
					echo "<label>Alternativas</label></br>";
					echo "<input type='text' name='p".$i."alt1' id='alternativa'> </td>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt1'>";
					echo "<input type='radio' id='op1'  name='p".$i."alt' value='1' checked>";
					echo "</label>";
					echo "</div>";
					
					echo "<div class='row' class='input-container'>";
					echo "<input type='text' name='p".$i."alt2' id='alternativa'> </td>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt2'>";
					echo "<input type='radio' id='op2'  name='p".$i."alt' value='2'>";
					echo "</label>";
					echo "</div>";
					
					echo "<div class='row' class='input-container'>";
					echo "<input type='text' name='p".$i."alt3' id='alternativa'> </td>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt3'>";
					echo "<input type='radio' id='op3' name='p".$i."alt' value='3'>";
					echo "</label>";
					echo "</div>";
					
					echo "<div class='row' class='input-container'>";
					echo "<input type='text' name='p".$i."alt4' id='alternativa'> </td>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt4'>";
					echo "<input type='radio' id='op4' name='p".$i."alt' value='4'>";
					echo "</label>";
					echo "</div>";
					
					echo "<div class='row' class='input-container'>";
					echo "<input type='text' name='p".$i."alt5' id='alternativa'> </td>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt5'>";
					echo "<input type='radio' id='op5' name='p".$i."alt' value='5'>";
					echo "</label>";
					echo "</div></br>";
					
				}
				
				echo "<input type='hidden' name='titulo' value='$titulo' />";
				echo "<input type='hidden' name='qntPerg' value='$qntPerg' />";
				echo "<input type='hidden' name='inicio' value='$inicio' />";
				echo "<input type='hidden' name='fim' value='$fim' />";			
				
			?>
			
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
					Finalizar
				</button>
		</form>
	</div>
	</div>
	</div>
</div>
<div class="col-md-2"></div>




</body>
</html>