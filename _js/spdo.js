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