<?php

// $postdata = file_get_contents("php://input");
// $request = json_decode($postdata);


// @$img = $request->img;
// @$fileName = $request->fileName;


// //funzioni
// // Quality is a number between 0 (best compression) and 100 (best quality)
// function png2jpg($originalFile, $outputFile, $quality) {
//     $image = imagecreatefrompng($originalFile);
//     imagejpeg($image, $outputFile, $quality);
//     imagedestroy($image);
// }


// if(!isset($_SERVER['DOCUMENT_ROOT'])){
//     if(isset($_SERVER['SCRIPT_FILENAME'])){
//         $_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
//     };
// };

// if(!isset($_SERVER['DOCUMENT_ROOT'])){
//     if(isset($_SERVER['PATH_TRANSLATED'])){
//         $_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
//     };
// };

// $PercorsoDominio = $_SERVER['DOCUMENT_ROOT'];
// $public = "/api/uploads/";
// $cartella = $PercorsoDominio.$public;

// // requires php5
// define('UPLOAD_DIR', $cartella);
// $img = str_replace('data:image/png;base64,', '', $img);
// $img = str_replace(' ', '+', $img);
// $data = base64_decode($img);
// $file = UPLOAD_DIR . "00000aaaa-temp" . '.png';
// $file2 = UPLOAD_DIR . $fileName;
// $success = file_put_contents($file, $data);

// $image = imagecreatefrompng($file);
// imagejpeg($image, $file2, 80);
// imagedestroy($image);
// unlink($file);

// print $success ? $file2 : $img;

?>

<?php 
// Directory where uploaded images are saved
$dirname = "uploads/music/"; 
// If uploading file
if ($_FILES) {
    //print_r($_FILES);
    move_uploaded_file($_FILES["file"]["tmp_name"], $dirname.$_FILES["file"]["name"]);
    echo "ok";
}else{
    echo "error";
}
?>