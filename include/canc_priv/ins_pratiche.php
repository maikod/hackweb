<?php
//##visualizza pratiche

//inizio della sessione
session_start();

require_once("../../security/security.php");
if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){
	
	if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] >= proteggi("d","erfsa",80,"afeg44","232")){

//da qui in poi html		
?>

---------------------------------------<br />
AGGIUNGI NUOVA PRATICA<br />
---------------------------------------<br />
<br />
i campi conrassegnati con <span style="color:#00FF00">*</span> sono obbligatori.
<br /><br />

<table><tr><td><fieldset><legend><span style="color:#00FF00">nuova pratica</span></legend>

	<form name="form1" id="form1" ><input type="hidden" id="form" name="form" value="1">
		<span style="color:#00FF00">*</span>R.G. numero:<br><input type="text" name="rg1num" id="rg1num"><br>
        anno (aaaa):<br><input type="text" maxlength="4" name="rg1anno" id="rg1anno">
		<br><br>
		<span style="color:#00FF00">*</span> presso (es. R.G. G.I.P. Tribunale di Bologna...):
		<br>
		<input type="text" name="organo" id="organo">
		<br><br>
		<span style="color:#00FF00">*</span> tuo assistito:
		<br>
		<input type="text" name="assistito" id="assistito">
		<br><br>
		controparte (potrai aggiungere altre controparti dal menu a sinistra) (inserisci nome.cognome della controparte):
		<br>
		<input type="text" name="controparte1" id="controparte1">
		<br><br>
		note eventuali:
		<br>
        <textarea name="note" id="note" rows="5"></textarea><br><br>
        <input type="submit" name="invia" id="invia" value="invia">
	</form>
            
</fieldset></td></tr></table>
            
<br />

<script type="text/javascript">		
	$('#form1').submit(function(event){
    var data = $(this).serialize();
    $.post('../php/canc_priv/elabora_ins_pratiche.php', data)
        .success(function(result){
        	//alert('errore: ' + result);
        	if(result == 2){
				$('#barra-sopra').html('riempi i campi richiesti');
        	}else if(result == 1){	
				$('#barra-sopra').html('pratica inserita');
				$('#content').html('Hai inserito la tua pratica!');
        	}else if(result == 3){
	        	alert('questo processo è già stato registrato, contattaci per chiedere l\'accesso agli atti');
        	}else if(result == 5){
	        	alert('questa controparte non ha registrato un profilo sulla nostra piattaforma, fallo registrare o registralo tu (in questo caso la controparte deve confermare via email)');
	        	$('#barra-sopra').html('questa controparte non ha registrato un profilo sulla nostra piattaforma, fallo registrare o registralo tu (in questo caso la controparte deve confermare via email)');
        	}
        })
        .error(function(){
            console.log('Error loading page');
        })
    return false;
	});
</script>		
		
<?php
//fine zona html

	}
}else{ 
	echo('tu non hai accesso a questa pagina.');
}
?>