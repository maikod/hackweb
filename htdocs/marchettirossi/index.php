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
    <meta name="description" content="Simone Bramante // Brahmino">
    <meta property="og:image" content="" />
    <meta property="og:title" content="Simone Bramante // Brahmino" />
    <meta property="og:description" content="Simone Bramante // Brahmino"/>
    <meta property="og:site_name" content="Simone Bramante // Brahmino"/>
    <meta property="og:type" content="website"/>
    <base href="/<?php echo HOST; ?>/">

    <title>Simone Bramante // Brahmino &#8211; Photographer // Director</title>

    <!-- icona sito -->
    <!-- <link rel="icon" type="image/png" href="img/logo/fav.png"> -->
    <link rel="icon" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-32x32.jpg" sizes="32x32" />
    <link rel="icon" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-180x180.jpg" />
    <meta name="msapplication-TileImage" content="http://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-270x270.jpg" />

    <!-- inclusions -->            

    <!-- library css -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" /> -->
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.min.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="js/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="js/file_upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="js/summernote/summernote-bs4.css">

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
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="nav-back">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav navbar-center">
                            <li><a class="nav-link active" href="#hw-overview">overview</a></li>
                            <li><a class="nav-link" href="#hw-stories">stories</a></li>
                            <li><a class="nav-link" href="#hw-info">info</a></li>
                            <li><a class="nav-link" href="#hw-press">press</a></li>
                            <li><div class="nav-separator">//</div></li>
                            <li><a class="" target="_blank" href="libs/createPDF.php">moodboard (0)</a></li>                                                        
                        </ul>

                    </div>
                </div>
            </div>
            <img id="main_logo" src="img/logo.png" class="nav-logo" />
        </nav>
        <!-- /.navbar -->



        <!-- body -->
        <div id="main_container">
            <div id="main_inner">
            </div>
        </div>



        <!-- Footer
        ================================================== -->        
        <div class="pre-footer" style="text-align:center">
            <hr class="hr2">
            <button type="submit" class="btn btn-default" style="margin-top:10px;"><a target="_blank" title="Instagram" href="http://instagram.com/brahmino" style="color:#222222;"><i class="fa fa-instagram"></i> BRAHMINO</a></button>        
            <br><br>
            <div id="instafeed" class="frenkifeed"></div>
            <div style="clear:both;"></div>
        </div>

        <div class="blog-footer" style="text-align: center;">    
            <div class="">2012-2018 © Simone Bramante. All Rights Reserved.<span style="color:#f9f9f9;"> // Made with <i class="fa fa-heart"></i> by <a style="color:#f9f9f9;" href="http://hackweb.it" target="_Blank">Frankie</a></span></div>            
            <div class="social-links">
			    <a target="_blank" title="Instagram" href="http://instagram.com/brahmino"><i class="fa fa-instagram"></i></a>
                <a target="_blank" title="Youtube" href="https://www.youtube.com/channel/UCjZqhF7UUC5yhMWe0e3WQsQ"><i class="fa fa-youtube"></i></a>
                <a target="_blank" href="http://twitter.com/Brahmino"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://www.facebook.com/Brahmino/"><i class="fa fa-facebook-official"></i></a>
            </div>                        
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
