<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('CommonBird_model', 'cbmodel');
        $this->load->model('Incubation_model', 'imodel');
        $this->load->model('Handfeed_model', 'hmodel');
        $this->load->model('Preweaning_model', 'pwmodel');
        $this->load->model('Weaning_model', 'wmodel');
        if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
    } 

    public function mis_format(){
       $date=$this->input->post('date');
       $to_date=$this->input->post('to_date');
       if(empty($date) && empty($to_date)){
            $date = date('Y-m-d', strtotime('-7 days'));
            $to_date = date('Y-m-d');
       }
        $data['incub_history'] = $this->imodel->get_incubation_history_dt($date,$to_date);
        $data['stunded'] = $this->imodel->get_stunded_byBirth($date,$to_date);	


        $data['handfeed_history'] = $this->hmodel->get_handfeeding_history_dt($date,$to_date);
        $data['stunded_handfeed'] = $this->hmodel->get_stunded_byBirth($date,$to_date);
        $data['stunded_after_handfeed'] = $this->hmodel->get_stunded_after_birth($date,$to_date);

      
        $data['prewean_history'] = $this->pwmodel->get_preweaning_history_dt($date,$to_date);
        $data['stunded_prewean'] = $this->pwmodel->get_stunded_byBirth($date,$to_date);
        $data['stunded_after_prewean'] = $this->pwmodel->get_stunded_after_birth($date,$to_date);
       

        $data['wean_history'] = $this->wmodel->get_weaning_history_dt($date,$to_date);
        $data['stunded_wean'] = $this->wmodel->get_stunded_byBirth($date,$to_date);
        $data['stunded_after_wean'] = $this->wmodel->get_stunded_after_birth($date,$to_date);


		$this->load->view('Mis/mis_format',$data);	
    }

   
}