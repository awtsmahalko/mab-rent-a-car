<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark"><i class="nav-icon fa fa-files-o"></i> Reports <button type="button" class="btn btn-success add-button" id="print_report" data-from="<?php echo $from; ?>" data-to="<?php echo $to; ?>"><i class="fa fa-print"></i> Print</button></h1>
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
                            <div class="row reportTop">
								<div class="col-sm-8">
									<h5>Total: &#8369; <?php echo $total; ?> </h5>
								</div>
								<div class="col-sm-4" id="rangeColumn">
									<div class="rangeLabel">Date range:</div>
									<div class="rangeinput">
										<div class="input-group">
											<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>
											</span>
											</div>
											<input type="text" class="form-control float-right" id="reportRange" value="<?php echo date('m/d/Y', strtotime($from)) ?> - <?php echo date('m/d/Y', strtotime($to)); ?>">
										</div>
					            	</div>
								</div>   
					        </div>
							<table id="reportTable" class="table table-bordered table-striped dt-responsive nowrap">
								<thead>
									<th>Fullname</th>
									<th>Address</th>
									<th>Car</th>
                                    <th>With Driver</th>
									<th>Place From</th>
									<th>Place To</th>
									<th>Date From</th>
									<th>Date To</th>
                                    <th>Total Pay</th>
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