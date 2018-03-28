<?php
	//inizio della sessione
	session_start();
	
	//recupero indirizzo web dell'utente
	$ip = $_SERVER['REMOTE_ADDR'];
	
	//recupero delle classi fondamentali
	require_once("./lib/acc_class.php");
	require_once("./lib/register_class.php");
	
	//inizializzazione della classe ACCOUNT
	$acc = new ACCOUNT;
	
	//da utilizzare solo quando si imposta il sito
	//$acc->creaDB();
	
	//funzione che carica automaticamente le classi
	function __autoload($nome_classe){
		require_once 'lib/' . $nome_classe . '.php';
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Scrambler Ducati">
    <meta property="og:image" content="" />
    <meta property="og:title" content="Scrambler Ducati" />
    <meta property="og:description" content="Scrambler Ducati"/>
    <meta property="og:site_name" content="Scrambler Ducati"/>
    <meta property="og:type" content="website"/>
    
    <title>CarChoice</title>
    
    <!-- icona sito -->
	<link rel="icon" type="image/png" href="img/logo/fav.png">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

    
    <!--CSS include-->
    <link href="css/custom.css" rel="stylesheet">
    
	<!--CSS jVideo -->
	<link href="js/jvideo/css/style3.css" rel="stylesheet" type="text/css">
	<link href="js/jvideo/css/mejs-skins.css" rel="stylesheet" type="text/css">
    
    <!-- CSS fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- JavaScript
	================================================== -->
	<!-- Placed at the top of the document so you can load plugins later -->
	<script src="js/jquery/jquery.min.js"></script>
	<script src="js/jquery/jquery.easing.min.js"></script>
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script src="js/holder/holder.js"></script>
	
	<!--<script src="js/ckeditor/ckeditor.js"></script>-->
	
	<!-- SUMMERNOTE -->	
	<link href="js/summernote/dist/summernote.css" rel="stylesheet">
	<script src="js/summernote/dist/summernote.min.js"></script>
	
	<!-- jVideo -->
	<script src="js/jvideo/mediaelement-and-player.js"></script>
	
	<!-- FlexSlider -->
	<link href="js/FlexSlider/flexslider.css" rel="stylesheet">
	<script src="js/FlexSlider/jquery.flexslider-min.js"></script>

	<!-- FRANKIE'S -->
	<script src="js/custom.js"></script>
	<script src="js/general.js"></script>
	<script src="js/loadPage.js"></script>
	
	<script>
		//variabili globali
		timeout = 0;
		pagina = '';
		utente = '';
		potere = 0;
		avatar = 'avatar_base.png';
	</script>
    
</head>


<body id="page-top" onresize="" style="" onload="">

	<!-- Navbar
    ================================================== -->
    <div class="container blog-masthead">
	    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand nav-link" href="#page-top">CarChoice</a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li><a class="nav-link" href="#page-top">Home</a></li>

	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            <li id="li-login">
		            <a id="a-login" class="nav-link" href="#login" data-toggle="dropdown">Login</a>
		            <ul id="user-menu" class="dropdown-menu">
			            <li><a onclick="" href="#login" class="edit-profile nav-link">edit profile</a></li>
			            <li><a onclick="logout();">logout</a></li>
		            </ul>
	            </li>
	          </ul>
	        </div><!-- /.collapse -->
	      </div><!-- /.container -->
	    </div>
    </div>
    <!-- /.navbar -->
    
    <!-- panel
    ================================================== -->
	<div id="panel" class="container">
	</div>
	<script>
	$('#panel').load('./include/user/panel.php');
	</script>

	<!-- JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

</body>

</html>

<?php
	//include_once('./php/checkUserLogin.php');
?>
