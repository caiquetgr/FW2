<?php
	
	include "verificaCpf.php";
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$sql = "SELECT p.idProvaAluno, p.notaProvaAluno, p.idModeloProva, m.tituloModeloProva, P.nomeProfessor
	FROM ProvaAluno as p JOIN ModeloProva as m ON p.idModeloProva = m.idModeloProva JOIN
	Professor as P ON m.cpfProfessor = P.cpfProfessor WHERE p.cpfAluno = $cpfAluno";
	
   $resultado = mysql_query($sql) or die(mysql_error());	
   
   			
		
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

<header>

<?php include "botaoSair.php"; ?>

		<div>
			<h1 id="titulo">Sistema de Provas Online</h1>
		</div>
</header>
 
<div class="container-fluid">
	
	<!-- Código que imprime as provas existentes no banco de dados -->		
	
	<?php
	
		//Cabeçalho
			echo "<div class='row' style='background-color: #FF9800; font-weight: bold;'>";
				echo "<div class='col-md-12' id='topo'>"; echo "Provas no Sistema - ".date('d/m/Y'); echo "</div>";	
			echo "</div>";
			
			echo "<div class='row' style='background-color: #FF9800; font-weight: bold;'>";
				 echo "<div class='col-md-1'></div>";
				 echo "<div class='col-md-2' style='border-left: 1px solid black'>"; echo "ID da Prova"; echo "</div>";
				 echo "<div class='col-md-2'>"; echo "Título da Prova";  echo "</div>";
				 echo "<div class='col-md-2'>"; echo "Professor"; echo "</div>";
				 echo "<div class='col-md-2'>"; echo "Nota"; echo "</div>";
				 echo "<div class='col-md-2'>"; echo "Ver prova"; echo "</div>";
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
			echo "<div class='row' id='cor$cor'>";
		
				 echo "<div class='col-md-1'></div>";
				 
				 echo "<div class='col-md-2' style='border-left: 1px solid black'>";
				 echo $registro->idProvaAluno;
				 echo "</div>";
				 
				 echo "<div class='col-md-2'>";
				 echo $registro->tituloModeloProva;	
				 echo "</div>";	
				 
				 echo "<div class='col-md-2'>";
				 echo $registro->nomeProfessor;	
				 echo "</div>";	
				 
				 	
				 echo "<div class='col-md-2' style='color: $corNota'>";
				 echo "<strong style='font-size: 16px;'>".$registro->notaProvaAluno."</strong>";				 						 
				 echo "</div>";	
				 
				 echo "<div class='col-md-2'>";
				 echo "<a href='resultadoIndividual.php?idProvaAluno=$registro->idProvaAluno'><span id='botao'>Visualizar</span></a>";
				 echo "</div>";
				 
				 echo "<div class='col-md-1'></div>";
				 		
			echo "</div>";		
		
			//Mudando a cor pra próxima linha
			$i++;		
			}
			
			
			echo "<div class='row'>";
			
		   echo "<div class='col-md-12' align='center'>";
		   echo "<form> <button style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
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