$(function(){
	var base_url = $('.base_url').data('value');
	// set alert position
	alertify.set('notifier','position', 'top-right');
    var messagetable = $('#messageTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/ajax_message",
            "type": "POST",
        },
	 
        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [5], 
	            "orderable": false,
	        },
        ],
        "columns": [
	        { data: "id" },
	        { data: "fullname" },
	        { data: "email" },
	        { data: "message" },
	        { data: "status",
	         	render: function (data, type, row) {
                   return (data == 1) ? '<span class="badge badge-success">Seen</span>' : '<span class="badge badge-danger">Not seen</span>';
               }
	        },
	        { data: "id",
	         	render: function (data, type, row) {
                   return  '<button class="btn btn-info btn-sm openmessage" value="'+data+'" data-toggle="modal" data-target="#openMessage"><i class="fa fa-search"></i> Open</button>';
               }
	        },
 
       ],
    });

    $('select[name="messageTable_length"]').removeClass('custom-select');
    $('select[name="messageTable_length"]').removeClass('custom-select-sm');

    //add staff form validation
	$('#messageForm').validate({
        rules: {
            reply: {
                required: true
            }
        },
        messages: {
        	reply: {
                required: "Reply is required"
            }
        }
    });

	//open message
	$(document).on('click', '.openmessage', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/openMessage',
			data: {
				id: id,
			},
			dataType: "json",
			beforeSend: function(){
				$('#loader').show();
			},
			success: function(data){
				$('#loader').hide();
				messagetable.ajax.reload();
				var data = data[0];
				$('#messageEmail').val(data.email);
				$('#fromEmail').val(data.fullname);
				$('#message').val(data.message);
			}
		});
	});

	//reply form submit
	$('#messageForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
			var message = $(this).serialize();
			//console.log(message);
			$.ajax({
				type: "POST",
				url: base_url+'adminController/sendEmail',
				data: message,
				dataType: "json",
				beforeSend: function(){
					$('#loader').show();
				},
				success: function(data){
					$('#loader').hide();
					if(data.error){
						alertify.error(data.message);
					} else {
						alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Reply sent successfully');
						$('#openMessage').modal('hide');
						$("#messageForm")[0].reset();
					}
				}
			});
		}
	});
   
});