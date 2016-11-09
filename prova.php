<?php
	
	include "verificaCpf.php";
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$idModeloProva = $_GET['idModeloProva']; 
	
			//Conferindo se aluno já fez esta prova	
	
	$sqlConfereDuplicata = "SELECT * FROM ProvaAluno WHERE cpfAluno=$cpfAluno and idModeloProva=$idModeloProva";
	
	$resultadoConfereDuplicata = mysql_query($sqlConfereDuplicata) or die(mysql_error());
	
		//Caso encontre este modelo de prova com o cpf deste aluno na tabela ProvaAluno, significa
		//que o aluno já fez essa prova.
	if( mysql_num_rows($resultadoConfereDuplicata) > 0 ){

		echo "<script>";
		echo "alert('Você já fez essa prova!');";
		echo "javascript:window.location='listaProvas.php';";
		echo "</script>";	
	
	}
	
	
			//Recuperando a prova inteira (perguntas, alternativas, etc)
			
	$sqlModeloProva = "SELECT tituloModeloProva, qntdPerguntas from ModeloProva WHERE idModeloProva=$idModeloProva";
	
	$resultadoModeloProva = mysql_query($sqlModeloProva) or die(mysql_error());
	
	$registroProva = mysql_fetch_object($resultadoModeloProva);
	
	if( mysql_num_rows($resultadoModeloProva) == 0 )	{
	
		echo "<script>";
		echo "alert('Esta prova não existe!');";
		echo "javascript:window.location='listaProvas.php';";
		echo "</script>";		
	
	}	
	
	//Quantidade de perguntas da prova
	$qntdPerguntas = $registroProva->qntdPerguntas;
	
	
			//Recuperando perguntas
			
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
  <link rel="stylesheet" type="text/css" href="_css/css2.css">
  <link rel = " stylesheet " href = " https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium & amp; lang = en " >
  <link rel="stylesheet" type="text/css" href="_css/prova.css">
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

<header>

		<div>
			<h1 id="titulo">Sistema de Provas Online</h1>
		</div>
</header>

<div class="container-fluid">
	
	<!-- Código que imprime a prova -->		
	
	<div id="instrucoes">	
	
	  <div class="row" id="instrucoes-texto">
	
		
		<div class="col-md-12" align='center'> <h5>Instruções:</h5>
		
		<h6>- A prova só pode ser realizada <strong>uma vez</strong>! <br/>
		- No momento em que apertar o botão <strong>"Finalizar"</strong>, esta prova só poderá ser refeita mediante
		a permissão do professor!<br/>
		- Há apenas <strong>uma alternativa correta!</strong><br/>
		- Caso haja dúvidas ou reclamações sobre a prova, entre em contato com o professor que a disponibilizou!<br/><br/>
								<strong style='color: #FF5722'>BOA SORTE!</strong>
		</h6>
	
		</div>
	
	  </div>	
	
	</div>
	
		<form action='finalizaProva.php' method='post'>
	
		
	
	<?php
	
		echo "<div class='row' id='prova'>	
		 	   <div class='col-md-12' id='titulo-prova'>
		      <h4 id='titulo-prova-texto' >$registroProva->tituloModeloProva</h4>
				</div>		      
		      </div>";
		      
		      
		
		
		
		$numeroPergunta = 1	;
		
						//Imprimindo a pergunta
		while( $pergunta = mysql_fetch_object($resultadoPerguntas) ){ 
		
      echo "<div class='row'>
      		  <div class='col-md-2'></div> 
      		 		<div class='col-md-8' >
      						<h5 id='pergunta'>	$numeroPergunta) $pergunta->questaoPergunta  </h5>
      				</div>
      		  <div class='col-md-2'></div>
      		</div>";
      		
      		
         		//Imprimindo alternativas
       $sqlAlternativa = "SELECT idAlternativa, alternativa FROM Alternativa WHERE idPergunta=$pergunta->idPergunta";  

		 $resultadoAlternativa = mysql_query($sqlAlternativa) or die(mysql_error());
		 
		 if( mysql_num_rows($resultadoAlternativa) == 0)
		 	--$numeroPergunta;
		 
		 		while( $alternativa = mysql_fetch_object($resultadoAlternativa) ){     
         
					echo "<div class='row' id='linha-alternativa'>
      		 			 	<div class='col-md-2'></div> 
      		 					<div class='col-md-8' >
      								 <input type='radio' name='respPerg$numeroPergunta' value='$alternativa->idAlternativa'/>
      								 <span id='alternativa'> $alternativa->alternativa  </span>
      							</div>
      		  				<div class='col-md-2'></div>
      					</div>";	         
         
         	}
         
         
			$numeroPergunta++;         
         
      }
      	
		echo "<input type='hidden' name='numeroPergunta' value='$numeroPergunta' />"; 
		echo "<input type='hidden' name='idModeloProva' value='$idModeloProva'/>";     	
		
				
		
		mysql_close();
		
		
	?>			
		
				<div class='row' >	
		 	   <div class='col-md-12' id='finalizar'>
		     		<button style='margin-top: 25px;' class="mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored">
					Finalizar
					</button>
				</div>		      
		      </div>		
			
		</form>
	

</div>


</body>
</html>