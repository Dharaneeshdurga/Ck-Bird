<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_send extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        $this->load->model('masters_model');
        //load the Login Model
        $this->load->model('LoginModel', 'login');
				$this->load->model('CommonBird_model', 'cbmodel');

    }
     public function send_status_mail() { 
     // $from_email = "durgadharaneesh29@gmail.com"; 
      $message_body = $this->input->post('message_body'); 
//echo $to_email;
// exit;
      //Load email library 
      $this->load->library('email'); 
      $config = array(
        'protocol' =>'smtp',
        'smtp_host' => 'smtp.office365.com',
        'smtp_port' => 587,
        'smtp_user' => 'rfh@hepl.com',
        'smtp_pass' => 'Tnk@2021',
        'smtp_crypto' => 'tls',
        'mailtype' =>'html',
        'smtp_timeout' => '60',
       // 'charset' => 'iso-8859-1',
        'charset' => 'utf-8',
       // 'newline' => '\r\n',
       // 'crlf' => '\r\n',
        'wordwrap' => TRUE
    );
        
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
	  $list = array('manikandan@cavininternational.com','sivasankary@cavininternational.com','thamizharasi@cavininternational.com');
	  $this->email->to($list);
	  $cc_list = array('rajan@cavininternational.com','abirami@cavininternational.com','lalithasp@cavininternational.com','madhan@cavininternational.com');
	  $this->email->cc($cc_list);
      $this->email->subject('Exceeds of Minimum Wastage'); 
      $this->email->message($message_body); 

      //Send mail 
      if($this->email->send()) {
       $auto_id = $this->input->post('auto_id'); 
       $table = $this->input->post('table'); 
       $where_id = $this->input->post('where_id'); 
        $where['mail_status'] = "mailed";
        $update_result = $this->masters_model->updates($table, $where, $where_id, $auto_id);

       echo("Mail sent");
      }
      else {
      $error = $this->email->print_debugger();
     // $error = "Email sent failed";
     // $this->session->set_flashdata("message",$error); 
     // $this->load->view('Execution/team_register'); 
      echo($error);
      }
   }
   
   public function send_mail() { 
				$from_email = "durgadharaneesh29@gmail.com"; 
				$to_email = $this->input->post('email'); 
			//echo $to_email;
			// exit;
				//Load email library 
				$this->load->library('email'); 
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => '465',
					'smtp_user' => 'durgadharaneesh29@gmail.com', // change it to yours
					'smtp_pass' => '29dharaneeshdurga', // change it to yours
					'mailtype' => 'html',
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
				$this->email->from($from_email, 'ck bird'); 
				$this->email->to('durgadevi.r@hemas.in');
				$this->email->subject('Email Test'); 
				$this->email->message('Testing the email class.'); 

				//Send mail 
				if($this->email->send()) {
				//$this->session->set_flashdata("message","Email sent successfully."); 
			// $this->load->view('mail'); 
				echo("Mail sent");

				}
				else {
				$error = $this->email->print_debugger();
			// $error = "Email sent failed";
			// $this->session->set_flashdata("message",$error); 
			// $this->load->view('mail'); 
				echo($error);

    }
 } 




 public function send_request_mail() { 
	$user_id = $this->session->userdata('user_id');
	$where_cond_g['status'] = 1;
	$where_cond_g['user_id'] = $user_id;
$user = $this->cbmodel->verify_data($where_cond_g,'ckb_users');
$user_name =  $user[0]->user_name;
//print_r($user); die;

	 $division = $this->input->post('divisions');
	 $to_division = $this->input->post('to_divisions'); 
	 $requirement = $this->input->post('requirement'); 
	 $date = $this->input->post('date_req'); 
	 $division = $this->input->post('divisions'); 
$message_body = "From Division: ".$division.'</br>';
$message_body = "To Division: ".$to_division.'</br>';
$message_body .= "Requirement: ".$requirement.'</br>';
$message_body .= "Date of Request: ".$date.'</br>';
$message_body .= "Raised By: ".$user_name;

	 $this->load->library('email'); 
	 $config = array(
		 'protocol' =>'smtp',
		 'smtp_host' => 'smtp.office365.com',
		 'smtp_port' => 587,
		 'smtp_user' => 'rfh@hepl.com',
		 'smtp_pass' => 'Tnk@2021',
		 'smtp_crypto' => 'tls',
		 'mailtype' =>'html',
		 'smtp_timeout' => '60',
		// 'charset' => 'iso-8859-1',
		 'charset' => 'utf-8',
		 'newline' => '\r\n',
		// 'crlf' => '\r\n',
		 'wordwrap' => TRUE
 );
		 
	 $this->email->initialize($config);
	 $this->email->set_newline("\r\n");
	 $this->email->from('rfh@hepl.com', 'ck bird'); 
	 $list = array('lalithasp@cavininternational.com','sivasankary@cavininternational.com','thamizharasi@cavininternational.com');
	 $this->email->to($list);
	 $cc_list = array('rajan@cavininternational.com','abirami@cavininternational.com','madhan@cavininternational.com');
	 $this->email->cc($cc_list);
	 $this->email->subject('Requirement Request'); 
	 $this->email->message($message_body); 

	 //Send mail 
	 if($this->email->send()) {
		echo("Mail sent");
	 }
	 else {
	 $error = $this->email->print_debugger();
	// $error = "Email sent failed";
	// $this->session->set_flashdata("message",$error); 
	// $this->load->view('Execution/team_register'); 
	 echo($error);
	 }
}




