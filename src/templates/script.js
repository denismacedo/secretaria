var req;

function loadXMLDoc(url,valor,tabela)
{
    req = null;
    // Procura por um objeto nativo (Mozilla/Safari)
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest()
        if (tabela == "estados")
		{
		  req.onreadystatechange = processReqChangeEstados;
          req.open("GET", url+'?fPais='+valor, true);
		}
		else if (tabela == "cidades")
		{
		  req.onreadystatechange = processReqChangeCidades;
		  req.open("GET", url+'?fEstados='+valor, true);
		}
        req.send(null);
    // Procura por uma versao ActiveX (IE)
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {            		    
			if (tabela == "estados")
			{
			  req.onreadystatechange = processReqChangeEstados;
              req.open("GET", url+'?fPais='+valor, true);			
			}
			else if (tabela == "cidades")
			{
			  req.onreadystatechange = processReqChangeCidades;
			  req.open("GET", url+'?fEstados='+valor, true);
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
            // procura pela div id="divestados" e insere o conteudo
            // retornado nela, como texto HTML
   	        document.getElementById('divestados').innerHTML = req.responseText;
        } 
		else 
		{
            alert("Houve um problema ao obter os dados:\n" + req.statusText);
        }
    }
}

function processReqChangeCidades()
{
    // apenas quando o estado for "completado"
    if (req.readyState == 4) {		
        // apenas se o servidor retornar "OK"
        if (req.status == 200) {
            // procura pela div id="divcidades" e insere o conteudo
            // retornado nela, como texto HTML
   	        document.getElementById('divcidades').innerHTML = req.responseText;
        } else {
            alert("Houve um problema ao obter os dados:\n" + req.statusText);
        }
    }
}

function changePais(valor)
{
	if (valor != "")
	{
      loadXMLDoc("sql/consultaEstados.php", valor, "estados");
	  document.getElementById('divestados').style.visibility='visible';
	}
	else
	{
		document.getElementById('divestados').style.visibility='hidden';
		document.getElementById('divcidades').style.visibility='hidden';
	}
}

function changeEstados(valor)
{
	if (valor != "")
	{
	  loadXMLDoc("sql/consultaCidades.php",valor,"cidades");
	  document.getElementById('divcidades').style.visibility='visible';
	}
	else
	{
		document.getElementById('divcidades').style.visibility='hidden';
	}
}

function mascaraData(Campo)
{
  if ((Campo.value.length == 2) || (Campo.value.length == 5))
  {
    Campo.value = Campo.value + "/";
  }
}

function validaDados(form) 
{
	var camposObrigatorios;
	camposObrigatorios = "";
	
	if (form.fNome.value == "")
	{
	  camposObrigatorios = "Informe o Nome!\n";
	}
	if (form.fDataNasc.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe a Data de Nascimento!\n";
	}
	if (form.fRua.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe a Rua!\n";
	}
	if (form.fNumero.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe o Número da Rua!\n";
	}
	if (form.fCep.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe o CEP!\n";
	}
	if (form.fBairro.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe o Bairro!\n";
	}
	if (form.fPais.value == "")
	{
	  camposObrigatorios = camposObrigatorios + "Informe o País!\n";
	}
	else if (form.fEstados.value == "")
		{
		  camposObrigatorios = camposObrigatorios + "Informe o Estado!\n";
		}
		else if (form.fCidades.value == "")
			{
			  camposObrigatorios = camposObrigatorios + "Informe a Cidade!\n";
			}
	if (form.fCodOrigem.value == "")
	{
	  //camposObrigatorios = camposObrigatorios + "Informe o Centro Espírita!\n";
	}

	if (camposObrigatorios != "")
	{
	  alert("Campos Obrigatórios \n\n" + camposObrigatorios);
	}
	return (camposObrigatorios == "");
}

function submitConfirmarCadastroPF() 
{
	if (validaDados(document.cadastroform)) 
	{
		document.cadastroform.action = 'sql/insertautocadastro.php';
		loading();
		document.cadastroform.submit();
	}
}

function submitConfirmarInscricao()
{
	document.inscricaoForm.action = 'sql/insert';
	document.inscricaoForm.submit();
}

function findResponsavel() 
{
	var mywin = chamaPopup('inscricaoConcafras2009.do?method=consultarRespPop', 640, 380, 80, 45);
	return true;
}

function findOrigem() {
	var mywin = chamaPopup('../sql/consultaOrigem.php', 740, 600, 100, 45);
	return true;
}

function loading() {
	var loading = document.getElementById("divLoading");
	loading.style.visibility = "VISIBLE";
	loading.style.display = "";
	loading.style.MozOpacity=.7; // transparencia FF
	loading.style.opacity=.7; // transparencia  FF, Opera, Safari, Netscape
	loading.style.filter="Alpha(Opacity=70)";
}

function chamaPopup(endereco,largura,altura,posicaoX,posicaoY, menubar){
	if (menubar) {
		menubar = 1;
	} else {
		menubar = 0;
	}
	mywindow = window.open(endereco,"","resizable=1,location=0,menubar=yes,status=1,scrollbars=1,width=" + largura + ",height=" + altura);
	mywindow.moveTo(posicaoX,posicaoY);
	mywindow.opener = window;
	return mywindow;
}