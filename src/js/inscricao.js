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

function submitExcluirInscricao() {
		document.inscricaoForm.action = "doInscricao.php?method=excluir";
		document.inscricaoForm.submit();
}