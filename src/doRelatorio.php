<?php 
session_start();

require_once('sql/conexao.php'); 
require_once('util/http.php'); 
require_once('util/comum.php'); 

require_once("sql/classPF.php"); 
require_once("sql/classOcorrencia.php"); 
require_once("sql/classInscricao.php"); 
require_once("sql/classTipoAlojamento.php"); 
require_once("sql/classParticipante.php"); 
require_once("sql/classCracha.php"); 
require_once("cursoBean.php"); 


$metodo = $_GET["method"];

if ($metodo == "numParticipantesCurso") {

	numParticipantesCurso();
	
} else if ($metodo == "numParticipantesComissao") {
	
	numParticipantesComissao();
		
} else if ($metodo == "participantesCurso") {
	
	participantesCurso();
	
} else if ($metodo == "participantesComissao") {
	
	participantesComissao();

} else if ($metodo == "participantesCidade") {
	
	participantesCidade();

} else if ($metodo == "cidades") {
	
	cidades();
	
} else if ($metodo == "inscritosSemCurso") {

	inscritosSemCurso();

} else if ($metodo == "dadosEvento") {

	dadosEvento();
	
} else if ($metodo == "inscritosInternet") {

	inscritosInternet();
	
} else if ($metodo == "inscritos") {

	inscritos();
	
} else if ($metodo == "presentes") {

	presentes();
	
} else if ($metodo == "inscricoesPagas") {

	inscricoesPagas();
} else if ($metodo == "vagas") {

	vagas();
} else if ($metodo == "centros") {

	centros();
} else if ($metodo == "crachasImpressos") {

	crachasImpressos();
} else if ($metodo == "criancasResponsaveis") {
	criancasResponsaveis();
} else if ($metodo == "criancasResponsaveisCurso") {
	criancasResponsaveisCurso();
} else if ($metodo == "relEmails") {
	relEmails();
} else if ($metodo == "relInscritosTE") {
	relInscritosTE();
} else if ($metodo == "relInscritosTA") {
	relInscritosTA();
} else if ($metodo == "relParticipantesCursoImp") {
	relParticipantesCursoImp();
}

function relParticipantesCursoImp() {
	include("relParticipantesCursoImp.php");
}
function relInscritosTA() {
	include("relInscritosTA.php");
}

function relInscritosTE() {
	include("relInscritosTE.php");
}

function numParticipantesCurso() {

	include("relNumParticipantesCurso.php");
}

function numParticipantesComissao() {

	include("relNumParticipantesComissao.php");
}

function participantesCurso() {

	include("relParticipantesCurso.php");
}


function participantesComissao() {

	include("relParticipantesComissao.php");
}


function participantesCidade() {

	include("relParticipantesCidade.php");
}

function cidades() {

	include("relCidades.php");
}


function inscritosSemCurso() {

	include("relInscritosSemCurso.php");
}


function dadosEvento() {

	include("relDadosEvento.php");
}

function inscritosInternet() {

	include("relInscritosInternet.php");
}

function inscritos() {

	include("relInscritos.php");
}

function presentes() {

	include("relPresentes.php");
}

function inscricoesPagas() {

	include("relInscricoesPagas.php");
}

function vagas() {

	include("relVagas.php");
}
function centros() {

	include("relCentros.php");
}

function crachasImpressos() {

	include("relCrachasImpressos.php");
}

function criancasResponsaveis() {
	include("relCriancaResponsavel.php");
}
function criancasResponsaveisCurso() {
	include("relCriancaResponsavelCurso.php");
}

function relEmails() {
	include("relEmails.php");
}

?>