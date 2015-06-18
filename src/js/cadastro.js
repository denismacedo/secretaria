function submitSalvar() {
	
	document.cadastroForm.action = 'doCadastro.php?method=salvar';
	//try {
	//loading();
	//} catch(err) {
	//	alert(err.description);
	//}
	document.cadastroForm.submit();

}

function submitNovo() {
	loading();
	window.location = 'cadastroPF.php';
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

function submitControlePresenca() {
	
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
	document.cadastroForm.action = 'controlePresenca.php';
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

function submitCracha(codigo) {
	
//	showFundo();
	
//	var divInsc = document.getElementById("divInscricao");
//	divInsc.style.visibility = "VISIBLE";
//	divInsc.style.display = "";
//	divInsc.style.MozOpacity=1; // transparencia FF
//	divInsc.style.opacity=1; // transparencia  FF, Opera, Safari, Netscape
//	divInsc.style.filter="Alpha(Opacity=100)";
//	
//	var divInscInterna = document.getElementById("divInscricaoInterna");
//	divInscInterna.style.visibility = "VISIBLE";
//	divInscInterna.style.display = "";
//	divInscInterna.style.MozOpacity=1; // transparencia FF
//	divInscInterna.style.opacity=100; // transparencia  FF, Opera, Safari, Netscape
//	divInscInterna.style.filter="Alpha(Opacity=100)";
//	
//	document.cadastroForm.target = 'ifInscricao';

	if (document.cadastroForm.SPECIAL_PARAM.value == "CRACHA_INFANTIL") {
		if (!confirm("DESEJA UTILIZAR O CRACHÁ PEQUENO PARA CRIANÇAS DE 0 A 6 ANOS NA IMPRESSÃO?")) {
			document.cadastroForm.SPECIAL_PARAM.value = "";
		}
	}

	document.cadastroForm.target = '_blank';
	document.cadastroForm.action = 'doInscricao.php?method=printCracha&codPF=' + codigo;
	document.cadastroForm.submit();
	
}

function submitCrachaFromInsc(codigo) {
	closeDivInscricao();
	submitCracha(codigo);
}

function executeHelper() {
	closeDivInscricao();
}


function submitExcluir() {

}

function validaDados(form) {

	return true;
}

function submitShowInsc() {
	var mywin = chamaPopup('cadastroPF.do?method=showInscricao&codigoPF=' + document.cadastroForm.codigo.value, 640, 380, 80, 45);
	return true;
}

function findPF() {
	var mywin = chamaPopup('cadastroPF.do?method=consultarPop', 640, 380, 80, 45);
	return true;
}

function atualizaPF() {
	document.cadastroForm.action = 'cadastroPF.do?method=init';
	loading();
	document.cadastroForm.submit();
}

function findResponsavel() {
	var mywin = chamaPopup('cadastroPF.do?method=consultarRespPop', 640, 380, 80, 45);
	return true;
}

function findOrigem() {
	var mywin = chamaPopup('cadastroPJ.do?method=consultarOrigemPop', 640, 380, 80, 45);
	return true;
}

function atualizaOrigem() {

}

function imprimeInscricao(codigoPF, subOcorrencia) {
	window.location = 'inscricao.do?method=printCracha&codigoPF=' + codigoPF + '&subOcorrencia='+subOcorrencia;
}

function submitChangePais() {
	document.cadastroForm.action = 'cadastroPF.do?method=changePais';
	loading();
	document.cadastroForm.submit();
}

function submitChangeEstado() {
	document.cadastroForm.action = 'cadastroPF.do?method=changeEstado';
	loading();
	document.cadastroForm.submit();
}


function searchPF() {
	loading();
	document.cadastroForm.action = 'doCadastro.php?method=searchPF';
	document.cadastroForm.target = '_self';
	document.cadastroForm.submit();
}

function searchByCPF() {
	if (document.cadastroForm.cpf.value.trim() != "") {
		loading();
		document.cadastroForm.action = 'doCadastro.php?method=searchByCPF';
		document.cadastroForm.target = '_self';
		document.cadastroForm.submit();
	} else {
		alert("Informe o CPF!");	
	}
}


function clearField(origem, fieldName) {
	if (origem.value == "") {
		field =	document.getElementById(fieldName);	
		field.value = "";
	}
}

function cadastrarPJ() {
	
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
	document.cadastroForm.action = 'cadastroPJ.php?POP=1';
	document.cadastroForm.submit();
}