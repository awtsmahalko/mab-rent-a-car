<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function login(){
        if($this->session->userdata('admin')){
            redirect('myadminpanel');
        }
        if($this->input->post()){
            $output = ['error'=>false, 'message'=>''];
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if(empty($username) || empty($password)){
                $output['error'] = true;
                $output['message'] = 'Input both fields';
                echo json_encode($output);
                exit();
            }

            $where_user = [
                'username' => $username
            ];

            // check if username exist
            $user = $this->mydb_model->fetch('admin', $where_user);

            if($user){
                $user = $user[0];
                // check password
                if(password_verify($password, $user->password)){
                    $this->session->set_userdata('admin', $user);
                } else {
                    $output['error'] = true;
                    $output['message'] = 'Incorrect Password';  
                }
            } else{
                $output['error'] = true;
                $output['message'] = 'Username not found';
            }
            echo json_encode($output);

        }
        else{
            $data['title'] = "Admin Login";
            $data['active'] = "";
            $this->loginview('admin/login', $data);
        }
    }
    public function logout(){
        $this->session->unset_userdata('admin');
        redirect('admin-login');
    }
}
