var check = false;
var base_url = $('.base_url').data('value');
$(function(){
    $('.nav-link').click(function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        if (href == '#home' || href == '#rental') {
            if (href == '#home') {
                location.href = base_url;
            } else {
                location.href = base_url+'rental';
            }
        } else {
            var url = window.location.href; 
            if (url == base_url) {
                $('html, body').animate({
                    scrollTop: $(href).offset().top
                });
            } else {
                location.href = base_url;
            }
        }
    });

    // add to our validator
    jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) >= Number($(params).val())); 
    },'Must be greater than {0}.');

    $('input[type="date"]').prop('min', function(){
        return new Date().toJSON().split('T')[0];
    });

    // set alert position
    alertify.set('notifier','position', 'top-right');

    //rental form validation
	$('#rentalForm').validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            address: {
                required: true
            },  
            rental_from: {
                required: true
            },
            rental_to: {
                required: true,
                greaterThan: "#rental_from"
            },
            car_id: {
                required: true
            },  
            contact_no: {
                required: true,
                digits: true,
                minlength: 11,
                maxlength: 11
            },
            place_from: {
                required: true,
            },
            place_to: {
                required: true,
            },
            terms: {
                required: true,
            }   
        },
        messages: {
        	firstname: {
                required: "Please input firstname"
            },
            lastname: {
                required: "Please input lastname"
            },
            address: {
                required: "Please input address"
            },  
            rental_from: {
                required: "Please select start date"
            },
            rental_to: {
                required: "Please select end date",
                greaterThan: "To should be greater than or equal to From"
            },
            car_id: {
                required: "Please select car to rent"
            },  
            contact_no: {
                required: "Please input contact info",
                digits: 'Numbers only',
                minlength: "Must contain 11 digit",
                maxlength: "11 digits only"
            },
            place_from: {
                required: "Please input starting place",
            },
            place_to: {
                required: "Please input to place",
            },
            terms: {
                required: "Please accept our terms",
            } 
        }
    });

	//rental form submit
	$('#rentalForm').submit(function(e){
        e.preventDefault();
		if($(this).valid()){
        
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var address = $('#address').val();
            var car = $('#car_id').val();
            var car_split = car.split('-');
            var car_id = car_split[0];
            var contact_no = $('#contact_no').val();
            var with_driver = check ? 1 : 0;
            var rental_from = $('#rental_from').val();
            var rental_to = $('#rental_to').val();
            var place_from = $('#place_from').val();
            var place_to = $('#place_to').val();

            $.ajax({
                type: "POST",
                url: base_url+'mainController/addRental',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    address: address,
                    car_id: car_id,
                    contact_no: contact_no,
                    with_driver: with_driver,
                    rental_from: rental_from,
                    rental_to: rental_to,
                    place_from: place_from,
                    place_to: place_to
                },
                dataType: 'json',
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if(data){
                    	window.location.href = base_url+'rental-confirm'
                    }
                }
            });
            
		}
	});

	//contact form validation
    $('#contactForm').validate({
        rules: {
            fullname: {
                required: true
            },
            message: {
                required: true
            },
            email: {
                required: true,
                email: true
            }     
        },
        messages: {
            fullname: {
                required: "Please input fullname"
            }, 
            message: {
                required: "Please input message"
            },
            email: {
                required: "Please input email",
                email: "Please input a valid email"
            }
        }
    });

    //contact form submit
    $('#contactForm').submit(function(e){
        e.preventDefault();
        if($(this).valid()){
            var contact = $(this).serialize();
            $.ajax({
                type: "POST",
                url: base_url+'mainController/addMessage',
                data: contact,
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if (!data.error) {
                        alertify.success('<i class="fa fa-info-circle"></i> &nbsp; Message sent');
                        $('#contactForm')[0].reset();
                    } else {
                        alertify.error('<i class="fa fa-remove"></i> &nbsp; Unable to send message');
                    }
                }
            });
        }
    });

	// checkbox
	$('.checkbox-image').click(function(){
		if (check) {
			$(this).attr('src', base_url+'assets/img/uncheck.png');
			check = false;
			checkPrice();
		} else {
			$(this).attr('src', base_url+'assets/img/check.png');
			check = true;
			checkPrice();
		}
		
	});

	//car onchange
	$('#car_id').change(function(){
		checkPrice();
        checkAvailable();
        var car_split = $(this).val().split('-');
        car_id = parseInt(car_split[0]);
        $.ajax({
            type: "POST",
            url: base_url+'mainController/getRowById',
            data: {
                table: 'cars',
                id: car_id,
            },
            dataType: "json",
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(data){
                $('#loader').hide();
                var car = data[0];
                var car_html = '<div class="rental-prev">';
                if (car.photo == '') {
                    car_html += '<img src="'+base_url+'assets/img/noimage.png">';
                } else {
                    car_html += '<img src="'+base_url+'assets/img/'+car.photo+'">';
                }
                car_html += '<p style="padding-top:20px;">Car: '+car.description+' <span style="display: block">Plate No.: '+car.plate_number+'</span></p></div>';
                
                $('#rental_car').html(car_html);
            }
        });
	});

	//confirm rental
	$('#confirm_rental').click(function(){
		$.ajax({
			type: "POST",
			url: base_url+'mainController/approveRental',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(data){
					window.location.href = base_url+'rental-success'
				}
			}
		});
	});

    //start date input
    $('#rental_from').change(function(){
        checkAvailable();
        checkPrice()
    });

    //end date input
    $('#rental_to').change(function(){
        checkAvailable();
        checkPrice()
    });

});
function checkPrice(){
	var driver_price = 0;
	var car_price = 0;
	if(check){
		driver_price = 500;
	}
	var car_id = $('#car_id').val();
	if(car_id !== ''){
		var car_split = car_id.split('-');
		car_price = parseInt(car_split[1]);
	}

	var total = car_price+driver_price;

    var start_date = $('#rental_from').val();
    var end_date = $('#rental_to').val();

    if(start_date != '' && end_date !== '' && end_date >= start_date){
        var times = 0;
        var new_start = new Date(start_date);
        var new_end = new Date(end_date);
        times = (new_end.getDate() - new_start.getDate()) + 1;
        total = (times*car_price)+driver_price;
    }

	$('#price').html(total+'.00');
}

function checkAvailable(){
    var start_date = $('#rental_from').val();
    var end_date = $('#rental_to').val();
    var car_id = $('#car_id').val();
    if(car_id !== ''){
        var car_split = car_id.split('-');
        car_id = parseInt(car_split[0]);
        if(start_date != '' && end_date !== '' && end_date >= start_date){
            $.ajax({
                type: "POST",
                url: base_url+'mainController/checkAvailable',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    car_id: car_id,
                },
                dataType: "json",
                beforeSend: function(){
                    $('#loader').show();
                },
                success: function(data){
                    $('#loader').hide();
                    if(data.match){
                        alertify.error('<i class="fa fa-remove"></i> &nbsp; Car not available');
                    }
                }
            });
        }
    }
}