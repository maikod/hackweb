<?php

require_once("ADMIN.php");

$debug = false;

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if($debug)
    echo $postdata;

@$action = $request->action;
@$data = $request->data;


$acc = new ADMIN();

if(!$debug){      
    $func = (string)$action;    
    if($func != ""){
        $acc->$func($data);   
    }    
}

?>