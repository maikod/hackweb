//variabili globali
var i = 0;
var a = 10;
var tempo;
var ip_addr;
var ipSplit;
var risultato;

function caricaFile(nomeFile){
	var ajax = new XMLHttpRequest();
	if(ajax){
		ajax.open("get", nomeFile, true);
		ajax.setRequestHeader("connection", "close");
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				if(ajax.status == 200){
					risultato = ajax.responseText;
					clearTimeout(loadIniziale);
					document.getElementById("loading").innerHTML = "";
					restante();
				}else{
					alert("fallito!");
				}
			}
		}
		ajax.send(null);
		caricamento("loading");
	}
}	

function tempus(){
	tempo = setInterval("rimpiazzatore()", 50);
	//rimpiazzatore();
}
function restante(){
	var pulsante = document.getElementById("pulsante");
	pulsante.innerHTML = "<input name=\"Pulsante\" type=\"button\" id=\"Pulsante\" value=\"Pulsante\" onclick=\"barra();tempus(); hide()\" />";
	ip_addr = risultato;
	ipSplit = ip_addr.split(',');
	var e = document.getElementById("quanto-fare");
	e.innerHTML = "ci sono "+ipSplit.length+" caratteri, bisogna fare "+ipSplit.length/a+" filtramenti.";
}
	
function rimpiazzatore(){
	if(a<=(ipSplit.length+4)){
		while(i<a){
			ip_addr = ip_addr.replace(",", "<br />");
			i++;
		}
		var ip = document.getElementById("ip");
	//	ip.innerHTML = ip_addr;
		var percentuale = document.getElementById("percentuale");
		var perc = (100*a)/ipSplit.length;
		//taglio
		var stringa = ""+perc;
		var percTagliato = stringa.split(".");
		//if(perc>99.1){
			//percTagliato[0] = 100;
		//}
		var str = "<br>% "+percTagliato[0];
		percentuale.innerHTML = str;
		
		a = a+10;
		var barraCaricamento = document.getElementById("barra-caricamento");
		if(percTagliato[0] < 100){
			barraCaricamento.style.visibility = 'visible';
		}else{
			percTagliato[0] = 100;
			barraCaricamento.style.visibility = 'hidden';
			ip.innerHTML = ip_addr;
			clearInterval(tempo);
		}
	}
}
function barra(){
	var e = document.getElementById("barra-caricamento");
	e.innerHTML = "<img src=\"../images/barre_caricamento/websedit-ag-bar2.gif\" id=\"barra-caricamento\" />";
	e.style.visibility = 'hidden';
}

function hide(){
	var e = document.getElementById("Pulsante");
	e.style.visibility = 'hidden';
}


