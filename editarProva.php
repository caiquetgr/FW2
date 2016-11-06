<?php

	include "verificaProfessor.php";
	
	include "conexao.php";	
	
	$idModeloProva = $_GET['idModeloProva'];
	
	
	//Prova
	$sql = "SELECT * FROM ModeloProva WHERE idModeloProva=$idModeloProva";
	
	$resultado = mysql_query($sql) or die(mysql_error());
	
	$ModeloProva = mysql_fetch_object($resultado);	
	
	
	//Perguntas
	 $sqlPerguntas = "SELECT idPergunta, questaoPergunta from Pergunta WHERE idModeloProva=$idModeloProva";
	 
	 $resultadoPerguntas = mysql_query($sqlPerguntas) or die(mysql_error());	 
	
?>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/index.css">
  <link rel="stylesheet" type="text/css" href="_css/CadastroProva2.css">
  <link rel="stylesheet" href="_css/material.min.css">
  <script src="_js/material.min.js"></script>
  <script src="_js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
  window.onload = function mudaH4(){
	var largura = window.innerWidth;
	
	//alert(largura);
	
		if(largura <= 480){
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


<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="mdl-grid portfolio-max-width">
	<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--8dp" style="align: center">
		<div class="col-md-12">
		 
			<div style="text-align: center">
			
		 <div id='instrucoes'>
		<h3 id="titulo-conteudo" style="text-align: center">Editar Prova</h3>
		</div>
		<br/><br/>
		<form action="atualizaProva.php" method="post">
			<h4 style="text-align: center">Instruções</h4>
			
			<p style="text-align: center"> Não altere drasticamente as alternativas, para não prejudicar o entendimento
			das provas que já foram realizadas. <br/>As notas das provas já realizadas <strong>não</strong> serão alteradas.
			<br/><br/>Os passos são os mesmo da criação de uma prova: <br/> - Selecione a alternativa que é a resposta; <br/>- Não é necessário
			o preenchimento das cinco alternativas.  </p><br/>
				<br/><br/>
			
			<?php
			
			//título da prova
			echo "<div id='linha-titulo'>";
			echo "<h5>".$ModeloProva->tituloModeloProva."</h5>";
			echo "</div><br/>";
				
				
					$i = 1;			
					
					$qntdPerg = 0;	
				
					while($pergunta = mysql_fetch_object($resultadoPerguntas)){
					
					//questão
					echo "<div class='row' id='linha-questão' style='text-align: center'>";
					echo "<div class='input-container'>";
					echo "<label id='questao'>Questão ".$i."</label>";
					echo "</div>";
					echo "<textarea class='mdl-textfield__input' type='text' rows='3'  name='perg".$i."' id='pergunta'>$pergunta->questaoPergunta</textarea>";
					echo "</div>";
					echo "</br>";
					
					$sqlAternativas = "SELECT * FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";
					
					$resultadoAlternativas = mysql_query($sqlAternativas) or die(mysql_error());
					
					$j = 1;					
					
					
					echo "<label>Alternativas</label></br>";					
					
					while($alternativa = mysql_fetch_object($resultadoAlternativas)){					
					
					$checkado = $alternativa->respostaAlternativa == 1 ? "checked" : "" ;					
					
					//alternativas
					echo "<div class='row' class='input-container'>";
					echo "<input type='radio' id='op1' name='p".$i."alt' value='$alternativa->idAlternativa' $checkado>";
					echo "<input type='text' name='p".$i."alt$j' id='alternativa' value='$alternativa->alternativa'>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt1'>";
					echo "</label>";
					echo "</div>";
						
					$j++;
					
					}
					
					while($j <= 5){
					
					echo "<div class='row' class='input-container'>";
					echo "<input type='radio' id='op1' name='p".$i."alt' value='$j'>";
					echo "<input type='text' name='p".$i."alt$j' id='alternativa'>";
					//echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='alt1'>";
					echo "</label>";
					echo "</div>";
					
					$j++;
					
					}
					
					
					/*
						NOTA
						
						Pegar por post normalmente essas alternativas, como se fosse insereProva,
						
						Select * from Alternativa WHERE idPergunta (Selecionar todas as alternativas daquela
						pergunta no banco de dados, e também a contagem de quantas tem (count))
						
						Ir usando o update, atualizar as que já estão lá, e quando o for com o count acabar,
						começar a usar o insert into alternativa
											
					*/					
					
					echo "<br/><br/><br/>";
		
					
					$i++;
					
					$qntdPerg++;
				}
				
				
				echo "<input type='hidden' name='idModeloProva' value='$idModeloProva'/>";				
				
			?>
			
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
					Finalizar
				</button>
				
		</form>
		</div>
	</div>
	</div>
	</div>
</div>
<div class="col-md-2"></div>

</body>
</html>