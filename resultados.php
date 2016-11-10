<?php
	
	include "verificaProfessor.php";
	
	include "conexao.php";
	
	$idModeloProva = $_GET['idModeloProva'];	
	
	$sqlEstatisticas = "SELECT COUNT(*) as quantidadeDeProvas, avg(notaProvaAluno) as media,
	max(notaProvaAluno) as maxima, min(notaProvaAluno) as minima
	 FROM ProvaAluno WHERE idModeloProva=$idModeloProva";
	 
	 $resultadoEstatisticas = mysql_query($sqlEstatisticas) or die(mysql_error());
	 
	 $estatisticas = mysql_fetch_object($resultadoEstatisticas);
   			
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>IFSP - SdPO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="_css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="_css/index.css">
  <link rel="stylesheet" href="_css/material.min.css">
  <link rel="stylesheet" type="text/css" href="_css/listaProvas.css" />
  <link rel="stylesheet" type="text/css" href="_css/jquery-ui.css">
  
  <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet">
  <script src="_js/material.min.js"></script>
  <script src="_js/bootstrap.min.js"></script>
  <script src="_js/jquery-3.1.1.js"></script>
  <script src="_js/jquery-ui.js"></script>
  
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
  
  
  <!-- Jquery para ver estatisticas -->
<script type="text/javascript">
	
	var maximizado = false;

$(document).ready(function(){
	  var maximizado = false;
	 	$("#relatorio").click(function () {
	 		
	 		if(!maximizado){
	 		  $("#estatisticas").slideDown();
	 		  $("#relatorio").html("Minimizar estatisticas");
	 		maximizado = true;
	 		} else {
	 		  $("#estatisticas").slideUp();
	 		  $("#relatorio").html("Ver Estatísticas");
	 		  maximizado = false;
	 		}
	 		
	 	})
	});
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

<style>

	#estatisticas{
		display: none;
		margin: 0 auto;	
	}
	
	#estatistica-linha{
		border: 1px solid black;	
		background-color: #4db6ac;
		font-weight: bold;
	}
	
	#imagem-grafico{
		display: block;
		margin: 0 auto;	
	}
	
	#relatorio{
		display: block;
		margin: 0 auto;
		background-color: #00acc1;
		opacity: 70%;	
	}
	
	#estatistica-linha-num{
		background-color: #b2dfd8;
		border: 1px solid black;
	}
	
