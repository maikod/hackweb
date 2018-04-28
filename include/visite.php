<?php

//verde = #00FF00

function visite(){

	$file = fopen('header/visite.txt', 'r');
	$file_letto = fread($file, filesize('header/visite.txt'));
	fclose($file);

	if(!isset($_SESSION['visite'])){
		$file_letto++;
		$file = fopen('header/visite.txt', 'w');
		fwrite($file, $file_letto);
		fclose($file);
		$_SESSION['visite'] = new Date();
	}

	$visite = $file_letto;

	// $acc->sql_open();

	// $query = "SELECT visite FROM visite WHERE id = 0";
	// $result = mysql_query($query);
	// $row = mysql_fetch_array($result);
	// $visite = $row['visite'];

	// if(!isset($_SESSION['visite'])){
	// 	$visite++;
	// 	$query = "UPDATE visite SET visite = $visite WHERE id = 0";
	// 	mysql_query($query);
	// 	$_SESSION['visite'] = 1;
	// }
	// $acc->sql_close();

	echo("<span style=\"color:#00FF00;\">$visite</span>");
}

visite();

//visite($acc);
// $acc->getVisitors();

?>