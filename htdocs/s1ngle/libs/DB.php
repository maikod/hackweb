<?php
/*******************************************************
 * Copyright (C) 2005-2017 Francesco La Placa - hackweb
 *
 * This file is part of hwFramework.
 *
 * This Framework can not be copied and/or distributed without the express
 * permission of author
 *******************************************************/

@session_start();

class DB
{
    var $conn;
    //local
    var $host = "localhost";    
    var $user = "root";
    var $pass = "franci";
    var $dbname = "scrambler_db";
    //remote
    var $host2 = "62.149.150.193";     
    var $user2 = "Sql677570";
    var $pass2 = "0aae578b";
    var $dbname2 = "Sql677570_1";    

    var $whitelist = array(
        'localhost',
        '127.0.0.1',
        '::1',
        '192.168.1.135',
        '192.168.1.104',
        '10.0.39.176',
        '192.168.1.100',
        '192.168.1.110'    
    );

    //costruttori
    function __construct(){  
        if(in_array($_SERVER['SERVER_NAME'], $this->whitelist)){
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        }else{
            $this->conn = new mysqli($this->host2, $this->user2, $this->pass2, $this->dbname2);
        }                
        $this->conn->set_charset("utf8");
        $this->conn->autocommit(FALSE);
    }

    function __destruct(){
        $this->conn->close();
    }
    //fine costruttori

    //funzioni sql
    function sql_open()
    {                
        if(in_array($_SERVER['SERVER_NAME'], $this->whitelist)){
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        }else{
            $this->conn = new mysqli($this->host2, $this->user2, $this->pass2, $this->dbname2);
        }        
        $this->conn->set_charset("utf8");
        return($this->conn);        
    }

    function sql_close()
    {
        $this->conn->close();
    }


    //funzioni varie
    function proteggi($lettera, $parola1, $oggetto, $parola2, $numero){
        $result = "$lettera" . sha1("$parola1") . md5($oggetto) . "$parola2" . sha1("$numero");
        return $result;
    }
}
?>
