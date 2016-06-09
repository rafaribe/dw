var latitude = document.getElementById('latitude').getAttribute("name");
console.log (latitude);
var longitude = document.getElementById('longitude').getAttribute("name");
console.log (longitude);
var myCenter=new google.maps.LatLng(latitude,longitude);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:16,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("map"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
