<?php
require_once("mysql_class.php");

class CANCPRIV extends DATABASE
{	

	function verifica_rg($rg1num, $rg1anno)
	{
		$result = 1;
		$this->sql_open();
		$db = $this->db;
		$sql = "SELECT rg1anno FROM cp_pratiche WHERE rg1num = '$rg1num'";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($a);
		while ($stmt->fetch()) {
			if($a == $rg1anno){
				$result = 3;
			}else{
				$result = 1;
			}
		}
		
		$stmt->close();
		$this->sql_close();

		return $result;
	}
	
	function verificaControparte($controparte){
		$result = 5;
		$this->sql_open();
		$db = $this->db;
		$sql = "SELECT login FROM accounts WHERE login = '$controparte'";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($a);
		if($stmt->num_rows <= 0 && $controparte == ''){
			$result = 1;
		}
		while ($stmt->fetch()) {
			if($a == $controparte){
				$result = 1;
			}else{
				$result = 5;
			}
		}
		
		$stmt->close();
		$this->sql_close();

		return $result;
	}
	
	function insPratica($rg1num, $rg1anno, $assistito, $utente, $controparte, $organo){
		$this->sql_open();
		$db = $this->db;
		$sql = "INSERT INTO cp_pratiche (rg1num, rg1anno, assistito, registrante, controparte1, organo) VALUES('$rg1num' , '$rg1anno', '$assistito', '$utente', '$controparte', '$organo')";
		$stmt = $db->prepare($sql);
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
		$sql = "SELECT cod_verifica FROM accounts WHERE login = '$user'";
		$stmt = $db->prepare($sql);
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
