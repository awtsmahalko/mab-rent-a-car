<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
    	$data['title'] = 'Home';
        $data['active'] = 'home';
		$this->mainview('main/home', $data);
	}
    public function rental() {
        $data['title'] = 'Car Rental';
        $data['active'] = 'rental';
        $data['rental'] = 'rental';
        $data['cars'] = $this->mydb_model->fetch('cars');
        $this->mainview('main/rental', $data); 
    }
    public function contract() {
        $data['title'] = 'Terms and Condition';
        $data['active'] = '';
        $data['rental'] = 'rental-term';
        $this->mainview('main/contract', $data); 
    }
    public function confirmRental(){
        if($this->session->userdata('rentaldata')){
            $data['title'] = 'Confirm Rental';
            $data['active'] = '';
            $data['rental'] = 'rental-confirm';
            $data['rental_details'] = $this->session->userdata('rentaldata');
            $car = $this->mydb_model->fetch('cars', array('id'=>$data['rental_details']['car_id']));
            $driver = $data['rental_details']['with_driver'] ? 500 : 0;
            $data['rental_details']['price'] = $car[0]->price+$driver;
            $data['rental_details']['car'] = $car[0]->description; 
            $this->mainview('main/confirm', $data); 
        } else {
            redirect('rental');
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
    public function addRental(){
        //unset any booking data and confirm data
        $this->session->unset_userdata('rentaldata');
       
        $rental['firstname'] = $this->input->post('firstname');
        $rental['lastname'] = $this->input->post('lastname');
        $rental['address'] = $this->input->post('address');
        $rental['contact_no'] = $this->input->post('contact_no');
        $rental['car_id'] = $this->input->post('car_id');
        $rental['with_driver'] = $this->input->post('with_driver');
        $rental['start_date'] = $this->input->post('rental_from');
        $rental['end_date'] = $this->input->post('rental_to');
        $rental['place_from'] = $this->input->post('place_from');
        $rental['place_to'] = $this->input->post('place_to');

        $earlier = new DateTime($rental['start_date']);
        $later = new DateTime($rental['end_date']);

        $num_days = $later->diff($earlier)->format("%a") + 1;

        $car = $this->mydb_model->fetch('cars', ['id'=>$rental['car_id']]);
        $car = $car[0];

        $driver = 0;

        if ($rental['with_driver']) {
            $driver = 500;
        }

        $rental['total_pay'] = ($num_days * $car->price) + $driver;
        //set rental data
        $this->session->set_userdata('rentaldata',$rental);
        echo json_encode(true);
        
    }
    public function approveRental(){
        $data = $this->session->userdata('rentaldata');
        $data['status'] = 0;
       
        // insert rental
        $rental = $this->mydb_model->insert('rentals', $data);

        // insert to reservation dates
        $period = new DatePeriod(
            new DateTime($data['start_date']),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d',strtotime($data['end_date'] . "+1 days")))
        );
       
        foreach ($period as $key => $value) {
            $date = $value->format('Y-m-d');
            $reserve = [
                'rental_id' => $rental,
                'date' => $date,
            ];
            $this->mydb_model->insert('car_reservation_dates', $reserve);
        }

        $car = $this->mydb_model->fetch('cars', ['id'=>$data['car_id']]);
        $car = $car[0];

        $message = 'Your rental is waiting for approval:'.PHP_EOL;
        $message .= $car->description.PHP_EOL;
        $message .= 'From: '.$data['start_date'].PHP_EOL;
        $message .= 'To: '.$data['end_date'].PHP_EOL;

        $this->sendSMS($data['contact_no'], $message);

        $this->session->unset_userdata('rentaldata');
        echo json_encode(true);
        
    }
    public function successRental(){
        $data['title'] = 'Success';
        $data['active'] = '';
        $this->mainview('main/success', $data);
    }
    public function contact(){
        $data['title'] = 'Contact Us';
        $data['active'] = 'contact';
        $this->mainview('main/contact', $data);
    }
    public function addMessage(){
        $output = ['error'=>false];

        $subject = 'Message from your site';
        $email = $this->input->post('email');
        $message = '';
        $message .= '<p>From: <strong>'.$this->input->post('fullname').'</strong></p>';
        $message .= $this->input->post('message');

        if($this->sendemail($email, $subject, $message)) {
            $output['message'] = 'Message sent';
        } else {
            $output['error'] = true;
            $output['message'] = 'Unable to send message';
        }

        echo json_encode($output);
    }
    public function contactSuccess(){
        $data['title'] = 'Message Sent';
        $data['active'] = 'contact';
        $this->mainview('main/sent', $data);
    }
    public function checkAvailable(){
        $output = ['match'=>false];
        //determine selected dates of user
        $selected_dates = [];

        $interval = new DateInterval('P1D'); 
  
        $realEnd = new DateTime($this->input->post('end_date')); 
        $realEnd->add($interval); 
      
        $period = new DatePeriod(new DateTime($this->input->post('start_date')), $interval, $realEnd); 
      
        // Use loop to store date into array 
        foreach($period as $date) {                  
            $selected_dates[] = $date->format('Y-m-d');  
        }

        //get rented dates of car - if any
        $rented_dates = [];
        $rentals = $this->mydb_model->fetch('rentals', ['car_id'=>$this->input->post('car_id')]);

        foreach($rentals as $rental){
            $rented_rows = $this->mydb_model->fetch('car_reservation_dates', ['rental_id'=>$rental->id]);
            foreach($rented_rows as $row){
                 $rented_dates[] = $row->date;
            }
        }

        //check if any matches
        foreach($selected_dates as $selected_date){
            if(in_array($selected_date, $rented_dates)){
                $output['match'] = true;
            }
        }

        echo json_encode($output);

    }

}
