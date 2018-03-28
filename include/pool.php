        Quanto valuti questo sito??<br />
        (inserisci un numero da 0 a 10)<br /><br />
        </p>
        <form id="form1" name="form1" method="post" action="./home.php?cat=pool">
          <label>voto
          <input name="voto" type="text" id="voto" value="10" size="4" maxlength="2" />
          </label>
          <label>--&gt;
          <input type="submit" name="vote" value="vote"/>
          </label>
          <label></label>
          <br />
          <br />
          <label>
          <input name="ris" type="submit" value="results" />
          </label>
          -
          <label>
          <input name="del" type="submit" value="dele" />
          </label>
        </form>
        <p>
          <?php
		$ris_stringa = 'risultati.htm';	
		$null = NULL;
		
		
		if($_POST['del'] != dele){
		if($_POST['ris'] != results){
		
			 if($_POST['voto'] == NULL){}
			 else { ?>
          il tuo voto: <?php echo $_POST['voto'];
			 
			 
			 $da = date('d M y - H:i:s');
			 $fo = fopen($ris_stringa, 'a');
			 //test
			 if($_SERVER['REMOTE_ADDR'] != "192.168.0.2" && 

$_SERVER['REMOTE_ADDR'] != "127.0.0.1" ){
			 
			 $fp = fopen('ip.txt', 'a');
			 fwrite($fp, $da);
			 fwrite($fp, " : ");
			 fwrite($fp, $_SERVER['REMOTE_ADDR']); 
			 fwrite($fp, "\n");
			 fclose($fp);
			 }
			 
			 fwrite($fo, $da);
			 fwrite($fo, " - voto: ");
			 fwrite($fo, $_POST['voto']);
			 fwrite($fo, "<br />");
			 fclose($fo);
			 
			 }
			 
			 }}?>
          <?php 
		  
			if($_POST['ris'] != results){
			if($_POST['del'] == dele){
			unlink($ris_stringa);
			}
			}
			
			//posizione del puntatore nel file
			$fo = fopen($ris_stringa, 'r');
			fseek($fo, 0, SEEK_END);
			//if
			$ft = ftell($fo);
			//echo $ft;
			/*if($ft > 223){
			fclose($fo);
			unlink($ris_stringa);
			
			
			}else{
			fclose($fo);
			
			}*/
						
			?>
          <br />
          <?php $ra = rand(0, 100);// echo $ra;
			  ?>
          <?php if($_POST['ris'] == results){?>
          <br />
          risultati:<br />
          <?php
		  include("./risultati.htm");

} ?>
