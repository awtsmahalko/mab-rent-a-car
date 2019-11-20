</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/adminlte.js"></script>
<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable/js/jquery.datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable/js/datatable.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

<?php
	if($active == 'home'){ ?>
		<script src="<?php echo base_url(); ?>assets/js/chart.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<?php }
	if($active == 'cars'){
		?>
		<script src="<?php echo base_url(); ?>assets/js/cars.js"></script>
		<?php
	}
	if($active == 'message'){
		?>
		<script src="<?php echo base_url(); ?>assets/js/message.js"></script>
		<?php
	}
	if($active == 'rental'){
		?>
		<script src="<?php echo base_url(); ?>assets/js/rental.js"></script>
		<?php
	}
	if($active == 'track'){
		?>
		<script type="text/javascript">

			var base_url = $('.base_url').data('value');
			is_declare = 0;
		    function trackCar(id,car_model,plate_number){
		    	$('#view_car_location').modal('show');
		    	$('#car_current_location').html("<br><center><h3><span class='fa fa-spin fa-spinner'></span> Loading map please wait..</h3></center>");
		    	$.ajax({
					type: "POST",
					url: base_url+'adminController/track_location',
					data: {
						id: id,
						car_model:car_model,
						plate_number:plate_number
					},
					success: function(data){
						is_declare += 1;
						$('#car_current_location').html(data);
						if(is_declare == 1){
							map = "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=myMap'><\/script>";
							$('#view_car_location_script').html(map);
						}
					}
				});
		    }
		    function viewClientDetails(name,contact,address){
		    	$('#view_client_details').modal('show');
		    	$("#client_name").val(name);
		    	$("#client_contact").val(contact);
		    	$("#client_address").val(address);
		    }
			$(function(){
				// set alert position
				alertify.set('notifier','position', 'top-right');
			    var rentaltable = $('#trackTable').DataTable({
			    	"processing": true, 
			        "serverSide": true, 
			        "order": [[0, 'asc']], 
			 
			        "ajax": {
			            "url": base_url+"adminController/ajax_track",
			            "type": "POST",
			        },
				 
			        //Set column definition initialisation properties.
			        "columnDefs": [
				        { 
				            "targets": [], 
				            // "orderable": false,
				        },
			        ],
			        "columns": [
				       	{ data: "rental_id" },
				        { data: "rental_id",
				         	render: function (data, type, row) {
			                	return row.firstname+' '+row.lastname+ "<button style='float:right;' class='btn btn-xs btn-outline-primary' onclick=\"viewClientDetails('"+row.firstname+' '+row.lastname+"','"+row.contact_no+"','"+row.address+"')\"><span class='fa fa-tasks'></span></button>";
			               	}
			            },
				       	{ data: "car_model" },
				       	{ data: "plate_number" },
				       	{ data: "rental_id",
				         	render: function (data, type, row) {
				         		return '<button class="btn btn-info viewrentaldates" value="'+data+'" data-toggle="modal" data-target="#viewRentalDates"><i class="fa fa-search"></i> View</button>';
			               	}
				        },
				       	{ data: "status",
				         	render: function (data, type, row) {
				         		var status = '';
				         		if(data == 1){
				         			status = '<span class="badge badge-success">on-going</span>';
				         		}else if(data == 2){
				         			status = '<span class="badge badge-primary">completed</span>';
				         		}else{
				         			status = '<span class="badge badge-danger">pending</span>';
				         		}

			                   	return status;
			               	}
				        },
				        { data: "rental_id",
				         	render: function (data, type, row) {
				         		var button = (row.status != 0)?'<button onclick=\'trackCar('+data+',"'+row.car_model+'","'+row.plate_number+'")\' class="btn btn-outline-primary" value="'+data+'"><i class="fa fa-map-marker"></i> Track Car</button>':'';
			                	return button;
			               	}
				        },
			 
			       ],
			    });

			    $('select[name="trackTable_length"]').removeClass('custom-select');
			    $('select[name="trackTable_length"]').removeClass('custom-select-sm');

			    //view rental dates modal
			    $(document).on('click', '.viewrentaldates', function(){
			    	var id = $(this).val();
			    	$.ajax({
						type: "POST",
						url: base_url+'adminController/fetchRentalDates',
						data: {
							id: id
						},
						dataType: "json",
						beforeSend: function(){
							$('#loader').show();
						},
						success: function(data){
							$('#loader').hide();
							var table = '<table class="table table-bordered">'
							$.each(data, function(x, y){
								table += '<tr><td>'+y.date+'</td></tr>';
							});
							table += '</table>';
							$('#dateTable').html(table); 
						}
					});
			    });
			   
			});
		</script>
		<?php
	}
	if($active == 'schedule'){
		?>
		<script src='<?php echo base_url(); ?>assets/js/jquery.ui.min.js'></script>
		<script src='<?php echo base_url(); ?>assets/js/moment.js'></script>
		<script src='<?php echo base_url(); ?>assets/calendar/main/main.min.js'></script>
		<script src='<?php echo base_url(); ?>assets/calendar/daygrid/main.min.js'></script>
		<script src='<?php echo base_url(); ?>assets/calendar/timegrid/main.min.js'></script>
		<script src='<?php echo base_url(); ?>assets/calendar/interaction/main.min.js'></script>
		<script src='<?php echo base_url(); ?>assets/calendar/bootstrap/main.min.js'></script>
		<script src="<?php echo base_url(); ?>assets/js/schedule.js"></script>
		<?php
	}
	if($active == 'report'){
		?>
		<script src="<?php echo base_url(); ?>assets/daterangepicker/js/moment.js"></script>
		<script src="<?php echo base_url(); ?>assets/daterangepicker/js/daterangepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/report.js"></script>
		<?php
	}
?>
</body>
</html>