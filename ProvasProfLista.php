<?php
	
	include "verificaProfessor.php";
	
	include "conexao.php";
	
	header('Content-Type: text/html; charset=UTF-8');	
	
	$sql = "SELECT m.idModeloProva, m.tituloModeloProva, m.dataInicioModeloProva, m.dataTerminoModeloProva, p.cpfProfessor FROM
	ModeloProva as m INNER JOIN Professor as p on m.cpfProfessor = p.cpfProfessor ORDER BY m.dataInicioModeloProva DESC";
	
	/*$sql = "SELECT f.cpfAluno, m.idModeloProva, m.tituloModeloProva, m.dataInicioModeloProva, m.dataTerminoModeloProva,
		  p.nomeProfessor FROM ModeloProva as m INNER JOIN Professor as p on m.cpfProfessor = p.cpfProfessor INNER JOIN
		  Aluno_PodeFazer_Prova as f on m.idModeloProva = f.idModeloProva ORDER BY m.dataInicioModeloProva DESC";
	*/
	
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
			echo "<div class='row' font-weight: bold;'>";
				echo "<div class='col-md-1'></div>";				
				echo "<div class='col-md-10' id='topo'>"; echo "Provas no Sistema - ".date('d/m/Y'); echo "</div>";
				echo "<div class='col-md-1'></div>";	
			echo "</div>";
			
			echo "<div class='row'>";
				 echo "<div class='col-md-1'></div>";
				 echo "<div class='col-md-2' id='linha-topo' style='border-left: 1px solid black'>"; echo "Nome da prova"; 			  echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Data de início da prova";  echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Data de término da prova"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Disponibilidade da prova"; echo "</div>";
				 echo "<div class='col-md-2' id='linha-topo'>"; echo "Função"; echo "</div>";
				 echo "<div class='col-md-1'></div>";
			echo "</div>";	 
			
			//Contador para zebrar as linhas
			$i = 0;
			// 0 ou 1 definem a cor
			$cor; 			
			
			$hoje = date('Y-m-d H:i:s');		
		
		
	
				//Percorrendo cada linha do resultado
			while($registro = mysql_fetch_object($resultado)){
					
				if( strcmp($registro->cpfProfessor, $cpfProf) == 0 ){	
					
			/* O id linhas depende da $cor, então se for 0, será uma cor, e se for 1, outra */
				if($i % 2 == 0)
					$cor = 0;			
				else 	
					$cor = 1;	
			
			//Data da prova, formatadas	
			$dataInicio = date_create($registro->dataInicioModeloProva);
			$datafim = 	date_create($registro->dataTerminoModeloProva);
			
			//Data de agora e datas formatadas em string para serem testadas
			$hoje = date('Y-m-d');
			$dataFimTestada = date_format($datafim, 'Y-m-d');						
			$dataIniTestada = date_format($dataInicio, 'Y-m-d');			
			
			
				
			
			//Imprimindo a linha
			echo "<div class='row'>";
		
				 echo "<div class='col-md-1'></div>";
				 
				 echo "<div class='col-md-2' id='cor$cor' style='border-left: 1px solid black'>";
				 echo $registro->tituloModeloProva;
				 echo "</div>";
				 
				 echo "<div class='col-md-2'  id='cor$cor'>";
				 echo date_format($dataInicio, 'd/m/Y');	
				 echo "</div>";	
				 
				 echo "<div class='col-md-2'  id='cor$cor' id='datafim'>";
				 echo date_format($datafim, 'd/m/Y');	
				 echo "</div>";	
				 
				 	
				 echo "<div class='col-md-2'  id='cor$cor'>";
				     
				 
				 		//Testando as datas, imprimindo a situação (Aberta/Fechada/Aguarde) dependendo da data atual
				 if(strtotime($hoje) > strtotime($dataFimTestada)){
				 		echo "<span style='color: red; font-weight: bold' id='disponibilidade' >Fechada</span>";
				 		$botao = true;
				 }else if(strtotime($hoje) <= strtotime($dataFimTestada) and strtotime($hoje) >= strtotime($dataIniTestada)){
				 		echo "<span style='color: #76FF03; font-weight: bold' id='disponibilidade' >Aberta</span>";
				 		$botao = true;	
				 } else {
						echo "<span style='color: #424242; font-weight: bold' id='disponibilidade' >Aguardando</span>";						
						$botao = true;
				 }
				 
				 echo "</div>";	
				 
				 echo "<div class='col-md-2'  id='cor$cor'>";
				 
				 if($botao == true)
				  		echo "<a href='ProvasMenu.php?idModeloProva=$registro->idModeloProva'><span id='botao'>Selecionar</span></a>";
				 else
				 		echo "<span id='botao2'>Selecionar</span>";
				  	
				 echo "</div>";
				 
				 echo "<div class='col-md-1'></div>";
				 		
			echo "</div>";		
		
			//Mudando a cor pra próxima linha
			$i++;		
			}
			
		} //Final do while geral
		
		echo "<div class='row'>";
			
		   echo "<div class='col-md-12' align='center'>";
		   echo "<form> <button id='botaoFuncProf' style='margin-top: 25px;' class='mdl-button mdl-js-button mdl-button--raised
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