<?php
//inizio della sessione
session_start();

//recupero indirizzo web dell'utente
$ip = $_SERVER['REMOTE_ADDR'];

//recupero delle classi fondamentali
require_once("./lib/acc_class.php");
require_once("./lib/register_class.php");
require_once("security/security.php");

//inizializzazione della classe ACCOUNT
$acc = new ACCOUNT;

//da utilizzare solo quando si imposta il sito
//$acc->creaDB();

//funzione che carica automaticamente le classi
function __autoload($nome_classe){
    require_once 'lib/' . $nome_classe . '.php';
}

//require_once("./lib/RUBA.php");

//get user
$utente = $acc->checkUser();

?>

<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="hackweb">
    <meta property="og:image" content="" />
    <meta property="og:title" content="hackweb" />
    <meta property="og:description" content="hackweb"/>
    <meta property="og:site_name" content="hackweb"/>
    <meta property="og:type" content="website"/>
    <link rel="icon" type="image/png" href="favicon.png"/>

    <title>hackweb</title>

    <!-- CSS
    ================================================== -->
    <!-- CSS personal -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--<link href="css/custom.css" rel="stylesheet">-->

    <!--CSS jVideo -->
    <link href="js/jvideo/css/style3.css" rel="stylesheet" type="text/css">
    <link href="js/jvideo/css/mejs-skins.css" rel="stylesheet" type="text/css">

    <!-- CSS fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <!--<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">-->


    <!-- JavaScript
    ================================================== -->
    <!-- Placed at the top of the document so you can load plugins later -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.easing.min.js"></script>

    <!-- Bootstrap -->
    <!--<script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/holder/holder.js"></script>-->

    <!--<script src="js/ckeditor/ckeditor.js"></script>-->

    <!-- SUMMERNOTE -->
    <link href="js/summernote/dist/summernote.css" rel="stylesheet">
    <script src="js/summernote/dist/summernote.min.js"></script>

    <!-- jVideo -->
    <script src="js/jvideo/mediaelement-and-player.js"></script>

    <!-- FlexSlider -->
    <link href="js/FlexSlider/flexslider.css" rel="stylesheet">
    <script src="js/FlexSlider/jquery.flexslider-min.js"></script>

    <!-- FRANKIE'S -->
    <script src="js/custom.js"></script>
    <script src="js/general.js"></script>
    <script src="js/loadPage.js"></script>
    <script src="js/caricaFile2.js"></script>
    <script src="js/typewriter.js"></script>

    <script>
        //variabili globali
        timeout = 0;
        pagina = '';
        utente = '<?php echo($utente); ?>';
        potere = 0;
        avatar = 'avatar_base.png';
        var informazioni = "Version 5.0<br>© hackweb, Riccione --> Bologna 2002 - 2017";
    </script>

    <script type="text/javascript">
        function nascondi() {
            var e = document.getElementById("hide");
            e.innerHTML = informazioni;
            if (e.style.visibility == 'hidden') {
                e.style.visibility = 'visible';
                e.style.display = 'block';
            } else {
                //alert('attenzione');
                //alert("manutenzione attiva!");
                e.style.visibility = 'hidden';
                e.style.display = 'none';
            }
        }
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-92261711-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>

    <!-- BODY
================================================== -->
<body>

    <div align="center" style="margin-top:5px" id="pagina">

        <!-- logo
================================================== -->
        <div id="logo">
            <table>
                <tr>
                    <td class="logo-table" background="images/logo.png" height="70">
                    </td>
                </tr>
            </table>
        </div>

        <!-- struttura
================================================== -->
        <div id="struttura">
            <table border="0">
                <tr>
                    <!-- colonna menu -->
                    <td id="col-menu" rowspan="2" align="center" valign="top">
                        <div id="menu">

                        </div>
                    </td>

                    <!-- colonna centrale -->
                    <td class="col-cent" align="center" valign="middle" height="10">
                        <table>
                            <tr>
                                <td class="col-cent" align="center" bgcolor="#272727" style="border-radius:10px;">
                                    <div style="padding-top: 5px; padding-bottom: 5px;" class="logincell" id="barra-sopra">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <!-- colonna laterale dx -->
                    <td class="col-dx" rowspan="2" valign="top">
                        <div class="logincell">Ultimi utenti iscritti:</div>
                        <?php $tempo = time(); ?>
                        <table class="table-dx" border="0">
                            <tr>
                                <td align="left" valign="middle" bgcolor="#272727" style="border-radius:10px; padding: 3px;">
                                        <?php
$conn = mysql_connect("62.149.150.193","Sql677570","0aae578b");
mysql_select_db("Sql677570_5");

$sql="SELECT login, id FROM accounts WHERE verifica = '1' ORDER BY id DESC LIMIT 6";
$risultati=mysql_query($sql);
$numeretto = 1;
while($riga=mysql_fetch_array($risultati)) {
    $target=$riga["login"];
    echo "<span class=\"logincell\">#$numeretto:</span> "."$target"."<br />";
    ++$numeretto;
}//Fine del while
mysql_close($conn);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="logincell">Sezione visitatore:</div>
                            <table class="table-dx">
                                <tr>
                                    <td bgcolor="#272727" align="center" style="border-radius:10px;">
                                        <?php
echo "Your IP address is:<br /> <span style=\"color:#00FF00\">$ip</span>";

//$ruba = new RUBA;
//$ruba->ruba();
                                        ?>
                                    </td>
                                </tr>
                            </table>

                            <table class="table-dx">
                                <tr>
                                    <td bgcolor="#272727" align="center" style="border-radius:10px;">visitatore #<?php include('include/visite.php'); ?></td>
                                </tr>
                            </table>

                            <table class="table-dx">
                                <tr>
                                    <td align="center" bgcolor="#272727" style="border-radius:10px; padding-top:10px; padding-bottom:5px;">
                                        <div id="fascia-news">
                                            <!--<span class="style2">
<span class="style4">
NEWS:</span></span>
<div align="left" style="padding-left:5px; padding-right:5px;"> <br />
<?php
$acc->getNews();
?>
</div>-->
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div align="center">
                                <!--<script type="text/javascript">
/* <![CDATA[ */
document.write('<s'+'cript type="text/javascript" src="http://ad.altervista.org/js.ad/size=300X250/r='+new Date().getTime()+'"><\/s'+'cript>');
/* ]]> */
</script>-->
                            </div>
                        </td>
                        <!-- FINE colonna laterale dx -->
                    </tr>
                    <tr>
                        <!-- colonna CONTENT -->
                        <td class="col-cent" height="400" align="center" valign="top" class="cell">
                            <table>
                                <tr>
                                    <td valign="top" height="400" align="center" bgcolor="#272727" class="col-cent" style="border-radius:10px;">
                                        <div align="center" class="cell" id="content">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- FINE colonna CONTENT -->
                    </tr>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function(e) {
                $('#content').load('include/assistenza.php');
                $('#barra-sopra').load('include/admin.php');
                $('#menu').load('include/menu.php');
                $('#fascia-news').load('./include/news.php');
            });


        </script>

    </body>
</html>
