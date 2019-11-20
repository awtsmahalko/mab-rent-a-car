<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><i class="nav-icon fa fa-dashboard"></i> Dashboard</h1>
				</div>
			</div>
		</div>
	</div>

	<!-- Main content -->
	<section  class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
        	<div class="row">
          		<div class="col-lg-3 col-6">
		            <!-- small box -->
		            <div class="small-box bg-info">
		              	<div class="inner">
		                	<h3><?= $total_rentals; ?></h3>

		                	<p>Total Rentals</p>
		              	</div>
		              	<div class="icon">
		                	<i class="fa fa-book"></i>
		              	</div>
		              	<a href="<?= base_url('myadminpanel-rentals'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		            </div>
          		</div>
          		<!-- ./col -->
	          	<div class="col-lg-3 col-6">
		            <!-- small box -->
		            <div class="small-box bg-success">
		              	<div class="inner">
		                	<h3><?= $total_cars; ?></h3>

		                	<p>Total Cars</p>
		              	</div>
		              	<div class="icon">
		                	<i class="fa fa-car"></i>
		              	</div>
		              	<a href="<?= base_url('myadminpanel-cars'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		            </div>
	         	</div>
	          	<!-- ./col -->
	         	<div class="col-lg-3 col-6">
		            <!-- small box -->
		            <div class="small-box bg-warning">
		              	<div class="inner">
		                	<h3><?= $pending_rentals; ?></h3>

		                	<p>Pending Rentals</p>
		              	</div>
		              	<div class="icon">
		                	<i class="fa fa-exclamation-circle"></i>
		              	</div>
		              	<a href="<?= base_url('myadminpanel-rentals'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		            </div>
	          	</div>
          		<!-- ./col -->
	          	<div class="col-lg-3 col-6">
		            <!-- small box -->
		            <div class="small-box bg-danger">
		              	<div class="inner">
		                	<h3><?= $car_today; ?></h3>

		                	<p>Cars Scheduled for Today</p>
		              	</div>
		              	<div class="icon">
		                	<i class="fa fa-calendar"></i>
		              	</div>
		              	<a href="<?= base_url('myadminpanel-schedules'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		            </div>
	          	</div>
          		<!-- ./col -->
        	</div>
        	<div class="row">
        		<div class="col-md-12">
	        		<div class="card">
	        			<div class="card-header">
	        				<h3 class="card-title">Monthly Income [ Year - <span id="yearIncome"><?= date('Y'); ?></span> ]</h3>
	        				<div class="card-tools">
		        				<select id="selectYear">
		        					<?php
		        						$cyear = date('Y');
		        						foreach($years as $year){ ?>
		        							<option value="<?= $year; ?>" <?= $cyear == $year? 'selected' : ''; ?>><?= $year; ?></option>
		        						<?php }
		        					?>
		        				</select>
		        			</div>
	        			</div>
	        			<div class="card-body">
	        				<canvas id="barChart"></canvas>
	        			</div>
	        		</div>
	        	</div>
        	</div>
		</div>
	</section >
</div>  