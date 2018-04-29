<?php
@$params = explode( "/", $_GET['params'] );

if(
    @$params[0] == 'immagini' || @$params[0] == 'js' || @$params[0] == 'css' 
    || @$params[0] == 'img' || @$params[0] == 'lib' || @$params[0] == 'files'
) exit;

if($params[0] == 'include') 
{
    echo '    
    <div class="spazio" id="hw-info" style="">
        <div class="inner">
            PAGE NOT FOUND
        </div>
    </div>
    ';
    exit(0);
}


@session_start();

define('HOST', explode('/', $_SERVER['REQUEST_URI'])[1]);
$_SESSION['HOST'] = HOST;
$link = ($_SERVER['REMOTE_ADDR'] == '::1') ? 'localhost' : $_SERVER['SERVER_NAME'];
$_SESSION['full_link'] = 'http://'.$link.'/'.HOST.'/';
$_SESSION['lang'] = !@$params[0] ? 'en' : @$params[0];
$_SESSION['params'] = @$params;

if(
    $_SESSION['lang'] != 'en'
){     
    header('Location: '.$_SESSION['full_link'].'en');    
    exit;
}


$connection = "ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

// echo $_SERVER['HTTP_HOST'];
// echo $_SERVER['REMOTE_ADDR'];
// echo $_SERVER['SERVER_NAME'];
?>