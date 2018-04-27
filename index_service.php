<?php
//recupero indirizzo web dell'utente
$ip = Get_IP();

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="hackweb">
    <meta property="og:image" content="http://www.hackweb.it/favicon.png" />
    <meta property="og:title" content="hackweb" />
    <meta property="og:description" content="hackweb"/>
    <meta property="og:site_name" content="hackweb"/>
    <meta property="og:type" content="website"/>    
    <link rel="icon" type="image/png" href="favicon.png"/>
    <base href="">
    <title>hackweb</title>
    
    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />    
    <!-- End CSS -->

    <!-- Javascript -->
    <script src="js/jquery/jquery-3.2.1.min.js"></script>     
    <script src="js/custom.js" async defer></script>
    <script src="js/functions.js" async defer></script>
    <script src="js/general.js" async defer></script>
    <script src="js/loadPage.js" async defer></script>
    <script src="js/caricaFile2.js" async defer></script>
    <script src="js/typewriter.js" async defer></script>    

    <script>
        //variabili globali
        var timeout = 0;
        var pagina = '';
        var utente = '';
        var potere = 0;
        var avatar = 'avatar_base.png';
        var informazioni = 'Version 5.0<br>© hackweb, Riccione / Bologna 2002 - 2018';
    </script>
    <!-- End Javascript -->
</head>



<body>
    <div align="center" style="margin-top:5px" id="pagina">

        <div id="logo" style="">
            <img src="images/logo.png" style="width:100%;">
        </div>


        <div id="struttura">
            <!-- menu -->
            <div id="col-menu">
                <div id="menu"></div>
            </div>            

            <!-- barra alta -->
            <div class="col-cent" style="background-color:#272727;">
                <div style="padding-top: 5px; padding-bottom: 5px;" class="logincell" id="barra-sopra"></div>
            </div>

            <!-- colonna destra -->
            <div class="col-dx" style="background-color:#272727;">
                <div class="logincell">Ultimi utenti iscritti:</div> 
                <div class="table-dx">
                    <?php
                    // $conn = mysql_connect("62.149.150.193","Sql677570","0aae578b");
                    // mysql_select_db("Sql677570_5");

                    // $sql="SELECT login, id FROM accounts WHERE verifica = '1' ORDER BY id DESC LIMIT 6";
                    // $risultati=mysql_query($sql);
                    // $numeretto = 1;
                    // while($riga=mysql_fetch_array($risultati)) {
                    //     $target=$riga["login"];
                    //     echo "<span class=\"logincell\">#$numeretto:</span> "."$target"."<br />";
                    //     ++$numeretto;
                    // }//Fine del while
                    // mysql_close($conn);
                    ?>
                </div>
                <div class="logincell">Sezione visitatore:</div>
                <div>
                    <?php
                    echo "Your IP address is:<br /> <span style=\"color:#00FF00\">$ip</span>";
                    ?>
                </div>
                <div>
                    visitatore #<?php //include('include/visite.php'); ?>
                </div>
                <div id="fascia-news">
                    <!--<span class="style2">
                    <span class="style4">
                    NEWS:</span></span>
                    <div align="left" style="padding-left:5px; padding-right:5px;"> <br />
                    <?php
                    // $acc->getNews();
                    ?>
                    </div>-->
                </div>
            </div>

            <!-- contenuto -->
            <div class="col-cent" style="background-color:#272727;">
                <div align="center" class="cell" id="content"></div>
            </div>
            
        </div>
    </div>
                
    <script>
        //script finali
        $(document).ready(function(e) {
            $('#content').load('include/assistenza.php');
            $('#barra-sopra').load('include/admin.php');
            $('#menu').load('include/menu.php');
            $('#fascia-news').load('./include/news.php');
        });
    </script>
</body>
</html>
