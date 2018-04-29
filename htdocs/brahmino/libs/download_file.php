<?php

require_once("ADMIN.php");

$request = json_decode($_POST['data']);

@$action = $request->action;
@$data = $request->data;

$acc = new ADMIN();
$acc->downloadPreset($data);

?>