<?php
//inizializzazione
@session_start();
setcookie("privacy", 'display:none;', time()+7776000);  

//variables
$protocol = 'https';
$params = array();

//funzione che carica automaticamente le classi
function __autoload($nome_classe){
    require_once 'lib/' . $nome_classe . '.php';
}

if(@$_SERVER["HTTPS"] != "on" && $_SERVER['SERVER_NAME'] != '::1' && $_SERVER['SERVER_NAME'] != '127.0.0.1' && $_SERVER['SERVER_NAME'] != '192.168.1.110' && $_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != '10.0.39.176')
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

//params read
if(isset($_GET['params'])) $params = explode( "/", $_GET['params'] );
if(@$params[0] == 'immagini' || @$params[0] == 'js' || @$params[0] == 'css' || @$params[0] == 'img' || @$params[0] == 'libs' || @$params[0] == 'files') exit;

if(@$params[0] == 'include') 
{
    $var = explode( ".", @$params[1] );
    echo '    
    <div class="spazio" id="hw-info" style="">
        <div class="inner">
            PAGE NOT FOUND
            '.$_GET['params'].'
        </div>
    </div>        
    ';
    // http_response_code(404);
    // die();    
    exit(0);
}

//constants and important variables
define('HOST', explode('/', $_SERVER['REQUEST_URI'])[1]);
echo $_SERVER['REQUEST_URI'];
$_SESSION['HOST'] = ($_SERVER['SERVER_NAME'] == '10.0.39.176' || $_SERVER['SERVER_NAME'] == '127.0.0.1') ? '/'.HOST : '';
$base_host = $_SESSION['HOST'].'/';
$link = ($_SERVER['SERVER_NAME'] == '::1') ? 'localhost' : $_SERVER['SERVER_NAME'];
$full_link = $protocol.'://'.$link.$_SESSION['HOST'];
$_SESSION['full_link'] = $full_link;
//canonical
$canonical = rtrim($_SESSION['full_link'],'/');
for($i=0;$i<count($params);$i++) $canonical .= "/".$params[$i];
$_SESSION['canonical'] = $canonical;
//params
$_SESSION['params'] = @$params;

//user ip
$ip = Get_IP();
$_SESSION['USER_IP'] = $ip;
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 3,  //1200 Seconds is 20 Minutes
    )
));

//geolocation by ip
//$geolocation = json_decode(file_get_contents('http://pro.ip-api.com/json/'.$_SESSION['USER_IP'].'?key=WdYJbc0rtoQIjXE',false,$ctx)); //old service
// @$geolocation = json_decode(file_get_contents('http://freegeoip.net/json/'.$_SESSION['USER_IP'].'',false,$ctx));
// $_SESSION['countryCode']=(isset($geolocation->country_code))? strtolower($geolocation->country_code) : false;

//setting manual countrycode
@$market = explode( "market=", @$_GET['params'] );
if(isset($market[1])){
    $_SESSION['countryCode'] = $market[1];
}

//password
@$pw = explode( "pw=", @$_GET['params'] );
if(isset($pw[1])){
    $_SESSION['pw'] = $pw[1];
}

//language
$lang = ($_SESSION['countryCode'] == false) ? 'en' : $_SESSION['countryCode'];

if(!@$params[0]) @$params[0] = '__';

$_SESSION['lang'] = (@$params[0] == '__') ? $lang : @$params[0];

if($_SESSION['lang'] != 'en' && $_SESSION['lang'] != 'it'){    
    header('Location: '.$_SESSION['full_link'].'/it');    
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