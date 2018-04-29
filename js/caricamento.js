//variabili globali
var numPuntini = 0;
var numParola = 0;
var puntini = "";
var loading = "";
var id_elemento;
var loadIniziale;

function caricamento(elemento){
	var parola = new Array("c","a","r","i","c","a","m","e","n","t","o",".",".",".","");
	id_elemento = elemento;
	var e = document.getElementById(elemento);	
	e.innerHTML = loading;
	if(numParola <= 14){
		loading += parola[numParola];
		numParola++;
	}else{
		numParola = 0;
		loading = "";
	}
	if(numPuntini <= 11){
		if(numParola == 12){
			puntini += parola[11];
			numPuntini++
		}else{
			puntini += ".";
			numPuntini++;
		}
	}else{
		numPuntini = 0;
		puntini = "";
	}
	loadIniziale = setTimeout("caricamento(id_elemento)", 300);
}