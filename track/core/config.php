<?php 

ini_set('date.timezone','UTC');
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Manila');
$today = date('H:i:s');
$date = date('Y-m-d H:i:s', strtotime($today));

session_start();

$host 	  = 'mysql.hostinger.com';
$username = 'u764488932_car';
$password = 'car12345';
$database = 'u764488932_car';

@mysql_connect($host, $username, $password) or die("Cannot connect to MySQL Server");
@mysql_select_db($database) or die ("Cannot connect to Database");
@mysql_query("SET SESSION sql_mode=''");