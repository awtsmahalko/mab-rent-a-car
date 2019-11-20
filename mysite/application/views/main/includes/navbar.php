<nav id="main-nav" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url(); ?>">
		    <img src="<?= base_url('assets/img/logo.jpg'); ?>" width="30" height="30" class="d-inline-block align-top" alt="">
		    Mab Rent a Car
		</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  		<ul class="navbar-nav mr-auto">
	    	</ul>
	    	<ul class="nav navbar-nav ml-auto">
	    		<li class="nav-item">
        			<a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
	        		<a class="nav-link" href="#cars">Our Cars</a>
				</li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="#about">About Us</a>
				</li>
				<li class="nav-item">
	        		<a class="nav-link" href="#contact">Contact Us</a>
				</li>
	      		<li class="nav-item <?php echo $active == 'rental' ? 'active' : ''; ?>">
	        		<a class="nav-link" href="#rental">Rent a Car</a>
	      		</li>
	      		
	    	</ul>
	  	</div>
  	</div>
</nav>