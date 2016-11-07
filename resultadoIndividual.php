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
	
	$sqlProfessor = "SELECT nomeProfessor, tituloModeloProva FROM ProvaAluno as p INNER JOIN ModeloProva as m ON
	 p.idModeloProva = m.idModeloProva INNER JOIN Professor as prof ON m.cpfProfessor = prof.cpfProfessor
	 WHERE p.idModeloProva = $idModeloProva";
	
	$resultadoProfessor = mysql_query($sqlProfessor) or die(mysql_error());
	
	$modeloProva = mysql_fetch_object($resultadoProfessor);
			
			//Nome do professor e título da prova
	$nomeProf = $modeloProva->nomeProfessor;
	$tituloProva = $modeloProva->tituloModeloProva;

				//Perguntas
	 $sqlPerguntas = "SELECT idPergunta, questaoPergunta from Pergunta WHERE idModeloProva=$idModeloProva";
	 
	 $resultadoPerguntas = mysql_query($sqlPerguntas) or die(mysql_error());	
			
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

<?php include "botaoSair.php"; ?>

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
			//Alterando a cor da nota de acordo com o valor dela			
			if( $notaProva < 6 && $notaProva > 4)
				$corNota = 'yellow';
			else if ( $notaProva < 4 )
				$corNota = 'red';
			else 
				$corNota = '#B2FF59';
	
			echo "<div class='row'>";
				echo "<div class='col-md-2'></div>";
				  
				 	echo "<div class='col-md-4' id='headerProva'> Aluno: 
				 					<strong style='letter-spacing: 0px;'>$nomeAluno</strong> </div>";
					echo "<div class='col-md-2' id='headerProva' > CPF: <strong>$cpfAluno</strong> </div>";
					echo "<div class='col-md-2' id='headerProva' 
							style='background-color: $corNota'> Nota: <strong>$notaProva / 10</strong> </div>";
					
				echo "<div class='col-md-2'></div>";
			echo "</div>";	
			
			echo "<div class='row'>";
				echo "<div class='col-md-2'></div>";
				  echo "<div class='col-md-4' id='headerProva'> Prova: <strong>$tituloProva</strong> </div>";
				  echo "<div class='col-md-4' id='headerProva'> Professor:
				  				 <strong style='letter-spacing: 0px;'>$nomeProf</strong> </div>";
				echo "<div class='col-md-2'></div>";
			echo "</div>";
			
			
							//PERGUNTAS E ALTERNATIVAS
							$numeroPergunta = 1	;	
							
			while( $pergunta = mysql_fetch_object($resultadoPerguntas) ){ 
		
      echo "<div class='row'>
      		  <div class='col-md-2'></div> 
      		 		<div class='col-md-8' >
      						<h5 id='pergunta'>	$numeroPergunta) $pergunta->questaoPergunta  </h5>
      				</div>
      		  <div class='col-md-2'></div>
      		</div>";
      		
      		
         		//Imprimindo alternativas
       $sqlAlternativa = "SELECT idAlternativa, alternativa, respostaAlternativa FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";  

		 $resultadoAlternativa = mysql_query($sqlAlternativa) or die(mysql_error());
		 
		 /*if( mysql_num_rows($resultadoAlternativa) == 0)
		 	-$numeroPergunta;*/
		 
		 		while( $alternativa = mysql_fetch_object($resultadoAlternativa) ){     
         		
					$radioCheck = "";         		
         		
         		//Se alternativa está correta, segundo o banco de dados
					$correta = (strcmp($alternativa->respostaAlternativa, "0") == 1) ? "#B2FF59" : ""; 
					
					//Consulta para conferir se aluno marcou esta alternativa
					$sqlAlternativaAluno = "SELECT * FROM ProvaAlunoRespondeu WHERE idProvaAluno=$idProvaAluno AND
					Alternativa_idAlternativa=$alternativa->idAlternativa";
					
					$resultadoAlternativaAluno = mysql_query($sqlAlternativaAluno) or die(mysql_error());
					
					//Se encontrou que aluno marcou esta alternatica, coloca checked no $radioCheck
					if( mysql_num_rows($resultadoAlternativaAluno) > 0)
						$radioCheck = "checked"; 
						
					//Se a alternativa marcada não for a correta, pinta de vermelho
					if( strcmp($radioCheck, "checked") == 0 && strcmp($correta, "") == 0 )
						$correta = "#EF5350";					
																        
         
					echo "<div class='row' id='linha-alternativa'>
      		 			 	<div class='col-md-2'></div> 
      		 					<div class='col-md-8' style='background-color: $correta; border-radius: 8px'>
      		 					
      								 <input type='radio' name='respPerg$numeroPergunta'
      								  value='$alternativa->idAlternativa' $radioCheck disabled='disabled'/>
      								  
      								 <span id='alternativa'> $alternativa->alternativa  </span>
      							</div>
      		  				<div class='col-md-2'></div>
      					</div>";	         
         
         	}
         
         
			$numeroPergunta++;         
         
      }							
			
			echo "<br/>";			
			
		mysql_close();	
		
		
		
		echo "<div class='row'>";
		echo "<div class='col-md-2'></div>";
		echo "<div class='col-md-8' align='center'>";
		
		//Se tiver 'prova', então a página anterior foi a finalização de uma prova
		//Caso não tenha 'prova' no GET, então o botão será "voltar", para a página anterior
		if( isset($_GET['prova']) ){		
		
		  echo "<form> <button style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored' formaction='funcAluno.php'>
					Finalizar
					</button> </form>";
					
		} else {
		  
		  
		  echo "<form> <button style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored' formaction='javascript:history.back()'>
					Voltar
					</button> </form>";
		
		
		}
		
		
		echo "</div>";
		echo "<div class='col-md-2'></div>";
		echo "</div>";
		
		echo "<br/>";	
		echo "<br/>";	
	?>

</div>


</body>
</html>