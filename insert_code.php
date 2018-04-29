<?php
require_once("lib/acc_class.php");
$user = $_GET['user'];
$code = $_GET['code'];

$acc = new ACCOUNT;
$acc->verifica_registrazione($user, $code);
?>