<div id="map_canvas" style="height: 354px; width:100%;"></div>
<script type="text/javascript">
var rental_id = "<?=$id?>";
var car_model = "<?=$car_model?>";
var plate_number = "<?=$plate_number?>";
var text_car = car_model + " ("+plate_number+")";
var auto_refresh = parseInt($("#auto_refresh").val()) * 1000;
var lineSymbol = {
  path: 'M 0,-1 0,1',
  strokeOpacity: 1,
  scale: 4
};
initMapTime();
// myMap();
setInterval(function(){
	initMapTime();
}, auto_refresh);
function myMap() {
	// initMapTime();
	// var mapProp= {
	//   center:new google.maps.LatLng(lat,long),
	//   zoom:16,
	//   mapTypeId: google.maps.MapTypeId.HYBRID,
	// 	styles:
	// 		[{
	// 			featureType: "poi",
	// 			elementType: "labels",
	// 			stylers:
	// 				[{
	// 					visibility: "off"
	// 				}]

	// 		}]
	// };

	// var map = new google.maps.Map(document.getElementById("map_canvas"),mapProp);

    // Define a symbol using SVG path notation, with an opacity of 1.
 //  var map = new google.maps.Map(document.getElementById('map_canvas'), {
 //    center: {lat: 10.682769028920585, lng: 122.9436225232788},
	// zoom:16,
	// mapTypeId: google.maps.MapTypeId.HYBRID
 //  });
	// var flightPlanCoordinates = [
	// {lat: 10.6817842, lng: 122.9533249},
	// {lat: 10.6798843, lng: 122.9524173},
	// {lat: 10.6764635, lng: 122.946031},
	// {lat: 10.682769028920585, lng: 122.9436225232788}
	// ];
	// console.log(flightPlanCoordinates);
}
function initMapTime(){
    $.ajax({
		type: "POST",
		url: base_url+'adminController/track_get_location',
		data: {
			rental_id: rental_id
		},
		success: function(data){
			var my_json = JSON.parse(data);
			my_json_length = my_json.length;
			if(my_json_length > 0){
				var lat = parseFloat(my_json[my_json_length - 1].lat);
				var long = parseFloat(my_json[my_json_length - 1].lng);

				// console.log(my_json[my_json_length - 1].lng);
				var map = new google.maps.Map(document.getElementById('map_canvas'), {
					center: {lat: lat, lng: long},
					zoom:16,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				var coordinates = [];
			    $.each(my_json, function(key,c) {
			    	my_arr = {lat: parseFloat(c.lat), lng: parseFloat(c.lng)};
			    	coordinates.push(my_arr);
			    });

				var flightPath = new google.maps.Polyline({
				path: coordinates,
				strokeOpacity: 0,
				icons: [{
					icon: lineSymbol,
					offset: '0',
					repeat: '20px'
				}],
				geodesic: true,
				strokeColor: '#FF0000',
				strokeWeight: 2
				});

				flightPath.setMap(map);
				var icon = {
				    url: base_url + "assets/img/car_marker.ico",
				    scaledSize: new google.maps.Size(50, 50)
				};
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(lat,long),
					icon: icon,
					map: map,
					animation : google.maps.Animation.DROP,
					label: text_car
					// label: {text : text_car, color : 'yellow'}
				});
				marker.setMap(map);
			}else{
				$("#map_canvas").html("<center><h3><span class='fa fa-exclamation-circle'></span> No Routes was found</h3></center>");
			}
			// console.log(my_json);

		}
	});
}
</script>