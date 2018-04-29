<?php
function getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );
 
    return (isset($codes[$status])) ? $codes[$status] : '';
}

function sendResponse($status = 200, $body = '', $content_type = 'text/html'){
	$status_header = 'HTTP/1.1 ' . $status . '' . getStatusCodeMessage($status);
	header($status_header);
	header('Content-type: ' . $content_type);
	echo $body;
}

class Accounts{

	//variabili
	private $conn;
	
	//costruttori	
	function __construct(){
		$this->conn = new mysqli("62.149.150.193", "Sql677570", "0aae578b", "Sql677570_4");
		$this->conn->autocommit(FALSE);
	}
	
	function __destruct(){
		$this->conn->close();
	}
	//fine costruttori
	
	//funzioni
	function logUser(){
		if(isset($_POST['user']) || isset($_GET['user'])){
			$username = $_POST['user'];
			$password = $_POST['pass'];
		
			//db interaction
			$query = "SELECT username, password FROM accounts WHERE username = '$username' AND password = '$password'";
			$rs = $this->conn->query($query);
			
			if($rs === false) {
				trigger_error('Wrong SQL: ' . $query . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				$rows_returned = $rs->num_rows;
				//echo($rows_returned);
			}
			
			if($rows_returned == "1"){
				//risposta all'app
				$result = array(
					"risultato" => "accesso effettuato",
				);
				sendResponse(200, json_encode($result));
				return true;
			}else{
				$result = array(
					"risultato" => "nome utente o password errati!",
				);
				sendResponse(200, json_encode($result));
				return true;
			}
		}
		sendResponse(400, 'Invalid request');
	}
	
	function getCars(){
		if(true){
			$marca = $_POST['marca'];
			if(isset($_GET['marca'])){
				$marca = $_GET['marca'];
			}

			$db = $this->conn;
		
			//db interaction
			$query = "SELECT id, nome, vecchio, breveDesc, descrizione FROM cars WHERE marca = '$marca' ORDER BY nome";
			//$rs = $this->conn->query($query);
			
			$stmt = $db->prepare($query);
			
			$stmt->execute();
		
			$stmt->bind_result($id, $nome, $vecchio, $breveDesc, $descrizione);
			
			$rows = array();
		
			while ($stmt->fetch()) {
				$result[] = array(
					"modello" 		=> $nome,
					"vecchio"		=> $vecchio,
					"breveDesc"		=> $breveDesc,
					"descrizione"	=> $descrizione
				);
			}
			
			sendResponse(200, json_encode($result));
		
			$stmt->close();
			//$db->close();	
			return true;	
		}
		sendResponse(400, 'Invalid request');
	}	

	
	function getMarche(){
		if(true){
			//$username = $_POST['user'];
			//$password = $_POST['pass'];
			$db = $this->conn;
		
			//db interaction
			$query = "SELECT id, nome, descrizione FROM marche";
			//$rs = $this->conn->query($query);
			
			$stmt = $db->prepare($query);
			
			$stmt->execute();
		
			$stmt->bind_result($id, $nome, $descrizione);
			
			$rows = array();
		
			while ($stmt->fetch()) {
				$rows[$id] = array($nome, $descrizione);
				$result[] = array(
					"marca" 		=> $nome,
					"descrizione" 	=> $descrizione
				);
			}
			
			sendResponse(200, json_encode($result));
		
			$stmt->close();
			//$db->close();	
			return true;	
		}
		sendResponse(400, 'Invalid request');
	}	
}

//iniziamo operazioni
$api = new Accounts;

if(isset($_POST['action']) || isset($_GET['action'])){
	if($_POST['action'] == "login" || $_GET['action'] == "login"){
		$api->logUser();
	}else if($_POST['action'] == "pay"){
		
	}else if($_POST['action'] == "getCars" || $_GET['action'] == "getCars"){
		$api->getCars();
	}
	else if($_POST['action'] == "getMarche" || $_GET['action'] == "getMarche"){
		$api->getMarche();
	}else{
		sendResponse(400, 'Invalid action');
	}
}else{
	sendResponse(400, 'Null request');
}



?>