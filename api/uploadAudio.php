<?php
if ($_FILES['File']['name']) {
    if (!$_FILES['File']['error']) {
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['File']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = 'uploads/audio/' . $filename; //change this directory
        $location = $_FILES["File"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo $filename; 
    }
    else
    {
        echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['File']['error'];
    }
}else{
    echo 'no file : ' . print_r($_FILES['File']);
    
}
?>