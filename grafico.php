<?php

 	$idModeloProva = $_GET['idModeloProva'];	

  include "conexao_mysqli.php";
 
  include "grafico_processamento.php";
    	
 	   $arrayPergNumero;
 	 
  	 
 	   include "jpgraph/jpgraph.php";
      include "jpgraph/jpgraph_bar.php";
 	 
 	 for($i=1; $i <= $qntdPerguntas; $i++ )
 	 	$arrayPergNumero[] = $i;
 	 	
 	 	
 	 			//Construindo gráfico
 	 			
 	 	$grafico = new graph(560,250,"png");
		$grafico->img->SetMargin(40,40,40,40);
		$grafico->SetScale("textint");
		
		
		$grafico->title->Set($nomeProva);
		$grafico->subtitle->Set('Acertos e erros');
		$grafico->ygrid->Show(true);
		$grafico->xgrid->Show(true);	  
		
		//barra verde, acertos
		$gBarrasA = new BarPlot($arrayAcertos);
		$gBarrasA->SetFillColor("green");
		$gBarrasA->SetShadow("black");
		$gBarrasA->SetLegend("Acertos");
		//barra vermelha, erros
		$gBarrasE = new BarPlot($arrayErradas);
		$gBarrasE->SetFillColor("red");
		$gBarrasE->SetShadow("black");
		$gBarrasE->SetLegend("Erros");
		
		//posição da legenda
		$grafico->legend->SetPos(0.90, 0.00,'center','right');
		
		$grupoBarras = new GroupBarPlot( array($gBarrasA, $gBarrasE) );
		$grafico->Add($grupoBarras);
		
		$grafico->yaxis->title->Set("Marcadas");
	   $grafico->xaxis->title->Set("Pergunta");
	   $grafico->xaxis->SetTickLabels($arrayPergNumero);
	   
	   
	   $grafico->Stroke();
  
  		
  			
 		
  
  

?>