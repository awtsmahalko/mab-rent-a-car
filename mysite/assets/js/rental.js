$(function(){
	var base_url = $('.base_url').data('value');
	// set alert position
	alertify.set('notifier','position', 'top-right');
    var rentaltable = $('#rentalTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[7, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/ajax_rental",
            "type": "POST",
        },
	 
        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [8], 
	            "orderable": false,
	        },
        ],
        "columns": [
			{ data: "fullname"},
	       	{ data: "contact_no" },
			{ data: "car_model" },
			{ data: "place_from" },
			{ data: "place_to" },
			{ data: "start_date" },
			{ data: "end_date" },
	       	{ data: "status",
	         	render: function (data, type, row) {
	         		var status = '';
	         		if(data == 0){
	         			status = '<span class="badge badge-danger">pending</span>';
	         		} else if (data == 1) {
	         			status = '<span class="badge badge-success">approved</span>';
	         		} else {
						status = '<span class="badge badge-primary">completed</span>';
					 }

                   	return status;
               	}
	        },
	        { data: "rental_id",
	         	render: function (data, type, row) {
	         		var button = '';
	         		if(row.status == 0){
						button += "<button type='button' class='btn btn-success editrental' value='"+JSON.stringify(row)+"' data-toggle='modal' data-target='#editRental' rel='tooltip' title='Edit'><i class='fa fa-pencil'></i></button>";
						button += ' <button class="btn btn-primary confirmrental" value="'+data+'" data-toggle="modal" data-target="#confirmRental" rel="tooltip" title="Approve"><i class="fa fa-handshake-o"></i></button>';
	         		} else if (row.status == 1) {
						button += "<button type='button' class='btn btn-success editrental' value='"+JSON.stringify(row)+"' data-toggle='modal' data-target='#editRental' rel='tooltip' title='Edit'><i class='fa fa-pencil'></i></button> ";
						button += '<button class="btn btn-primary additionalpay" value="'+data+'" data-toggle="modal" data-target="#additionalRental" rel="tooltip" title="Addional Pay"><i class="fa fa-pencil-square-o"></i></button> ';
						button += '<button class="btn btn-primary paymentrental" value="'+data+'" data-toggle="modal" data-target="#paymentRental" rel="tooltip" title="Payments"><i class="fa fa-money"></i></button> ';
						button += '<button class="btn btn-primary completerental" value="'+data+'" data-toggle="modal" data-target="#completeRental" rel="tooltip" title="Complete"><i class="fa fa-check"></i></button>';
					} else {
						button += '<button class="btn btn-primary paymentrentalcomplete" value="'+data+'" data-toggle="modal" data-target="#paymentRentalComplete" rel="tooltip" title="Payments"><i class="fa fa-money"></i></button>';
					}
	         		button += " <button type='button' class='btn btn-info searchrental' value='"+JSON.stringify(row)+"' data-toggle='modal' data-target='#viewRental' rel='tooltip' title='View Full Details'><i class='fa fa-search'></i></button>";
                	return button;
               	}
	        },
 
       ],
    });

    $('select[name="rentalTable_length"]').removeClass('custom-select');
	$('select[name="rentalTable_length"]').removeClass('custom-select-sm');
	
	// tooltip
    $('body').tooltip({
        selector: '[rel="tooltip"]'
    });

	// search rental
	$(document).on('click', '.searchrental', function(){
		var rental = JSON.parse($(this).val());
		$('#fullname').val(rental.firstname+' '+rental.lastname);
		$('#address').val(rental.address);
		$('#contact').val(rental.contact_no);
		$('#car').val(rental.car_model);
		var driver = 'No';
		if (rental.with_driver == 1) {
			driver = 'Yes';
		}
		$('#driver').val(driver);
		$('#date').val(rental.start_date+' to '+rental.end_date);
		$('#place_from').val(rental.place_from);
		$('#place_to').val(rental.place_to);
		var status = 'Pending';
		if (rental.status == 1) {
			status = 'Approved';
		}
		if (rental.status == 2) {
			status = 'Completed';
		}
		$('#status').val(status);
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getTotal',
			data: {id: rental.rental_id},
			dataType: "json",
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				var total = 0;
				total = data;
				$('#total').val(total);
			}
		});
	});

	// edit rental
	$(document).on('click', '.editrental', function(){
		var rental = JSON.parse($(this).val());
		$('#rental_id').val(rental.rental_id);
		$('#rental_from').val(rental.start_date);
		$('#rental_to').val(rental.end_date);
	});

	$('#EditRentalForm').submit(function(e){
		e.preventDefault();
		var rental = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editRental',
			data: rental,
			dataType: "json",
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				if (!data.error) {
					rentaltable.ajax.reload();
					$('#EditRentalForm')[0].reset();
					alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Rental updated');
					$('#editRental').modal('hide');
				} else {
					alertify.error('<i class="fa fa-remove"></i> &nbsp; '+data.message);
				}
				
			}
		});
	});

	// confirm rental
	$(document).on('click', '.confirmrental', function(){
		var id = $(this).val();
		$('#confirm-rental').val(id);
	});

	$('#confirm-rental').click(function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/confirmRental',
			data: {id: id},
			dataType: "json",
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				rentaltable.ajax.reload();
				alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Rental approved');
				$('#confirmRental').modal('hide');
			}
		});
	});

    //complete rental modal
    $(document).on('click', '.completerental', function(){
    	var id = $(this).val();
    	$('#rentalid').val(id);
    });

    //complete rental submit
    $('#completeRentalForm').submit(function(e){
    	e.preventDefault();
		var rental = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/completeRental',
			data: rental,
			dataType: "json",
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				rentaltable.ajax.reload();
				$('#completeRentalForm')[0].reset();
				alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Rental completed');
				$('#completeRental').modal('hide');
			}
		});
    	
    });

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

	$(document).on('click', '.paymentrentalcomplete', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getPayments',
			data: {id: id},
			dataType: 'json',
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				var html = '';
				var total = 0;
				$.each(data.payments, function(x, y){
					html += '<tr>';
					html += '<td>'+y.date+'</td>';
					html += '<td>'+y.payment+'</td>';
					html += '<tr>';
					total = total + parseFloat(y.payment);
				});
				html += '<tr>';
				html += '<td align="right"><b>Total:</b></td>';
				html += '<td>'+total+'</td>';
				html += '<tr>';
				html += '<tr>';
				html += '<td align="right"><b>Due:</b></td>';
				html += '<td>'+data.due+'</td>';
				html += '<tr>';
				html += '<tr>';
				html += '<td align="right"><b>Balance:</b></td>';
				html += '<td>'+(parseFloat(data.due)-parseFloat(total))+'</td>';
				html += '<tr>';
				$('#paymentTableComplete').html(html);
			}
		});
	});

	// addtional
	$(document).on('click', '.additionalpay', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getAdditionals',
			data: {id: id},
			dataType: 'json',
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				var html = '';
				var total = 0;
				$.each(data, function(x, y){
					html += '<tr>';
					html += '<td>'+y.additional_description+'</td>';
					html += '<td>'+y.amount+'</td>';
					html += '<tr>';
					total = total + parseFloat(y.amount);
				});
				html += '<tr>';
				html += '<td align="right"><b>Total:</b></td>';
				html += '<td>'+total+'</td>';
				html += '<tr>';
				$('#additionalTable').html(html);
				$('#additional_rental_id').val(id);
			}
		});
	});

	$('#AdditionalForm').validate({
        rules: {
			description: {
				required: true,
			},
            amount: {
				required: true,
				digits: true
            },  
        },
        messages: {
            amount: {
				required: "Please input amount",
				digits: "Only numbers allowed"
			},
			description: {
				required: "Please input description",
			},
        }
	});
	
	// additional form submit
    $('#AdditionalForm').submit(function(e){
        e.preventDefault();
        if($(this).valid()){
			var additional = $(this).serialize();
            $.ajax({
                type: "POST",
                url: base_url+'adminController/addAdditional',
                data: additional,
                dataType: 'json',
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if (!data.error) {
						rentaltable.ajax.reload();
						$('#AdditionalForm')[0].reset();
						alertify.success('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
						$('#additionalRental').modal('hide');
					} else {
						alertify.error('<i class="fa fa-remove></i> &nbsp; '+data.message);
					}
                }
            });
        }
    });
	
	// payments
	$(document).on('click', '.paymentrental', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getPayments',
			data: {id: id},
			dataType: 'json',
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				var html = '';
				var total = 0;
				$.each(data.payments, function(x, y){
					html += '<tr>';
					html += '<td>'+y.date+'</td>';
					html += '<td>'+y.payment+'</td>';
					html += '<tr>';
					total = total + parseFloat(y.payment);
				});
				html += '<tr>';
				html += '<td align="right"><b>Total:</b></td>';
				html += '<td>'+total+'</td>';
				html += '<tr>';
				html += '<tr>';
				html += '<td align="right"><b>Due:</b></td>';
				html += '<td>'+data.due+'</td>';
				html += '<tr>';
				html += '<tr>';
				html += '<td align="right"><b>Balance:</b></td>';
				html += '<td>'+(parseFloat(data.due)-parseFloat(total))+'</td>';
				html += '<tr>';
				$('#paymentTable').html(html);
				$('#payment_rental_id').val(id);
			}
		});
	});
	
	$('#PaymentForm').validate({
        rules: {
            amount: {
				required: true,
				digits: true
            },  
        },
        messages: {
            amount: {
				required: "Please input amount",
				digits: "Only numbers allowed"
            },
        }
    });

    // payments form submit
    $('#PaymentForm').submit(function(e){
        e.preventDefault();
        if($(this).valid()){
			var payment = $(this).serialize();
            $.ajax({
                type: "POST",
                url: base_url+'adminController/addPayment',
                data: payment,
                dataType: 'json',
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if (!data.error) {
						rentaltable.ajax.reload();
						$('#PaymentForm')[0].reset();
						alertify.success('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
						$('#paymentRental').modal('hide');
					} else {
						alertify.error('<i class="fa fa-remove></i> &nbsp; '+data.message);
					}
                }
            });
        }
    });
   
});