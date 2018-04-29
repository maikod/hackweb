<?php
require_once("mysql_class.php");

class ACCOUNT extends DATABASE
{
	//variabili


	//funzione verifica dell'utente durante la registrazione
	function verifica_utente($nick, $mail)
	{
		$this->sql_open();
		$db = $this->db;
		$sql = "SELECT login, mail FROM accounts";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($user, $mail2);
		while ($stmt->fetch()) {
			if($user == $nick){
				$result = 2;
			}else if($mail == $mail2){
				$result = 3;
			}
		}

		$stmt->close();
		$this->sql_close();

		return $result;
	}
	//fine funzione verifica dell'utente durante la registrazione

	//funzione di login
	function login($nick, $pass, $casella){
		//elimina potere
		setcookie($this->proteggi("g","giovi","potere","dfg","115"), "", time()-3600, "/");
		$this->sql_open();
		$db = $this->db;
		$sql = "SELECT login, password, potere, verifica FROM accounts";
		$stmt = $db->prepare($sql);
		$this->verificato = 2;
		$stmt->execute();
		$stmt->bind_result($user, $pwd, $pot, $ver);
		while ($stmt->fetch()) {
			if($user == $nick && $pwd == md5($pass)){
				if($ver == "1"){
					if($pot > 0){
						setcookie($this->proteggi("g","giovi","potere","dfg","115"), $this->proteggi("d","erfsa",$pot,"afeg44","232"), time()+3000000, "/");
					}
					$this->loggato = true;
					$this->verificato = 1;
					break;
				}else{
					$this->loggato = false;
					$this->verificato = 0;
				}
			}else{
				$this->loggato = false;
			}
		}
		if($this->loggato == false && $this->verificato == 2){
			echo "2";
		}else if($this->loggato == false && $this->verificato == 0){
			echo "3";
		}else{
			session_start(); //inizio sessione
			$_SESSION['user'] = $nick;
			$this->ricorda($nick, $casella);
			echo($nick);
			/*?>
			<script>
			utente = '<?php echo($username); ?>';
			potere = '<?php echo($potere); ?>';
			//$('#login').load('./include/user/panel.php');
			</script>
			<?php*/
		}
		$stmt->close();
		$this->sql_close();
	}


	function register($user, $pwd, $mail){
		$codice = rand();
		$cod_criptato = md5($codice);
		$mex = "Welcome $user,<br>
		to complete your registration click the link below:<br><br>
		http://hackweb.it/insert_code.php?code=$cod_criptato&user=$user<br><br>
		--------------------------<br>
		verification code: $cod_criptato<br>
		--------------------------<br><br>
		Don't reply, this is an automatic message!<br><br>";

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: hackweb Administrator <admin@hackweb.it>" . "\r\n";

		mail($mail, "Registration to hackweb", $mex, $headers);
		$pwd = md5($pwd);

		$this->sql_open();
		$db = $this->db;
		//$sql = "INSERT INTO accounts (login, password, mail, cod_verifica) VALUES('$user' , '$pwd', '$mail', '$cod_criptato')";
		$sql = "INSERT INTO accounts (login, password, mail, cod_verifica) VALUES(? , ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssss', $user,$pwd,$mail,$cod_criptato);
		$stmt->execute();

		$stmt->close();
		$this->sql_close();

		return 1;
		//$query = "UPDATE accounts SET cod_verifica = '$cod_criptato' WHERE login = '$user'";
	}

	function ricorda($user, $check){
		if($check == "ric"){
			setcookie(md5("user"), ("r" . sha1("qwe") . md5($user) . "aSd" . sha1("1")), time()+3000000, "/");
			$_SESSION['ric'] = "sarai ricordato";
			}
		}//fine funzione

	function logout(){
		session_start();
		$_SESSION=array();
		session_destroy();
		setcookie(md5("user"), "", time()-3600, "/");
		setcookie($this->proteggi("g","giovi","potere","dfg","115"), "", time()-3600, "/");
		return 1;
		}//fine funzione

