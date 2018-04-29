//caricafile scritta in jquery
function caricaFile2(nomeFile, id){
	$("#"+id).load(
	    nomeFile, //pagina da caricare
	    {}, //un oggetto JavaScript vuoto = nessun dato da inviare
	    function () { //funzione di callback
	    }
	);
	return false;
}

//esempio di invio dati post:
//$('#risultato').load("ajax/utenti.php", {nome:"Mario",cognome:"Rossi"})