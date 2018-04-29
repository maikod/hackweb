<?php
class DATABASE
	{
		var $db;
		var $host = "62.149.150.193";
		var $user = "Sql677570";
		var $pass = "0aae578b";
		var $dbname = "Sql677570_4";
	
		function sql_open()
		{
			$this->db = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			return($this->db);
		}
	

		function sql_close()
		{
			$this->db->close();
		}
	}
?>