<?php

$base_directory = '/home/myuser/';

if(unlink($base_directory.$_GET['file']))
    echo "File Deleted.";

?>