<?php
require_once("../lib/acc_class.php");
$acc = new ACCOUNT;

$testo = $_POST['testo'];
$data = date('d/m/y');

//mysql
$acc->sql_open();
$db = $acc->db;
$sql = "INSERT INTO news (data, testo) VALUES (?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param('ss', $data,$testo);
$stmt->execute();

$stmt->close();
$acc->sql_close();

echo('1');

?>