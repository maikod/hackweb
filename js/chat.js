var serverSide = "/lib/LibChat.php";
function getChat(risultato){
	var ris = document.getElementById(risultato);
	
	var ajax = new XMLHttpRequest();
	
	if(ajax){
		ajax.open("get", serverSide + "?get=1", true);
		ajax.setRequestHeader("connection", "close");
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				if(ajax.status == 200){
					ris.innerHTML = ajax.responseText;
				}
			}
		}
		ajax.send(null);
	}
	return !ajax;
}

function saveChat(nome, messaggio, risultato){
	var name = document.getElementById(nome).value;
	var msg = document.getElementById(messaggio).value;
	var ris = document.getElementById(risultato);
	
	var ajax = new XMLHttpRequest();
	
	if(ajax){
		ajax.open("get", serverSide + "?name=" + name + "&msg=" + msg + "&get=0", true);
		ajax.setRequestHeader("connection", "close");
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				if(ajax.status == 200){
					ris.innerHTML = ajax.responseText;
				}
			}
		}
		ajax.send(null);
	}
	return !ajax;
}
		