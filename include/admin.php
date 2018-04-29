<?php 
	
//funzione che carica automaticamente le classi
function __autoload($nome_classe){
    require_once '../libs/' . $nome_classe . '.php';
}

//inizializzazione della classe ACCOUNT
$acc = new ADMIN;

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