
<p>Ultimamente il carico di lavoro sta aumentando considerevolmente e,
    al fine di organizzare meglio il mio lavoro, da questo momento le richieste di assistenza
    possono essere fatte solamente da questo sito, compilando l'apposito modulo.<br>
<br>
<span style="color:#00FF00">N.B.</span> inserisci dati <span style="color:#00FF00"><u>corretti</u></span>, altrimenti non ti verr&agrave; risposto.<br>
i campi con * sono obbligatori.
</p>

<table><tr><td style="width: 100%;"><fieldset><legend><span style="color:#00FF00">modulo richiesta assistenza</span></legend>

	<form name="form1" id="form1" ><input type="hidden" id="form" name="form" value="1">
	<p>nome*<br>
	  <input type="text" name="nome" id="nome"><br>cognome<br><input type="text" name="cognome" id="cognome"><br>
	  mail*<br>
	  <input name="mail" type="text" id="mail" style="width: 90%;"><br>telefono<br><input type="text" name="telefono" id="telefono"><br><label><br>
	    urgenza*<br>
	    <input type="radio" name="urgenza" value="1" id="urgenza_0">normale</label>
	            <br><label>	<input type="radio" name="urgenza" value="2" id="urgenza_1">abbastanza urgente</label><br><label>	<input type="radio" name="urgenza" value="3" id="urgenza_2">questione di vita o di morte</label><br><br>
	            tipo di richiesta*<br>
	            <input type="text" name="tipo_richiesta" id="tipo_richiesta">	<br>
	            descrizione della richiesta*<br>
	            <textarea name="descrizione_richiesta" id="descrizione_richiesta" style="width: 90%;" rows="5"></textarea><br><br>	<input type="submit" name="invia" id="invia" value="invia">
	</form>
            
</fieldset></td></tr></table>
            
<br />

<script type="text/javascript">		
	$('#form1').submit(function(event){
    var data = $(this).serialize();
    $.post('../php/elabora_assistenza.php', data)
        .success(function(result){
        	//alert('welcome back ' + result);
        	if(result == 2){
				$('#barra-sopra').html('fill requested fields');
        	}else if(result == 1){
				$('#barra-sopra').html('your request is ok');
				$('#content').html('you sent your request!<br><span style=\"color:#0f0\">Frankie will contact you soon.</span>');

        	}      	
        })
        .error(function(){
            console.log('Error loading page');
        })
    return false;
	});
</script>