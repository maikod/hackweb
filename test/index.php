<?php
function url(){
  return sprintf(
  "%s://%s%s%s",
  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
  $_SERVER['SERVER_NAME'],
  '/hackweb/test',
  isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'].'/' : '/'
);
}

if(!isset( $GLOBALS['base_root']) && !isset( $GLOBALS['resources_root'])) {
  if (strpos($_SERVER["SERVER_NAME"], 'localhost') !== false) {
    $GLOBALS['environment'] = 'local';
    $GLOBALS['base_root'] = 'lingua/sezione/';
    
  } else if (strpos($_SERVER["SERVER_NAME"], 'www.enhancers.it') !== false) {
    $GLOBALS['environment'] = 'stage';
    $GLOBALS['base_root'] = 'stage/pininfarina/';
  } else {
    $GLOBALS['environment'] = 'production';
    $GLOBALS['base_root'] = '';
  }

  $resources_root = url().$base_root;
  $GLOBALS['resources_root'] = url().$base_root;
}

//print(url().$base_root);

//header('Location:'.url().$base_root);

$base_root = $GLOBALS['base_root'];
$environment = $GLOBALS['environment'];
$resources_root = $GLOBALS['resources_root'];

echo 'Questa pagina mostra il prodotto numero ' . $_GET['id'];
?>
