
var delay=20;
var currentChar=1;
var destination="[not defined]";
var finished = 0;

function type()
{
  if (document.getElementById)
  {
    var dest=document.getElementById(destination);
    if (dest)
    {
      dest.innerHTML=text.substr(0, currentChar);
      currentChar++
      if (currentChar>text.length)
      {
       currentChar=1;
       // setTimeout("type()", 5000);
	   finished = 1;
	   dest.innerHTML += "<div style=\"padding-left:50px\"><table><tr><td width=\"400\"><fieldset><legend>modulo richiesta assistenza</legend><form name=\"form1\" method=\"post\" action=\"\"><input type=\"hidden\" name=\"form\" value=\"1\"><p>nome<br><input type=\"text\" name=\"nome\" id=\"nome\"><br>cognome<br><input type=\"text\" name=\"cognome\" id=\"cognome\"><br>mail<br><input name=\"mail\" type=\"text\" id=\"mail\" size=\"40\"><br>telefono<br><input type=\"text\" name=\"telefono\" id=\"telefono\"><br><label><br>urgenza:<br><input type=\"radio\" name=\"urgenza\" value=\"1\" id=\"urgenza_0\">tranquillo</label><br><label>	<input type=\"radio\" name=\"urgenza\" value=\"2\" id=\"urgenza_1\">abbastanza urgente</label><br><label>	<input type=\"radio\" name=\"urgenza\" value=\"3\" id=\"urgenza_2\">questione di vita o di morte</label><br><br>tipo di richiesta<br><input type=\"text\" name=\"tipo_richiesta\" id=\"tipo_richiesta\">	<br>descrizione della richiesta<br><textarea name=\"descrizione_richiesta\" id=\"descrizione_richiesta\" cols=\"45\" rows=\"5\"></textarea><br><br>	<input type=\"submit\" name=\"invia\" id=\"invia\" value=\"invia\">	</p></fieldset></form></td></tr></table></div>";
	   
      }
      else
      {
        setTimeout("type()", delay);
      }
    }
  }
}
function startTyping(textParam, delayParam, destinationParam)
{
  text=textParam;
  delay=delayParam;
  currentChar=1;
  destination=destinationParam;
  type();
}

function scriviResto(){
	resto = ("<div style=\"padding-left:50px\"><table><tr><td width=\"400\"><fieldset><legend>modulo richiesta assistenza</legend><form name=\"form1\" method=\"post\" action=\"\"><input type=\"hidden\" name=\"form\" value=\"1\"><p>nome<br><input type=\"text\" name=\"nome\" id=\"nome\"><br>cognome<br><input type=\"text\" name=\"cognome\" id=\"cognome\"><br>mail<br><input name=\"mail\" type=\"text\" id=\"mail\" size=\"40\"><br>telefono<br><input type=\"text\" name=\"telefono\" id=\"telefono\"><br><label><br>urgenza:<br><input type=\"radio\" name=\"urgenza\" value=\"1\" id=\"urgenza_0\">tranquillo</label><br><label>	<input type=\"radio\" name=\"urgenza\" value=\"2\" id=\"urgenza_1\">abbastanza urgente</label><br><label>	<input type=\"radio\" name=\"urgenza\" value=\"3\" id=\"urgenza_2\">questione di vita o di morte</label><br><br>tipo di richiesta<br><input type=\"text\" name=\"tipo_richiesta\" id=\"tipo_richiesta\">	<br>descrizione della richiesta<br><textarea name=\"descrizione_richiesta\" id=\"descrizione_richiesta\" cols=\"45\" rows=\"5\"></textarea><br><br>	<input type=\"submit\" name=\"invia\" id=\"invia\" value=\"invia\">	</p></fieldset></form></td></tr></table></div>"	);
}