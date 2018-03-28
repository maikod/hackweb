<?php
//##visualizza pratiche

//inizio della sessione
session_start();

require_once("../../security/security.php");
if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){
	
	if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] >= proteggi("d","erfsa",80,"afeg44","232")){

//da qui in poi html		
?>
sezione in costruzione		
<?php
//fine zona html

	}
}else{ 
	echo('tu non hai accesso a questa pagina.');
}
?>