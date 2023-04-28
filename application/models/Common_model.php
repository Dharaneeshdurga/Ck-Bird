<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
	 public function importData($table,$data) {

        $res = $this->db->insert_batch($table, $data);
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	function get_random_password($chars_min = 8, $chars_max = 12, $use_upper_case = true, $include_numbers = true, $include_special_chars = true) {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if ($include_numbers) {
            $selection .= "1234567890";
        }
       // if ($include_special_chars) {
       //     $selection .= "!@\"#$%&[]{}?|";
      //  }

        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .= $current_letter;
        }

        return $password;
    }
	function general_where_select_field($table,$select = '*' ,$col, $va1){
		$this->db->select($select); 
		$this->db->where($col, $va1);
		$query = $this->db->get($table);
		return $query->row_array();
	}
   
    function com_get_table_result_array($table, $col, $id){
    	if(is_array($id)){
		$this->db->where_in($col, $id); 
 	    }else{
		$this->db->where($col, $id); 
 	    } 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	function com_get_table_result_array_with_two_cond($table, $col, $id, $col1, $id1){
    	if(is_array($id)){
		$this->db->where_in($col, $id); 
 	    }else{
		$this->db->where($col, $id); 
 	    } 
		$this->db->where($col1, $id1); 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	public function get_server_location(){
		if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
			$server_location = "localhost";
		}else{
			$server_location = "remote";
		}
		return $server_location; 
	}
	public function get_client_name(){
		$base_url = base_url();
		$base_url_array = explode('/', $base_url);
		$client_folder_name =(count($base_url_array) -2);
		$client_name = $base_url_array[$client_folder_name]; 
		return $client_name; 
	}
    
	function send_mail_old($to_email, $email_name, $subject, $message) { 
	 
        if ($to_email != "") {
			
			$from_email = "premkumar.m@hemas.in";  
			//$email_from = $this->get_table_row('email_from', 'ef_id', '1');
			$email_from = $this->remainder_model->get_table_row('company_profile', 'comp_profile_id', '1');
			//echo "<pre>"; print_r($email_from); die;
            $reply_email =  $email_from['reply_email']; 
            $from_email =  $email_from['smtp_email']; 
			
				$config = array();
                $config['useragent']           = "CodeIgniter";
                $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
               
				
				$config['smtp_host'] = $email_from['smtp_host']; 
				$config['smtp_port'] = $email_from['smtp_port']; 
				$config['smtp_user'] = $email_from['smtp_email']; 
				$config['smtp_pass'] = $email_from['smtp_password'];
				
                $config['mailtype'] = 'html';
                $config['charset']  = $email_from['smtp_charset'];
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;

                $this->load->library('email');
				
			if($email_from['reply_email']==''){ $from_email = 'noreplyifst@gmail.com'; }
			if($email_name ==''){ $email_name = 'IFST GROUP - CSS'; }

			  $this->email->initialize($config); 
			  $this->email->set_newline("\r\n"); 
			  $this->email->from($from_email, $email_name);
			  $this->email->to($to_email);
			  //$this->email->reply_to($reply_email);
			  $this->email->subject($subject);
			  $this->email->message($message); 
            if ($this->email->send()) {
               return "YES";
            } else {
                 show_error($this->email->print_debugger()); 
            }
        }
    }
	public function send_mail($to_email, $email_name, $subject, $message) { 
		$to_email_old = "premkumar.m@hemas.in";  
		if ($to_email != "") {
			
			//$from_email = "premkumar.m@hemas.in";  
			
			  //$email_from = $this->get_table_row('email_from', 'ef_id', '1'); 
			  $email_from = $this->remainder_model->get_table_row('company_profile', 'comp_profile_id', '1'); 
			  //echo "<pre>"; print_r( $email_from ); die;
			  $config = array();
              //  $config['useragent']           = "CodeIgniter";
               // $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
               
				$config['smtp_host'] = $email_from['smtp_host']; 
				$config['smtp_port'] = $email_from['smtp_port']; 
				$config['smtp_user'] = $email_from['smtp_email']; 
				$config['smtp_pass'] = $email_from['smtp_password'];
				
                $config['mailtype'] = 'html';
                $config['charset']  = $email_from['smtp_charset'];
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;
				/********
				$config['smtp_host'] = 'ifstgroup.com'; 
				$config['smtp_port'] = '25'; 
				$config['smtp_user'] = 'premkumar.m@hemas.in'; 
				$config['smtp_pass'] = 'mani123!!';
				
                $config['mailtype'] = 'html';
                $config['charset']  = 'iso-8859-1';
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE; 
				**********/
                $this->load->library('email');
				$from_email = 'premkumar.m@hemas.in';
				$from_email = $email_from['smtp_email'];
				//$reply_email =  $email_from['reply_email']; 
				//$from_email =   $email_from['smtp_email']; 
				//if($from_email == ''){ $from_email = 'noreplyifst@gmail.com'; }
				//if($reply_email == ''){ $reply_email = 'noreplyifst@gmail.com'; }
				//if($email_name == ''){ $email_name = 'IFST GROUP - CSS'; }
				// echo $email_name; die;
			  //$email_name = 'IFST GROUP  CSS';
			  $this->email->initialize($config); 
			  $this->email->set_newline("\r\n"); 
			  $this->email->from($from_email, $email_name);
			  $this->email->to($to_email);
			  $this->email->subject($subject);
			  $this->email->message($message); 
			 	 
			
            if ($this->email->send()) {
               return "YES";
            } else {
                 show_error($this->email->print_debugger()); 
            }
        }
		
	}
	
		
	function insert_data($table, $data){
		 $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
		return $last_id;
	}

	function already_exists_data($table, $field, $data, $id){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field, $data);

		if(!empty($id)){
			$this->db->where('particular_type_id !=', $id);
		}
		 
		$query = $this->db->get();
		return $query->result_array();

	}

	function updates($table, $data, $col, $id = ''){
		$this->db->where($col, $id);
		$this->db->update($table, $data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	function update_with_two_cond($table, $data, $col, $id, $col2, $id2){
		$this->db->where($col, $id);
		$this->db->where($col2, $id2);
		$this->db->update($table, $data);
		return true;
	}
	function update_with_three_cond($table, $data, $col, $id, $col2, $id2, $col3, $id3){
		$this->db->where($col, $id);
		$this->db->where($col2, $id2);
		$this->db->where($col3, $id3);
		$this->db->update($table, $data);
		return true;
	}
	function update_with_four_cond($table, $data, $col, $id, $col2, $id2, $col3, $id3, $col4, $id4){
		$this->db->where($col, $id);
		$this->db->where($col2, $id2);
		$this->db->where($col3, $id3);
		$this->db->where($col4, $id4);
		$this->db->update($table, $data);
		//$this->db->last_query();exit;
		return true;
	}
	function get_table($table){ 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	function get_table_last_row($table, $order_by){ 
		$this->db->order_by($order_by, "desc");
		$query = $this->db->get($table);
		return $query->row_array();
	}
	function get_table_row($table, $col, $id){
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		$query->row_array();
		//echo $this->db->last_query(); exit;
		return $query->row_array();
		
	}
	function get_table_row_with_two_condition($table, $col, $id, $col2, $id2){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$query = $this->db->get($table);
		//echo $this->db->last_query(); exit;
		return $query->row_array();
	}
	function get_table_row_with_three_condition($table, $col, $id, $col2, $id2, $col3, $id3){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$query = $this->db->get($table);
		return $query->row_array();
	}
	function get_table_row_with_three_condition_order_by($table, $col, $id, $col2, $id2, $col3, $id3, $order_id, $order_by){
		$this->db->order_by($order_id, $order_by);
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$query = $this->db->get($table);
		return $query->row_array();
	}
	public function get_table_row_with_four_condition($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4){

		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$query = $this->db->get($table);
		//echo $this->db->last_query(); exit;
		$result = $query->row_array();
		//$aaa = array('rrr' => '6');
		  //echo "<pre>"; print_r($result); exit;
		 return $result;
		// 
		 
		 
	}
    function get_table_row_with_four_condition_result($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	function get_table_row_with_four_condition_order_by($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4, $order_id, $order_by){
		$this->db->order_by($order_id, $order_by);
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$query = $this->db->get($table);
		return $query->row_array();
	}
	
	function get_table_row_with_five_condition($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4, $col5,$id5){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$this->db->where($col5, $id5); 
		$query = $this->db->get($table);
		return $query->row_array();
	}
	function get_table_row_with_six_condition($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4, $col5,$id5, $col6,$id6){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$this->db->where($col5, $id5); 
		$this->db->where($col6, $id6); 
		$query = $this->db->get($table);
		return $query->row_array();
	}
	function get_table_row_with_seven_condition($table, $col, $id, $col2, $id2, $col3, $id3,$col4,$id4,$col5,$id5,$col6,$id6,$col7,$id7){
		$this->db->where($col, $id); 
		$this->db->where($col2, $id2); 
		$this->db->where($col3, $id3); 
		$this->db->where($col4, $id4); 
		$this->db->where($col5, $id5); 
		$this->db->where($col6, $id6); 
		$this->db->where($col7, $id7); 
		$query = $this->db->get($table);
		return $query->row_array();
	}	
	function get_table_result_array($table, $col, $id){
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		return $query->result_array();
	}

	function get_table_where_with_more_not_equal($table, $col, $id, $col2, $id2){
		$this->db->where($col, $id); 
		$this->db->where($col2.' !=', ''); 
		$query = $this->db->get($table);
		return $query->result_array();
	}

	function get_table_where_with_more($table, $col, $id, $col2, $id2){
		$this->db->where($col2, $id2); 
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	function get_table_where_with_three_condition($table, $col, $id, $col2, $id2,$col3,$id3){
		$this->db->where($col3, $id3); 
		$this->db->where($col2, $id2); 
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	function get_table_where_with_three_condition_group_by($table, $col, $id, $col2, $id2,$col3,$id3, $group_by_id){
		$this->db->where($col3, $id3); 
		$this->db->where($col2, $id2); 
		$this->db->where($col, $id); 
		$this->db->group_by($group_by_id);
		$query = $this->db->get($table);
		return $query->result_array();
	}	
	function get_table_where_with_more_order_by($table, $col, $id, $col2, $id2, $order_val, $order_by){
		$this->db->order_by($order_val, $order_by);
		$this->db->where($col2, $id2); 
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	function get_table_where_with_three_more_order_by($table, $col, $id, $col2, $id2, $col3, $id3,$order_val, $order_by){
		$this->db->order_by($order_val, $order_by);
		$this->db->where($col3, $id3); 
		$this->db->where($col2, $id2); 
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	function get_city_list(){
		$this->db->select("*");
        $this->db->where('status', "1");
        $query = $this->db->get('city')->result_array();
		
          return $query;
	}

	function get_survey_list(){
		$this->db->select("*");
        $this->db->where('status', "1");
        $query = $this->db->get('survey')->result_array();
		
          return $query;
	}

	function getTelecallerlist(){
		$this->db->select("*");
        $this->db->where('status', "1");
        $query = $this->db->get('telecaller')->result_array();
		
          return $query;
	}

	function getAreaList($district){
		$this->db->select("*");
        $this->db->where('district', $district);
        $query = $this->db->get('areas')->result_array();
		
          return $query;
	}
}
//upload fie mode ******

