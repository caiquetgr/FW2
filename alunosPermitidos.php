<?php
	
	
	
	include "verificaProfessor.php";
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$idModeloProva = $_GET['id'];	
	
	$sql = "select * from Aluno WHERE cpfAluno NOT IN ( SELECT cpfAluno from Aluno_PodeFazer_Prova WHERE
	        idModeloProva = $idModeloProva ) ORDER BY nomeAluno";
	$resultado = mysql_query($sql) or die(mysql_error());	
	
	
	$sql2 = "SELECT * FROM Aluno_PodeFazer_Prova as p INNER JOIN Aluno as a on p.cpfAluno = a.cpfAluno WHERE p.idModeloProva=$idModeloProva ORDER BY a.nomeAluno ";
	$resultado2 = mysql_query($sql2) or die(mysql_error());
	
	$sql3 = "SELECT tituloModeloProva FROM ModeloProva WHERE idModeloProva=$idModeloProva";    
   $resultado3 = mysql_query($sql3) or die(mysql_error());
   $prova = mysql_fetch_object($resultado3);	
   
   $contador = 1;		
		
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
  <link rel="stylesheet" type="text/css" href="_css/alunosPermitidos.css" />
  
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

	<div class="container">  
	
 	 	<img src="_imagens/logo.png" id="logo" alt="Sistema de Provas Online"/>
 	 	<img src="_imagens/logo.png" id="logo-alt" alt="Sistema de Provas Online"/>
 	 	
   </div>
	
</div>

		<h6 style="text-align: center;">
		Nesta página, você marcará os alunos que estão autorizados a fazer a sua prova! <br/>
		Caso o aluno não esteja marcado, ele não conseguirá ver esta prova!
		</h6>		

<div class="container-fluid">
	
	<!-- Código que imprime os alunos no banco e suas permissões com relação a prova clicada
		na página anterior -->
		
		
		<div class="row" >
		<div class='col-md-1'></div>
		<div class="col-sm-10" id='topo'> Lista de permissão (<?php echo $prova->tituloModeloProva; ?>)</div>
		<div class='col-md-1'></div>
		</div>		
	
		<form action="alunosPermitidosAtualiza.php" method="post">
	
	<?php
	
	//Contador para saber se já tem dois alunos na mesma linha
	$contaLinha = 1;	
	
		
		while($alunosRegistrados = mysql_fetch_object($resultado)){
	
		while($alunosPermitidos = mysql_fetch_object($resultado2)){	
			
			if($contaLinha == 1){	
	 		echo "<div class='row'>";
	 		echo "<div class='col-md-1'></div>";	
		}
				
				echo "<div class='col-md-1' id='checkbox'>";
				echo "<input type='checkbox' name='caixa".$contador."' value='".$alunosPermitidos->cpfAluno."' checked/>";	
				echo "</div>";	
						
						
					
			echo "<div class='col-md-3' id='nomeAluno'>";
				echo $alunosPermitidos->nomeAluno;
			echo "</div>";
			
			echo "<div class='col-md-1' id='cpfAluno'>";
				echo $alunosPermitidos->cpfAluno;
			echo "</div>";
	
			
	
		if($contaLinha == 2){
			echo "<div class='col-md-1'></div> </div>";
			//echo "</div>";
			$contaLinha = 1;
			$contador++;
		} else {
			$contaLinha++;
			$contador++;
		}
	
		}
			//Checkbox desmarcada
		if($contaLinha == 1){	
	 		echo "<div class='row'>";
	 		echo "<div class='col-md-1'></div>";	
		}
				
				echo "<div class='col-md-1' id='checkbox'>";
				echo "<input type='checkbox' name='caixa".$contador."' value='".$alunosRegistrados->cpfAluno."'/>";	
				echo "</div>";	
						
					
			echo "<div class='col-md-3' id='nomeAluno'>";
				echo $alunosRegistrados->nomeAluno;
			echo "</div>";
			
			echo "<div class='col-md-1' id='cpfAluno'>";
				echo $alunosRegistrados->cpfAluno;
			echo "</div>";
	
	
	
		if($contaLinha == 2){
			echo "<div class='col-md-1'></div> </div>";
			//echo "</div>";
			$contaLinha = 1;
			$contador++;
		} else {
			$contaLinha++;
			$contador++;
		}
			
		
	 	}
	
		echo "<input type='hidden' name='idModeloProva' value='$idModeloProva'/>";
	   echo "<input type='hidden' name='contador' value='$contador'/>";
		
		mysql_close();
		
		
	?>			
		<div class='row'>
		
			<div class='col-md-12' align='center'>
			
			<button style="margin-top: 20px;" class="mdl-button mdl-js-button mdl-button--raised
			 mdl-js-ripple-effect mdl-button--colored" formaction="#">
					Voltar
			</button>			
			&nbsp;
			<button style="margin-top: 20px;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
					Atualizar
			</button>		
			</div>
		</div>
		
		
		
		</form>	
	
</div>





</body>
</html>
