<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="hackweb">
    <meta property="og:image" content="<?php echo $full_link; ?>" />
    <meta property="og:title" content="hackweb" />
    <meta property="og:description" content="hackweb"/>
    <meta property="og:site_name" content="hackweb"/>
    <meta property="og:type" content="website"/>    
    <link rel="icon" type="image/png" href="favicon.png"/>
    <link rel="alternate" hreflang="<?php echo $lang; ?>" href="<?php echo $canonical; ?>" />
    <link id="canonical" rel="canonical" href="<?php echo $canonical; ?>" /> 
    <base href="<?php echo $base_host; ?>">
    <title>hackweb</title>
    
    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />    
    <!-- End CSS -->

    <!-- Javascript -->
    <script src="js/jquery/jquery-3.2.1.min.js"></script>     
    <script src="js/custom.js"></script>    
    <!-- <script src="js/general.js" async defer></script>
    <script src="js/loadPage.js" async defer></script>
    <script src="js/caricaFile2.js" async defer></script>
    <script src="js/typewriter.js" async defer></script>     -->
    <!-- End Javascript -->
</head>



<body>
    <div align="center" style="margin-top:5px" id="pagina">

        <div id="logo" style="">
            <img src="images/logo.png" style="width:100%; max-width:900px;">
        </div>


        <div id="struttura">
            <!-- menu -->
            <div id="col-menu">
                <div id="menu"></div>
            </div>            

            <!-- colonna destra -->
            <div class="col-dx">
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
                <div class="table-dx">
                    <div class="details">
                        <?php
                        echo "Your IP address is:<br /> <span style=\"color:#00FF00\">$ip</span>";
                        ?>
                    </div>                
                    <div class="space"></div>
                    <div class="details">
                        visitatore #
                        <?php include('include/visite.php'); ?>
                    </div>
                </div>
                <div class="logincell">News:</div>
                <div id="fascia-news" class="table-dx">
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
            <!-- End colonna destra -->

            <!-- barra alta -->
            <div class="col-cent top">
                <div class="logincell" id="barra-sopra"></div>
            </div>            

            <!-- contenuto -->
            <div class="col-cent main" style="">
                <div align="center" class="cell" id="content">                    
                </div>
            </div>
            
        </div>
    </div>
                
    <script>
        //script finali
        $(document).ready(function(e) {
            $('#content').load('include/home.php');
            $('#barra-sopra').load('include/admin.php');
            $('#menu').load('include/menu.php');
            $('#fascia-news').load('./include/news.php');
                        
            clockInterval = setInterval(function(){                
                clock($('#clock'));  
            },1000);                                                  
        });
    </script>
</body>
</html>
