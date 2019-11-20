$(function(){
    var base_url = $('.base_url').data('value');
	// set alert position
    alertify.set('notifier','position', 'top-right');

    $('#reportRange').daterangepicker();

    var range = $('#reportRange').val();
    range = range.split(' - ');
    var from = range[0];
    var to = range[1];

    $('#reportRange').change(function(){
    	var rangechange = $(this).val();
    	rangechange = rangechange.split(' - ');
    	var range_from = rangechange[0];
    	range_from_split = range_from.split('/');
    	var new_from = range_from_split[1]+'-'+range_from_split[0]+'-'+range_from_split[2];
    	var range_to = rangechange[1];
    	range_to_split = range_to.split('/');
    	var new_to = range_to_split[1]+'-'+range_to_split[0]+'-'+range_to_split[2];
    	window.location.href= base_url+"myadminpanel-reports/"+new_from+"/"+new_to;
    });

    var reporttable = $('#reportTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[7, 'desc']], 
 
        "ajax": {
            "url": base_url+"adminController/ajax_report",
            "type": "POST",
            "data": {from:from,to:to}
        },
	 
        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [3, 8], 
	            "orderable": false,
	        },
        ],
        "columns": [
			{ data: "fullname"},
	       	{ data: "address" },
            { data: "car_model" },
            { data: "with_driver",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "Yes";
                    } else {
                        return "No";
                    }
                }
            },
			{ data: "place_from" },
			{ data: "place_to" },
			{ data: "start_date" },
            { data: "end_date" },
            { data: "rental_id", 
                render: function (data, type, row) {
                    var additional = 0;
                    if (row.addamount !== null) {
                        additional = row.addamount;
                    }
                    return parseFloat(row.total_pay) + parseFloat(additional);
                }
            },
            
       ],
    });

    $('select[name="reportTable_length"]').removeClass('custom-select');
    $('select[name="reportTable_length"]').removeClass('custom-select-sm');
    
    $('#print_report').click(function(){
    	var from = $(this).data('from');
    	var to = $(this).data('to');
    	window.open(base_url+'myadminpanel-print-report/'+from+'/'+to);
    });
	
});