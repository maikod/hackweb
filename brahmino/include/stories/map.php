<div class="map-container">
    <div id="map"></map>
</div>

<script>
//google maps scripts
var info_pos = {lat: -25.363, lng: 131.044};
var info_pos_text = "Today's working here. Next Projects in Italy, UK, Switzerland, Japan.";
var geocoder = new google.maps.Geocoder();
var address = 'Milan, Italy';
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
</script>