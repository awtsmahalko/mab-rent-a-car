<!DOCTYPE html>
<html>
<head>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<!-- 
    <script src="../Admin/assets/js/vendor/jquery-2.1.4.min.js"></script> -->
</head>
<body>
<input type="hidden" id="plate" value="<?=$_GET['id']?>">
<div id="map_canvas" style="height: 354px; width:100%;"></div>
<div id="locations" style="text-align: center;max-height: 400px;overflow: auto;">
  <h2>Locations log</h2>
</div>
<script>

$(document).ready(function() {
  // getLocation();
  setInterval(function(){
    getLocation();
  }, 60000);
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        $("#map_canvas").html("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
  var code = $("#plate").val();
  $.post("savePosition.php",{
    code:code,
    latitude:position.coords.latitude,
    longitude:position.coords.longitude
  },function(data,status){
      var res = JSON.parse(data);
      var lat = parseFloat(position.coords.latitude);
      var long = parseFloat(position.coords.longitude);

      // console.log(my_json[my_json_length - 1].lng);
      var map = new google.maps.Map(document.getElementById('map_canvas'), {
        center: {lat: lat, lng: long},
        zoom:16,
        // mapTypeId: google.maps.MapTypeId.HYBRID
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var icon = {
          url: "../mysite/assets/img/car_marker.ico",
          scaledSize: new google.maps.Size(50, 50)
      };
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,long),
        icon: icon,
        map: map,
        animation : google.maps.Animation.DROP,
        label : res.text
      });
      marker.setMap(map);
    $("#locations").append("<p>"+res.log+"</p>");
  });
}
</script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=getLocation'></script>
</body>
</html>
