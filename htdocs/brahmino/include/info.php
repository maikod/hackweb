<script>
var info_pos_text = "Today's working here.";
var address = 'Bologna, Italy';
</script>

<div class="spazio" id="hw-info" style="">
    <div class="inner info">
        <div class="ppb_wrapper">

            <div id="info-body">
                <?php include_once('content/infoBody.php'); ?>
            </div>
            
            <br><br>
            <hr>
            <br>
            <div class="social_share_wrapper shortcode"><h5>Share On</h5><br><ul><li><a class="stories-social-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://www.brahmino.com/info/"><i class="fab fa-facebook-f marginright"></i></a></li><li><a target="_blank" class="stories-social-tw" href="https://twitter.com/intent/tweet?original_referer=http://www.brahmino.com/info/&amp;url=http://www.brahmino.com/info/"><i class="fab fa-twitter marginright"></i></a></li><li><a target="_blank" class="stories-social-pi" href="http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.brahmino.com%2Finfo%2F"><i class="fab fa-pinterest-p marginright"></i></a></li><li><a target="_blank" class="stories-social-go" href="https://plus.google.com/share?url=http://www.brahmino.com/info/"><i class="fab fa-google-plus-g marginright"></i></a></li></ul></div>
            <p>
            </p></div></div></div></div></div>
        
            <div class="map-container">                
                <div id="map"></div>
            </div>

        </div>
    </div>
</div>


<script>

//google maps scripts
var info_pos = {lat: -25.363, lng: 131.044};
var geocoder = new google.maps.Geocoder();
var marker = null;
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

//social links update
$('.stories-social-fb').attr('href', 'https://www.facebook.com/sharer/sharer.php?u='+location.href);
$('.stories-social-tw').attr('href', 'https://twitter.com/intent/tweet?original_referer='+location.href+'&url='+location.href);
$('.stories-social-pi').attr('href', 'http://www.pinterest.com/pin/create/button/?url='+location.href);
$('.stories-social-go').attr('href', 'https://plus.google.com/share?url='+location.href);
</script>