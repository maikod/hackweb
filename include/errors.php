          <?php
		 if($_GET['err'] == '1'){?>
          completa tutti i campi richiesti..<br />
          <a href="./home.php?cat=mail" target="_self">indietro</a>
          <?php }elseif($_GET['err'] == '2'){ ?>
          le password inserite non corrispondono.. <a href="./home.php?cat=mail" target="_self">indietro</a>
          <?php }elseif($_GET['err'] == '3'){ ?>
          inserisci una mail corretta!<br />
          <a href="./home.php?cat=mail" target="_self">indietro</a>
          <?php }elseif($_GET['err'] == '4'){ ?>
          nome utente già in uso..<br />
          <a href="./home.php?cat=mail" target="_self">indietro</a>
          <?php }elseif($_GET['err'] == '5'){ ?>
          indirizzo e-mail già utilizzato..<br />
          <a href="./home.php?cat=mail" target="_self">indietro</a>
          <?php }elseif($_GET['err'] == '6'){ ?>
          nome utente o password sbagliati..<br />
          <a href="./home.php?cat=login" target="_self">riprova</a>
          
          <?php }elseif($_GET['err'] == '7'){ ?>
          questo account non è ancora stato verificato, controlla la tua mail.<br />
          <a href="./home.php?cat=login" target="_self">riprova</a>
          <?php }elseif($_GET['err'] == '8'){ ?>
          completa tutti i campi richiesti..<br />
          <a href="./home.php?cat=assistenza" target="_self">riprova</a>
    
          <?php }else{
		  print "inviato correttamente ! :)";}?>