<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Weaning extends CI_Controller {	
	
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
        $this->load->model('Preweaning_model', 'pwmodel');
        $this->load->model('Weaning_model', 'wmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function weaning(){
		$this->load->view('Weaning/weaning');	
	}
    public function weaning_details(){
		$this->load->view('Weaning/weaning_details');	
	}
    public function view_weaning_details(){
		$this->load->view('Weaning/view_weaning');	
	}
    public function weaning_history(){
        $date=$this->input->post('date');
        $to_date=$this->input->post('to_date');
        $data['wean_history'] = $this->wmodel->get_weaning_history_dt($date,$to_date);
        $data['stunded'] = $this->wmodel->get_stunded_byBirth($date,$to_date);
        $data['stunded_after'] = $this->wmodel->get_stunded_after_birth($date,$to_date);
        $data['from_date']=$date;
        $data['to_date']=$to_date;
        $this->load->view('Weaning/weaning_history',$data);	
	}
    public function weaning_history_view(){
        $date = $this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $datawhere = $this->input->post('type');
				$data['datawhere'] = $datawhere;

        if($datawhere == "all"){
            $array_data ="";
          }
        if($datawhere == "production"){
			$status = "3";
        $array_data['bird_status']="Production";
        
      }
      if($datawhere == "splay_leg"){
		$status = "3";
        $array_data['health_status']="Splay Leg";
      }
      if($datawhere == "airbubble"){
		$status = "3";
        $array_data['health_status']="Airbubble";
      }
      if($datawhere == "mort"){
		$status = "3";
        $array_data['health_status']="Mortality";
      }
      if($datawhere == "sale"){
		$status = "3";
        $array_data['bird_status']="Sale";
      }

	  if($datawhere == "cured"){
	 $status = "3";
		$array_data['health_status']="Cured";
	  }
	  if($datawhere == "yolk_infection"){
	 $status = "3";
		$array_data['health_status']="Yolk sac infection";
	  }
	  if($datawhere == "obesity"){
	 $status = "3";
		$array_data['health_status']="Obesity";
	  }
	  if($datawhere == "ecoli"){
	 $status = "3";
		$array_data['health_status']="E.coli infection";
	  }
	  if($datawhere == "wry_neck"){
	 $status = "3";
		$array_data['health_status']="Wry neck";
	  }
	  if($datawhere == "slow_digest"){
	 $status = "3";
		$array_data['health_status']="Slow digestion";
	  }
	  if($datawhere == "crop_injury"){
	 $status = "3";
		$array_data['health_status']="Crop injury";
	  }
	  if($datawhere == "crop_burn"){
	 $status = "3";
		$array_data['health_status']="Crop burn";
	  }
	  if($datawhere == "oes_injury"){
	 $status = "3";
		$array_data['health_status']="Oesophageal injury";
	  }
	  if($datawhere == "dehydration"){
	 $status = "3";
		$array_data['health_status']="Dehydration";
	  }
	  if($datawhere == "unabsorbed_yolk_sac"){
	 $status = "3";
		$array_data['health_status']="Unabsorbed yolk sac";
	  }
	  if($datawhere == "air_crop"){
	 $status = "3";
		$array_data['health_status']="Air in the crop";
	  }
	  if($datawhere == "air_crop"){
	 $status = "3";
		$array_data['health_status']="Air in the crop";
	  }
	  if($datawhere == "traumatic_injury"){
	 $status = "3";
		$array_data['health_status']="Traumatic injury";
	  }
	  if($datawhere == "stunted_chick"){
	 $status = "3";
		$array_data['health_status']="Stunted chick";
	  }
	  if($datawhere == "reduced_crop_size"){
	 $status = "3";
		$array_data['health_status']="Reduced crop size";
	  }
	  if($datawhere == "splayed_leg"){
	 $status = "3";
		$array_data['health_status']="Splayed leg";
	  }
	  if($datawhere == "fungal_infection"){
	 $status = "3";
		$array_data['health_status']="Fungal infection";
	  }
	
	  if($datawhere == "parasitic_infection"){
		$status = "3";
		   $array_data['health_status']="Parasitic infection";
		 }

		 if($datawhere == "nervous_incoordination"){
			$status = "3";
			   $array_data['health_status']="Nervous incoordination";
			 }
			 if($datawhere == "bacterial_infection"){
				$status = "3";
				   $array_data['health_status']="Bacterial infection";
				 }
				 if($datawhere == "viral_infection"){
					$status = "3";
					   $array_data['health_status']="Viral infection";
					 }
					 if($datawhere == "nervous_coccidiosis"){
						$status = "3";
						   $array_data['health_status']="Nervous Coccidiosis";
						 }
						 if($datawhere == "gout"){
							$status = "3";
							   $array_data['health_status']="Gout";
							 }

							 if($datawhere == "asp_pnuem"){
								$status = "2";
									$array_data['health_status']="Aspiration Pneumonia";
								}
								if($datawhere == "resp_distress"){
									$status = "0";
										$array_data['health_status']="Respiratory distress";
									}

      if($datawhere == "stunt"){
		$status = "3";
      $data['stunded'] = $this->wmodel->get_stunded_byBirth($date,$to_date);
      }
      if($datawhere == "stunt_after"){
		$status = "3";
        $data['stunded_after'] = $this->wmodel->get_stunded_after_birth($date,$to_date);
        }
        if($datawhere != "stunt" && $datawhere != "stunt_after"){
			$status = "3";
      $data['incub_history_view'] = $this->wmodel->get_weaning_historyView_dt($array_data,$date,$to_date,$status);
      }
        
       
        $this->load->view('Weaning/weaning_history_view',$data);	
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
                "url" => "Weaning/weaning"
            );
            echo json_encode($result);
    
        }
    }

    public function weaning_move_sale(){
        $where_cond_i['auto_id'] = $this->input->post('incub_id');   
        $where_cond_i['branch_id'] = $this->session->userdata('branch_id');   
         $get_incub_result['full_detail'] = $this->cbmodel->verify_data($where_cond_i,'ckb_incubation');
         $where_cond_h['incub_id'] = $this->input->post('incub_id'); 
         $where_cond_h['branch_id'] = $this->session->userdata('branch_id'); 
         $get_incub_result['act_weight'] = $this->cbmodel->get_all_data($where_cond_h,'ckb_weaning');

         echo json_encode($get_incub_result);
 
     }
    public function get_weaning_list(){
        $postData = $this->input->post();
        $date=$this->input->post('date');
        $to_date=$this->input->post('to_date');
        $handfeed_result = $this->wmodel->verify_data_weaning_dt($postData,$date,$to_date);
        echo json_encode($handfeed_result);
    }

    public function get_weaning_update(){
        $postData = $this->input->post();
       $postData1 = $this->input->post('incub_id');        
        $get_wean_update_result = $this->wmodel->get_wean_data_byone($postData,$postData1);
        echo json_encode($get_wean_update_result);
       // $this->load->view('Handfeeding/view_handfeed',$get_handfeed_update_result);	

    }
    public function get_weaning_weight(){
       // $postData = $this->input->post();
       $where_cond_bed['incub_id'] = $this->input->post('current_incubid');      
       $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
        $get_wean_update_weight = $this->cbmodel->verify_data($where_cond_bed,'ckb_weaning');
        echo json_encode($get_wean_update_weight);
       // $this->load->view('Handfeeding/view_handfeed',$get_handfeed_update_result);	

    }
    public function get_weaning_byid(){
        $where_cond_i['auto_id'] = $this->input->post('incub_id');    
        $where_cond_i['branch_id'] = $this->session->userdata('branch_id');  
         $get_incub_result = $this->cbmodel->verify_data($where_cond_i,'ckb_incubation');
         echo json_encode($get_incub_result);
 
     }
    
    public function get_wean_feed(){

        $where_cond_bed['status'] = 1;
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_bed['incub_id'] = $this->input->post('current_incubid');
        $where_cond_bed['feed_date'] = $this->input->post('current_date');
        
        $get_prewean_feed_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_weaning_feed');

        echo json_encode($get_prewean_feed_result);
    }
    public function move_production(){
           
        $auto_id = $this->input->post('p_id');
        $where_cond_h['auto_id'] = $auto_id;
        $where_cond_h['status'] = 3;
        $where_cond_h['move_production_date'] = $this->input->post('pr_date');
        $where_cond_h['bird_status'] = "Production";
        $where_cond_h['gender'] = $this->input->post('gender');
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
        $add_bird['weight'] = $this->input->post('pr_weight');
        $add_bird['status'] = 1;
        $add_bird['bird_status'] = $this->input->post('bird_status');
        $add_bird['created_by'] = $this->session->userdata('user_id');
        $add_bird['branch_id'] = $this->session->userdata('branch_id');
        $bird_result = $this->cbmodel->data_add('ckb_bird',$add_bird);

            if($production_result ){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Weaning/weaning"
                );
                echo json_encode($result);
        
            }
    
    }
    public function move_sale(){
           
        $auto_id = $this->input->post('p_id');
        $where_cond_h['auto_id'] = $auto_id;
        $where_cond_h['status'] = 3;
        $where_cond_h['sale_date'] = $this->input->post('pr_date');
        $where_cond_h['bird_status'] = "Sale";
        $where_cond_h['gender'] = $this->input->post('gender');
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
        $add_bird['weight'] = $this->input->post('pr_weight');
        $add_bird['status'] = 1;
        $add_bird['bird_status'] = $this->input->post('bird_status');
        $add_bird['created_by'] = $this->session->userdata('user_id');
        $add_bird['branch_id'] = $this->session->userdata('branch_id');

        $bird_result = $this->cbmodel->data_add('ckb_bird',$add_bird);

            if($production_result && $bird_result ){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Weaning/weaning"
                );
                echo json_encode($result);
        
            }
    
    }


    public function addWeaning(){
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
         $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

        //  $where_cond_b['target_vfeed'] = $this->input->post('target_vol');
        //  $where_cond_b['target_feed'] = $this->input->post('target_no_feed');
        //  $where_cond_b['actn_feed'] = $this->input->post('actn_feed');
        //  $where_cond_b['ratio'] = $this->input->post('ratio');
        //  $where_cond_b['volume'] = $this->input->post('volume');
        //  $where_cond_b['targetv_day'] = $this->input->post('tv_day');
        //  $where_cond_b['targetg_day'] = $this->input->post('targetfeed_gday');
        //  $where_cond_b['actualv_day'] = $this->input->post('actualFeed_vday');
        //  $where_cond_b['actualf_day'] = $this->input->post('actualFeed_gday');
        //  $where_cond_b['achieved'] = $this->input->post('achieved');
        
        // // $where_cond_b['created_on'] = $this->session->userdata('user_id');
        // for($index = 1 ;$index<= $where_cond_b['actn_feed']; $index++){
        //     $feed = 'feed'.$index;
        //      $where_cond_f['feed'] = $this->input->post($feed);
        //      $where_cond_f['feed_date'] = $this->input->post('feed_date');
        //      //get_handfeed_feed$where_cond_b['feed_date'] = "23-09-2021";
        //      $where_cond_f['incub_id'] =  $where_cond_b['incub_id'];
        //      $where_cond_f['species_id'] =  $where_cond_b['species_id'];
        //      $feed_result = $this->cbmodel->data_add('ckb_weaning_feed',$where_cond_f);

        //  }
         $incub_result = $this->cbmodel->data_add('ckb_weaning',$where_cond_b);

        // $id = $this->db->insert_id();
         
         if($incub_result){
             $result = array(
                 "logstatus" => "success",
                 "url" => "Weaning/weaning"
             );
             echo json_encode($result);
     
         }
     }
     public function revert_to_prewean(){
        $egg_no = $this->input->post('egg_no');
        $branch_id = $this->session->userdata('branch_id');
    
        $where_cond_h['egg_no'] = $egg_no;
        $where_cond_h['branch_id'] = $branch_id;
        $where_cond_h['status'] = 2;
      
       //update in incubation
        $revert_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'egg_no', $egg_no);
      
      
       
        
        
        if($revert_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Weaning/weaning"
                );
                echo json_encode($result);
        
            }
    }
}//end class
?>
