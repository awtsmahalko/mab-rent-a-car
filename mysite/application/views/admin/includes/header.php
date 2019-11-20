<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">

  	<title>Mab Rent a Cart | <?php echo $title; ?></title>

  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminlte.min.css">
 	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/alertify/css/alertify.min.css">
 	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatable/css/datatable.css">

	<?php
		if ($active == 'schedule') {
			?>
			<link href='<?php echo base_url(); ?>assets/calendar/main/main.min.css' rel='stylesheet' />
			<link href='<?php echo base_url(); ?>assets/calendar/daygrid/main.min.css' rel='stylesheet' />
			<link href='<?php echo base_url(); ?>assets/calendar/timegrid/main.min.css' rel='stylesheet' />
			<link href='<?php echo base_url(); ?>assets/calendar/bootstrap/main.min.css' rel='stylesheet' />
			<?php
		}
	?>
	<?php
 		if ($active == 'report') {
 			?>
 			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/daterangepicker/css/daterangepicker.css">
 			<?php
 		}
 	?>

 	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
 	
 	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
 	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<span class="base_url" data-value="<?php echo base_url(); ?>">
<div id="loader">
	<div id="loader-image"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<div class="wrapper">