<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark"><i class="nav-icon fa fa-car"></i> Cars <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addCars"><i class="fa fa-plus"></i> Add New</button></h1>
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
							<table id="carsTable" class="table table-bordered table-striped">
								<thead>
									<th>Car Model</th>
									<th>Plate Number</th>
									<th>Price</th>
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

<!-- Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addCars">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Add New Car</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body">
        		<form id="addCarForm">
				 	<div class="form-group row">
					    <label for="description" class="col-sm-4 col-form-label text-center">Car Model</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="description" name="description">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="plate_number" class="col-sm-4 col-form-label text-center">Plate Number</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="plate_number" name="plate_number">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="price" class="col-sm-4 col-form-label text-center">Price</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="price" name="price">
					    </div>
				  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
        		</form>
      		</div>
    	</div>
  	</div>
</div>

<!-- Edit Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editCar">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Edit Car</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body">
        		<form id="editCarForm">
        			<input type="hidden" id="carid">
				  	<div class="form-group row">
					    <label for="edit_description" class="col-sm-4 col-form-label text-center">Car Model</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="edit_description" name="edit_description">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="edit_plate_number" class="col-sm-4 col-form-label text-center">Plate Number</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="edit_plate_number" name="edit_plate_number">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <label for="edit_price" class="col-sm-4 col-form-label text-center">Price</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="edit_price" name="edit_price">
					    </div>
				  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
        		</form>
      		</div>
    	</div>
  	</div>
</div>