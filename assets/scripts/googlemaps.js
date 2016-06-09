
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: {lat: '<?php echo $lat;?>', lng: '<?php echo $lng;?>'}
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: '<?php echo $lat;?>', lng: '<?php echo $lng;?>'}
  });
  marker.addListener('click', toggleBounce);
}
