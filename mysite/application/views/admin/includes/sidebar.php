<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>myadminpanel" class="brand-link">
      	<!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      	<span class="brand-text font-weight-light temp-title">Mab Rent a Car</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        	<div class="info">
          		<a href="#" class="d-block">ADMINISTRATOR</a>
        	</div>
      	</div>

      	<!-- Sidebar Menu -->
      	<nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          	<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel" class="nav-link <?php echo $active == 'home'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-dashboard"></i>
		              	<p>Dashboard</p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel-cars" class="nav-link <?php echo $active == 'cars'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-car"></i>
		              	<p>Cars <span class="badge badge-success right" id="carcount"><?= $admindata['cars']; ?></span></p>
		            </a>
	          	</li>
				<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel-schedules" class="nav-link <?php echo $active == 'schedule'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-calendar"></i>
		              	<p>Schedules</p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel-rentals" class="nav-link <?php echo $active == 'rental'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-book"></i>
		              	<p>Rentals <span class="badge badge-success right"><?= $admindata['rentals']; ?></span></p>
		            </a>
	          	</li>
				<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel-reports/<?php echo date('d-m-Y', strtotime("-1 week")) ?>/<?php echo date('d-m-Y'); ?>" class="nav-link <?php echo $active == 'report'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-files-o"></i>
		              	<p>Reports</p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="<?php echo base_url(); ?>myadminpanel-track" class="nav-link <?php echo $active == 'track'? "active" : "";  ?>">
		              	<i class="nav-icon fa fa-map-marker"></i>
		              	<p>Track Cars</p>
		            </a>
	          	</li>
	        </ul>
      	</nav>
      
    </div>
</aside>

 
  