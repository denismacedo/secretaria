var req;

function loadXMLDoc(url, tabela)
{
    req = null;
    // Procura por um objeto nativo (Mozilla/Safari)
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest()
        if (tabela == "estados")
		{
		  req.onreadystatechange = processReqChangeEstados;
          req.open("GET", url, true);
		}
		else if (tabela == "cidades")
		{
		  req.onreadystatechange = processReqChangeCidades;
		  req.open("GET", url, true);
		}
        req.send(null);
    // Procura por uma versao ActiveX (IE)
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {            		    
			if (tabela == "estados")
			{
			  req.onreadystatechange = processReqChangeEstados;
              req.open("GET", url, true);			
			}
			else if (tabela == "cidades")
			{
			  req.onreadystatechange = processReqChangeCidades;
			  req.open("GET", url, true);
			}
            req.send();
        }
    }
}

function processReqChangeEstados()
{
    // apenas quando o estado for "completado"
    if (req.readyState == 4) 
	{
        // apenas se o servidor retornar "OK"
        if (req.status == 200) 
		{
			//alert(req.responseText);
            // procura pela div id="divestados" e insere o conteudo
            // retornado nela, como texto HTML
   	        var divUF = document.getElementById('divUF');
			divUF.innerHTML = req.responseText;
			divUF.style.visibility = "VISIBLE";
			divUF.style.display = "";
			
			var divEstado = document.getElementById("divEstado");
			divEstado.style.visibility = "VISIBLE";
			divEstado.style.display = "";
        } 
		else 
		{
            alert("Houve um problema ao obter os dados:\n" + req.statusText);
        }
		unloading();
    }
}

function processReqChangeCidades()
{
    // apenas quando o estado for "completado"
    if (req.readyState == 4) {		
        // apenas se o servidor retornar "OK"
        if (req.status == 200) {
			//alert(req.responseText);
            // procura pela div id="divcidades" e insere o conteudo
            // retornado nela, como texto HTML
   	        var divCidade = document.getElementById('divCidade');
			divCidade.innerHTML = req.responseText;
			divCidade.style.visibility = "VISIBLE";
			divCidade.style.display = "";
			
			var divCid = document.getElementById("divCid");
			divCid.style.visibility = "VISIBLE";
			divCid.style.display = "";
        } else {
            alert("Houve um problema ao obter os dados:\n" + req.statusText);
        }
		unloading();
    }
}

function changePais(valor)
{
	
	if (valor != "")
	{
	  loading();
      loadXMLDoc("doInscricao.php?method=getEstados&pais=" + valor, "estados");
	  document.getElementById('divEstado').style.visibility='visible';
	  document.getElementById('divUF').style.visibility='visible';
	  document.getElementById('divCidade').style.visibility='hidden';
	  document.getElementById('divCid').style.visibility='hidden';
	}
	else
	{
		document.getElementById('divEstado').style.visibility='hidden';
		document.getElementById('divUF').style.visibility='hidden';
		document.getElementById('divCidade').style.visibility='hidden';
		document.getElementById('divCid').style.visibility='hidden';
	}
}

function changeEstado(pais, estado)
{
	if (estado != "")
	{
			loading();
	  loadXMLDoc("doInscricao.php?method=getCidades&pais=" + pais + "&uf=" + estado, "cidades");
	  document.getElementById('divCidade').style.visibility='visible';
	  document.getElementById('divCid').style.visibility='visible';
	}
	else
	{
		document.getElementById('divCidade').style.visibility='hidden';
		document.getElementById('divCid').style.visibility='hidden';
	}
}



function submitSalvar() {
	
	document.cadastroForm.action = 'doInscricao.php?method=salvar';
	loading();
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
	document.cadastroForm.action = 'doInscricao.php?method=initCracha&codPF=' + codigo;
	document.cadastroForm.submit();
	
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
	var mywin = chamaPopup('doInscricao.php?method=getResponsaveis', 640, 380, 80, 45);
	return true;
}

function findOrigem() {
	var mywin = chamaPopup('doInscricao.php?method=getCentros', 640, 380, 80, 45);
	return true;
}

function atualizaOrigem() {

}

function imprimeInscricao(codigoPF, subOcorrencia) {
	window.location = 'inscricao.do?method=printCracha&codigoPF=' + codigoPF + '&subOcorrencia='+subOcorrencia;
}

function submitChangePais(pais) {
	document.cadastroForm.action = 'doInscricao.php?method=getEstados&pais=';
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

function exibeCadCentro() {
	var mywin = chamaPopup('doInscricao.php?method=initCadCentro', 670, 380, 80, 45);
	return true;
}

function submitSalvarPJ() {

	document.cadastroForm.action = 'doInscricao.php?method=salvarPJ';
	document.cadastroForm.submit();

	
}