<div class="spazio" id="hw-preview" style="">
    <div class="inner">        
        <!-- contenitore della singola storia -->
        <div class="stories-item" style="display:none;">
            <?php include_once('preview/storyPreview.php'); ?>
        </div>

        <div class="sidebar_content full_width general-item" style="display:none;">
            <div style="max-width:1300px; margin:0 auto;">                                
                <?php 
                $content = @$_SESSION['PreviewContent'];
                echo $content;
                ?>                                    
            </div>        
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

if(sezione2 == 'storyPreview'){
    $('.stories-item').show();
    // var html = getCookie(sezione2);
    // $('.stories-item').html(html).show();
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
}else if(sezione2 == 'generalPreview'){    
    $('.general-item').show();

    // google maps scripts    
    if(typeof address != 'undefined'){
        var info_pos = {lat: -25.363, lng: 131.044};
        var geocoder = new google.maps.Geocoder();
        var marker = null;
        var map = new google.maps.Map($('.general-item #map')[0], {
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
}


</script>