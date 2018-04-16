<?php
@session_start();

setcookie("privacy", 'display:none;', time()+7776000);  

//variables
$protocol = 'https';

if(@$_SERVER["HTTPS"] != "on" && $_SERVER['SERVER_NAME'] != '::1' && $_SERVER['SERVER_NAME'] != '127.0.0.1' && $_SERVER['SERVER_NAME'] != '192.168.1.110' && $_SERVER['SERVER_NAME'] != 'localhost'
&& $_SERVER['SERVER_NAME'] != '10.0.39.176')
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}else{
    $protocol = 'http';
}

function Get_IP() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

@$params = explode( "/", $_GET['params'] );
//stop some params
if(@$params[0] == 'immagini' || @$params[0] == 'js' || @$params[0] == 'css' || @$params[0] == 'img' || @$params[0] == 'libs' || @$params[0] == 'files') exit;

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

//host def
define('HOST', explode('/', $_SERVER['REQUEST_URI'])[1]);
$_SESSION['HOST'] = ($_SERVER['SERVER_NAME'] == '10.0.39.176' || $_SERVER['SERVER_NAME'] == '127.0.0.1') ? '/'.HOST.'/' : '/';
$link = ($_SERVER['REMOTE_ADDR'] == '::1') ? 'localhost' : $_SERVER['SERVER_NAME'];
$_SESSION['full_link'] = $protocol.'://'.$link.$_SESSION['HOST'];
$_SESSION['params'] = @$params;

$_SESSION['USER_IP']=Get_IP();
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 3,  //1200 Seconds is 20 Minutes
    )
));
//$geolocation = json_decode(file_get_contents('http://pro.ip-api.com/json/'.$_SESSION['USER_IP'].'?key=WdYJbc0rtoQIjXE',false,$ctx)); //old service
// @$geolocation = json_decode(file_get_contents('http://freegeoip.net/json/'.$_SESSION['USER_IP'].'',false,$ctx));
$_SESSION['countryCode']=(isset($geolocation->country_code))? strtolower($geolocation->country_code) : false;

//setting manual countrycode
@$market = explode( "market=", @$_GET['params'] );
if(isset($market[1])){
    $_SESSION['countryCode'] = $market[1];
}

$lang = ($_SESSION['countryCode'] == false) ? 'en' : $_SESSION['countryCode'];

if(!@$params[0]) @$params[0] = '__';

$_SESSION['lang'] = (@$params[0] == '__') ? $lang : @$params[0];


if(
    $_SESSION['lang'] != 'en' && $_SESSION['lang'] != 'it' && $_SESSION['lang'] != 'jp' 
    && $_SESSION['lang'] != 'de' && $_SESSION['lang'] != 'fr' && $_SESSION['lang'] != 'es' 
    && $_SESSION['lang'] != 'pt'
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