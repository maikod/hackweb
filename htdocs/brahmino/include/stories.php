
<div class="spazio" id="hw-stories" style="">
    <div class="inner stories">

        <div class="stories-list">
            <div id="" class="page-header">			
                <div class="page_title_wrapper">
                    <div class="page_title_inner">
                        <h2>Stories</h2>
                        <div class="page-subtitle">
                            The journal about my photo &amp; video productions.
                            People, places, travels, projects. 		    	
                        </div>
                    </div>
                </div>
            </div>

            <hr class="hr2">

            <!-- sezione stories -->
            <div class="stories-grid" style="display:none;">
                <div class="stories-cell-sizer"></div>  
                <div class="stories-gutter-sizer"></div>    
            </div>

            <div class="grid-loading">
                <div style="text-align:left; margin: 0 auto; max-width:100px;">Loading
                </div>
            </div>
        </div>

        <!-- contenitore della singola storia -->
        <div class="stories-item">

        </div>
    </div>
</div>

<script>
//config setup
origin = 0;
increment = 20;
loading = false;
end = false;
$isot = null;
$stories_gallery = null;

var singleStoryLoad = function(){
    
    //map
    if($('#map').length > 0){
        console.log("map load");
        //google maps scripts
        var info_pos = {lat: -25.363, lng: 131.044};
        var info_pos_text = "Today's working here.";        
        var geocoder = new google.maps.Geocoder();
        var address = 'Milan, Italy';
        var marker = null;

        address = $('.summernote-map-content').attr('address');
        info_pos_text = $('.summernote-map-content').attr('message');

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: info_pos,
            styles: map_style
        });
        var infowindow = new google.maps.InfoWindow({
            content: info_pos_text
        });
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: info_pos_text
                });
                marker.addListener('click', function(){
                    infowindow.open(map, marker);
                });
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    //fb button
    var fbUrl = location.href.replace('/'+lang+'/', '/__/');
    $('#fb-like-btn').attr('data-href', fbUrl);
    console.log('fb');
    FB.XFBML.parse();    

    //stop loading interval
    stopInterval();
}

if(sezione2 == ''){
    loadingInterval();
    $('.stories-item').hide();    
    loadStories().then(function(data) {        
        stopInterval();
    });                   
}else{
    loadingInterval();
    $('.stories-list').hide();
    loadStory(sezione2).then(function(data){
        $('.stories-item').html(data);
        $stories_gallery = $('.stories-gallery-grid').fadeTo(0,0).imagesLoaded(function(){        
            $stories_gallery.masonry({
                itemSelector: '.stories-gallery-cell',
                columnWidth: '.stories-gallery-cell-sizer',
                gutter: '.stories-gallery-gutter-sizer',
                percentPosition: true
            }).fadeTo(400,1);                     
        });
        //sistemazione link social           
        $('.stories-social-fb').attr('href', 'https://www.facebook.com/sharer/sharer.php?u='+location.href);
        $('.stories-social-tw').attr('href', 'https://twitter.com/intent/tweet?original_referer='+location.href+'&url='+location.href);
        $('.stories-social-pi').attr('href', 'http://www.pinterest.com/pin/create/button/?url='+location.href);
        $('.stories-social-go').attr('href', 'https://plus.google.com/share?url='+location.href);
        
        //mappa e altre cose
        singleStoryLoad();
    });
}    

// $mason = $('.stories-grid').masonry({
//     itemSelector: '.stories-cell',
//     columnWidth: '.stories-cell-sizer',
//     gutter: '.stories-gutter-sizer',
//     percentPosition: true
// });    
// $mason.masonry('layout');    

$('#hw-stories').on('click', '.stories-cell .stories-cat a', function(e){
    e.preventDefault();
    return false;
});

$('#hw-stories').on('click', '.stories-cell .stories-link', function(e){

    e.preventDefault();
    var $el = $(this);    
    sezione2 = $el.attr('href');  
    section[2] = sezione2;  

    //save scroll position
    lastScroll = $(window).scrollTop();
    console.log(lastScroll);
    
    //go to page top
    // window.scroll({
    //     top: 0, 
    //     left: 0, 
    //     behavior: 'smooth' 
    // });
    $(window).scrollTop(0);
    
    $('.stories-list').fadeOut('fast', function(){   
        loadingInterval();
                     
        loadStory(sezione2).then(function(data){
            window.history.pushState(null, null, lang+'/'+sezione+'/'+section[2]);
            $('.stories-item').html(data);
            $('.stories-gallery-grid').fadeTo(0,0);
            $('.stories-item').fadeIn('fast',function(){
                $stories_gallery = $('.stories-gallery-grid').fadeTo(0,0).imagesLoaded(function(){        
                    $stories_gallery.masonry({
                        itemSelector: '.stories-gallery-cell',
                        columnWidth: '.stories-gallery-cell-sizer',
                        gutter: '.stories-gallery-gutter-sizer',
                        percentPosition: true
                    }).fadeTo(400,1);                                
                });
                //sistemazione link social
                $('.stories-social-fb').attr('href', 'https://www.facebook.com/sharer/sharer.php?u='+location.href);
                $('.stories-social-tw').attr('href', 'https://twitter.com/intent/tweet?original_referer='+location.href+'&url='+location.href);
                $('.stories-social-pi').attr('href', 'http://www.pinterest.com/pin/create/button/?url='+location.href);
                $('.stories-social-go').attr('href', 'https://plus.google.com/share?url='+location.href);
                
                //mappa e altri dettagli
                singleStoryLoad();
            });
        });
    });
    
    return false;
});

</script>