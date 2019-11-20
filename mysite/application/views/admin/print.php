<div class="container">
	<div class="print-body">
		<button class="btn btn-success btn-print-report" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
		<div class="main-title">Mabs Rent a Car</div>
		<div class=""><p class="text-center">Report Range: <strong><?php echo date('M d, Y', strtotime($from)); ?> - <?php echo date('M d, Y', strtotime($to)); ?></strong></p></div>
		<div class="total-div"><strong>Total: &#8369; <?php echo $total; ?></strong></div>
		<table class="table table-bordered">
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
				<?php
					foreach ($rentals as $rental) {
						?>
						<tr>
                            <td><?= $rental->fullname; ?></td>
                            <td><?= $rental->address; ?></td>
                            <td><?= $rental->car_model; ?></td>
                            <td><?= $rental->with_driver ? 'Yes' : 'No'; ?></td>
                            <td><?= $rental->place_from; ?></td>
                            <td><?= $rental->place_to; ?></td>
                            <td><?= date('M d, Y', strtotime($rental->start_date)); ?></td>
							<td><?= date('M d, Y', strtotime($rental->end_date)); ?></td>
                            <td><?= $rental->total_pay + $rental->addamount; ?></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>