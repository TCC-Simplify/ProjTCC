//FUNÇÕES MOSTRAR SENHA PARA PÁGINA DE CADASTRO DE EMPRESA
function mostrarSenha(){
	var tipo = document.getElementById("senha");
	var botao = document.getElementById("botao");
	var botao2 = document.getElementById("botao2");
	if(tipo.type == "password"){
		tipo.type = "text";
		botao.style.color = "red";
	}else{
		tipo.type = "password";
		botao.style.color = "white";
	}

}

function mostrarSenha2(){
	var tipo = document.getElementById("senha2");
	if(tipo.type == "password"){
		tipo.type = "text";
		botao2.style.color = "red";
	}else{
		tipo.type = "password";
		botao2.style.color = "white";
	}
}
$(document).ready(function()
{	
	$("#cnpj").mask("99.999.999/9999-99");
});
 
$(document).ready(function(){
		$("#cep").mask("99999-999");
});
