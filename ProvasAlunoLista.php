<?php
	
	include "verificaCpf.php";
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$sql = "SELECT p.idProvaAluno, p.notaProvaAluno, p.idModeloProva, m.tituloModeloProva, R.nomeProfessor
	FROM ProvaAluno as p JOIN ModeloProva as m ON p.idModeloProva = m.idModeloProva JOIN
	Professor as R ON m.cpfProfessor = R.cpfProfessor WHERE p.cpfAluno = $cpfAluno";
	
   $resultado = mysql_query($sql) or die(mysql_error());	
   
   			
		
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
	
	<!-- Código que imprime as provas existentes no banco de dados -->		
	
	<?php
	
		//Cabeçalho
			echo "<div class='row' >";
			   echo "<div class='col-md-1'></div>";
				echo "<div class='col-md-10' id='topo'>"; echo "Provas no Sistema - ".date('d/m/Y'); echo "</div>";
				echo "<div class='col-md-1'></div>";	
			echo "</div>";
			
			echo "<div class='row' >";
				 echo "<div class='col-md-1'></div>";
				 echo "<div class='col-md-2' id='linha-topo' style='border-left: 1px solid black'>"; echo "ID da Prova"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Título da Prova";  echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Professor"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Nota"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Ver prova"; echo "</div>";
				 echo "<div class='col-md-1'></div>";
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
				 echo $registro->tituloModeloProva;	
				 echo "</div>";	
				 
				 echo "<div class='col-md-2' id='cor$cor'>";
				 echo $registro->nomeProfessor;	
				 echo "</div>";	
				 
				 	
				 echo "<div class='col-md-2' id='cor$cor' style='color: $corNota'>";
				 echo "<strong style='font-size: 16px;'>".$registro->notaProvaAluno."</strong>";				 						 
				 echo "</div>";	
				 
				 echo "<div class='col-md-2' id='cor$cor'>";
				 echo "<a href='resultadoIndividual.php?idProvaAluno=$registro->idProvaAluno'><span id='botao' background-color: #00bcd4; >Visualizar</span></a>";
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
	
</body>

</html>