function submitSalvar() {
	
	document.cadastroForm.action = 'doCadastroPJ.php?method=salvar';
	loading();
	document.cadastroForm.submit();

}

function submitNovo(pop) {
	loading();
	if (pop != "") {
		window.location = 'cadastroPJ.php?POP=' + pop;
	} else {
		window.location = 'cadastroPJ.php';
	}
	//document.cadastroForm.submit();
}

function submitInscricao(codigo) {
	
	showFundo();
	
	var divInsc = document.getElementById("divInscricao");
	divInsc.style.visibility = "VISIBLE";
	divInsc.style.display = "";
	divInsc.style.MozOpacity=1; // transparencia FF
	divInsc.style.opacity=1; // transparencia  FF, Opera, Safari, Netscape
	divInsc.style.filter="Alpha(Opacity=100)";
	
	var divInscInterna = document.getElementById("divInscricaoInterna");
	divInscInterna.style.visibility = "VISIBLE";
	divInscInterna.style.display = "";
	divInscInterna.style.MozOpacity=1; // transparencia FF
	divInscInterna.style.opacity=100; // transparencia  FF, Opera, Safari, Netscape
	divInscInterna.style.filter="Alpha(Opacity=100)";
	
	document.cadastroForm.target = 'ifInscricao';
	document.cadastroForm.action = 'doInscricao.php?method=init&codPF=' + codigo;
	document.cadastroForm.submit();
}

function closeDivInscricao() {
	
	hideFundo();
	
	var divInsc = document.getElementById("divInscricao");
	divInsc.style.visibility = "HIDDEN";
	divInsc.style.display = "NONE";
	
	var divInscInterna = document.getElementById("divInscricaoInterna");
	divInscInterna.style.visibility = "HIDDEN";
	divInscInterna.style.display = "NONE";
	
}

function searchPJ() {
	loading();
	document.cadastroForm.action = 'doCadastroPJ.php?method=searchPJ';
	document.cadastroForm.target = '_self';
	document.cadastroForm.submit();
}

function clearField(origem, fieldName) {
	if (origem.value == "") {
		field =	document.getElementById(fieldName);	
		field.value = "";
	}
}