</style>


 
<div class="container-fluid">
	
	<!-- Código que imprime as provas existentes no banco de dados -->		
	
	
	 <button id='relatorio'  class='mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored'>
					Ver Estatísticas
	</button>
	
	<?php
	
					//Estatisticas
		
	   echo "<br>
	   <div id='estatisticas'>
	   <img id='imagem-grafico' src='grafico.php?idModeloProva=$idModeloProva'/>";
		
		
		echo "<div class='row' >";	   
	   echo "<div class='col-md-4'></div>";
	   
		echo "<div class='col-md-1' id='estatistica-linha' >";
		echo "Nº de Provas";  echo "</div>";
		 
		echo "<div class='col-md-1' id='estatistica-linha' >"; 
		echo "Nota mínima"; echo "</div>";
		
		echo "<div class='col-md-1' id='estatistica-linha' >";
		 echo "Média"; echo "</div>";
		 
		echo "<div class='col-md-1' id='estatistica-linha' >";
		 echo "Nota máxima"; echo "</div>";
		 
		echo "<div class='col-md-4'></div>";
	
	   echo "</div>";
	   
	   echo "<div class='row' >";	   
	   echo "<div class='col-md-4'></div>";
	   
		echo "<div class='col-md-1' id='estatistica-linha-num' >";
		echo $estatisticas->quantidadeDeProvas;  echo "</div>";
		 
		echo "<div class='col-md-1' id='estatistica-linha-num' >"; 
		echo number_format($estatisticas->minima, 1); echo "</div>";
		
		echo "<div class='col-md-1' id='estatistica-linha-num' >";
		 echo number_format($estatisticas->media, 1); echo "</div>";
		 
		echo "<div class='col-md-1' id='estatistica-linha-num' >";
		 echo number_format($estatisticas->maxima, 1); echo "</div>";
		 
		echo "<div class='col-md-4'></div>";
	
	   echo "</div>";
	   
	   
	   echo "</div><br/>";
		
		
		//FIM ESTATISTICAS

	
	
	
	$sql = "SELECT idProvaAluno, p.cpfAluno, nomeAluno, notaProvaAluno FROM ProvaAluno as p JOIN Aluno as a
	ON p.cpfAluno = a.cpfAluno WHERE p.idModeloProva = $idModeloProva ";
	
   $resultado = mysql_query($sql) or die(mysql_error());	
	
		//Cabeçalho
			echo "<div class='row' >";
				 echo "<div class='col-md-1'></div>";
				echo "<div class='col-md-10' id='topo' style=''>"; echo "Provas no Sistema - ".date('d/m/Y'); echo "</div>";	
				echo "<div class='col-md-1'></div>";
			echo "</div>";
			
			echo "<div class='row'>";
				 echo "<div class='col-md-1'></div>";
				 echo "<div class='col-md-2' id='linha-topo' style='border-left: 1px solid black'>"; echo "ID da Prova"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo' >"; echo "CPF";  echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo' >"; echo "Aluno"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo' >"; echo "Nota"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo' >"; echo "Ver prova"; echo "</div>";
				 echo "<div class='col-md-1' id='linha-topo' ></div>";
			echo "</div>";	 
			
			//Contador para zebrar as linhas
			$i = 0;
			// 0 ou 1 definem a cor
			$cor; 			
			// Cor da nota (verde, amarela, vermelha)
			$corNota;	
	
				//Percorrendo cada linha do resultado
			while($registro = mysql_fetch_object($resultado)){
					
			$cor = $i % 2 == 0  ?  1  :  0;
			
			$notaProva = $registro->notaProvaAluno;
			
			if( $notaProva < 6 && $notaProva > 4)
				$corNota = '#FFB300';
			else if ( $notaProva < 4 )
				$corNota = '#EF5350';
			else 
				$corNota = '#388E3C';		
						
			//Imprimindo a linha
			echo "<div class='row' >";
		
				 echo "<div class='col-md-1'></div>";
				 
				 echo "<div class='col-md-2' id='cor$cor' style='border-left: 1px solid black'>";
				 echo $registro->idProvaAluno;
				 echo "</div>";
				 
				 echo "<div class='col-md-2' id='cor$cor'>";
				 echo $registro->cpfAluno;	
				 echo "</div>";	
				 
				 echo "<div class='col-md-2' id='cor$cor'>";
				 echo $registro->nomeAluno;	
				 echo "</div>";	
				 
				 	
				 echo "<div class='col-md-2' id='cor$cor' style='color: $corNota'>";
				 echo "<strong style='font-size: 16px;'>".$registro->notaProvaAluno."</strong>";				 						 
				 echo "</div>";	
				 
				 echo "<div class='col-md-2' id='cor$cor'>";
				 echo "<a href='resultadoIndividual.php?idProvaAluno=$registro->idProvaAluno'><span id='botao'>Visualizar</span></a>";
				 echo "</div>";
				 
				 echo "<div class='col-md-1'></div>";
				 		
			echo "</div>";		
		
			//Mudando a cor pra próxima linha
			$i++;		
			}
			
			
			echo "<div class='row'>";
			
		   echo "<div class='col-md-12' align='center'>";
		   echo "<form> <button id='home' style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
		     		mdl-js-ripple-effect mdl-button--colored' formaction='javascript:history.back()'>
					Voltar
					</button> </form>	";
         echo "</div>";					
         
		
		mysql_close();
	
	?>			
	
		
	
</div>

</body>
</html>
	
