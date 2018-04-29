<?php

require_once("../../lib/acc_class.php");

$username = $_POST['username'];
$pwd = $_POST['pwd'];
$check = $_POST['ricordami'];
$last_ip = $_SERVER['REMOTE_ADDR'];

if(!isset($check)){
	$check = "ric";
}

//verifica nome utente 
$acc = new ACCOUNT;

$acc->login($username, $pwd, $check);

?>