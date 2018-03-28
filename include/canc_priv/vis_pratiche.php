<?php
//##visualizza pratiche

//richiesta nome utente
	session_start();
	
	//recupero delle classi fondamentali
	require_once("../../lib/acc_class.php");
	
	//inizializzazione della classe ACCOUNT
	$acc = new ACCOUNT;
	
	//get user
	$utente = $acc->checkUser();

//inizio della sessione
session_start();

require_once("../../security/security.php");
if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){
	
	if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] >= proteggi("d","erfsa",80,"afeg44","232")){

//da qui in poi html		
?>
	
<?php
//fine zona html

//inizio zona php editabile
require_once("../../lib/CANCPRIV.php");
$canc = new CANCPRIV;

//mysql
$canc->sql_open();
$db = $canc->db;
$sql = "SELECT rg1num, rg1anno, registrante, assistito, controparte1, organo  FROM cp_pratiche WHERE registrante = '$utente' 
OR controparte1 = '$utente'";
$stmt = $db->prepare($sql);
$stmt->execute();

$stmt->bind_result($b1, $b2, $b3, $b4, $b5, $b6);

//INIZIO costruzione tabella
echo('<table class="" width="400"><tr class="tab-pratiche"><td class="tab-pratiche"><span style="color:#00FF00">R.G.</span></td>
<td class="tab-pratiche"><span style="color:#00FF00">organo</span></td>
<td class="tab-pratiche"><span style="color:#00FF00">registrante</span></td>
<td class="tab-pratiche"><span style="color:#00FF00">assistito</span></td>
<td class="tab-pratiche"><span style="color:#00FF00">controparte 1</span></td>
</tr>');

while ($stmt->fetch()) {
	echo('<tr class="tab-pratiche"><td class="tab-pratiche">'.$b1.'/'.$b2.'</td>
	<td class="tab-pratiche">'.$b6.'</td>
	<td class="tab-pratiche">'.$b3.'</td>
	<td class="tab-pratiche">'.$b4.'</td>
	<td class="tab-pratiche">'.$b5.'</td>
	</tr>');
}

echo('</table>');
//FINE costruzione tabella		
		
$stmt->close();
$canc->sql_close();

//fine zona php editabile

	}
}else{ 
	echo('tu non hai accesso a questa pagina.');
}
?>