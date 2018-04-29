<?php
require_once('../lib/acc_class.php');

$marca = $_POST['marca'];
$modello = $_POST['modello'];
$vecchio = $_POST['vecchio'];
$breveDesc = $_POST['breveDesc'];
$descrizione = $_POST['descrizione'];
$immagine = $_POST['immagine'];
$dimensioni = $_POST['dimensioni'];
$motori = $_POST['motori'];
$modelli = $_POST['modelli'];
$serieNuova = $_POST['serieNuova'];
$serieVecchia = $_POST['serieVecchia'];
$prezzo = $_POST['prezzo'];
$immagineVecchie = $_POST['immagineVecchie'];

$marca = ucwords($marca);
//$modello = ucwords($modello);

echo($prezzo);

$acc = new ACCOUNT;

if($modello == ""){
	echo("non hai inserito il modello");
}else{
	$acc->caricaMacchina($marca, $modello, $vecchio, $breveDesc, $descrizione, $immagine, $dimensioni, $motori, $modelli, $serieNuova, $serieVecchia, $prezzo, $immagineVecchie);
}
?>