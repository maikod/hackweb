var serverSide = '../include/newsGoogle.php';

function leggiNewsGoogle(idPaese, idSubmit, idRisultato){
	var paeseScelto = document.getElementById(idPaese).value;
	var bottoneSubmit = document.getElementById(idSubmit);
	var divRisultato = document.getElementById(idRisultato);
	var ajax = new XMLHttpRequest();
	
	if(ajax && paeseScelto && bottoneSubmit && divRisultato){
		bottoneSubmit.disabled = true;
		ajax.open("get", serverSide + "?lingua=" + paeseScelto, true);
		ajax.setRequestHeader("connection", "close");
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				if(ajax.status == 200){
					clearTimeout(loadIniziale);
					divRisultato.innerHTML = ajax.responseXML;
				}else{
					divRisultato.innerHTML = "impossibile effettuare l'operazione richiesta";
				}
				bottoneSubmit.disabled = false;
			}
		}
		ajax.send(null);
		caricamento("risultato");
	}
	return !ajax;
}