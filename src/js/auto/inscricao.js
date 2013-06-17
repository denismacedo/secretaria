function HabilitaComissao()
{  
  if (document.inscricaoForm.flag_trabalhador.value == "S")
  {
    document.getElementById('divComissao').style.visibility = 'visible';
  }
  else
  {
    document.getElementById('divComissao').style.visibility = 'hidden';
  }
}

function submitConfirmarInscricao() {
	document.inscricaoForm.action = "doInscricao.php?method=save";
	document.inscricaoForm.submit();
}

function submitBoleto() {
	document.inscricaoForm.action = "doInscricao.php?method=geraBoleto";
	document.inscricaoForm.submit();
}