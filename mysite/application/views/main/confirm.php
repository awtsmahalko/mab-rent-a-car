<div id="content" class="home-div">
	<div class="container">
		<p class="rental-title">Rental Details</p>
		<div class="row justify-content-md-center">
			<div class="col-md-10">
				<div class="form-group row">
					<label for="firstname" class="col-sm-2 col-form-label text-center">Firstname</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['firstname']; ?>">
					</div>
					<label for="lastname" class="col-sm-2 col-form-label text-center">Lastname</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['lastname']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="address" class="col-sm-2 col-form-label text-center">Address</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['address']; ?>">
					</div>
					<label for="contact_no" class="col-sm-2 col-form-label text-center">Contact No.</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['contact_no']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="car_id" class="col-sm-2 col-form-label text-center">Car</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['car']; ?>">
					</div>
					<label for="driver" class="col-sm-2 col-form-label text-center">With Driver?</label>
					<div class="col-sm-4">
						<?= $rental_details['with_driver'] ? 'Yes' : 'No'; ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="start_date" class="col-sm-2 col-form-label text-center">Start Date</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['start_date']; ?>">
					</div>
					<label for="end_date" class="col-sm-2 col-form-label text-center">End Date</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['end_date']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="place_from" class="col-sm-2 col-form-label text-center">Place From</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['place_from']; ?>">
					</div>
					<label for="place_to" class="col-sm-2 col-form-label text-center">Place To</label>
					<div class="col-sm-4">
						<input type="text" readonly="" class="form-control-plaintext" value="<?= $rental_details['place_to']; ?>">
					</div>
				</div>
				<p class="rental-price">Initial Price: &#8369; <?= number_format($rental_details['total_pay'], 2); ?></p>
				<div class="form-group row">
					<button type="button" id="confirm_rental" class="btn btn-success btn-lg btn-rental">Confirm &nbsp;&nbsp;<i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
