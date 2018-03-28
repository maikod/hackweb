<?php

//richiesta nome utente
	session_start();
	
	//recupero delle classi fondamentali
	require_once("../../lib/acc_class.php");
	
	//inizializzazione della classe ACCOUNT
	$acc = new ACCOUNT;
	
	//get user
	$utente = $acc->checkUser();

require_once("../../lib/CANCPRIV.php");

$rg1num = $_POST['rg1num'];
$rg1anno = $_POST['rg1anno'];
$assistito = $_POST['assistito'];
$controparte = $_POST['controparte1'];
$organo = $_POST['organo'];

//verifica nome utente 
$can = new CANCPRIV;

//$result = $can->verifica_rg($rg1num, $rg1anno);
$result = $can->verificaControparte($controparte);

if($result > 1){
	echo($result);
}else{
	if($rg1num == NULL || $rg1anno == NULL || $assistito == NULL || $organo == NULL){
		echo('2');
	}
	else{
		$result = $can->insPratica($rg1num, $rg1anno, $assistito, $utente, $controparte, $organo);
		echo($result);
	}
}

?>
