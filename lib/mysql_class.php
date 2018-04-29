<?php
class DATABASE
	{
		var $db;
		var $host = "62.149.150.193";
		var $user = "Sql677570";
		var $pass = "0aae578b";
		var $dbname = "Sql677570_5";

		function sql_open()
		{
			$this->db = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			$this->db->set_charset("utf8");
			return($this->db);
		}


		function sql_close()
		{
			$this->db->close();
		}

		//funzioni varie
		function proteggi($lettera, $parola1, $oggetto, $parola2, $numero){
			$result = "$lettera" . sha1("$parola1") . md5($oggetto) . "$parola2" . sha1("$numero");
			return $result;
		}
	}
?>
