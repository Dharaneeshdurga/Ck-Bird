<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Incubtemperature extends CI_Controller {	
	
	public function __construct()	
    {	
        parent::__construct();	
        $this->load->helper(array(	
            'form',	
            'utility_helper',
            'html',	
            'file',	
            'url'	
        ));	
		$this->load->model('masters_model');
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	
        $this->load->model('CommonBird_model', 'cbmodel');
        $this->load->model('Incubation_model', 'imodel');
        $this->load->model('Incubtemp_model', 'itmodel');
      //  $this->load->library('excel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	
    public function incubtemperature(){
		$this->load->view('Incubation/listing_incubtemp');	
        //echo "check";
	}
    public function add_incubtemperature(){
		$this->load->view('Incubation/incubation_temperature');	
        //echo "check";
	}
    public function view_incubationTemp(){
		$this->load->view('Incubation/view_incubationTemp');	
        //echo "check";
	}
    public function edit_incubationTemp(){
		$this->load->view('Incubation/edit_incubationTemp');	
        //echo "check";
	}
    public function datalog(){
        $where_cond_t['status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
        $data['datalog_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_incub_datalog');
		
		$this->load->view('Incubation/datalog',$data);	
       
	}
    function datalog_download($log)
    {
       
        $this->load->helper('download');
        $data = file_get_contents("uploads/datalog/".$log); // Read the file's contents
        force_download($log, $data);
         
         
    }
    public function get_incubtemp_list(){
        $postData = $this->input->post();
        $postData1 = $this->input->post('date');
        $postData2 = $this->input->post('incub');
        $handfeed_result = $this->itmodel->verify_data_incubtemperature_dt($postData,$postData1,$postData2);
    
        echo json_encode($handfeed_result);
    }


    public function get_incubtempdetails(){
        
      // $where_cond_incub['date'] = $this->input->post('date');;
    // $where_cond_incub['incub_no'] = $this->input->post('incubation');
     $date= $this->input->post('date');;
     $incub = $this->input->post('incubation');
      $incubtemp_result = $this->itmodel->verify_data_jointable($date,$incub);
      echo json_encode($incubtemp_result);
 
     }
     public function get_handtempdetails(){
        
        $where_cond_incub['date'] = $this->input->post('date');;
      $where_cond_incub['brooder_id'] = $this->input->post('broo');
      $where_cond_incub['branch_id'] = $this->session->userdata('branch_id');
       $handfeedtemp_result = $this->cbmodel->verify_data($where_cond_incub,'ckb_handfeed_temp');
 
      //print_r($where_cond_incub);
       //print_r($incub_result);
       echo json_encode($handfeedtemp_result);
  
      }
     public function get_weightloss(){
        
       // $where_cond_incub['date'] = $this->input->post('date');;
      $where_cond_incub['incub_id'] = $this->input->post('incub_row_id');
      $where_cond_incub['branch_id'] = $this->session->userdata('branch_id');

       $weightloss_result = $this->cbmodel->verify_data($where_cond_incub,'ckb_incubation_details');
 
      //print_r($where_cond_incub);
       //print_r($incub_result);
       echo json_encode($weightloss_result);
  
      }
      public function upload_datalog(){
        // echo $this->input->post('invoice');
        // exit;
                  
          //Check whether Member upload profile_img
          $branch_id = $this->session->userdata('branch_id');

          if(!empty($_FILES['datalog_file']['name'])){
              $config['upload_path'] = 'uploads/datalog/';
              $config['allowed_types'] = 'pdf|csv';
              $config['file_name'] = $_FILES['datalog_file']['name'];
              
              //Load upload library and initialize here configuration
              $this->load->library('upload',$config);
              $this->upload->initialize($config);
              
              if($this->upload->do_upload('datalog_file')){
                  $uploadData = $this->upload->data();
                  $datalog = $uploadData['file_name'];
              }else{
                  $datalog = '';
              }
          }else{
              $datalog = 'empty';
          }
         
          $data['date'] = $this->input->post('ent_date');
          $data['datalog'] = $datalog;
          $data['branch_id'] = $branch_id;
          
       $insertData = $this->cbmodel->data_add('ckb_incub_datalog',$data);
      
          
          //Storing insertion status message.
          if($insertData){
              $this->session->set_flashdata('message', ' Data Log successfully Saved.');
              redirect(base_url('index.php/Incubtemperature/datalog'));
          }else{
              $this->session->set_flashdata('error', 'Some problems occured, please try again.');
              redirect(base_url('index.php/Incubtemperature/datalog'));
          }
      
      
      }
    public function get_incubdetails(){
        
       $where_cond_g['status'] = 1;
		$group_result = $this->cbmodel->verify_data($where_cond_g,'ckb_addincubation');

      echo json_encode($group_result);

    }
    public function get_users(){
        
        $where_cond_g['status'] = 1;
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');
         $user_result = $this->cbmodel->verify_data($where_cond_g,'ckb_users');
 
       echo json_encode($user_result);
 
     }
     public function get_user_byone(){
        
        $where_cond_g['status'] = 1;
        $where_cond_g['user_id'] =  $this->input->post('user_id');
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');

         $user_result = $this->cbmodel->verify_data($where_cond_g,'ckb_users');
 
       echo json_encode($user_result);
 
     }
     public function get_brooder(){
        
        $where_cond_g['status'] = 1;
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');

         $brooder_result = $this->cbmodel->verify_data($where_cond_g,'ckb_brooder');
 
       echo json_encode($brooder_result);
 
     }
     public function get_selectedbrooder(){
        
        //$where_cond_g['status'] = 1;
        $where_cond_g['incub_id'] = $this->input->post('current_broo_id');
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');
         $brooder_result = $this->cbmodel->verify_data($where_cond_g,'ckb_move_brooder');
 
       echo json_encode($brooder_result);
 
     }
     public function get_brooder_name(){
        
      //  $where_cond_g['status'] = 1;
        $where_cond_g['auto_id'] = $this->input->post('current_broo_id');
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');
         $brooder_result = $this->cbmodel->verify_data($where_cond_g,'ckb_brooder');
 
       echo json_encode($brooder_result);
 
     }
     public function get_selectedusers(){
        
        $group_id = $this->input->post('group_id');

        $where_cond_s['group_id'] = $group_id;
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');

		$species_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species');

        echo json_encode($species_result);
    }
	public function edit_species_age_weight(){
		
		//if ($param == "update") {
			$update_id =  $this->input->post('edit_id');
			$spe_info = $this->masters_model->get_table_row('ckb_species_import', 'id', $update_id);
			
			//get the form values
			$data['age']   		= $this->input->post('edit_age', TRUE);
			$data['std_weight']   	= $this->input->post('edit_weight', TRUE);
            $data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$update_result = $this->masters_model->updates('ckb_species_import', $data, 'id', $update_id);
            if($update_result){	
		$this->session->set_flashdata('message', ('Species age and Weight has been Updated!'));
        redirect(base_url('index.php/masters/species'));
            }

  /*  if($update_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "masters/excel_display"
                );
               echo json_encode($result);
        
            }*/
		//	redirect(base_url('masters/species'));
	//	}
		
		//$data['group'] = $this->masters_model->get_table('ckb_group');
	//	$data['spe_info'] = $this->masters_model->get_table_row('ckb_species', 'id', $update_id);
	//	$this->load->view('masters/edit_species', $data);

	}

    public function get_age(){
        $sp_id = $this->input->post('current_id');
        $age_weight = $this->masters_model->get_table_row('ckb_species_import', 'species_id', $sp_id);
        if($age_weight){
            $result = array(
                "logstatus" => "success",
                "url" => "Incubtemperature/incubtemperature"
            );
           echo json_encode($result);
    
        }
     }


    public function getage(){
        
       // $sp_id = $this->input->post('current_id');
       $sp_id = $this->input->post('species_id');
       $data['group_name'] =$this->input->post('gname');
       $data['bird_species'] =$this->input->post('sname');
       $data['branch_id'] = $this->session->userdata('branch_id');
        $data['species_result'] = $this->masters_model->get_table_rows('ckb_species_import', 'species_id', $sp_id);
       // $data['species_result'] = $this->cbmodel->verify_data($where_cond_s,'ckb_species_import');
        $this->load->view('masters/excel_display' , $data);	

      //  echo json_encode($species_result);
    }
     public function addIncubationtemp(){
        $branch_id = $this->session->userdata('branch_id');
    
        $data = array(
            array(
               'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('6am'),
               //'note_time' => $this->input->post('notetime6'), 
               'temperature' => $this->input->post('temp6'), 
               'relative_humidity' => $this->input->post('hum6'), 
               'rotation' => $this->input->post('rotate6'), 
               'egg_no' => $this->input->post('eggno6'), 
               'sign' => $this->input->post('user6'), 
               'branch_id' => $branch_id,
               
               
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('8am'),
              // 'note_time' => $this->input->post('notetime8'), 
               'temperature' => $this->input->post('temp8'), 
               'relative_humidity' => $this->input->post('hum8'), 
               'rotation' => $this->input->post('rotate8'), 
               'egg_no' => $this->input->post('eggno8'), 
               'sign' => $this->input->post('user8'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('10am'),
              // 'note_time' => $this->input->post('notetime10'), 
               'temperature' => $this->input->post('temp10'), 
               'relative_humidity' => $this->input->post('hum10'), 
               'rotation' => $this->input->post('rotate10'), 
               'egg_no' => $this->input->post('eggno10'), 
               'sign' => $this->input->post('user10'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('12pm'),
               //'note_time' => $this->input->post('notetime12p'), 
               'temperature' => $this->input->post('temp12p'), 
               'relative_humidity' => $this->input->post('hum12p'), 
               'rotation' => $this->input->post('rotate12p'), 
               'egg_no' => $this->input->post('eggno12p'), 
               'sign' => $this->input->post('user12p'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('2pm'),
              // 'note_time' => $this->input->post('notetime2p'), 
               'temperature' => $this->input->post('temp2p'), 
               'relative_humidity' => $this->input->post('hum2p'), 
               'rotation' => $this->input->post('rotate2p'), 
               'egg_no' => $this->input->post('eggno2p'), 
               'sign' => $this->input->post('user2p'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('4pm'),
              // 'note_time' => $this->input->post('notetime4p'), 
               'temperature' => $this->input->post('temp4p'), 
               'relative_humidity' => $this->input->post('hum4p'), 
               'rotation' => $this->input->post('rotate4p'), 
               'egg_no' => $this->input->post('eggno4p'), 
               'sign' => $this->input->post('user4p'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('6pm'),
              // 'note_time' => $this->input->post('notetime6p'), 
               'temperature' => $this->input->post('temp6p'), 
               'relative_humidity' => $this->input->post('hum6p'), 
               'rotation' => $this->input->post('rotate6p'), 
               'egg_no' => $this->input->post('eggno6p'), 
               'sign' => $this->input->post('user6p'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('8pm'),
               //'note_time' => $this->input->post('notetime8p'), 
               'temperature' => $this->input->post('temp8p'), 
               'relative_humidity' => $this->input->post('hum8p'), 
               'rotation' => $this->input->post('rotate8p'), 
               'egg_no' => $this->input->post('eggno8p'), 
               'sign' => $this->input->post('user8p'), 
               'branch_id' => $branch_id,
               
            ),
            array(
                'date' => $this->input->post('cur_date'),
               'incub_no' => $this->input->post('incubation_no'),
               'time' => $this->input->post('10pm'),
              // 'note_time' => $this->input->post('notetime10p'), 
               'temperature' => $this->input->post('temp10p'), 
               'relative_humidity' => $this->input->post('hum10p'), 
               'rotation' => $this->input->post('rotate10p'), 
               'egg_no' => $this->input->post('eggno10p'), 
               'sign' => $this->input->post('user10p'), 
               'branch_id' => $branch_id,
               
            ),
            
         );
      // print_r($data);
      // exit;
        $incub_result = $this->db->insert_batch('ckb_incubtemp', $data);
        
         //exit;
         // $incub_result = $this->cbmodel->data_add('ckb_incubtemp',$data);

        
       if($incub_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Incubtemperature/incubtemperature"
            );
           echo json_encode($result);
    
        }
    }
public function move_handfeeding(){
    $where_cond_i['status'] = 0;
    $auto_id = $this->input->post('incub_id');
    $where_cond_h['incub_id'] = $auto_id;
    $where_cond_h['move_handfeed_date'] = $this->input->post('move_date');
    $where_cond_h['move_handfeed_brooder'] = $this->input->post('brooder');
    $where_cond_h['branch_id'] = $this->session->userdata('branch_id');
   $branch_id = $this->session->userdata('branch_id');
    $incub_where= array('incub_id' =>  $auto_id , 'branch_id' =>$branch_id);

  //  $incub_result = $this->masters_model->branch_updates('ckb_incubation', $where_cond_h, $incub_where);
    $incub_result = $this->cbmodel->updates('ckb_incubation', $where_cond_i, 'auto_id', $auto_id);
  
    $query1 = $this->db->get_where('ckb_move_brooder', array('incub_id' => $auto_id ));
    $count_in_brooder = $query1->num_rows();
   if($count_in_brooder == 0){
    $move_result = $this->cbmodel->data_add('ckb_move_brooder',$where_cond_h);
   }
   else{
    $where_cond_u['move_handfeed_date'] = $this->input->post('move_date');
    $where_cond_u['move_handfeed_brooder'] = $this->input->post('brooder');
    $move_result = $this->cbmodel->updates('ckb_move_brooder', $where_cond_u, 'incub_id', $auto_id);

   }
        if($move_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Incubation/incubation"
            );
            echo json_encode($result);
    
        }

}

public function get_handfeed_list(){
    $postData = $this->input->post();
    $handfeed_result = $this->imodel->verify_data_handfeed_dt($postData);

    echo json_encode($handfeed_result);
}

public function updateIncubationtemp(){
      $id= $this->input->post('id');
      $branch_id = $this->session->userdata('branch_id');
    $data = array(
        array(
            'id' => $this->input->post('id0'),
           'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('6am'),
           'note_time' => $this->input->post('notetime0'), 
           'temperature' => $this->input->post('temp0'), 
           'relative_humidity' => $this->input->post('hum0'), 
           'rotation' => $this->input->post('rotate0'), 
           'egg_no' => $this->input->post('eggno0'), 
           'sign' => $this->input->post('user0'), 
           'branch_id' => $branch_id, 
           
           
           
        ),
        array(
         'id' => $this->input->post('id1'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('8am'),
           'note_time' => $this->input->post('notetime1'), 
           'temperature' => $this->input->post('temp1'), 
           'relative_humidity' => $this->input->post('hum1'), 
           'rotation' => $this->input->post('rotate1'), 
           'egg_no' => $this->input->post('eggno1'), 
           'sign' => $this->input->post('user1'), 
           'branch_id' => $branch_id, 
           
        ),
        array(
            'id' => $this->input->post('id2'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('10am'),
           'note_time' => $this->input->post('notetime2'), 
           'temperature' => $this->input->post('temp2'), 
           'relative_humidity' => $this->input->post('hum2'), 
           'rotation' => $this->input->post('rotate2'), 
           'egg_no' => $this->input->post('eggno2'), 
           'sign' => $this->input->post('user2'), 
           'branch_id' => $branch_id,         ),
        array(
            'id' => $this->input->post('id3'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('12pm'),
           'note_time' => $this->input->post('notetime3'), 
           'temperature' => $this->input->post('temp3'), 
           'relative_humidity' => $this->input->post('hum3'), 
           'rotation' => $this->input->post('rotate3'), 
           'egg_no' => $this->input->post('eggno3'), 
           'sign' => $this->input->post('user3'), 
           'branch_id' => $branch_id,  
           
        ),
        array(
            'id' => $this->input->post('id4'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('2pm'),
           'note_time' => $this->input->post('notetime4'), 
           'temperature' => $this->input->post('temp4'), 
           'relative_humidity' => $this->input->post('hum4'), 
           'rotation' => $this->input->post('rotate4'), 
           'egg_no' => $this->input->post('eggno4'), 
           'sign' => $this->input->post('user4'), 
           'branch_id' => $branch_id,  
        ),
        array(
            'id' => $this->input->post('id5'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('4pm'),
           'note_time' => $this->input->post('notetime5'), 
           'temperature' => $this->input->post('temp5'), 
           'relative_humidity' => $this->input->post('hum5'), 
           'rotation' => $this->input->post('rotate5'), 
           'egg_no' => $this->input->post('eggno5'), 
           'sign' => $this->input->post('user5'), 
           'branch_id' => $branch_id,  
        ),
        array(
            'id' => $this->input->post('id6'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('6pm'),
           'note_time' => $this->input->post('notetime6'), 
           'temperature' => $this->input->post('temp6'), 
           'relative_humidity' => $this->input->post('hum6'), 
           'rotation' => $this->input->post('rotate6'), 
           'egg_no' => $this->input->post('eggno6'), 
           'sign' => $this->input->post('user6'), 
           'branch_id' => $branch_id,  
           
        ),
        array(
            'id' => $this->input->post('id7'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('8pm'),
           'note_time' => $this->input->post('notetime7'), 
           'temperature' => $this->input->post('temp7'), 
           'relative_humidity' => $this->input->post('hum7'), 
           'rotation' => $this->input->post('rotate7'), 
           'egg_no' => $this->input->post('eggno7'), 
           'sign' => $this->input->post('user7'), 
           'branch_id' => $branch_id,  
        ),
        array(
            'id' => $this->input->post('id8'),
            'date' => $this->input->post('date'),
           'incub_no' => $this->input->post('incubation'),
           'time' => $this->input->post('10pm'),
           'note_time' => $this->input->post('notetime8'), 
           'temperature' => $this->input->post('temp8'), 
           'relative_humidity' => $this->input->post('hum8'), 
           'rotation' => $this->input->post('rotate8'), 
           'egg_no' => $this->input->post('eggno8'), 
           'sign' => $this->input->post('user8'), 
           'branch_id' => $branch_id,  
           
        ),
        
     );
 //print_r($data);
  // exit;
   // $incubupdate_result = $this->db->update_batch('ckb_incubtemp', $data, 'date','incub_no');
    $incubupdate_result = $this->db->update_batch('ckb_incubtemp', $data, 'id');
    //$incubupdate_result  = $this->cbmodel->update_rows($data,'ckb_incubtemp');
     //exit;
     // $incub_result = $this->cbmodel->data_add('ckb_incubtemp',$data);

   // print_r($incubupdate_result );
   if($incubupdate_result){
        $result = array(
            "logstatus" => "success",
            "url" => "Incubtemperature/incubtemperature"
        );
       echo json_encode($result);

    }
}
public function updateHandfeedtemp(){
    $id= $this->input->post('id');
    $branch_id = $this->session->userdata('branch_id');
  
  $data = array(
      array(
          'id' => $this->input->post('id0'),
         'date' => $this->input->post('date'),
         'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('6am'),
        // 'note_time' => $this->input->post('notetime0'), 
         'temperature' => $this->input->post('temp0'), 
         'relative_humidity' => $this->input->post('hum0'), 
         'rotation' => $this->input->post('rotate0'), 
         'egg_no' => $this->input->post('eggno0'), 
         'sign' => $this->input->post('user0'), 
         'branch_id' => $branch_id, 
         
         
         
      ),
      array(
          'id' => $this->input->post('id1'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('8am'),
        // 'note_time' => $this->input->post('notetime1'), 
         'temperature' => $this->input->post('temp1'), 
         'relative_humidity' => $this->input->post('hum1'), 
         'rotation' => $this->input->post('rotate1'), 
         'egg_no' => $this->input->post('eggno1'), 
         'sign' => $this->input->post('user1'), 
         'branch_id' => $branch_id, 
         
      ),
      array(
          'id' => $this->input->post('id2'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('10am'),
        // 'note_time' => $this->input->post('notetime2'), 
         'temperature' => $this->input->post('temp2'), 
         'relative_humidity' => $this->input->post('hum2'), 
         'rotation' => $this->input->post('rotate2'), 
         'egg_no' => $this->input->post('eggno2'), 
         'sign' => $this->input->post('user2'), 
         'branch_id' => $branch_id, 
         
      ),
      array(
          'id' => $this->input->post('id3'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('12pm'),
        // 'note_time' => $this->input->post('notetime3'), 
         'temperature' => $this->input->post('temp3'), 
         'relative_humidity' => $this->input->post('hum3'), 
         'rotation' => $this->input->post('rotate3'), 
         'egg_no' => $this->input->post('eggno3'), 
         'sign' => $this->input->post('user3'), 
         'branch_id' => $branch_id, 
         
      ),
      array(
          'id' => $this->input->post('id4'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('2pm'),
        // 'note_time' => $this->input->post('notetime4'), 
         'temperature' => $this->input->post('temp4'), 
         'relative_humidity' => $this->input->post('hum4'), 
         'rotation' => $this->input->post('rotate4'), 
         'egg_no' => $this->input->post('eggno4'), 
         'sign' => $this->input->post('user4'), 
         'branch_id' => $branch_id, 
         
      ),
      array(
          'id' => $this->input->post('id5'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('4pm'),
       //  'note_time' => $this->input->post('notetime5'), 
         'temperature' => $this->input->post('temp5'), 
         'relative_humidity' => $this->input->post('hum5'), 
         'rotation' => $this->input->post('rotate5'), 
         'egg_no' => $this->input->post('eggno5'), 
         'sign' => $this->input->post('user5'), 
         'branch_id' => $branch_id, 
         
      ),
      array(
          'id' => $this->input->post('id6'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('6pm'),
        // 'note_time' => $this->input->post('notetime6'), 
         'temperature' => $this->input->post('temp6'), 
         'relative_humidity' => $this->input->post('hum6'), 
         'rotation' => $this->input->post('rotate6'), 
         'egg_no' => $this->input->post('eggno6'), 
         'sign' => $this->input->post('user6'), 
         'branch_id' => $branch_id, 
      ),
      array(
          'id' => $this->input->post('id7'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('8pm'),
        // 'note_time' => $this->input->post('notetime7'), 
         'temperature' => $this->input->post('temp7'), 
         'relative_humidity' => $this->input->post('hum7'), 
         'rotation' => $this->input->post('rotate7'), 
         'egg_no' => $this->input->post('eggno7'), 
         'sign' => $this->input->post('user7'), 
         'branch_id' => $branch_id, 
      ),
      array(
          'id' => $this->input->post('id8'),
          'date' => $this->input->post('date'),
          'brooder_id' => $this->input->post('brooder_name'),
         'time' => $this->input->post('10pm'),
       //  'note_time' => $this->input->post('notetime8'), 
         'temperature' => $this->input->post('temp8'), 
         'relative_humidity' => $this->input->post('hum8'), 
         'rotation' => $this->input->post('rotate8'), 
         'egg_no' => $this->input->post('eggno8'), 
         'sign' => $this->input->post('user8'), 
         'branch_id' => $branch_id, 
         
      ),
      
   );
//print_r($data);
// exit;
 // $incubupdate_result = $this->db->update_batch('ckb_incubtemp', $data, 'date','incub_no');
  $incubupdate_result = $this->db->update_batch('ckb_handfeed_temp', $data, 'id');
  //$incubupdate_result  = $this->cbmodel->update_rows($data,'ckb_incubtemp');
   //exit;
   // $incub_result = $this->cbmodel->data_add('ckb_incubtemp',$data);

 // print_r($incubupdate_result );
 if($incubupdate_result){
      $result = array(
          "logstatus" => "success",
          "url" => "Handfeeding/list_handfeed_temp"
      );
     echo json_encode($result);

  }
}

public function updateage(){
    $branch_id = $this->session->userdata('branch_id');
    
    $length = $this->input->post('length');
    for ( $index = 0; $index < $length; $index++) {
      $age = 'age'.$index;
      $weight = 'weight'.$index;
      
        $data = array(
            array(
                'id' => $this->input->post('sp_id'),
               'age' => $this->input->post($age),
               'std_weight' => $this->input->post($weight),  
               'branch_id' => $branch_id, 
                   
               
            ),
        );
        $incub_result = $this->cbmodel->verify_data($data,'ckb_species_import');
      
      //  $incubupdate_result = $this->db->update_batch('ckb_species_import', $data, 'id');
        if($incubupdate_result){
            $result = array(
                "logstatus" => "success",
                "url" => "masters/species"
            );
           echo json_encode($result);
      
        }
   }
//print_r($data);
// exit;
 // $incubupdate_result = $this->db->update_batch('ckb_incubtemp', $data, 'date','incub_no');
  
  //$incubupdate_result  = $this->cbmodel->update_rows($data,'ckb_incubtemp');
   //exit;
   // $incub_result = $this->cbmodel->data_add('ckb_incubtemp',$data);

 // print_r($incubupdate_result );
 
}
// public function brooder_select(){
//     $id = $this->input->post('incub_row_id');
//     $result=$this->imodel->select_brooder($id);
//     if($result->boorder_name=="")
//     echo json_encode($result);

 
// }


}
    