	//funzione verifica potere
	function ver_potere($pot){
		if($_COOKIE[$this->proteggi("g","giovi","potere","dfg","115")] == $this->proteggi("d","erfsa",$pot,"afeg44","232")){
		return true;
		}
	}//fine funzione

	function verifica_registrazione($user, $code){
		$this->sql_open();
		$db = $this->db;
		$sql = "SELECT cod_verifica FROM accounts WHERE login = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('s', $user);
		$stmt->execute();
		$stmt->bind_result($cod);
		while ($stmt->fetch()) {
			if($cod == $code){
				$result = 1;
			}else{
				echo "your account is already verified... or maybe the code is not correct...";
			}
		}

		if($result == 1){
			$sql = "UPDATE accounts SET cod_verifica = '1', verifica = '1' WHERE login = '$user'";
			$stmt2 = $db->prepare($sql);
			$stmt2->execute();
			echo "yuppiii! your account is now verified!<br><br>hackweb";
			$stmt2->close();
		}

		$stmt->close();
		$this->sql_close();
	}

	function getNews(){
		$this->sql_open();

		$db = $this->db;

		$sql = "SELECT data, testo FROM news ORDER BY id DESC LIMIT 5";

		$stmt = $db->prepare($sql);
		//$stmt->bind_param('ssss', $titolo, $testo, $utente, $data);

		$stmt->execute();

		$stmt->bind_result($data, $testo);


		//$rows = array();

		while ($stmt->fetch()) {
			//$testo = utf8_encode($testo);
			echo("- <span style=\"color:#0F0;\">$data</span>:<br>$testo<br><br>");
		}

		$stmt->close();
		$this->sql_close();
	}

	function getVisitors(){

		$this->sql_open();

		$db = $this->db;

		$sql = "SELECT visite FROM visite WHERE id = 0";

		$stmt = $db->prepare($sql);
		//$stmt->bind_param('ssss', $titolo, $testo, $utente, $data);

		$stmt->execute();

		$stmt->bind_result($visite);

		while ($stmt->fetch()) {
			$visite = $visite;
		}

		if(!isset($_SESSION['visite'])){
			$visite++;
			$sql = "UPDATE visite SET visite = '$visite' WHERE id = 0";
			$stmt2 = $db->prepare($sql);
			$stmt2->execute();
			$stmt2->close();
			$_SESSION['visite'] = 1;
		}

		$stmt->close();
		$this->sql_close();
		echo("<span style=\"color:#00FF00;font-size:9px\">$visite</span>");
	}

	function checkUser(){
		if(isset($_SESSION['user'])){
			$utente = $_SESSION['user'];
		}elseif(isset($_COOKIE[md5('user')])){
			$this->sql_open();
			$db = $this->db;
			$sql = "SELECT login FROM accounts";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($nick);
			while ($stmt->fetch()) {
				if(("r" . sha1("qwe") . md5($nick) . "aSd" . sha1("1")) == $_COOKIE[md5('user')]){
					$utente = $nick;
				}
			}

			$stmt->close();
			$this->sql_close();
		}else{
            $utente = 0;
        }
		return $utente;
	}

	//richiesta assistenza
	function richiestaHelp($nome, $cognome, $mail, $telefono, $urgenza, $tipo_richiesta, $descrizione_richiesta)
	{
		$this->sql_open();
		$db = $this->db;
		$sql = "INSERT INTO assistenza (nome, cognome, mail, telefono, urgenza, tipo, descrizione) VALUES('$nome' , '$cognome', '$mail', '$telefono', '$urgenza', '$tipo_richiesta', '$descrizione_richiesta')";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($user, $mail2);

		$stmt->close();
		$this->sql_close();
	}
	//fine richiesta assistenza

//fine della classe
} //chiusura classe

/*
<meta http-equiv="refresh" content="0;url=/home.php?cat=err&err=4">
*/
?>
