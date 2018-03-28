<?php 

	//inizio della sessione
	session_start();
	
	//recupero delle classi fondamentali
	require_once("../lib/acc_class.php");
	
	//inizializzazione della classe ACCOUNT
	$acc = new ACCOUNT;
	
	//get user
	$utente = $acc->checkUser();
	if(isset($_SESSION['user'])){
		echo "welcome back $utente";
		//echo "session id: ". $_COOKIE['PHPSESSID']."<br />";
		//echo $_SESSION['ric'];
	}elseif(isset($_COOKIE[md5('user')])){
		echo "welcome back $utente";
	}else{
		echo "please login...";
	}

?>
<script>
//alert(utente);
</script>