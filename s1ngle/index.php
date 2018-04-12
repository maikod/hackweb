<!-- s1ngle -->

<?php
//php iniziale
include_once('libs/config.php');
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="S1NGLE">
    <meta property="og:image" content="" />
    <meta property="og:title" content="S1NGLE" />
    <meta property="og:description" content="S1NGLE"/>
    <meta property="og:site_name" content="S1NGLE"/>
    <meta property="og:type" content="website"/>
    <base href="<?php echo HOST; ?>">

    <title>S1NGLE</title>

    <!-- icona sito -->
    <link rel="icon" type="image/png" href="img/logo.png">
    <!-- <link rel="icon" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-32x32.jpg" sizes="32x32" />
    <link rel="icon" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-180x180.jpg" />
    <meta name="msapplication-TileImage" content="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-270x270.jpg" /> -->

    <!-- inclusions -->            

    <!-- library css -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" /> -->
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.min.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="js/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="js/file_upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="js/summernote/summernote-bs4.css">
    <link href="js/frankousel/frankousel.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- personal CSS include-->
    <link href="css/custom.css?v=0.003" rel="stylesheet">
    <link href="css/custom.mobile.css?v=0.003" rel="stylesheet">
    <link href="css/admin.css?v=0.003" rel="stylesheet">
    <link href="css/admin.mobile.css?v=0.003" rel="stylesheet">

    <!-- personal CSS fonts -->    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
    <!-- <link rel="stylesheet" href="js/font-awesome/font-awesome.min.css" />   -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Gloria+Hallelujah" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Quattrocento" rel="stylesheet">
</head>


<body onresize="" style="" onload="">
    <div id="main_page">        


        <!-- Navbar
        ================================================== -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <img src="img/logo2.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">            
                <ul class="navbar-nav ml-auto mt-0 mt-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">S1NGLE STORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="how_to">SHOP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-cart" ><img src="img/cart.jpg"></a>
                    </li>
                </ul>            
            </div>    
        </nav>
        <!-- /.navbar -->



        <!-- body -->
        <div id="main_container">
            <div id="main_inner">

            </div>
        </div>



        <!-- Footer
        ================================================== -->        
        <!-- <div class="pre-footer" style="text-align:center">
            <hr class="hr2">
            <button type="submit" class="btn btn-default" style="margin-top:10px;"><a target="_blank" title="Instagram" href="http://instagram.com/brahmino" style="color:#222222;"><i class="fa fa-instagram"></i> BRAHMINO</a></button>        
            <br><br>
            <div id="instafeed" class="frenkifeed"></div>
            <div style="clear:both;"></div>
        </div> -->

        <div class="blog-footer" style="text-align: center;">    
            <!-- <div class="">2012-2018 © Simone Bramante. All Rights Reserved.<span style="color:#f9f9f9;"> // Made with <i class="fa fa-heart"></i> by <a style="color:#f9f9f9;" href="http://hackweb.it" target="_Blank">Frankie</a></span></div>            
            <div class="social-links">
			    <a target="_blank" title="Instagram" href="http://instagram.com/brahmino"><i class="fa fa-instagram"></i></a>
                <a target="_blank" title="Youtube" href="https://www.youtube.com/channel/UCjZqhF7UUC5yhMWe0e3WQsQ"><i class="fa fa-youtube"></i></a>
                <a target="_blank" href="http://twitter.com/Brahmino"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://www.facebook.com/Brahmino/"><i class="fa fa-facebook-official"></i></a>
            </div> -->
        </div>
        <!-- /.footer -->
    </div>
</body>
</html>

<!-- JavaScript & CSS
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JQUERY -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
<script src="js/jquery/jquery-3.2.1.min.js"></script>
<!-- library scripts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script> -->
<script src="js/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/iso.t.js"></script>
<!-- <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script> -->
<script src="js/imagesloaded.pkgd.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script> -->
<script src="js/fancybox/jquery.fancybox.min.js"></script>
<script src="js/file_upload/js/vendor/jquery.ui.widget.js"></script>
<script src="js/file_upload/js/jquery.iframe-transport.js"></script>
<script src="js/file_upload/js/jquery.fileupload.js"></script>
<script src="js/instafeed.min.js"></script>
<script src="js/summernote/summernote-bs4.js"></script>
<script src="js/frankousel/frankousel.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>

<!-- personal scripts -->
<script src="js/custom.js?v=0.002"></script>
<script src="js/overview.js?v=0.002"></script>
<script src="js/admin.js?v=0.002"></script>

<?php
//php finale
echo '<script>
    var HOST = "'.@$_SESSION['HOST'].'";
    var sezione = "'.@$_SESSION['params'][1].'";
    var sezione2 = "'.@$_SESSION['params'][2].'";
    var lang = "'.@$_SESSION['lang'].'";
    var section = [];
    section[0] = lang;
    section[1] = sezione;
    section[2] = sezione2;    
</script>';

//aggiustamenti admin
if($result['potere'] >= 0){
    echo '
    <script>
        $("#navbar .nav").append(\'<li><a class="nav-link" href="#hw-admin">admin</a></li>\');        
    </script>
    ';
} 
?>

<!-- script finale -->
<script>
$(window).on('load', function () {
	// eseguire quando tutti gli elementi (anche immagini) del primo caricamento sono stati effettuati
});

$(function() {		
	//primo caricamento della pagina
    init();
});
</script>