public function send_mortality_mail() { 
			$user_id = $this->session->userdata('user_id');
			//$where_cond_g['status'] = 1;
			$where_cond_g['auto_id'] = $this->input->post('incub_id'); 
		$egg_result = $this->cbmodel->verify_data($where_cond_g,'ckb_incubation');
		$egg_no =  $egg_result[0]->egg_no;
	//print_r($egg_result); die;
			
			$bird_group = $egg_result[0]->group_id;
			$bird_species = $egg_result[0]->species_id;
			$aviary_id =  $egg_result[0]->aviary_id;
			$cage =  $egg_result[0]->cage;
			$male_parent_rno = $egg_result[0]->male_parent_ringno;
			$female_parent_rno = $egg_result[0]->female_parent_ringno;

$status = $egg_result[0]->status;
if($status == 0){

			$where_cond_s['incub_id'] = $this->input->post('incub_id'); 
		$br_date = $this->cbmodel->verify_data($where_cond_s,'ckb_move_brooder');
		$br_date =  $br_date[0]->move_handfeed_date;
		$d = "HANDFEEDING";
}
if($status == 2){
	$br_date =  $egg_result[0]->moved_pweaning_date;
	$d = "PREWEANING";
}
if($status == 3){
	$br_date =  $egg_result[0]->moved_weaning_date;
	$d = "WEANING";
}

			$mor_date = $this->input->post('hs_date'); 
			$mor_date = date('d-m-Y',strtotime($mor_date));
	//	echo $mor_date; die;
			
			$where_cond_1['status'] = 1;
			$where_cond_g1['auto_id'] = $bird_group;
		$bird_group = $this->cbmodel->verify_data($where_cond_g1,'ckb_group');
		$bird_group =  $bird_group[0]->group_name;
		
		$where_cond_g2['status'] = 1;
		$where_cond_g2['auto_id'] = $bird_species;
		$bird_species = $this->cbmodel->verify_data($where_cond_g2,'ckb_species');
		$bird_species =  $bird_species[0]->bird_species;
		
		$where_cond_g3['status'] = 1;
		$where_cond_g3['auto_id'] = $aviary_id;
		$aviary = $this->cbmodel->verify_data($where_cond_g3,'ckb_aviary');
		$aviary =  $aviary[0]->aviary_name;
		
	
		
		$message_body = "Egg No: (".$egg_no.")- Mortality.\r\n";
		$message_body .= "Group Name: ".$bird_group."\r\n";
		$message_body .= "Species Name: ".$bird_species."\r\n";
		$message_body .= "Aviary: ".$aviary."\r\n";
		$message_body .= "Cage: ".$cage."\r\n";
		$message_body .= "Male Parent Ring No: ".$male_parent_rno."\r\n";
		$message_body .= "Female Parent Ring No: ".$female_parent_rno."\r\n";
		$message_body .= "Moved On: ".$br_date."\r\n";
		$message_body .= "Mortality Date: ".$mor_date."\r\n";


	
	

			$this->load->library('email'); 
			$config = array(
				'protocol' =>'smtp',
				'smtp_host' => 'smtp.office365.com',
				'smtp_port' => 587,
				'smtp_user' => 'rfh@hepl.com',
				'smtp_pass' => 'Tnk@2021',
				'smtp_crypto' => 'tls',
				'mailtype' =>'text',
				'smtp_timeout' => '60',
				// 'charset' => 'iso-8859-1',
				'charset' => 'utf-8',
				'newline' => '\r\n',
				// 'crlf' => '\r\n',
				'wordwrap' => TRUE
		);
				
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('rfh@hepl.com', 'ck bird'); 
			//$this->email->to('venkatesh@cavininternational.com');
			// $this->email->cc('durga.r@hepl.com');
			$list = array('manikandan@cavininternational.com','sivasankary@cavininternational.com','thamizharasi@cavininternational.com');
			$this->email->to($list);
			$cc_list = array('rajan@cavininternational.com','abirami@cavininternational.com','lalithasp@cavininternational.com','madhan@cavininternational.com');
			$this->email->cc($cc_list);
			$this->email->subject('Chick Mortality Acknowledgement- '.$d); 
			$this->email->message($message_body); 

			//Send mail 
			if($this->email->send()) {
				echo "Mail sent";
			}
			else {
			$error = $this->email->print_debugger();
			// $error = "Email sent failed";
			// $this->session->set_flashdata("message",$error); 
			// $this->load->view('Execution/team_register'); 
			echo($error);
	 }
}





