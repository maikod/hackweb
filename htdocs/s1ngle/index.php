<!-- s1ngle -->

<?php
//php iniziale
include_once('libs/config.php');
//CIAO
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="s1ngle">
    <meta property="og:image" content="" />
    <meta property="og:title" content="s1ngle" />
    <meta property="og:description" content="s1ngle"/>
    <meta property="og:site_name" content="s1ngle"/>
    <meta property="og:type" content="website"/>
    <base href="<?php echo HOST; ?>">

    <title>s1ngle</title>

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
    <link href="css/base.css?v=0.003" rel="stylesheet">
    <link href="css/custom.mobile.css?v=0.003" rel="stylesheet">
    <link href="css/admin.css?v=0.003" rel="stylesheet">
    <link href="css/admin.mobile.css?v=0.003" rel="stylesheet">

    <!-- personal CSS fonts -->    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
    <!-- <link rel="stylesheet" href="js/font-awesome/font-awesome.min.css" />   -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Gloria+Hallelujah" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Quattrocento" rel="stylesheet">



    <!-- JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- JQUERY -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous" async defer></script> -->
    <script src="js/jquery/jquery-3.2.1.min.js"></script>
    
    <!-- library scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous" async defer></script> -->
    <script src="js/popper.min.js" async defer></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous" async defer></script> -->
    <script src="js/bootstrap/bootstrap.min.js" async defer></script>
    <script src="js/masonry.pkgd.min.js" async defer></script>
    <script src="js/iso.t.js" async defer></script>
    <!-- <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js" async defer></script> -->
    <script src="js/imagesloaded.pkgd.min.js" async defer></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js" async defer></script> -->
    <script src="js/fancybox/jquery.fancybox.min.js" async defer></script>
    <script src="js/file_upload/js/vendor/jquery.ui.widget.js" defer></script>     
    <script src="js/file_upload/js/jquery.iframe-transport.js" defer></script>
    <script src="js/file_upload/js/jquery.fileupload.js" defer></script>
    <script src="js/instafeed.min.js" defer></script>
    <script src="js/summernote/summernote-bs4.js" async defer></script>
    <script src="js/filesaver.js" async defer></script>
    <script src="js/blob.js" async defer></script>     
    <script src="js/jquery-ui/jquery-ui.min.js" defer></script>
    <script src="js/jquery.ui.touch-punch.min.js" defer></script>
    <script async defer src="js/frankousel/frankousel.js"></script>
    
    <!-- personal scripts -->
    <script src="js/variables.js?v=0.002" ></script>
    <script src="js/custom.js?v=0.002" ></script>
    <script src="js/functions.js?v=0.002"></script>
    <script src="js/overview.js?v=0.002"></script>
    <script src="js/admin.js?v=0.002"></script>

    <!-- secondary scripts -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCw0ZmNj6TqqcMyrlkYeZq2_x8xJoHPJfk&callback=initMap"></script> -->
    <script async defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- shopify -->
    <!-- <script src="http://sdks.shopifycdn.com/js-buy-sdk/v1/latest/index.umd.min.js"></script> -->    
    <script src="https://sdks.shopifycdn.com/buy-button/latest/buybutton.js"></script>
    <script src="js/shopify/shopify.js"></script>
</head>



<body onresize="" style="" onload="" >

    <!-- include facebook sdk -->
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root" style="display:none;"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v2.12&appId=2134505389899827';
    js.async = true;
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- facebook sdk end -->


    <div id="main_page" >        
        <!-- Navbar
        ================================================== -->
        <nav class="navbar navbar-expand-lg navbar-light" >
            <a class="navbar-brand" href="#">
                <img src="img/logo2.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">            
                <ul class="navbar-nav ml-auto mt-0 mt-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">s1ngle STORY</a>
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

        <div class="blog-footer" style="text-align: left;">    
            <div class="" style="color:#fff;">2018 © s1ngle. All Rights Reserved.<br><span style="color:#fff; font-size:9px;">Made with <i class="fa fa-heart"></i> by <a style="color:#f9f9f9;" href="http://hackweb.it" target="_Blank">Frankie</a></span></div>            
            <div class="social-links">
			    <a target="_blank" title="Instagram" href="http://instagram.com/brahmino"><i class="fa fa-instagram"></i></a>
                <a target="_blank" title="Youtube" href="https://www.youtube.com/channel/UCjZqhF7UUC5yhMWe0e3WQsQ"><i class="fa fa-youtube"></i></a>
                <a target="_blank" href="http://twitter.com/Brahmino"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://www.facebook.com/Brahmino/"><i class="fa fa-facebook-official"></i></a>
            </div>
        </div>
        <!-- /.footer -->
    </div>

    <!-- modal jqueryui -->
    <div id="modal" title="Are you sure?" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
    </div>

    <!-- cookie -->
    <div id="accept_cookie" style="<?php echo @$_COOKIE['cookiePolicy']; ?>; display:none;" >
        <!-- This site uses cookies – small text files that are placed on your machine to help the site provide a better user experience. In general, cookies are used to retain user preferences, store information for things like shopping carts, and provide anonymised tracking data to third party applications like Google Analytics. As a rule, cookies will make your browsing experience better. However, you may prefer to disable cookies on this site and on others. The most effective way to do this is to disable cookies in your browser. We suggest consulting the Help section of your browser or taking a look at the About Cookies website which offers guidance for all modern browsers.         -->
        This site uses cookies: <a class="cookie-link" id="cookie-more">Find out more.</a> <a class="cookie-link" id="cookie-close">Close.</a>
        <br>
        <!-- <button id="cookie-close" type="submit" class="btn btn-default btn-sm"><a style="color:#222222;">Close</a></button> -->        
    </div>
    <!-- Modal -->
    <div class="modal fade" id="cookie-policy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="font-family:'Montserrat';">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cookie Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body cookie-body">
                    This site uses cookies – small text files that are placed on your machine to help the site provide a better user experience. In general, cookies are used to retain user preferences, store information for things like shopping carts, and provide anonymised tracking data to third party applications like Google Analytics. As a rule, cookies will make your browsing experience better. However, you may prefer to disable cookies on this site and on others. The most effective way to do this is to disable cookies in your browser. We suggest consulting the Help section of your browser or taking a look at the About Cookies website which offers guidance for all modern browsers.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>



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
//shopify variables
var client = ShopifyBuy.buildClient({
    domain: 's1ngle.myshopify.com',
    storefrontAccessToken: '445279826d6edd0de201acd1f25092e5', // previously apiKey, now deprecated    
    // appId: '6',
});
var ui = ShopifyBuy.UI.init(client);

$(function() {		
	//primo caricamento della pagina
    init();

    //gestione cookies
    var cookies = [];
    var cookies_raw = document.cookie.split(';');
    var i2 = 0;
    for(i = 0; i < cookies_raw.length; i++){        
        if(cookies_raw[i].includes('moodb-')){            
            cookies[i2] = cookies_raw[i];
            i2++;
        }
    }
    $('.index-moodb').html(cookies.length);


    //cookie policy
    $('#cookie-close').click(function(){        
        createCookie('cookiePolicy','display:none;',1000);					
		$('#accept_cookie').slideUp('fast')
		return false;
    });
    //cookie more link
    $('#cookie-more').click(function(){
        $('#cookie-policy-modal').modal('toggle')
    });
    //cookie close with timer
    if(getCookie('cookiePolicy') == null){
        window.setTimeout(function(){
            $('#cookie-close').click();
        }, 20000);
    }    
    
});

$(window).on('load', function () {
	// eseguire quando tutti gli elementi (anche immagini) del primo caricamento sono stati effettuati
});
</script>
