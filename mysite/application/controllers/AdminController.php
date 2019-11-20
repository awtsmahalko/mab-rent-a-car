<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        // check if logged in
        if(!$this->is_logged_in()){
            redirect('admin-login');
        }

    }   
    public function index(){
        $years = [];
        $year = date('Y');
        for($i=1; $i<=10; $i++){
            $years[] = $year--;
        }
        sort($years);
        $data['years'] = $years;
        $data['title'] = "Admin Home";
        $data['active'] = "home";

        $data['total_rentals'] = $this->mydb_model->fetch('rentals', array(), array(), '', true);
        $data['total_cars'] = $this->mydb_model->fetch('cars', array(), array(), '', true);
        $data['pending_rentals'] = $this->mydb_model->fetch('rentals', array('status'=>0), array(), '', true);
        // $data['car_today'] = $this->mydb_model->fetch('car_reservation_dates', array('date'=>date('Y-m-d')), array(), '', true);
        $data['car_today'] = $this->mydb_model->fetch('car_reservation_dates', array('date'=>date('Y-m-d'), 'rentals.status !='=>0), array('rentals'=>'rentals.id=car_reservation_dates.rental_id'), 'LEFT', true);

        $this->adminview('admin/home', $data);
    }
    public function cars(){
        $data['title'] = "Admin Cars";
        $data['active'] = "cars";
        $this->adminview('admin/cars', $data);
    }
    public function addCar(){
        if($this->mydb_model->insert('cars', $this->input->post())){
            $output['status'] = true;
            $output['carcount'] = $this->mydb_model->fetch('cars', array(), array(), true);
            echo json_encode($output);
        }
    }
    public function ajax_cars(){
        $columns = [
            'description', 'plate_number', 'price'
        ];
        $search_columns = [
            'description', 'plate_number', 'price'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->mydb_model->fetch('cars',[],[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('cars',$limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('cars',$limit,$start,$order,$dir,[],[],'','*',$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('cars',$limit,$start,$order,$dir,[],[],'','*',$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data); 
    }
    public function editCar(){
        $where = [
            'id' => $this->input->post('id')
        ];
        unset($_POST['id']);
        $car = $this->input->post();
        
        if($this->mydb_model->update('cars', $car, $where)){
            echo json_encode(true);
        }
    }
    public function messages(){
        $data['title'] = "Admin Messages";
        $data['active'] = "message";
        $this->adminview('admin/messages', $data);
    }
    public function ajax_message(){
        $columns = [
            'id', 'fullname', 'email', 'message', 'status'
        ];
        $search_columns = [
            'id', 'fullname', 'email'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->mydb_model->fetch('messages',[],[],true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('messages',$limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('messages',$limit,$start,$order,$dir,[],[],'*',$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('messages',$limit,$start,$order,$dir,[],[],'*',$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data); 
    }
    public function openMessage(){
        $messages = $this->mydb_model->fetch('messages', array('id'=>$this->input->post('id')));

        $data['status'] = 1;

        if($this->mydb_model->update('messages', $data, array('id'=>$this->input->post('id')))){
            echo json_encode($messages);
        }

    }
    public function rentals(){
        $data['title'] = "Admin Rentals";
        $data['active'] = "rental";
        $this->adminview('admin/rentals', $data);
    }
    public function confirmRental(){
        $data['status'] = 1;
        $this->mydb_model->update('rentals', $data, array('id'=>$this->input->post('id')));
        
        // send message to client
        $rental = $this->mydb_model->fetch('rentals', ['rentals.id'=>$this->input->post('id')], ['cars'=>'cars.id=rentals.car_id']);
        $rental = $rental[0];
        $message = 'Your rental has been approved:'.PHP_EOL;
        $message .= $rental->description.PHP_EOL;
        $message .= 'From: '.$rental->start_date.PHP_EOL;
        $message .= 'To: '.$rental->end_date.PHP_EOL;

        $this->sendSMS($rental->contact_no, $message);

        echo json_encode(true);
        
    }
    public function ajax_rental(){
        $columns = [
            'fullname', 'contact_no', 'cars.description', 'place_from', 'place_to', 'start_date', 'end_date', 'status'
        ];
        $select = 'rentals.id AS rental_id, CONCAT_WS(" ", firstname, lastname) AS fullname, cars.description AS car_model, rentals.*';
        $join = [
            'cars'=>'cars.id=rentals.car_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'firstname', 'lastname', 'cars.description',
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->mydb_model->fetch('rentals',[],[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data); 
    }
    public function editRental() {
        $output = ['error'=>false];

        $id = $this->input->post('rental_id');

        // delete reserve dates with the rental
        $this->mydb_model->delete('car_reservation_dates', ['rental_id'=>$id]);

        $rental = [
            'start_date' => $this->input->post('rental_from'),
            'end_date' => $this->input->post('rental_to'),
        ];

        $rental_details = $this->mydb_model->fetch('rentals', ['id'=>$id]);
        $rental_details = $rental_details[0];

        $earlier = new DateTime($rental['start_date']);
        $later = new DateTime($rental['end_date']);

        $num_days = $later->diff($earlier)->format("%a") + 1;

        $car = $this->mydb_model->fetch('cars', ['id'=>$rental_details->car_id]);
        $car = $car[0];

        $driver = 0;

        if ($rental_details->with_driver) {
            $driver = 500;
        }

        $rental['total_pay'] = ($num_days * $car->price) + $driver;

        // check if new dates is availabel with the car
        $error = false;
        $rented_days = [];

        $renteds = $this->mydb_model->fetch('rentals', ['car_id'=>$car->id, 'status !='=>0]);
        foreach ($renteds as $rented) {
            $rented_dates = $this->mydb_model->fetch('car_reservation_dates', ['rental_id'=>$rented->id]);
            foreach ($rented_dates as $rented_date) {
                $rented_days[] = $rented_date->date;
            }
        }

        $period = new DatePeriod(
            new DateTime($rental['start_date']),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d',strtotime($rental['end_date'] . "+1 days")))
        );

        foreach ($period as $key => $value) {
            $date = $value->format('Y-m-d');
            if (in_array($date, $rented_days)){
                $error = true;
            }
        }

        if ($error) {
            $output['error'] = true;
            $output['message'] = 'Dates have reservations';
        } else {
            // update rental
            $this->mydb_model->update('rentals', $rental, ['id'=>$id]);

            $period = new DatePeriod(
                new DateTime($rental['start_date']),
                new DateInterval('P1D'),
                new DateTime(date('Y-m-d',strtotime($rental['end_date'] . "+1 days")))
            );

            foreach ($period as $key => $value) {
                $date = $value->format('Y-m-d');
                $reserve = [
                    'rental_id' => $id,
                    'date' => $date,
                ];
                $this->mydb_model->insert('car_reservation_dates', $reserve);
            }
        }

        echo json_encode($output);

    }
    public function completeRental(){
        // $data['additional_payment'] = $this->input->post('additional_pay');
        $data['status'] = 2;

        if($this->mydb_model->update('rentals', $data, array('id'=>$this->input->post('id')))){
            echo json_encode(true);
        }
    }
    public function is_logged_in(){
        if(!$this->session->userdata('admin')){
            return false;
        } else {
            return true;
        }
    }
    public function getRowById(){
        $table = $this->input->post('table');
        $where = [
            $table.'.id' => $this->input->post('id')
        ];
        $join = [];
        if($this->input->post('join_table')){
            $join[$this->input->post('join_table')] = $this->input->post('join_column'); 
        }
        
        echo json_encode($this->mydb_model->fetch($table, $where, $join));
    }

    public function fetchRentalDates(){
        echo json_encode($this->mydb_model->fetch('car_reservation_dates', ['rental_id'=>$this->input->post('id')]));
    }

    public function getMonthlyIncome(){
        $data = [];
        $year = $this->input->post('year');
        for($i = 1; $i <=12; $i++){
            $total_rental = 0;
            $rentals = $this->mydb_model->fetch('rentals', array('status'=>2, 'month(end_date)'=>$i, 'year(end_date)'=>$year));
            foreach ($rentals as $rental) {
                $total_rental += $rental->total_pay;
                $additionals = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$rental->id], [], '', false, 'SUM(amount) AS total_additional');
                $additionals = $additionals[0];
                $total_rental += $additionals->total_additional;
            }
            $data[] =  $total_rental;
        }
        echo json_encode($data);
    }

    public function getPayments() {
        $id = $this->input->post('id');

        $rental = $this->mydb_model->fetch('rentals', ['id'=>$id]);
        $rental = $rental[0];

        // additional payments
        $additionals = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$id], [], '', false, 'SUM(amount) AS total_additional');
        $additionals = $additionals[0];
        
        $output['payments'] = $this->mydb_model->fetch('payments', ['rental_id'=>$id]);
        $output['due'] = $rental->total_pay + $additionals->total_additional;

        echo json_encode($output);
    }

    public function getAdditionals() {
        $id = $this->input->post('id');

        $output = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$id]);
        
        echo json_encode($output);
    }

    public function addAdditional() {
        $output = ['error'=>false];

        $id = $this->input->post('additional_rental_id');

        $additional = [
            'rental_id' => $id,
            'additional_description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        ];

        if($this->mydb_model->insert('rental_additional_payments', $additional)) {
            $output['message'] = 'Additional payment added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Unable to add additional payment';
        }

        echo json_encode($output);
    }

    public function addPayment() {
        $output = ['error'=>false];

        $id = $this->input->post('payment_rental_id');

        $payment = [
            'rental_id' => $id,
            'date' => date('Y-m-d'),
            'payment' => $this->input->post('amount')
        ];

        if($this->mydb_model->insert('payments', $payment)) {
            $output['message'] = 'Payment added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Unable to add payment';
        }

        echo json_encode($output);

    }

    public function schedules() {
        $data['title'] = "Admin Car Schedules";
        $data['active'] = "schedule";
        $this->adminview('admin/schedules', $data);
    }

    public function getCarSchedules() {
        $output = [];

        $schedules = $this->mydb_model->fetch('car_reservation_dates', array('rentals.status !='=>0), array('rentals'=>'rentals.id=car_reservation_dates.rental_id', 'cars'=>'cars.id=rentals.car_id'), 'LEFT');

        foreach ($schedules as $schedule) {
            $output[] = [
                'title' => $schedule->description,
                'start' => $schedule->date,
                'backgroundColor' => '#f56954',
                'borderColor' => '#f56954'
            ];
        }
        echo json_encode($output);
    }

    public function reports($from='', $to='') {
        $data['title'] = "Admin Reports";
        $data['active'] = "report";
        $data['from'] = date('Y-m-d', strtotime($from));
        $data['to'] = date('Y-m-d', strtotime($to));
        $data['total'] = 0;
        // total rent
        $rentals = $this->mydb_model->fetch('rentals', array('status'=>2, 'end_date >='=>$data['from'], 'end_date <='=>$data['to']));
        foreach ($rentals as $rental) {
            $data['total'] += $rental->total_pay;
            $additionals = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$rental->id], [], '', false, 'SUM(amount) AS total_additional');
            $additionals = $additionals[0];
            $data['total'] += $additionals->total_additional;
        }
        
        $this->adminview('admin/reports', $data);
    }

    public function ajax_report() {
        $from = date('Y-m-d', strtotime($this->input->post('from')));
        $to = date('Y-m-d', strtotime($this->input->post('to')));

        $columns = [
            'rentals.id', 'address', 'cars.description', 'with_driver', 'place_from', 'place_to', 'start_date', 'end_date',
        ];
        $select = 'rentals.id AS rental_id, SUM(rental_additional_payments.amount) AS addamount, CONCAT_WS(" ", firstname, lastname) AS fullname, cars.description AS car_model, rentals.*';
        $where = ['rentals.end_date >='=>$from, 'rentals.end_date  <='=>$to, 'rentals.status'=>2];
        $join = [
            'cars'=>'cars.id=rentals.car_id',
            'rental_additional_payments'=>'rentals.id=rental_additional_payments.rental_id'
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'firstname', 'lastname', 'address', 'cars.description', 'place_from', 'place_to'
        ];
      
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->mydb_model->fetch('rentals',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,$where,$join,$join_type,$select,'','',false,'rentals.id');
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,false,'rentals.id');

            $totalFiltered = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true,'rentals.id');
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data); 
    }

    public function reportPrint($from = '', $to = '') {
        $data['title'] = 'Print Report';
        $data['from'] = $from;
        $data['to'] = $to;
        $where = ['rentals.end_date >='=>$from, 'rentals.end_date  <='=>$to, 'rentals.status'=>2];
        $select = 'rentals.id AS rental_id, SUM(rental_additional_payments.amount) AS addamount, CONCAT_WS(" ", firstname, lastname) AS fullname, cars.description AS car_model, rentals.*';
        $join = [
            'cars'=>'cars.id=rentals.car_id',
            'rental_additional_payments'=>'rentals.id=rental_additional_payments.rental_id'
        ];
        $join_type = 'LEFT';

        $data['rentals'] = $this->mydb_model->fetch('rentals',$where,$join,$join_type,false,$select,'rentals.id');

        $data['total'] = 0;
        // total rent
        $rentals = $this->mydb_model->fetch('rentals', array('status'=>2, 'end_date >='=>$data['from'], 'end_date <='=>$data['to']));
        foreach ($rentals as $rental) {
            $data['total'] += $rental->total_pay;
            $additionals = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$rental->id], [], '', false, 'SUM(amount) AS total_additional');
            $additionals = $additionals[0];
            $data['total'] += $additionals->total_additional;
        }

        $this->printview('admin/print', $data);
    }

    public function getTotal() {
        $id = $this->input->post('id');

        $rental = $this->mydb_model->fetch('rentals', ['id'=>$id]);
        $rental = $rental[0];

        // additional payments
        $additionals = $this->mydb_model->fetch('rental_additional_payments', ['rental_id'=>$id], [], '', false, 'SUM(amount) AS total_additional');
        $additionals = $additionals[0];

        $total = $rental->total_pay + $additionals->total_additional;

        echo json_encode($total);

    }

    public function track(){
        $data['title'] = "Admin Track";
        $data['active'] = "track";
        $this->adminview('admin/track', $data);
    }
    public function track_location(){
        $id = $this->input->post('id');
        $car_model = $this->input->post('car_model');
        $plate_number = $this->input->post('plate_number');
        $data['title'] = "Admin Rentals";
        $data['active'] = "rental";
        $data['id'] = $id;
        $data['car_model'] = $car_model;
        $data['plate_number'] = $plate_number;
        $this->load->view('admin/track_modal', $data);
    }
    public function ajax_track(){
       $columns = [
            'rental_id', 'fullname', 'contact_no', 'car_model', 'plate_number', 'place_from', 'place_to', 'start_date', 'end_date', 'status'
        ];
        $select = 'rentals.id AS rental_id, CONCAT_WS(" ", firstname, lastname) AS fullname, cars.description AS car_model, cars.plate_number AS plate_number, rentals.*';
        $join = [
            'cars'=>'cars.id=rentals.car_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'firstname', 'lastname', 'cars.description',
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->mydb_model->fetch('rentals',[],[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('rentals',$limit,$start,$order,$dir,[],$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data); 
    }
    public function track_get_location()
    {
       $rental_id = $this->input->post('rental_id');
       $data =  $this->mydb_model->fetch_coord($rental_id);
       echo json_encode($data);
    }
}
