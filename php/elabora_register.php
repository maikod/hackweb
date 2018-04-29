<?php
require_once("../lib/acc_class.php");

$nick = $_POST['nick'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$mail = $_POST['mail'];
$text = $_POST['object'];
$last_ip = $_SERVER['REMOTE_ADDR'];
$mex = "capo abbiamo un nuovo utente.. ecco i suoi dati..

-----------------------------
nick:		$nick
password:	$pwd
mail:		$mail
ip:		$last_ip
------------------------------
questo è il suo messaggio:

$text
";

//verifica nome utente 
$acc = new ACCOUNT;

$result = $acc->verifica_utente($nick, $mail);

if($result == 2 || $result == 3){
	echo($result);
	
}else{
	if($nick == NULL || $pwd == NULL || $pwd2 == NULL || $mail == NULL){
		echo('4');
	}
	elseif($pwd != $pwd2){
		echo('5');
	}elseif(eregi('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$', $mail)){
		$result = $acc->register($nick, $pwd, $mail);
		echo($result);
	}else{
		echo('email format not correct');
	} 
}

?>
