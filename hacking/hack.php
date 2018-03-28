<?php
$filename = "http://www.amicidigigi.it/admin";
$handle = fopen($filename, "rb");
$contents = '';
while (!feof($handle)) {
  $contents .= fread($handle, 8192);
}
fclose($handle);
echo($contents);
?>