$(function(){
	var base_url = $('.base_url').data('value');
    // set alert position
    alertify.set('notifier','position', 'top-right');
    var cartable = $('#carsTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/ajax_cars",
            "type": "POST",
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [3], 
	            "orderable": false,
	        },
        ],
        "columns": [
	        { data: "description" },
	        { data: "plate_number" },
	        { data: "price" },
	        { data: "id",
	         	render: function (data, type, row) {
                   return  '<button class="btn btn-success btn-sm editcar" value="'+data+'" data-toggle="modal" data-target="#editCar"><i class="fa fa-edit"></i> Edit</button>';
               }
	        },
 
       ],
    });

    $('select[name="carsTable_length"]').removeClass('custom-select');
    $('select[name="carsTable_length"]').removeClass('custom-select-sm');

    //add car form validation
    $('#addCarForm').validate({
        rules: {
            description: {
                required: true
            },
            plate_number: {
                required: true
            },
            price: {
                required: true,
            }     
        },
        messages: {
            description: {
                required: "Please input car model"
            }, 
            plate_number: {
                required: "Please input plate number"
            },
            price: {
                required: "Please input price",
            }
        }
    });

    //add car form submit
    $('#addCarForm').submit(function(e){
        e.preventDefault();
        if($(this).valid()){
            var car = $(this).serialize();
            $.ajax({
                type: "POST",
                url: base_url+'adminController/addCar',
                data: car,
                dataType: 'json',
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if(data){
                        alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Car added successfully');
                        $("#addCarForm")[0].reset();
                        $('#addCars').modal('hide');
                        cartable.ajax.reload();
                        $('#carcount').html(data.carcount);
                    }
                }
            });
        }
    });

    //edit button
    $(document).on('click', '.editcar', function(){
        var carid = $(this).val();
        $.ajax({
            type: "POST",
            url: base_url+'adminController/getRowById',
            data: {
                id: carid,
                table: 'cars',
            },
            dataType: "json",
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(data){
                $('#loader').hide();
                var data = data[0];
                $('#edit_description').val(data.description);
                $('#edit_plate_number').val(data.plate_number);
                $('#edit_price').val(data.price);
                $('#carid').val(data.id);
            }
        });
    });

    //edit staff form submit
    $('#editCarForm').submit(function(e){
        e.preventDefault();
        var description = $('#edit_description').val();
        var plate_number = $('#edit_plate_number').val();
        var price = $('#edit_price').val();
        var id = $('#carid').val();
        $.ajax({
            type: "POST",
            url: base_url+'adminController/editCar',
            data: {
                id: id,
                description: description,
                plate_number: plate_number,
                price: price,
            },
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(data){
                $('#loader').hide();
                if(data){
                    alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Car updated successfully');
                    $('#editCar').modal('hide');
                    cartable.ajax.reload();
                }
            }
        });
        
    });
   
});