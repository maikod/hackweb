<?php 
$fp = fopen('ip.txt', 'r');
fseek($fp, 0, SEEK_END);
$fposi = ftell($fp);
echo $fposi;
if($fposi > 100000){
	fclose($fp);
	unlink('ip.txt');}
	else{fclose($fp);}
require_once './lib/simpleclass.php';
$a = new SimpleClass();
$a->displayVar();
?>