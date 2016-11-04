/*
	Sistema de Provas Online - Por Caique Borges e Vivian Rebeca
	2016
*/

//Retorna a data atual (formatada) do sistema
//Feita em 16/09/2016
function dataAtual(){	
	
	var data = new Date();
	
	var dia = data.getDate();
	
	var m = 	data.getMonth() + 1;
	
	var mes = (m.toString().length < 2) ? ('0' + m.toString()) : m;
	var ano = data.getFullYear(); 
	
	var dataFormatada = dia + '/' + mes + '/' + ano;	
	
	return dataFormatada;
	
	}
	

//Conferir se CPF do aluno está vazio
function cpfVazio(){
	
	var cpf = document.getElementById('cpf');	
	
	if(cpf.value == ""){
		alert("Preencha o cpf antes de confirmar!");
		return false;	
	}

}


//Conferir os campos da página "CadastroProva.php"
function validaCamposCadastro(){
	
	var titulo = document.getElementById('titulo');
	var qntPerg = 	document.getElementById('qntPerg');
	var dtInicio = 	document.getElementById('data');
	var dtFim = 	document.getElementById('dataF');
	
	if(titulo.value == ""){
		alert("Preencha o título antes de ir para a próxima página!");
		return false;	
	}
	
	if(qntPerg.value == ""){
		alert("Preencha a quantidade de perguntas antes de ir para a próxima página!");
		return false;	
	}
	
	if(qntPerg.value < 1){
		alert("A quantidade de questões precisa ser maior que zero!");
		return false;	
	}
	
	if(dtInicio.value == ""){
		alert("Escolha a data de abertura da prova antes de ir para a próxima página!");
		return false;	
	}
	
	if(dtFim.value == ""){
		alert("Escolha a data de fechamento da prova antes de ir para a próxima página!");
		return false;	
	}
	
	
	var token = dtInicio.value.split("/");
	var dataInicio = new Date(token[2] + '-' + token[1] + '-' + token[0]); 
	
	var token2 = dtFim.value.split("/");
	var dataFim = new Date(token2[2] + '-' + token2[1] + '-' + token2[0]); 
	
		
	if( dataInicio.getTime() > dataFim.getTime() ){
		alert("A data de inicio da prova não pode ser maior que a data de fechamento!");
		return false;	
	}	
	
	 return validaDatas();
	
}


	//Mascara de data
function formatacaoData(campoData){

       var data = campoData.value;
	   
	   if(event.keyCode != 8 || evento.keyCode!= 8) // 8 = Código do Backspace, para não introduzir a barra novamente quando tentar apagar
	   {
	   if(data.length == 2){
		  data = data + "/";
		  campoData.value = data;
		  return true;
	   }
	   
	   if(data.length == 5){
		  data = data + "/";
		  campoData.value = data;
		  return true;
	      }
	  }
}

 //Validação de datas
function validaDatas(){
            var dia = (document.forms[0].data.value.substring(0,2)); 
            var mes = (document.forms[0].data.value.substring(3,5)); 
            var ano = (document.forms[0].data.value.substring(6,10)); 
 
            var situacao = ""; 
			
			if(document.forms[0].data.value != ""){
            // verifica o dia valido para cada mes 
            if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
                situacao = "falsa"; 
            } 
 
            // verifica se o mes e valido 
            if (mes < 01 || mes > 12 ) { 
                situacao = "falsa"; 
            } 
 
            // verifica se e ano bissexto 
            if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
                situacao = "falsa"; 
            } 
			
			    
            if (situacao == "falsa") { 
                alert("Data de inicio inválida!"); 
					 document.getElementById('data').focus();
             // document.getElementById("data").style.backgroundColor = "#ff0000";
					 return false
              } 
			}
			
			
			   var dia = (document.forms[0].dataF.value.substring(0,2)); 
            var mes = (document.forms[0].dataF.value.substring(3,5)); 
            var ano = (document.forms[0].dataF.value.substring(6,10)); 
 
            var situacao = ""; 
			
			if(document.forms[0].dataF.value != ""){
            // verifica o dia valido para cada mes 
            if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
                situacao = "falsa"; 
            } 
 
            // verifica se o mes e valido 
            if (mes < 01 || mes > 12 ) { 
                situacao = "falsa"; 
            } 
 
            // verifica se e ano bissexto 
            if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
                situacao = "falsa"; 
            } 
			
			    
            if (situacao == "falsa") { 
                alert("Data de término inválida!"); 
				document.getElementById('dataF').focus();
            //  document.getElementById("dataF").style.backgroundColor = "#ff0000";
				return false
              } 
			}
} 		