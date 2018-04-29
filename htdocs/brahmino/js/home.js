//home.js

var init_home = function(){
    var $carousel = $('.main-carousel').frankousel({
        // options
        cellAlign: 'center',
        contain: true,
        imagesLoaded: true,
        percentPosition: false,
        autoPlay: true
    });
    
    var $imgs = $carousel.find('.carousel-cell .img');
    // get transform property
    var docStyle = document.documentElement.style;
    var transformProp = typeof docStyle.transform == 'string' ?
        'transform' : 'WebkitTransform';
    
    var frkousl = $carousel.data('frankousel');
    
    $carousel.on( 'scroll.frankousel', function() {
            frkousl.slides.forEach( function( slide, i ) {
            var img = $imgs[i];
            var x = ( slide.target + frkousl.x ) * -1/3;
            img.style[ transformProp ] = 'translateX(' + x  + 'px)';
        });
    });

    var $carousel2 = $('.menu-carousel').frankousel({
        // options
        // freeScroll: false,
        // cellAlign: 'left',
        autoPlay: true,
        wrapAround: true,
        cellAlign: 'center'        
    });
    
    $('.menu_moto-home .frankousel-page-dots').css('opacity', '0');
    $('.frankousel-prev-next-button').css('opacity', '0');
}