<?php
include 'core/config.php';
$rental_id = $_POST['code'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$date_time = date("Y-m-d H:i:s");
$fetch = mysql_fetch_array(mysql_query("SELECT l_id,address,date_time FROM location WHERE rental_id = '$rental_id' AND lat = '$latitude' AND lng = '$longitude'"));
if($fetch[0] > 0){
	$log = $fetch[1]." at ".date("F d Y H:i A",strtotime($date_time));
}else{
	$address = getaddress($latitude.",".$longitude);
	mysql_query("INSERT INTO `location` (`lat`,`lng`,`address`,`date_time`,`rental_id`) VALUES ('$latitude','$longitude','$address','$date_time','$rental_id')");
	$log = $address." at ".date("F d Y H:i A",strtotime($date_time));
}

$response['log'] = $log;
$response['text'] = getCarData($rental_id);
echo json_encode($response);

function getaddress($coordinates)
{
	$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$coordinates.'&sensor=false&key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK"){
	  return $data->results[0]->formatted_address;
	}
	else{
	  return false;
	}
}
function getCarData($rental_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT description, plate_number FROM rentals AS r, cars AS c WHERE c.id = r.car_id AND r.id = $rental_id"));
	return "$fetch[0] ($fetch[1])";
}
?>