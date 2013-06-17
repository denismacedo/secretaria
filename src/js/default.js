function loading() {
	
	/*var divBkg = document.getElementById("divBackground");
	divBkg.style.visibility = "VISIBLE";
	divBkg.style.display = "";
	divBkg.style.MozOpacity=.8; // transparencia FF
	divBkg.style.opacity=.8; // transparencia  FF, Opera, Safari, Netscape
	divBkg.style.filter="Alpha(Opacity=80)";
	
	divBkg.style.width = larguraPag;
	divBkg.style.height = alturaPag;	*/

	showFundo();

	var loading = document.getElementById("divCarregando");
	loading.style.visibility = "VISIBLE";
	loading.style.display = "";
	loading.style.MozOpacity=.7; // transparencia FF
	loading.style.opacity=.7; // transparencia  FF, Opera, Safari, Netscape
	loading.style.filter="Alpha(Opacity=70)";

}

function unloading() {
	
	
	hideFundo();

	var loading = document.getElementById("divCarregando");
	loading.style.visibility = "HIDDEN";
	loading.style.display = "NONE";
}

function showFundo() {
	
	medidas = pegaMedidas(false); 
	larguraPag = medidas[0];
	alturaPag = medidas[1];	
	
	var objBody = document.getElementsByTagName("body").item(0);
	
	// cria a div transparente que cobre todo o fundo
	var objFundo = document.createElement("div");
	objFundo.setAttribute('id','fundo_img'); // define o id
	// CSS do objeto
	objFundo.style.position="absolute"; 
	objFundo.style.top="0px";
	objFundo.style.left="0px";
	objFundo.style.width=larguraPag+"px";
	objFundo.style.height=alturaPag+"px";
	objFundo.style.background="#fff";
	objFundo.style.zIndex=970;
	objFundo.style.MozOpacity=.7; // transparencia FF
	objFundo.style.opacity=.7; // transparencia  FF, Opera, Safari, Netscape
	objFundo.style.filter="Alpha(Opacity=70)"; // transparencia  IE
	// Adiciona o objeto no Body do html
	objBody.appendChild(objFundo);
	
}

function hideFundo() {
	
	var objBody = document.getElementsByTagName("body").item(0);
	
	// cria a div transparente que cobre todo o fundo
	var objFundo = document.getElementById("fundo_img");
	objBody.removeChild(objFundo);

}

function pegaMedidas(rolagem){
	// Pega altura e largura do conteudo da pagina
	var larguraPag, alturaPag;
	if (self.innerHeight) {	// Todos exceto IE entram aqui
		larguraPag = self.innerWidth;
		alturaPag = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // IE 6, IE 7 entraram aqui
		larguraPag = document.documentElement.clientWidth;
		alturaPag = document.documentElement.clientHeight;
	} else if (document.body) { // Nenhum testado entrou aqui, deixo por garantia
		larguraPag = document.body.clientWidth;
		alturaPag = document.body.clientHeight;
	}
	if(rolagem){ // se foi pedidos os valores incluindo barra de rolagem
		var rolagemH, rolagemV;
		
		if (window.innerHeight && window.scrollMaxY) {	// Nenhum testado entrou aqui, mas deixo por garantia
			rolagemH = document.body.scrollWidth;
			rolagemV = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ 
			// Opera9, Mac 3 para windows entram aqui
			rolagemH = document.body.scrollWidth;
			rolagemV = document.body.scrollHeight;
		} else { //IE6, IE7, FF, Netscape entram aqui.
			rolagemH = document.body.offsetWidth;
			rolagemV = document.body.offsetHeight;
		}	
		// Verifica se deve usar a altura do quadro do navegador ou da rolagem se existir
		if(rolagemV > alturaPag) {
			alturaPag = rolagemV;
			if(/Internet Explorer/.test(navigator.appName)) alturaPag+=30; // corrigir bug IE
		}
		// Verifica se deve usar a largura do quadro do navegador ou da rolagem se existir
		if(rolagemH > larguraPag) larguraPag = rolagemH;
	}
	valores = new Array(larguraPag,alturaPag); 
	return valores;
}

function mascaraData(campoData){
  var data = campoData.value;
  if (data.length == 2){
	  data = data + '/';
	  campoData.value = data;
		return true;              
  }
  if (data.length == 5){
	  data = data + '/';
	  campoData.value = data;
	  return true;
  }
 }
		 
function ehNumerico(e)
{
	var retorno = false;
	var tecla=(window.event)?event.keyCode:e.which;
	if ((tecla > 47 && tecla < 58)) {
		retorno = true;
	} else if (tecla != 8) {
		retorno = false;
	} else { 
		retorno = true;
	}
	if (window.event) {
		event.returnValue=retorno;
	}
	return retorno;
}

function validaData(campo){
	if (campo.value!='') {
		var expReg = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[1-2][0-9]\d{2})$/;
		var msgErro = 'Data inválida.';
		
		if (campo.value.match(expReg)) {
			
			var dia = parseFloat(campo.value.substring(0,2));
			var mes = parseFloat(campo.value.substring(3,5));
			var ano = parseFloat(campo.value.substring(6,10));
			
			if (ano < 1900) {
				alert("Data inválida !!! O ano deve ser maior que 1900.");
				return false;
			}
			
			if ((mes==4 || mes==6 || mes==9 || mes==11) && dia > 30) {
				alert("Data inválida !!! O mês especificado contém no máximo 30 dias.");
				return false;
			} else {
				if (ano%4!=0 && mes==2 && dia>28) {
					alert("Data inválida!! O mês especificado contém no máximo 28 dias.");
					return false;
				} else {
					if (ano%4==0 && mes==2 && dia>29) {
						alert("Data inválida!! O mês especificado contém no máximo 29 dias.");
						return false;
					}
				}
			}
		} else {
			alert(msgErro);
			campo.focus();
			return false;
		}
	}
}

