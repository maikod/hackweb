
<div id="hw-overview" class="spazio">
    <div class="inner">
        <div class="inner-grid">
            <div class="cell-sizer"></div>
            <!-- <div class="gutter-sizer"></div> -->
        </div>
        <div class="grid-loading">
            <div style="text-align:left; margin: 0 auto; max-width:100px;">Loading
            </div>
        </div>
        <div class="overview-moodboard-btn">
            <i class="fa fa-plus" aria-hidden="true" val="0"></i> Moodboard [<span class="cart-mood-selector">0</span>]
        </div>
    </div>
</div>

<script>
$(function(){
    initOverview();

    $('.overview-moodboard-btn').hide().css('opacity','1');

    $('body').off('click', '.overview-img-link');
    $('body').on('click', '.overview-img-link', function (e) {
        $('.overview-moodboard-btn').fadeIn('fast');
    });

    $().fancybox({
        selector : '[data-fancybox="gallery"]',
        loop     : true,
        beforeClose: function( instance, slide ) {
            $('.overview-moodboard-btn').fadeOut('fast');
        },
        afterLoad: function(instance, slide){
            //gestione dei cookies moodboard
            window.setTimeout(function(){                
                var $img = $('.fancybox-slide--current .fancybox-image');
                var $symbol = $('.overview-moodboard-btn .fa');
                var curimg = $img.attr('src');    
                $symbol.attr('val', '0').removeClass('fa-minus').addClass('fa-plus');                      
                for(i = 0; i < cookies.length; i++){
                    var cookie = cookies[i].split('=');                    
                    if(cookie[1] == curimg){
                        $symbol.attr('val', cookie[0].split('moodb-')[1]).removeClass('fa-plus').addClass('fa-minus');                                    
                        break;
                    }               
                }
            }, 200);            
        },
        buttons : [
            'slideShow',
            'fullScreen',
            'thumbs',
            'share',
            // 'download',
            // 'zoom',
            'close'
        ],
    });

    //click mood cart
    $('.overview-moodboard-btn').click(function(){
        var $el = $(this);
        var $number = $('.cart-mood-selector', $el);
        var $symbol = $('.fa', $el);
        var i = $number.html();
        var $img = $('.fancybox-slide--current .fancybox-image');

        if($symbol.hasClass('fa-plus')){
            i++;
            $symbol.removeClass('fa-plus').addClass('fa-minus');
            var val = $('.overview-img-link[href="'+$img.attr('src')+'"]').attr('val');            
            createCookie('moodb-'+val, $img.attr('src'), 30);            
        }else{
            $symbol.removeClass('fa-minus').addClass('fa-plus');
            deleteCookie('moodb-'+$symbol.attr('val'));
            i--;            
        }
        cookies = [];
        cookies_raw = document.cookie.split(';');
        i2 = 0;
        for(i3 = 0; i3 < cookies_raw.length; i3++){        
            if(cookies_raw[i3].includes('moodb-')){            
                cookies[i2] = cookies_raw[i3];
                i2++;
            }
        }        
        $number.html(i);
        $('.index-moodb').html(i);
        // console.log(getCookie('moodb-'+i));
    });


    //verifica dei cookies
    var cookies = [];
    var cookies_raw = document.cookie.split(';');
    var i2 = 0;
    for(i = 0; i < cookies_raw.length; i++){        
        if(cookies_raw[i].includes('moodb-')){            
            cookies[i2] = cookies_raw[i];
            i2++;
        }
    }
    $('.overview-moodboard-btn .cart-mood-selector').html(cookies.length);
    $('.index-moodb').html(cookies.length);    
});
</script>