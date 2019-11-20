<div id="banner">
	<?php
		if ($active == "home") { ?>
			<div id="slider" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#slider" data-slide-to="0" class="active"></li>
					<li data-target="#slider" data-slide-to="1"></li>
					<li data-target="#slider" data-slide-to="2"></li>
					<li data-target="#slider" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item carousel1 active">
						<div class="carousel-caption-center">
						</div>
					</div>
					<div class="carousel-item carousel2">
						<div class="carousel-caption">
						</div>
					</div>
					<div class="carousel-item carousel3">
						<div class="carousel-caption">
						</div>
					</div>
					<div class="carousel-item carousel4">
						<div class="carousel-caption">
						</div>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="banner-div">
				<!-- <img src="<?= base_url('assets/img/banner.jpeg'); ?>"> -->
				<!-- <span class="banner-text"><?php echo $title; ?></span> -->
				<p><?php echo $title; ?></p>
			</div>
		<?php }

	?>
</div>
		