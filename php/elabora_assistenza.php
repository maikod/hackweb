<?php 
require_once("../lib/acc_class.php");
$acc = new ACCOUNT;

if($_POST['form'] == 1){
    $nome = mysql_real_escape_string($_POST['nome']);
    $cognome = mysql_real_escape_string($_POST['cognome']);
    $mail = mysql_real_escape_string($_POST['mail']);
    $telefono = mysql_real_escape_string($_POST['telefono']);
    $urgenza = mysql_real_escape_string($_POST['urgenza']);
    $descrizione_richiesta = mysql_real_escape_string($_POST['descrizione_richiesta']);
	
	$headers = 'From: h@ckweb webmaster <webmaster@hackweb.altervista.org>' . "\r\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
	$headers .= "Content-Transfer-Encoding: 7bit\n\n";
	
	$subject = "h@ckweb assistance: $tipo_richiesta";
	$mex = "<html><head></head><body>nome: $nome <br>cognome: $cognome <br>mail: $mail <br>telefono: $telefono <br>urgenza: $urgenza <br><br>descrizione:<br>$descrizione_richiesta<br><br><br><br></body></html>";
	
	if($nome == "" || $mail == "" || $urgenza == "" || $descrizione_richiesta == ""){
		echo "2";
	}else{
		$acc->richiestaHelp($nome, $cognome, $mail, $telefono, $urgenza, $tipo_richiesta, $descrizione_richiesta);
		
		//mail
		mail("frank10gm@gmail.com", $subject, $mex, $headers);
		
		echo("1");
	}
}

?>
	