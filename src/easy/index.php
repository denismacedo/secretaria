<?php 
require_once("../util/comum.php"); 
require_once("../util/http.php"); 
require_once('../sql/conexao.php'); 
include ("../sql/classOcorrencia.php");
require_once("../sql/classConfiguracaoPagamento.php"); 

$codEvento = getPost("evento");
$codOcorrencia = getPost("ocorrencia");

if ($codEvento != "" && $codOcorrencia != "") {
	
	$objOco = new classOcorrencia();
	$objOco = $objOco->findByCodigo($codEvento, $codOcorrencia);

	$agora = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
	$fim = mktime (0, 0, 0, substr($objOco->fim_inscricao,5,2)  , substr($objOco->fim_inscricao,8,2), substr($objOco->fim_inscricao,0,4));
	
	if ($agora > $fim) {
		$encerrado = true;
	} else {
		$encerrado = false;
	}
}

if ($objOco != "") {

	session_register($EVENTO_SESSION);
	session_register($OCORRENCIA_SESSION);
	session_register($NOME_EVENTO_SESSION);
	$_SESSION["NOME_EVENTO_SESSION"] = $objOco->nome;
	$_SESSION["EVENTO_SESSION"] = $objOco->evento;
	$_SESSION["OCORRENCIA_SESSION"] = $objOco->codigo;
	
	
	$objCPFinder = new classConfiguracaoPagamento();
	$objCP = $objCPFinder->findByEventoOcorrencia($_SESSION["EVENTO_SESSION"], $_SESSION["OCORRENCIA_SESSION"]);
	
}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>CONCAFRAS - Secretaria</title>

	<script type="text/JavaScript" src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/JavaScript" src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<script type="text/JavaScript" src="../js/popups.js"></script>
	<script type="text/JavaScript" src="../js/default.js"></script>
	<script type="text/JavaScript" src="../js/auto/cadastro.js"></script>

</head>

<body>
    <!-- Preloader -->
    <!--div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div-->
    <div id="wrapper" style=" width: 100%; margin: 0 auto;">
       
        <!-- Page Content -->
        <div id="page-wrapper" style=" width: 100%; margin: 0 auto;">
            <div class="container-fluid" style=" width: 100%; margin: 0 auto;">
			  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tbody><tr>
				<td class="tituloheader" align="center" background="../imagens/bg_top.jpg" height="40">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody><tr>
							<td valign="middle" align="left">
								<img src="../imagens/logo_concafras.jpg">
							</td>
							<td valign="baseline" align="right">
								<img src="../imagens/logo_inscricao.jpg">
							</td>
						</tr>
					</tbody></table>
				</td>
			  </tr>
			  
			  <tr>
				<td background="../imagens/bg_menu.jpg">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody><tr>
						<td>
						</td>

						<td align="center" nowrap="nowrap" style="color:#FFFFFF;padding:4px" >
						
						<B><?php echo $_SESSION["NOME_EVENTO_SESSION"]; ?></B>
						</td>
					</tr>
				</tbody>
				</table>
					</td>
			  </tr>
			<tr>
				<td>
				<?php include("message.php"); ?>
				</td>
			  </tr>
			</tbody>
			</table>
	<div id="divCarregando" style="border: 8px solid #036; overflow: visible; color: #fff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; position: absolute; left: 30%; top: 25%; width: 380px; height: 140px; z-index: 999; background-color: #369; visibility: hidden; padding:20px;filter:alpha(opacity=80);-moz-opacity:.80;opacity:.80;
">
		<p align="center"><br><br>Aguarde!<br><br>Carregando a página... <br></p>
	</div>
  <br/><br/><br/>
	<div class="white-box">
		<table width="100%" border="0" cellpadding="3" cellspacing="0">
		  <tr>
			
			<?php if (true) { ?>
			<td align="center" valign="middle">					
			  <a href="doInscricao.php?method=init"><img src="../imagens/btn_nova.png" alt="Realizar Nova Inscri&ccedil;&atilde;o" width="138" height="120" border="0"></a>

<br>
<?php
$valor='conceicao';
if (preg_match('/[^a-z ]/i',$valor)) {
echo 'valor invalido: '.$valor;
} else {
//echo 'valor valido: '.$valor;
}

?>


			  </td>
			<?php } else { ?>
			
			<?php } ?>
			
			<!--td align="center" valign="middle">
			<a href="doInscricao.php?method=acompanhaInscricaoInit"><img src="../imagens/btn_acompanhar.png" alt="Reimprimir Boleto" width="138" height="120" border="0"></a>
			</td-->
		  </tr>
		</table>
    </div>

</div>
            <!-- /.container-fluid -->
           
        </div>
		<div class="text-center" style=" width: 75%; margin: 1 auto;">
		<span style="color:#FFF">Sistema de inscri&ccedil;&atilde;o CONCAFRAS-PSE</span>
		</div>
        <!-- /#page-wrapper -->
    </div>

    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
</body>

</html>

