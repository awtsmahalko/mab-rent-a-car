<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // load
        $this->load->helper('url');
        $this->load->model('mydb_model');
        $this->load->library('session');

    }
    public function adminview($page = '', $data = '') {
        $data['admindata'] = $this->admindata();
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/includes/navbar');
        $this->load->view('admin/includes/sidebar');
        $this->load->view($page, $data);
        $this->load->view('admin/includes/footer');
    }
    public function loginview($page = '', $data = '') {
        $this->load->view('admin/includes/header', $data);
        $this->load->view($page, $data);
        $this->load->view('admin/includes/login-footer');
    }
    public function mainview($page = '', $data = '') {
        $this->load->view('main/includes/header', $data);
        $this->load->view('main/includes/navbar');
        $this->load->view('main/includes/banner', $data);
        $this->load->view($page, $data);
        $this->load->view('main/includes/footer');
    }
    public function admindata(){
        $data = [];
        $data['cars'] = $this->mydb_model->fetch('cars', array(), array(), '', true);
        $data['rentals'] = $this->mydb_model->fetch('rentals', ['status'=>0], array(), '', true);
        return $data;
    }


    public function sendemail($emailto, $subject, $message, $attachment=[]){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'amaliastacruz13@gmail.com', // change it to yours
            'smtp_pass' => 'Arnalia1317', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        ];
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($emailto);
        $this->email->to($config['smtp_user']);
        $this->email->subject($subject);
        $this->email->message($message);

        if($attachment){
            $this->email->attach($attachment['buffer'], 'attachment', $attachment['filename'], $attachment['type']);
        }
        
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendSMS($number, $message){
        // $apicode = 'TR-MABRE356468_41JZH';
        $apicode = 'TR-MABRE794318_7CD9A';
        $ch = curl_init();
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
        curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec ($ch);
        curl_close ($ch);
    }

    public function printview($page = '', $data = '') {
        $this->load->view('admin/includes/print-header', $data);
        $this->load->view($page, $data);
        $this->load->view('admin/includes/print-footer', $data);
    }
    
}
