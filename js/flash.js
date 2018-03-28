function protect(){
	var pwd = prompt("questa pagina ha una visibilità limitata, inserisci la password per accedere pienamente...");
	if(pwd == "disable"){
		clearTimeout(tim);
	}else{
		alert("accesso negato");
		document.location.href='http://www.hackweb.altervista.org';
	}
}
var tim = setTimeout("alert('tempo per visualizzare la pagina scaduto');protect()", 10000);