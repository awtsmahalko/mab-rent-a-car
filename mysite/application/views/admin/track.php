<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
          <div class="col-sm-6" style="float: left;">
					 <h1 class="m-0 text-dark"><i class="nav-icon fa fa-map-marker"></i> Track Cars</h1>
          </div>
          <div class="col-sm-6" style="float: left;">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Auto Refresh map at</span>
              </div>
              <input type="number" min="1" value="30" step="1" class="form-control" id="auto_refresh">
              <div class="input-group-prepend">
                <span class="input-group-text"> Seconds</span>
              </div>
            </div>
          </div>
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
							<table id="trackTable" class="table table-bordered table-striped nowrap">
								<thead>
                  <th>Rental ID</th>
									<th>Client</th>
									<th>Car Model</th>
									<th>Plate No</th>
									<th>Rental Dates</th>
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
        		<h5 class="modal-title">Confirm Rental</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body text-center">
        		<h5>Are you sure you want to confirm rental?</h5>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="button" id="confirm-rental" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- Complete Rental -->
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
        			<div class="form-group row">
					    <label for="additional_pay" class="col-sm-4 col-form-label">Additional Pay</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="additional_pay" name="additional_pay">
					    </div>
				  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Ok</button>
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

<div class="modal fade" tabindex="-1" role="dialog" id="view_car_location">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Car Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div id="view_car_location_script"></div>
            <div class="row" id="car_current_location">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="view_client_details">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Client Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
              </div>
              <input type="text" class="form-control" id="client_name" readonly/>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Address</span>
              </div>
              <input type="text" class="form-control" id="client_address" readonly/>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Contact</span>
              </div>
              <input type="text" class="form-control" id="client_contact" readonly/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>