public function send_dis_mail() { 
	$user_id = $this->session->userdata('user_id');
	$where_cond_g['status'] = 1;
	$where_cond_g['user_id'] = $user_id;
$user = $this->cbmodel->verify_data($where_cond_g,'ckb_users');
$user_name =  $user[0]->user_name;
//print_r($user); die;

	 $egg_no = $this->input->post('egg_no');  
	 $date = $this->input->post('dof'); 
	 $fertile_type = $this->input->post('fertile_type'); 
	 $bird_group = $this->input->post('bird_group');
	 $bird_species = $this->input->post('bird_species');
	 $male_parent_rno = $this->input->post('male_parent_rno');
	 $female_parent_rno = $this->input->post('female_parent_rno');
	 $doi = $this->input->post('doi');
	 $clutch_no = $this->input->post('clutch_no');
	 $egg_no_clutch = $this->input->post('egg_no_clutch');
	 $aviary_id = $this->input->post('aviary_id');
	 $cage = $this->input->post('cage');

	 $where_cond_1['status'] = 1;
	 $where_cond_g1['auto_id'] = $bird_group;
 $bird_group = $this->cbmodel->verify_data($where_cond_g1,'ckb_group');
 $bird_group =  $bird_group[0]->group_name;

 $where_cond_g2['status'] = 1;
 $where_cond_g2['auto_id'] = $bird_species;
$bird_species = $this->cbmodel->verify_data($where_cond_g2,'ckb_species');
$bird_species =  $bird_species[0]->bird_species;

$where_cond_g3['status'] = 1;
$where_cond_g3['auto_id'] = $aviary_id;
$aviary = $this->cbmodel->verify_data($where_cond_g3,'ckb_aviary');
$aviary =  $aviary[0]->aviary_name;

$message_body = "Egg No: (".$egg_no.")'  Type: $fertile_type."."\r\n";
$message_body .= "Group Name: ".$bird_group."\r\n";
$message_body .= "Species Name: ".$bird_species."\r\n";
$message_body .= "Aviary: ".$aviary."\r\n";
$message_body .= "Cage: ".$cage."\r\n";
$message_body .= "Male Parent Ring No: ".$male_parent_rno."\r\n";
$message_body .= "Female Parent Ring No: ".$female_parent_rno."\r\n";
$message_body .= "Date of Incubation: ".date('d-m-Y',strtotime($doi))."\r\n";
$message_body .= "Date of Dis/Infertile: ".date('d-m-Y',strtotime($date))."\r\n";
$message_body .= "Clutch No: ".$clutch_no."\r\n";
$message_body .= "Egg no in clutch: ".$egg_no_clutch."\r\n";

	 $this->load->library('email'); 
	 $config = array(
		 'protocol' =>'smtp',
		 'smtp_host' => 'smtp.office365.com',
		 'smtp_port' => 587,
		 'smtp_user' => 'rfh@hepl.com',
		 'smtp_pass' => 'Tnk@2021',
		 'smtp_crypto' => 'tls',
		 'mailtype' =>'text',
		 'smtp_timeout' => '60',
		// 'charset' => 'iso-8859-1',
		 'charset' => 'utf-8',
		 'newline' => '\r\n',
		 'crlf' => '\r\n',
		 'wordwrap' => TRUE
 );
		 
	 $this->email->initialize($config);
	 $this->email->set_newline("\r\n");
	 $this->email->from('rfh@hepl.com', 'ck bird'); 
	// $this->email->to('durga.r@hepl.com');
	// $this->email->cc('venkatesh@cavininternational.com');
	$list = array('manikandan@cavininternational.com','sivasankary@cavininternational.com','thamizharasi@cavininternational.com');
	$this->email->to($list);
	$cc_list = array('rajan@cavininternational.com','abirami@cavininternational.com','lalithasp@cavininternational.com','madhan@cavininternational.com');
	$this->email->cc($cc_list);
	 $this->email->subject('Dis/Infertile Egg'); 
	 $this->email->message($message_body); 

	 //Send mail 
	 if($this->email->send()) {
		echo "MAIL SENT";
	 }
	 else {
	 $error = $this->email->print_debugger();
	// $error = "Email sent failed";
	// $this->session->set_flashdata("message",$error); 
	// $this->load->view('Execution/team_register'); 
	 echo($error);
	 }
}

