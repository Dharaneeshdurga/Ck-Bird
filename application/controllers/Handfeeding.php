<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Handfeeding extends CI_Controller {	
	
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
        $this->load->model('Handfeed_model', 'hmodel');
        $this->load->model('Incubtemp_model', 'itmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function handfeeding(){
		$this->load->view('Handfeeding/handfeeding');	
        
	}
    public function handfeed_details(){
		$this->load->view('Handfeeding/handfeed_details');	
	}
    public function view_handfeed_details(){
		$this->load->view('Handfeeding/view_handfeed');	
	}
    public function list_handfeed_temp(){
		$this->load->view('Handfeeding/listing_handfeedtemp');	
	}
    public function add_handfeedtemperature(){
		$this->load->view('Handfeeding/handfeeding_temperature');	
        //echo "check";
	}
    public function handfeeding_history(){
        $date=$this->input->post('date');
        $to_date=$this->input->post('to_date');
        $data['handfeed_history'] = $this->hmodel->get_handfeeding_history_dt($date,$to_date);
        $data['stunded'] = $this->hmodel->get_stunded_byBirth($date,$to_date);
        $data['stunded_after'] = $this->hmodel->get_stunded_after_birth($date,$to_date);
        $data['from_date']=$date;
        $data['to_date']=$to_date;
        $this->load->view('Handfeeding/handfeeding_history',$data);	
	}
    public function handfeeding_history_view(){
    $date = $this->input->post('from_date');
    $to_date=$this->input->post('to_date');
    $datawhere = $this->input->post('type');
		$data['datawhere'] = $datawhere;
    if($datawhere == "all"){
		$status = "0";
        $array_data ="";
      }
    if($datawhere == "prewean"){
		$status = "2";
		$array_data = "";
    
  }
  if($datawhere == "splay_leg"){
	$status = "0";
    $array_data['health_status']="Splay Leg";
  }
  if($datawhere == "airbubble"){
	$status = "0";
    $array_data['health_status']="Airbubble";
  }
  
  if($datawhere == "sale"){
	$status = "0";
    $array_data['bird_status']="Sale";
  }

  if($datawhere == "cured"){
	$status = "0";
    $array_data['health_status']="Cured";
  }
  if($datawhere == "yolk_infection"){
	$status = "0";
    $array_data['health_status']="Yolk sac infection";
  }
  if($datawhere == "obesity"){
	$status = "0";
    $array_data['health_status']="Obesity";
  }
  if($datawhere == "ecoli"){
	$status = "0";
    $array_data['health_status']="E.coli infection";
  }
  if($datawhere == "wry_neck"){
	$status = "0";
    $array_data['health_status']="Wry neck";
  }
  if($datawhere == "slow_digest"){
	$status = "0";
    $array_data['health_status']="Slow digestion";
  }
  if($datawhere == "crop_injury"){
	$status = "0";
    $array_data['health_status']="Crop injury";
  }
  if($datawhere == "crop_burn"){
	$status = "0";
    $array_data['health_status']="Crop burn";
  }
  if($datawhere == "oes_injury"){
	$status = "0";
    $array_data['health_status']="Oesophageal injury";
  }
  if($datawhere == "dehydration"){
	$status = "0";
    $array_data['health_status']="Dehydration";
  }
  if($datawhere == "unabsorbed_yolk_sac"){
	$status = "0";
    $array_data['health_status']="Unabsorbed yolk sac";
  }
  if($datawhere == "air_crop"){
	$status = "0";
    $array_data['health_status']="Air in the crop";
  }
  if($datawhere == "air_crop"){
	$status = "0";
    $array_data['health_status']="Air in the crop";
  }
  if($datawhere == "traumatic_injury"){
	$status = "0";
    $array_data['health_status']="Traumatic injury";
  }
  if($datawhere == "stunted_chick"){
	$status = "0";
    $array_data['health_status']="Stunted chick";
  }
  if($datawhere == "reduced_crop_size"){
	$status = "0";
    $array_data['health_status']="Reduced crop size";
  }
  if($datawhere == "splayed_leg"){
	$status = "0";
    $array_data['health_status']="Splayed leg";
  }
  if($datawhere == "fungal_infection"){
	$status = "0";
    $array_data['health_status']="Fungal infection";
  }
  if($datawhere == "mort"){
	$status = "0";
    $array_data['health_status']="Mortality";
  }
  if($datawhere == "asp_pnuem"){
	$status = "0";
    $array_data['health_status']="Aspiration Pneumonia";
  }
	if($datawhere == "resp_distress"){
		$status = "0";
			$array_data['health_status']="Respiratory distress";
		}



  if($datawhere == "stunt"){
	$status = "0";
  $data['stunded'] = $this->hmodel->get_stunded_byBirth($date,$to_date);
  }
  if($datawhere == "stunt_after"){
	$status = "0";
    $data['stunded_after'] = $this->hmodel->get_stunded_after_birth($date,$to_date);
    }
    if($datawhere != "stunt" && $datawhere != "stunt_after"){
     
  $data['incub_history_view'] = $this->hmodel->get_handfeeding_historyView_dt($array_data,$date,$to_date,$status);
  }
    
   
    $this->load->view('Handfeeding/handfeeding_history_view',$data);	
}

    public function datalog(){
        $where_cond_t['status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');

        $data['datalog_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_handfeed_datalog');
		
		$this->load->view('Handfeeding/datalog',$data);	
       
	}
    function datalog_download($log)
    {
       
        $this->load->helper('download');
        $data = file_get_contents("uploads/datalog/".$log); // Read the file's contents
        force_download($log, $data);
         
         
    }
    public function upload_datalog(){
        // echo $this->input->post('invoice');
        // exit;
        $branch_id = $this->session->userdata('branch_id');

                  
          //Check whether Member upload profile_img
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

       $insertData = $this->cbmodel->data_add('ckb_handfeed_datalog',$data);
      
          
          //Storing insertion status message.
          if($insertData){
              $this->session->set_flashdata('message', ' Data Log successfully Saved.');
              redirect(base_url('index.php/Handfeeding/datalog'));
          }else{
              $this->session->set_flashdata('error', 'Some problems occured, please try again.');
              redirect(base_url('index.php/Handfeeding/datalog'));
          }
      
      
      }
    public function move_production(){
           
        $auto_id = $this->input->post('p_id');
        $where_cond_h['auto_id'] = $auto_id;
       // $where_cond_h['status'] = 4;
        $where_cond_h['move_production_date'] = $this->input->post('pr_date');
        $where_cond_h['gender'] = $this->input->post('gender');
		$where_cond_h['sale_date'] = $this->input->post('pr_date');
		$where_cond_h['bird_status'] = "Sale";
        $where_cond_h['branch_id'] = $this->session->userdata('branch_id');

        $production_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'auto_id', $auto_id);
     
        $incub_id = $this->input->post('p_id');
        $add_bird['auto_id'] = $incub_id;
        $add_bird['group_id'] = $this->input->post('group_id');
        $add_bird['aviary_id'] = $this->input->post('aviary_id');
        $add_bird['cage_id'] = $this->input->post('cage');
        $add_bird['species_id'] = $this->input->post('species_id');
        $add_bird['ring_no'] = $this->input->post('ring_no');
        $add_bird['gender'] = $this->input->post('gender');
        $add_bird['proven'] = $this->input->post('proven');
        $add_bird['weight'] = $this->input->post('weight');
        $add_bird['status'] = 1;
        $add_bird['bird_status'] = "Sale";
        $add_bird['created_by'] = $this->session->userdata('user_id');
        $add_bird['branch_id'] = $this->session->userdata('branch_id');


        $bird_result = $this->cbmodel->data_add('ckb_bird',$add_bird);

            if($production_result && $bird_result ){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Handfeeding/handfeeding"
                );
                echo json_encode($result);
        
            }
    
    }
    public function change_health_status(){
           
        $auto_id = $this->input->post('incub_id');
        $where_cond_h['auto_id'] = $auto_id;
        $where_cond_h['health_change_date'] = $this->input->post('hs_date');
        $where_cond_h['health_status'] = $this->input->post('health_status');
        $where_cond_h['branch_id'] = $this->session->userdata('branch_id');

        $change_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'auto_id', $auto_id);
        if($change_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Handfeeding/handfeeding"
            );
            echo json_encode($result);
    
        }
    }

    public function get_handfeed_byid(){
        $where_cond_i['auto_id'] = $this->input->post('incub_id');   
        $where_cond_i['branch_id'] = $this->session->userdata('branch_id');
   
         $get_incub_result['full_detail'] = $this->cbmodel->verify_data($where_cond_i,'ckb_incubation');
         $where_cond_h['incub_id'] = $this->input->post('incub_id');  
         $where_cond_h['branch_id'] = $this->session->userdata('branch_id');

         $get_incub_result['act_weight'] = $this->cbmodel->get_all_data($where_cond_h,'ckb_handfee');
         if($get_incub_result['act_weight']==null){
          $get_incub_result['act_weight']="error";
         }

         echo json_encode($get_incub_result);
 
     }
    public function get_handfeedtemp_list(){
        $postData = $this->input->post();
        $postData1 = $this->input->post('date');
        $postData2 = $this->input->post('broo');
       // $handfeed_result = $this->itmodel->verify_data_incubtemperature_dt($postData,$postData1,$postData2);
        $handfeed_result = $this->itmodel->verify_data_handtemperature_dt($postData,$postData1,$postData2);
    
        echo json_encode($handfeed_result);
    }
    public function get_selectedbrooder(){
        
       // $group_id = $this->input->post('current_id');

        $where_cond_s['auto_id'] = $broo_id;
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');

		$bro_result = $this->cbmodel->verify_data($where_cond_s,'ckb_brooder');

        echo json_encode($bro_result);
    }
        public function get_speciesWeight(){    
        
            $sp_id = $this->input->post('current_id');
            $sp_age = $this->input->post('current_age');
            $where_cond_s['age'] = $sp_age;
            $where_cond_s['species_id'] = $sp_id;
            $where_cond_s['status'] = 1;
            $where_cond_s['branch_id'] = $this->session->userdata('branch_id');

            $species_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species_import');
					

            echo json_encode($species_result);
        }
      /*  public function get_speciesWeightgain(){    
        
            $sp_id = $this->input->post('current_id');
            $sp_age = $this->input->post('current_age');
            $where_cond_s['age'] = $sp_age-1;
            $where_cond_s['species_id'] = $sp_id;
           // $where_cond_s['status'] = 1;
            $species_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species_import');
            echo json_encode($species_result);
        }*/

        public function get_handfeed_update(){
            $postData = $this->input->post();
           $postData1 = $this->input->post('handfeed_id');        
            $get_handfeed_update_result = $this->hmodel->verify_data_handfeed_history($postData,$postData1);
            echo json_encode($get_handfeed_update_result);
           // $this->load->view('Handfeeding/view_handfeed',$get_handfeed_update_result);	

        }
        public function get_handfeed_weight(){
            // $postData = $this->input->post();
            $where_cond_bed['incub_id'] = $this->input->post('current_incubid');      
            $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
             $get_handfeed_update_weight = $this->cbmodel->verify_data($where_cond_bed,'ckb_handfee');
             echo json_encode($get_handfeed_update_weight);
            // $this->load->view('Handfeeding/view_handfeed',$get_handfeed_update_result);	
     
         }
        public function get_handfeed_feed(){

            $where_cond_bed['status'] = 1;
            $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
            $where_cond_bed['incub_id'] = $this->input->post('current_incubid');
            $where_cond_bed['feed_date'] = $this->input->post('current_date');
            $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
            $get_handfeed_feed_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_handfeed_feed');
    
            echo json_encode($get_handfeed_feed_result);
        }
        public function addHandfeed(){
           // $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
          //  $auto_id = "I".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
    
           // $where_cond_b['auto_id'] = $auto_id;
            $where_cond_b['incub_id'] = $this->input->post('incub_id');
            $where_cond_b['species_id'] = $this->input->post('species_id');
            $where_cond_b['brooder_name'] = $this->input->post('brooder_name');
            $where_cond_b['hatch_weight'] = $this->input->post('hatch_weight');
            $where_cond_b['egg_no'] = $this->input->post('egg_no');
            $where_cond_b['age'] = $this->input->post('age');
          //  $where_cond_b['egg_no'] = $this->input->post('egg_no');
            $where_cond_b['std_weight'] = $this->input->post('std_weight');
            $where_cond_b['act_weight'] = $this->input->post('actual_weight');
            $where_cond_b['status'] = $this->input->post('status');
           // $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
            $where_cond_b['weight_gain'] = $this->input->post('weight_gain');
            $where_cond_b['target_vfeed'] = $this->input->post('target_vol');
            $where_cond_b['target_feed'] = $this->input->post('target_no_feed');
            $where_cond_b['actn_feed'] = $this->input->post('actn_feed');
            $where_cond_b['ratio'] = $this->input->post('ratio');
            $where_cond_b['volume'] = $this->input->post('volume');
            $where_cond_b['targetv_day'] = $this->input->post('tv_day');
            $where_cond_b['targetg_day'] = $this->input->post('targetfeed_gday');
            $where_cond_b['actualv_day'] = $this->input->post('actualFeed_vday');
            $where_cond_b['actualf_day'] = $this->input->post('actualFeed_gday');
            $where_cond_b['achieved'] = $this->input->post('achieved');
            $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
			$branch_id = $this->session->userdata('branch_id');

           // $where_cond_b['created_on'] = $this->session->userdata('user_id');
           for($index = 1 ;$index<= $where_cond_b['actn_feed']; $index++){
               $feed = 'feed'.$index;
                $where_cond_f['feed'] = $this->input->post($feed);
                $where_cond_f['feed_date'] = $this->input->post('feed_date');
                //get_handfeed_feed$where_cond_b['feed_date'] = "23-09-2021";
                $where_cond_f['incub_id'] =  $where_cond_b['incub_id'];
                $where_cond_f['species_id'] =  $where_cond_b['species_id'];
                $where_cond_f['branch_id'] =  $branch_id;
                $feed_result = $this->cbmodel->data_add('ckb_handfeed_feed',$where_cond_f);

            }
            $incub_result = $this->cbmodel->data_add('ckb_handfee',$where_cond_b);

           // $id = $this->db->insert_id();
            
            if($incub_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Handfeeding/handfeeding"
                );
                echo json_encode($result);
        
            }
        }

       public function change_brooder(){
           // $where_cond_i['status'] = 0;
            $auto_id = $this->input->post('incub_id');
            $brooder_name = $this->input->post('brooder');
            $branch_id = $this->session->userdata('branch_id');
            $data['auto_id'] = $brooder_name;
            $get_br_dt = $this->cbmodel->verify_data($data,'ckb_brooder');
foreach ($get_br_dt as $br_name){
    $bname = $br_name->brooder_name;
}

            if($bname == "Brooder 35" || $bname == "brooder 35" || $bname == "BROODER 35" ){
                $where_cond_h['status'] = 3;
                $where_cond_h['incub_id'] = $auto_id;
                $where_cond_h['move_35_date'] = $this->input->post('move_date');
                $where_cond_h['move_35_brooder'] = $brooder_name;
                $where_cond_h['branch_id'] = $branch_id;


            $move_result = $this->cbmodel->updates('ckb_move_brooder', $where_cond_h, 'incub_id', $auto_id);
       }
       if($bname == "Brooder 34" || $bname == "brooder 34" || $bname == "BROODER 34" ){
        $where_cond_j['status'] = 2;
        $where_cond_j['incub_id'] = $auto_id;
        $where_cond_j['move_34_date'] = $this->input->post('move_date');
        $where_cond_j['move_34_brooder'] = $brooder_name;
        $where_cond_j['branch_id'] = $branch_id;

    $move_result = $this->cbmodel->updates('ckb_move_brooder', $where_cond_j, 'incub_id', $auto_id);
}
if($bname == "Brooder 33" || $bname == "brooder 33" || $bname == "BROODER 33" ){
    $where_cond_k['status'] = 1;
    $where_cond_k['incub_id'] = $auto_id;
    $where_cond_k['move_33_date'] = $this->input->post('move_date');
    $where_cond_k['move_33_brooder'] = $brooder_name;
    $where_cond_k['branch_id'] = $branch_id;


$move_result = $this->cbmodel->updates('ckb_move_brooder', $where_cond_k, 'incub_id', $auto_id);
}
if($bname == "Brooder 36" || $bname == "brooder 36" || $bname == "BROODER 36" ){
    $where_cond_l['status'] = 0;
    $where_cond_l['incub_id'] = $auto_id;
    $where_cond_l['move_handfeed_date'] = $this->input->post('move_date');
    $where_cond_l['move_handfeed_brooder'] = $brooder_name;
    $where_cond_l['branch_id'] = $branch_id;


$move_result = $this->cbmodel->updates('ckb_move_brooder', $where_cond_l, 'incub_id', $auto_id);
}
      
           //$move_result = $this->cbmodel->data_add('ckb_move_brooder',$where_cond_h);
                
                if($move_result){
                    $result = array(
                        "logstatus" => "success",
                        "url" => "Handfeeding/handfeeding"
                    );
                    echo json_encode($result);
            
                }
        
        }
    
        public function move_pre_weaning(){
           
            $auto_id = $this->input->post('p_id');
            $branch_id = $this->session->userdata('branch_id');

            $where_cond_h['auto_id'] = $auto_id;
            $where_cond_h['branch_id'] = $branch_id;
            $where_cond_h['status'] = 2;
            $where_cond_h['moved_pweaning_date'] = $this->input->post('p_date');
           // $where_cond_h['move_handfeed_brooder'] = $this->input->post('brooder');
            $preWeaning_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'auto_id', $auto_id);
          // $move_result = $this->cbmodel->data_add('ckb_move_brooder',$where_cond_h);
                
                if($preWeaning_result){
                    $result = array(
                        "logstatus" => "success",
                        "url" => "Handfeeding/handfeeding"
                    );
                    echo json_encode($result);
            
                }
        
        }
        public function addHandfeedtemp(){
            $branch_id = $this->session->userdata('branch_id');
    
            $data = array(
                array(
                   'date' => $this->input->post('cur_date'),
                   'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('6am'),
                   //'note_time' => $this->input->post('notetime6'), 
                   'temperature' => $this->input->post('temp6'), 
                   'relative_humidity' => $this->input->post('hum6'), 
                  // 'rotation' => $this->input->post('rotate6'), 
                   'egg_no' => $this->input->post('eggno6'), 
                   'sign' => $this->input->post('user6'), 
                   'branch_id' => $branch_id, 
                   
                   
                   
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('8am'),
                  // 'note_time' => $this->input->post('notetime8'), 
                   'temperature' => $this->input->post('temp8'), 
                   'relative_humidity' => $this->input->post('hum8'), 
                  // 'rotation' => $this->input->post('rotate8'), 
                   'egg_no' => $this->input->post('eggno8'), 
                   'sign' => $this->input->post('user8'), 
                  'branch_id' => $branch_id, 
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('10am'),
                  // 'note_time' => $this->input->post('notetime10'), 
                   'temperature' => $this->input->post('temp10'), 
                   'relative_humidity' => $this->input->post('hum10'), 
                  // 'rotation' => $this->input->post('rotate10'), 
                   'egg_no' => $this->input->post('eggno10'), 
                   'sign' => $this->input->post('user10'), 
                  'branch_id' => $branch_id, 
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('12pm'),
                   //'note_time' => $this->input->post('notetime12p'), 
                   'temperature' => $this->input->post('temp12p'), 
                   'relative_humidity' => $this->input->post('hum12p'), 
                  // 'rotation' => $this->input->post('rotate12p'), 
                   'egg_no' => $this->input->post('eggno12p'), 
                   'sign' => $this->input->post('user12p'), 
                   'branch_id' => $branch_id, 
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('2pm'),
                  // 'note_time' => $this->input->post('notetime2p'), 
                   'temperature' => $this->input->post('temp2p'), 
                   'relative_humidity' => $this->input->post('hum2p'), 
                  // 'rotation' => $this->input->post('rotate2p'), 
                   'egg_no' => $this->input->post('eggno2p'), 
                   'sign' => $this->input->post('user2p'), 
                   'branch_id' => $branch_id, 
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('4pm'),
                  // 'note_time' => $this->input->post('notetime4p'), 
                   'temperature' => $this->input->post('temp4p'), 
                   'relative_humidity' => $this->input->post('hum4p'), 
                  // 'rotation' => $this->input->post('rotate4p'), 
                   'egg_no' => $this->input->post('eggno4p'), 
                   'sign' => $this->input->post('user4p'), 
                   'branch_id' => $branch_id, 

                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('6pm'),
                  // 'note_time' => $this->input->post('notetime6p'), 
                   'temperature' => $this->input->post('temp6p'), 
                   'relative_humidity' => $this->input->post('hum6p'), 
                  // 'rotation' => $this->input->post('rotate6p'), 
                   'egg_no' => $this->input->post('eggno6p'), 
                   'sign' => $this->input->post('user6p'), 
                   'branch_id' => $branch_id, 
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('8pm'),
                   //'note_time' => $this->input->post('notetime8p'), 
                   'temperature' => $this->input->post('temp8p'), 
                   'relative_humidity' => $this->input->post('hum8p'), 
                  // 'rotation' => $this->input->post('rotate8p'), 
                   'egg_no' => $this->input->post('eggno8p'), 
                   'sign' => $this->input->post('user8p'), 
                   'branch_id' => $branch_id, 
                   
                ),
                array(
                    'date' => $this->input->post('cur_date'),
                    'brooder_id' => $this->input->post('brooder_name'),
                   'time' => $this->input->post('10pm'),
                  // 'note_time' => $this->input->post('notetime10p'), 
                   'temperature' => $this->input->post('temp10p'), 
                   'relative_humidity' => $this->input->post('hum10p'), 
                  // 'rotation' => $this->input->post('rotate10p'), 
                   'egg_no' => $this->input->post('eggno10p'), 
                   'sign' => $this->input->post('user10p'), 
                   'branch_id' => $branch_id, 
                ),
                
             );
        //    print_r($data);
        //    exit;
            $incub_result = $this->db->insert_batch('ckb_handfeed_temp', $data);
            
             //exit;
             // $incub_result = $this->cbmodel->data_add('ckb_incubtemp',$data);
    
            
           if($incub_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Handfeeding/list_handfeed_temp"
                );
               echo json_encode($result);
        
            }
        }
public function revert_to_incubation(){
    $egg_no = $this->input->post('egg_no');
    $branch_id = $this->session->userdata('branch_id');

    $where_cond_h['egg_no'] = $egg_no;
    $where_cond_h['branch_id'] = $branch_id;
    $where_cond_h['status'] = 1;
  
   //update in incubation
    $revert_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'egg_no', $egg_no);
  
  
    //delete data in ckb_move_brooder   
     $auto_id = $this->input->post('incub_id');   
    $query1 = $this->db->get_where('ckb_move_brooder', array('incub_id' => $auto_id ));
    $count_in_brooder = $query1->num_rows();
   if($count_in_brooder > 0){
    $where_cond_bed['incub_id'] = $auto_id;
    $table_name  = "ckb_move_brooder";
    $delete_result = $this->cbmodel->delete_data($table_name,$where_cond_bed);
   }
    
    
    if($revert_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Handfeeding/handfeeding"
            );
            echo json_encode($result);
    
        }
}

}//end class
?>
