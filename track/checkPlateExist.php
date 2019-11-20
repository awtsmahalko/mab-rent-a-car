<?php
include 'core/config.php';
$rental_id = $_POST['id'];
$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM rentals WHERE id = '$rental_id'"));
echo $fetch[0];
?>