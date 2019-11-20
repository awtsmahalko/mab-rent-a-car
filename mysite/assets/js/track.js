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
function viewClientDetails(name,contact,email,address){
	$('#view_client_details').modal('show');
	$("#client_name").val(name);
	$("#client_contact").val(contact);
	$("#client_email").val(email);
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
                	return row.firstname+' '+row.lastname+ "<button style='float:right;' class='btn btn-xs btn-outline-primary' onclick=\"viewClientDetails('"+row.firstname+' '+row.lastname+"','"+row.contact_no+"','"+row.email+"','"+row.address+"')\"><span class='fa fa-tasks'></span></button>";
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
	         		if(data == 0){
	         			status = '<span class="badge badge-success">In-progress</span>';
	         		} else {
	         			status = '<span class="badge badge-primary">Completed</span>';
	         		}

                   	return status;
               	}
	        },
	        { data: "rental_id",
	         	render: function (data, type, row) {
	         		var button = '';
	         			button = '<button onclick=\'trackCar('+data+',"'+row.car_model+'","'+row.plate_number+'")\' class="btn btn-outline-primary" value="'+data+'"><i class="fa fa-map-marker"></i> Track Car</button>';
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