<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark"><i class="nav-icon fa fa-comments"></i> Messages</h1>
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
							<table id="messageTable" class="table table-bordered table-striped">
								<thead>
									<th>MessageId</th>
									<th>From</th>
									<th>Email</th>
									<th>Message</th>
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

<!-- Message Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="openMessage">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">View Message</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
       			 </button>
      		</div>
      		<div class="modal-body">
        		<form id="messageForm">
        			<input type="hidden" id="messageEmail" name="email">
        			<div class="form-group row">
					    <label for="username" class="col-sm-2 col-form-label">From</label>
					    <div class="col-sm-4">
					      	<input type="text" readonly class="form-control-plaintext" id="fromEmail">
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <div class="col-sm-12">
					      	<textarea readonly="true" class="form-control" rows="5" id="message"></textarea>
					    </div>
				  	</div>
				  	<div class="form-group row">
					    <div class="col-sm-12">
					      	<textarea class="form-control" rows="5" id="reply" name="reply" placeholder="Write a reply here..."></textarea>
					    </div>
				  	</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> Reply</button>
        		</form>
      		</div>
    	</div>
  	</div>
</div>