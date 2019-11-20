<?php
include 'core/config.php';
?>
<!DOCTYPE HTML>
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MAB Tracker <?= date('Y');?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="assets/js/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/scss/style.css">

<!--     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	<style>
	.btn {border-radius: 3px;}
	</style>
</head>
<body>
<div class="content mt-3">
    <div class="col-xl-12 col-lg-6">
        <section class="card">
            <div class="twt-feed blue-bg">
                <div class="corner-ribon black-ribon">
                    <i class="fa fa-car"></i>
                </div>
                <div class="fa fa-car wtt-mark"></div>

                <div class="media">
                    <div class="media-body col-sm-12">
                        <h2 class="text-white display-6">Drive with Passion and Love</h2>
                    </div>
                </div>
            </div>
            <div class="weather-category twt-category">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <center><div class="stat-icon dib"><i class="fa fa-car text-primary border-primary"></i></div></center>
                            </div><br>
                            <div class="stat-content dib col-sm-12">
                                <input type="number" min="1" step="1" onkeyup="checkPlate()" class="form-control" id="plate" placeholder="Rental Id">
                            </div>
                            <small id="label-err"></small><br><br>
                            <div class="stat-content dib col-sm-12" id="track" style="display: none;">
                               <center><button type="button" class="btn btn-primary" onclick="trackNow()"><span class="fa fa-check-circle"></span> Track Now</button></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    function trackNow(){
        var id = $("#plate").val();
        window.location = "track.php?id="+id;
    }
    function checkPlate(){
        var id = $("#plate").val();
        $.post("checkPlateExist.php",{
            id:id
        },function(data,status){
            if (data > 0) {
                $("#track").show();
                $("#label-err").html("");
            }else{
                $("#track").hide();
                $("#label-err").html("<span style='color:red'> Oops Rental id does not exist");
            }
            
        });
    }
</script>
</body>
</html>
