<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark"><i class="nav-icon fa fa-book"></i> Rentals</h1>
				</div>
			</div>
		</div>
	</div>

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<table id="rentalTable" class="table table-bordered table-striped dt-responsive nowrap">
								<thead>
									<th>Fullname</th>
									<th>Contact</th>
									<th>Car</th>
									<th>Place From</th>
									<th>Place To</th>
									<th>Date From</th>
									<th>Date To</th>
									<th>Status</th>
									<th>Actions</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Confirm Rental -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Approve Rental</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body text-center">
        		<h5>Are you sure you want to approve rental?</h5>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="button" id="confirm-rental" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- Complete Rental -->
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="completeRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Complete Rental</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body text-center">
        		<form id="completeRentalForm">
        			<input type="hidden" id="rentalid" name="id">
        			<div class="form-group row">
					    <label for="additional_pay" class="col-sm-4 col-form-label">Additional Pay</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="additional_pay" name="additional_pay">
					    </div>
				  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Ok</button>
        		</form>
      		</div>
    	</div>
  	</div>
</div> -->
<div class="modal fade" tabindex="-1" role="dialog" id="completeRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Complete Rental</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body text-center">
        		<form id="completeRentalForm">
        			<input type="hidden" id="rentalid" name="id">
        			<h4 class="text-center">Mark rental as complete?</h4>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
        		</form>
      		</div>
    	</div>
  	</div>
</div>

<!-- View Rental Dates -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewRentalDates">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Rental Dates</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body">
        		<div class="row" id="dateTable">
        		</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- View Rental -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Rental Full Details</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			</button>
      		</div>
      		<div class="modal-body text-center">
	            <div class="form-group row">
	                <label for="fullname" class="col-sm-4 col-form-label">Fullname</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="fullname" name="fullname" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="address" class="col-sm-4 col-form-label">Address</label>
	                <div class="col-sm-8">
						<input type="text" class="form-control" id="address" name="address" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
	                <label for="contact" class="col-sm-4 col-form-label">Contact</label>
	                <div class="col-sm-8">
	                    <input type="number" class="form-control" id="contact" name="contact" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="car" class="col-sm-4 col-form-label">Car</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="car" name="car" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="driver" class="col-sm-4 col-form-label">With Driver</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="driver" name="driver" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="date" class="col-sm-4 col-form-label">Date</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="date" name="date" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="place_from" class="col-sm-4 col-form-label">From</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="place_from" name="place_from" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="place_to" class="col-sm-4 col-form-label">To</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="place_to" name="place_to" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="total" class="col-sm-4 col-form-label">Total</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="total" name="total" readonly>
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="status" class="col-sm-4 col-form-label">Status</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="status" name="status" readonly>
	                </div>
	            </div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- Edit Rental -->
<div class="modal fade" tabindex="-1" role="dialog" id="editRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Edit Rental</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			</button>
      		</div>
      		<div class="modal-body text-center">
	            <form id="EditRentalForm">
				<input type="hidden" id="rental_id" name="rental_id">
				<div class="form-group row">
	                <label for="rental_from" class="col-sm-4 col-form-label">Date From</label>
	                <div class="col-sm-8">
	                    <input type="date" class="form-control" id="rental_from" name="rental_from">
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="rental_to" class="col-sm-4 col-form-label">Date To</label>
	                <div class="col-sm-8">
	                    <input type="date" class="form-control" id="rental_to" name="rental_to">
	                </div>
	            </div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>

<!-- Payments -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Payments</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			</button>
      		</div>
      		<div class="modal-body">
			  	<table class="table table-bordered">
					<thead>
						<th>Date</th>
						<th>Payment</th>
					</thead>
					<tbody id="paymentTable">
					</tbody>
				</table>
			  	<hr>
				<p class="text-center">Add Payment:</p>
	            <form id="PaymentForm">
				<input type="hidden" id="payment_rental_id" name="payment_rental_id">
				<div class="form-group row">
	                <label for="amount" class="col-sm-4 col-form-label text-center">Amount</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="amount" name="amount">
	                </div>
	            </div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>

<!-- Payment Complete -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentRentalComplete">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Payments</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			</button>
      		</div>
      		<div class="modal-body">
			  	<table class="table table-bordered">
					<thead>
						<th>Date</th>
						<th>Payment</th>
					</thead>
					<tbody id="paymentTableComplete">
					</tbody>
				</table>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- Additional Payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="additionalRental">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Additional Payments</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			</button>
      		</div>
      		<div class="modal-body">
			  	<table class="table table-bordered">
					<thead>
						<th>Description</th>
						<th>Amount</th>
					</thead>
					<tbody id="additionalTable">
					</tbody>
				</table>
			  	<hr>
				<p class="text-center">Add:</p>
	            <form id="AdditionalForm">
				<input type="hidden" id="additional_rental_id" name="additional_rental_id">
				<div class="form-group row">
	                <label for="description" class="col-sm-4 col-form-label text-center">Description</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="description" name="description">
	                </div>
	            </div>
				<div class="form-group row">
	                <label for="amount" class="col-sm-4 col-form-label text-center">Amount</label>
	                <div class="col-sm-8">
	                    <input type="text" class="form-control" id="amount" name="amount">
	                </div>
	            </div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				</form>
      		</div>
    	</div>
  	</div>
</div>