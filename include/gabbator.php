<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	color: #888;
}
.style2 {color: #00FF00}
-->
</style>
<div align="center"><div align="center"><span class="style1">Questo strumento va utilizzato con cura,<br />
        l'amministrazione gli scripter e tutto lo staff<br />
        non si prendono nessuna responsabilit&agrave; in caso di uso scorretto!<br />
</span><br />
</div>
  <table width="307" border="0">
    <tr>
      <td height="87" valign="top">
	  
	  
        <div align="right"><span class="style1"><span class="style2">Usi giornalieri rimasti:</span> 
          <?php 
if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] == proteggi("d","erfsa",100,"afeg44","232")){
	echo "illimitati";
	}elseif($_COOKIE[md5('usi')] == md5(1)){
		echo "0";
			}else{
echo "1";
}  
		  ?> 
        <SPACER> </span></div>
        <div class="logincell" align="left">
        <form action="../lib/invia_mail.php" method="post" enctype="multipart/form-data" name="mailform" target="_self" id="mailform">
          <label>nome (mittente): <br>
          <input name="mittenten" type="text" class="form"  id="mittenten">
            </label>
          <br>
          <label>email (mittente):<br>
          <input name="emittente" type="text" class="form" id="emittente">
          </label>
          <br>
          <label>email (destinatario):<br>
          <input name="destinatario" type="text" class="form" id="destinatario">
          </label>
          <br>
          <label>Oggetto:<br>
          <input name="oggetto" type="text" class="form" id="oggetto">
          </label>
          <br>
          <label>Messaggio:<br>
          <textarea name="messaggio" cols="40" rows="6" class="form" id="messaggio"></textarea>
          </label>
          <br>
          <br>
                    <?php 
if($_COOKIE[md5('usi')] == md5(1)){

}else{
echo("<input name=\"invia\" type=\"submit\" class=\"form\" id=\"invia\" value=\"invia\">");
}  
		  ?>
          
          <input name="clear" type="reset" class="form" id="clear" value="annulla">
        </form>
        </div></td>
    </tr>
  </table>
</div>
