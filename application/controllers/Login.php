<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('LoginModel', 'login');

    }

    public function doLogin() {
        //get the input fields from login form
        $log_user_id = $this->input->post('log_user_id');
        $log_pass = md5($this->input->post('log_pass'));
        
        $data = array(
            'user_id' => $log_user_id,
            'user_pass' => $log_pass,
            'status' => "1"
        );

        
        //send the log_user_id pass to query if the user is present or not
        $check_login = $this->login->checkLogin($data);

        //if the result is query result is 1 then valid user
        if ($check_login) {
            //if yes then set the session 'loggin_in' as true
            $this->session->set_userdata('logged_in', TRUE);

            $this->session->set_userdata('val', $check_login);
            $this->session->set_userdata('user_id', $check_login['user_id']);
            $this->session->set_userdata('user_name', $check_login['user_name']);
            $this->session->set_userdata('status', $check_login['status']);
            $this->session->set_userdata('role_type', $check_login['role_type']);
            $this->session->set_userdata('branch_id', $check_login['branch_id']);

                $user_role_id = $check_login['role_id'];
                $role_result = $this->login->get_role_permission($user_role_id);

            $this->session->set_userdata('role_result', $role_result);
            $this->session->set_userdata('client_name', 'CK Bird Management');

            if($this->session->role_type =='Admin'){

                $result = array(
                    "logstatus" => "success",
                    "url" => "Bird/bird_manage"
                );
                echo json_encode($result);


            }
            else{

                $result = array(
                    "logstatus" => "success",
                    "url" => "Bird/bird_manage"
                );
                echo json_encode($result);
            }

        } else {
            //if no then set the session 'logged_in' as false
            $this->session->set_userdata('logged_in', false);
            
            //and redirect to login page with flashdata invalid msg
            
            $result = array(
                "logstatus" => "failed"
            );
            echo json_encode($result);

    
        }
    }

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role_type');
        $this->session->unset_userdata('role_result');
       // $this->session->unset_userdata('role_id');
        
        redirect(base_url());
    }
}