public function send_bird_mortality_mail() { 
	$user_id = $this->session->userdata('user_id');
	//$where_cond_g['status'] = 1;
	$where_cond_g['auto_id'] = $this->input->post('p_id'); ;
$ring_result = $this->cbmodel->verify_data($where_cond_g,'ckb_bird');
$ring_no =  $ring_result[0]->ring_no;
//print_r($ring_result); die;

	// $egg_no = $this->input->post('egg_no');  
	
	
	

	$bird_group = $ring_result[0]->group_id;
	$bird_species = $ring_result[0]->species_id;
	$aviary_id =  $ring_result[0]->aviary_id;
	$cage =  $ring_result[0]->cage_id;
	$proven = $ring_result[0]->proven;
	$gender = $ring_result[0]->gender;
	$mor_date = $this->input->post('health_change_date'); 
	$mor_date = date('d-m-Y',strtotime($mor_date));
	$branch = $ring_result[0]->branch_id;
	
	$where_cond_1['status'] = 1;
	$where_cond_g1['auto_id'] = $bird_group;
$bird_group = $this->cbmodel->verify_data($where_cond_g1,'ckb_group');
$bird_group =  $bird_group[0]->group_name;

$where_cond_g2['status'] = 1;
$where_cond_g2['auto_id'] = $bird_species;
$bird_species = $this->cbmodel->verify_data($where_cond_g2,'ckb_species');
$bird_species =  $bird_species[0]->bird_species;

$where_cond_g3['status'] = 1;
$where_cond_g3['auto_id'] = $aviary_id;
$aviary = $this->cbmodel->verify_data($where_cond_g3,'ckb_aviary');
$aviary =  $aviary[0]->aviary_name;

$where_cond_g4['status'] = 1;
$where_cond_g4['auto_id'] = $branch;
$branchs = $this->cbmodel->verify_data($where_cond_g4,'ckb_branch');
$branchs =  $branchs[0]->branch_name;

$message_body = "Ring No: (".$ring_no.")- Mortality.\r\n";
$message_body .= "Group Name: ".$bird_group."\r\n";
$message_body .= "Species Name: ".$bird_species."\r\n";
$message_body .= "Aviary: ".$aviary."\r\n";
$message_body .= "Cage: ".$cage."\r\n";
$message_body .= "Proven: ".$proven."\r\n";
$message_body .= "Gender: ".$gender."\r\n";
$message_body .= "Mortality Date: ".$mor_date."\r\n";
$message_body .= "Branch: ".$branchs."\r\n";









	$this->load->library('email'); 
	$config = array(
		'protocol' =>'smtp',
		'smtp_host' => 'smtp.office365.com',
		'smtp_port' => 587,
		'smtp_user' => 'rfh@hepl.com',
		'smtp_pass' => 'Tnk@2021',
		'smtp_crypto' => 'tls',
		'mailtype' =>'text',
		'smtp_timeout' => '60',
		// 'charset' => 'iso-8859-1',
		'charset' => 'utf-8',
		'newline' => '\r\n',
		// 'crlf' => '\r\n',
		'wordwrap' => TRUE
);
		
	$this->email->initialize($config);
	$this->email->set_newline("\r\n");
	$this->email->from('rfh@hepl.com', 'ck bird'); 
	//$this->email->to('durga.r@hepl.com');
	//$this->email->cc('venkatesh@cavininternational.com');
	$list = array('manikandan@cavininternational.com','sivasankary@cavininternational.com','thamizharasi@cavininternational.com');
	$this->email->to($list);
	$cc_list = array('rajan@cavininternational.com','abirami@cavininternational.com','lalithasp@cavininternational.com','madhan@cavininternational.com');
	$this->email->cc($cc_list);
	$this->email->subject('Bird Mortality Acknowledgement'); 
	$this->email->message($message_body); 

	//Send mail 
	if($this->email->send()) {
		echo "Mail sent";
	}
	else {
	$error = $this->email->print_debugger();
	
	echo($error);
}
}
}//class
