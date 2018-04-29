<?php
function proteggi($lettera, $parola1, $oggetto, $parola2, $numero){
	$result = "$lettera" . sha1("$parola1") . md5($oggetto) . "$parola2" . sha1("$numero");
	return $result;
}
?>