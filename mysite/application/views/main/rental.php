<div id="content" class="home-div">
	<div class="container">
		<div class="row">
			<div id="rental_car" class="col-sm-4">
			</div>
			<div class="col-sm-8">
				<form id="rentalForm">
					<div class="form-group row">
						<label for="firstname" class="col-sm-2 col-form-label text-center">Firstname</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="firstname" name="firstname">
						</div>
						<label for="lastname" class="col-sm-2 col-form-label text-center">Lastname</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="lastname" name="lastname">
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-sm-2 col-form-label text-center">Address</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="address" name="address">
						</div>
						<label for="contact_no" class="col-sm-2 col-form-label text-center">Contact No.</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="contact_no" name="contact_no">
						</div>
					</div>
					<div class="form-group row">
						<label for="car_id" class="col-sm-2 col-form-label text-center">Car</label>
							<div class="col-sm-4">
								<select class="form-control" id="car_id" name="car_id">
									<option value="">Select</option>
									<?php
										foreach($cars as $car){ ?>
											<option value="<?= $car->id; ?>-<?= $car->price ?>"><?= $car->description; ?> [&#8369;<?= number_format($car->price, 2); ?>]</option>
										<?php } 
									?>
								</select>
							</div>
						<label for="driver" class="col-sm-2 col-form-label text-center">With Driver?</label>
						<div class="col-sm-4">
							<img src="<?= base_url('assets/img/uncheck.png'); ?>" class="checkbox-image"> Yes [&#8369;500.00]
						</div>
					</div>
					<div class="form-group row">
						<label for="rental_from" class="col-sm-2 col-form-label text-center">Date From</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="rental_from" name="rental_from">
						</div>
						<label for="rental_to" class="col-sm-2 col-form-label text-center">Date To</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="rental_to" name="rental_to">
						</div>
					</div>
					<div class="form-group row">
						<label for="place_from" class="col-sm-2 col-form-label text-center">Place From</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="place_from" name="place_from">
						</div>
						<label for="place_to" class="col-sm-2 col-form-label text-center">Place To</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="place_to" name="place_to">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="checkbox" id="terms" name="terms"> By clicking submit, you agree to our <a href="<?php echo base_url('rental-terms'); ?>" target="_blank">Terms and Conditions</a>
							<label id="terms-error" class="error" for="terms"></label>
						</div>
					</div>
					<p class="rental-price">Initial Price: &#8369; <span id="price">0.00</span></p>
					<div class="form-group row">
						<button type="submit" class="btn btn-success btn-lg btn-rental"><i class="fa fa-car"></i> Submit</button>
					</div>
                </form>									
			</div>
		</div>
	</div>
</div>
