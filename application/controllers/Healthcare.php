<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class  Healthcare extends CI_Controller {	
	
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
        $this->load->model('Breeding_model', 'brmodel');
        $this->load->model('Healthcare_model', 'health');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function stund_register(){
		$this->load->view('Healthcare/stund_register');	
	}
    public function view_stund(){
		$this->load->view('Healthcare/view_stund');	
	}
    public function add_treatment(){
		$this->load->view('Healthcare/treatment_register');	
	}
    public function edit_treatment(){
		$this->load->view('Healthcare/edit_treatment');	
	}
	public function edit_mort(){
		$this->load->view('Healthcare/edit_mort');	
	}
    public function view_treatment(){
		$this->load->view('Healthcare/view_treatment');	
	}

     public function shell_register(){
		$this->load->view('Healthcare/shell_register');	
	}
    public function splay_leg_register(){
		$this->load->view('Healthcare/splay_leg_register');	
	}
    public function view_splay(){
		$this->load->view('Healthcare/view_splay');	
	}
    public function mort_register(){
		//$this->load->view('Healthcare/mort_register');	
		$this->load->view('Healthcare/view_mort_old');	
	}
    public function view_shell(){
		$this->load->view('Healthcare/view_shell');	
	}
    public function view_mort(){
		$this->load->view('Healthcare/view_mort');	
	}
    public function edit_healthsetting_samples(){
        $this->load->view('Masters/edit_healthcare_samples');	
    }
    public function add_chick($id){
        $proven_id = $id;
        $proven_result_chick['pro_result'] = $this->brmodel->get_proven_byid($proven_id);
		$this->load->view('Breeding/add_chick',$proven_result_chick);	
	}
    public function view_weaning_details(){
		$this->load->view('Weaning/view_weaning');	
	}
    public function get_samples_setting(){
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');
        $samples_result = $this->cbmodel->verify_data($where_cond_s,'ckb_healthsetting_sample');
        echo json_encode($samples_result);
    }
    public function get_lab_setting(){
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');
        $lab_result = $this->cbmodel->verify_data($where_cond_s,'ckb_healthsetting_lab');
        echo json_encode($lab_result);
    }
    public function get_egg_no(){
       // $status= 1;
        $species_id = $this->input->post('species_id');
        $cage_id = $this->input->post('cage_id');
        $aviary_id = $this->input->post('aviary_id');
		$egg_result = $this->cbmodel->get_birdspecies_eggno($species_id,$cage_id,$aviary_id);
        echo json_encode($egg_result);
    }
	public function get_mortality_eggs(){
		$species_id = $this->input->post('species_id');
        $cage_id = $this->input->post('cage_id');
        $aviary_id = $this->input->post('aviary_id');
		$mort_egg_result = $this->cbmodel->get_birdspecies_mort_eggno($species_id,$cage_id,$aviary_id);
        echo json_encode($mort_egg_result);
	}
    public function get_birdspecies_egg_ring(){
        $status= 1;
         //$species_id = $this->input->post('species_id');
         $cage_id = $this->input->post('cage_id');
         $aviary_id = $this->input->post('aviary_id');
         $egg_result = $this->cbmodel->get_birdspecies_eggandring($status,$cage_id,$aviary_id);
         echo json_encode($egg_result);
     }

     public function get_species_name(){
        $status= 1;
         //$species_id = $this->input->post('species_id');
         $cage_id = $this->input->post('cage_id');
         $aviary_id = $this->input->post('aviary_id');
         $sp_result = $this->cbmodel->get_speciesname_eggandring($status,$cage_id,$aviary_id);
         echo json_encode($sp_result);
     }
     public function get_egg_ring(){
       // $status= 1;
         $species_id = $this->input->post('species_id');
         $cage_id = $this->input->post('cage_id');
         $aviary_id = $this->input->post('aviary_id');
      //  echo $species_id;
         $egg_ringno = $this->cbmodel->get_eggandring_no($species_id,$cage_id,$aviary_id);
         echo json_encode($egg_ringno);
     }
	
     public function get_treatment_byid(){
          $id = $this->input->post('treatment_id');
          $treatment_dt = $this->health->get_temp_id($id);
          echo json_encode($treatment_dt);
      }
	  public function get_mort_byid(){
		$id = $this->input->post('mort_id');
		$mort_dt = $this->health->get_mort_id($id);
		echo json_encode($mort_dt);
	}
      public function get_handfeed_details(){
        // $status= 1;
          $incub_id['incub_id'] = $this->input->post('incub_id');
          $incub_id['branch_id'] = $this->session->userdata('branch_id');
          $moved_date = $this->health->get_handfeed_dt($incub_id);
          echo json_encode($moved_date);
      }
     public function get_egg_details(){ //get egg details from egg number on incubation table
          $where_data['egg_no'] = $this->input->post('egg_no');
          $where_data['branch_id'] = $this->session->userdata('branch_id');

          $egg_details['full_egg_result'] = $this->health->get_eggs_incub($where_data);
if(!empty($egg_details['full_egg_result'])){
         foreach ( $egg_details['full_egg_result']  as  $value){
         $male_parent_ringno = $value->male_parent_ringno;
         $female_parent_ringno = $value->female_parent_ringno;
         }
         if($value->status == 0){
         $egg_details['act_weight'] = $this->cbmodel->get_all_data($where_data,'ckb_handfee');
         }
         if($value->status == 2){
            $egg_details['act_weight'] = $this->cbmodel->get_all_data($where_data,'ckb_preweaning');
            }
            if($value->status == 3){
                $egg_details['act_weight'] = $this->cbmodel->get_all_data($where_data,'ckb_weaning');
                }
            $query = $this->db->get_where('ckb_healthcare_stunt', array('mp_ring' => $male_parent_ringno ));
            $query1 = $this->db->get_where('ckb_healthcare_stunt', array('fp_ring' => $female_parent_ringno ));
            $count_male = $query->num_rows();
            $count_female = $query1->num_rows();
            $egg_details['male_ring_count'] = $count_male;
            $egg_details['female_ring_count'] = $count_female;

            $egg_no = $this->input->post('egg_no');
            $egg_details['clutch_no'] = $this->health->get_eggs_clutch($egg_no);
            $egg_details['eggno_in_clutch'] = $this->health->get_eggno_inclutch($egg_no);
			$egg_details['inf'] ="incubation";
			}
			else{
				$where_cond_s['ring_no'] = $this->input->post('egg_no');
				$egg_details['bird'] = $this->cbmodel->verify_data($where_cond_s,'ckb_bird');				
				$egg_details['inf'] ="bird";
			}
          echo json_encode($egg_details);
      }
public function get_mortality_egg_details(){
	
	$egg_no= $this->input->post('egg_no');


	$query = $this->db->get_where('ckb_incubation', array('egg_no' => $egg_no ));
	$check = $query->num_rows();
	if($check > 0){
		$where_data['egg_no'] = $this->input->post('egg_no');
		$where_data['branch_id'] = $this->session->userdata('branch_id');
		$egg_details['full_egg_result'] = $this->health->get_eggs_incub($where_data);	
	}
	else{
		$where_data1['ring_no'] = $this->input->post('egg_no');
		$where_data1['branch_id'] = $this->session->userdata('branch_id');
		$egg_details['full_egg_result'] = $this->health->get_eggs_bird($where_data1);	
		
	}
	echo json_encode($egg_details);

}
      public function get_egg_clutch(){ //get clutch details from egg number on ckb_breeding_proven
        $egg_no = $this->input->post('egg_no');
        $egg_clutch['clutch_no'] = $this->health->get_eggs_clutch($egg_no);
        $egg_clutch['eggno_in_clutch'] = $this->health->get_eggno_inclutch($egg_no);
        echo json_encode($egg_clutch);
    }
   
    public function get_parents_history(){ //get clutch details from egg number on ckb_breeding_proven
       // $mp_ring = $this->input->post('mp_ring');
       // $fp_ring = $this->input->post('fp_ring');
       $data['mp_ring'] = $this->input->post('mp_ring');
        $data['fp_ring'] = $this->input->post('fp_ring');
        $data['branch_id'] = $this->session->userdata('branch_id');
        $parents_history = $this->health->parents_history_dt($data);
        echo json_encode($parents_history);
    }
  
   
    public function get_stunt_list(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $ring= $this->input->post('ring');
        $sp= $this->input->post('sp');
        $get_stunt_result = $this->health->get_stunt_register_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp);
        echo json_encode($get_stunt_result);
    }
    public function get_splay_list(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $ring= $this->input->post('ring');
        $sp= $this->input->post('sp');
        $get_splay_result = $this->health->get_splay_register_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp);
        echo json_encode($get_splay_result);
    }
    public function get_treatment_list(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $ring= $this->input->post('ring');
        $sp= $this->input->post('sp');
        $get_temp_result = $this->health->treatment_register_get($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp);
        echo json_encode($get_temp_result);
    }

    public function get_shell_list(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $ring= $this->input->post('ring');
        $sp= $this->input->post('sp');
        $get_shell_result = $this->health->shell_register_get($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp);
        echo json_encode($get_shell_result);
    }
    public function get_mort_list(){
        $postData = $this->input->post();
        // $date = $this->input->post('date');
        // $to_date = $this->input->post('to_date');
        // $aviary_id = $this->input->post('avairy');
        // $cage_id= $this->input->post('cage');
        // $ring= $this->input->post('ring');
        $egg_no= $this->input->post('egg_no');
        $get_shell_result = $this->health->mort_register_get($postData,$egg_no);
        echo json_encode($get_shell_result);
    }
    
    public function get_mortality_all(){
		$postData = $this->input->post();
		$get_mort_result = $this->health->get_all_mortaility_dt($postData);
        echo json_encode($get_mort_result);
	}

    
     public function add_stunt_register(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_stunt');
        if($get_cur_auto_id == "false"){
           $auto_id="HS001";
        }
       else{
       $auto_id = "HS".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

        $where_cond_b['stund_date'] = $this->input->post('stund_date');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['bird_species'] = $this->input->post('bird_species');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
        $where_cond_b['hatch_date'] = $this->input->post('hatch_date');
        $where_cond_b['mp_ring'] = $this->input->post('mp_ring');
        $where_cond_b['no_mp_ring'] = $this->input->post('no_mp_ring');
        $where_cond_b['fp_ring'] = $this->input->post('fp_ring');
        $where_cond_b['no_fp_ring'] = $this->input->post('no_fp_ring');
        $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
        $where_cond_b['std_egg_weight'] = $this->input->post('std_egg_weight');
        $where_cond_b['hatch_weight'] = $this->input->post('hatch_weight'); 
        $where_cond_b['std_hatch_weight'] = $this->input->post('std_hatch_weight');       
         $where_cond_b['age'] = $this->input->post('age');
         $where_cond_b['body_weight'] = $this->input->post('body_weight');

        $where_cond_b['clutch_no'] = $this->input->post('clutch_no');
        $where_cond_b['egg_no_clutch'] = $this->input->post('egg_no_clutch');
        $where_cond_b['stunt_f_day'] = $this->input->post('stunt_f_day');
        $where_cond_b['std_wean_days'] = $this->input->post('std_wean_days');
        $where_cond_b['handfeed_chick_issue'] = $this->input->post('handfeed_chick_issue');

        $where_cond_b['c_m_adapt'] = $this->input->post('c_m_adapt');
        $where_cond_b['status'] = $this->input->post('status');

        $stunt_result = $this->cbmodel->data_add('ckb_healthcare_stunt',$where_cond_b);

       // $id = $this->db->insert_id();
        
        if($stunt_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Healthcare/view_stund"
            );
            echo json_encode($result);
    
        }
    }
    public function add_splayleg_register(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_splay');
        if($get_cur_auto_id == "false"){
           $auto_id="SP001";
        }
       else{
       $auto_id = "SP".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['splay_date'] = $this->input->post('splay_date');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['bird_species'] = $this->input->post('bird_species');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
        $where_cond_b['hatch_date'] = $this->input->post('hatch_date');
        $where_cond_b['mp_ring'] = $this->input->post('mp_ring');
        $where_cond_b['no_mp_ring'] = $this->input->post('no_mp_ring');
        $where_cond_b['fp_ring'] = $this->input->post('fp_ring');
        $where_cond_b['no_fp_ring'] = $this->input->post('no_fp_ring');
        $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
        $where_cond_b['std_egg_weight'] = $this->input->post('std_egg_weight');
        $where_cond_b['hatch_weight'] = $this->input->post('hatch_weight');
     
        $where_cond_b['std_hatch_weight'] = $this->input->post('std_hatch_weight');
       // $where_cond_b['clutch_no'] = $this->input->post('clutch_no');
      //  $where_cond_b['egg_no_clutch'] = $this->input->post('egg_no_clutch');
        $where_cond_b['detect_date'] = $this->input->post('detect_date');
      //  $where_cond_b['std_wean_days'] = $this->input->post('std_wean_days');
       // $where_cond_b['handfeed_chick_issue'] = $this->input->post('handfeed_chick_issue');

        $where_cond_b['c_m_adapt'] = $this->input->post('c_m_adapt');
        $where_cond_b['status'] = $this->input->post('status');

        $splay_result = $this->cbmodel->data_add('ckb_healthcare_splay',$where_cond_b);

       // $id = $this->db->insert_id();
        
        if($splay_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Healthcare/view_splay"
            );
            echo json_encode($result);
    
        }
    }
    public function add_treatment_form(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_treatment');
        if($get_cur_auto_id == "false"){
           $auto_id="HT001";
        }
       else{
       $auto_id = "HT".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }
       $where_cond_b['auto_id'] = $auto_id;
       $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['date'] = $this->input->post('date');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['bird_count'] = $this->input->post('bird_count');
        $where_cond_b['bird_species'] = $this->input->post('bird_species');
        $where_cond_b['eegring_no'] = $this->input->post('eegring_no');
        $where_cond_b['division'] = $this->input->post('division');
        $where_cond_b['age'] = $this->input->post('age');
        $where_cond_b['sex'] = $this->input->post('sex');
        $where_cond_b['therapy_schedule'] = $this->input->post('therapy_schedule');
        $where_cond_b['anamnesis'] = $this->input->post('anamnesis');
        $where_cond_b['body_weight'] = $this->input->post('body_weight');
        $where_cond_b['bcs'] = $this->input->post('bcs');
        $where_cond_b['physical_examination'] = $this->input->post('physical_examination');
     
        $where_cond_b['samples_collected'] = $this->input->post('samples_collected');
        $where_cond_b['lab_diagnostics'] = $this->input->post('lab_diagnostics');
        $where_cond_b['inferences'] = $this->input->post('inferences');
        $where_cond_b['medication_details'] = $this->input->post('medication_details');
       

        $treat_result = $this->cbmodel->data_add('ckb_healthcare_treatment',$where_cond_b);
      // echo $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_treatment');
     //echo $id = $this->db->insert_id();
        
        if($treat_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Healthcare/view_treatment"
            );
            echo json_encode($result);
    
        }
    }
    public function add_shell_register(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_shell');
        if($get_cur_auto_id == "false"){
           $auto_id="AT001";
        }
       else{
       $auto_id = "AT".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['shell_date'] = $this->input->post('shell_date');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['bird_species'] = $this->input->post('bird_species');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
        $where_cond_b['dis_date'] = $this->input->post('dis_date');
        $where_cond_b['bos_date'] = $this->input->post('bos_date');
        $where_cond_b['mp_ring'] = $this->input->post('mp_ring');
        $where_cond_b['fp_ring'] = $this->input->post('fp_ring');
        $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
        $where_cond_b['std_egg_weight'] = $this->input->post('std_egg_weight');
        $where_cond_b['egg_shell_weight'] = $this->input->post('egg_shell_weight');
     
        $where_cond_b['egg_shell_thick'] = $this->input->post('egg_shell_thick');
        $where_cond_b['clutch_no'] = $this->input->post('clutch_no');
        $where_cond_b['egg_no_clutch'] = $this->input->post('egg_no_clutch');
        $where_cond_b['egg_lb'] = $this->input->post('egg_lb');
        $where_cond_b['membrane_integrity'] = $this->input->post('membrane_integrity');
        $where_cond_b['edema'] = $this->input->post('edema');
        $where_cond_b['hemo'] = $this->input->post('hemo');
        $where_cond_b['yolk'] = $this->input->post('yolk');
        $where_cond_b['dis_type'] = $this->input->post('dis_type');
        $where_cond_b['inference'] = $this->input->post('inference');

        if(!empty($_FILES['video_bos']['name'])){
            $config['upload_path'] = 'uploads/video/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['file_name'] = $_FILES['video_bos']['name'];
            
            //Load upload library and initialize here configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('video_bos')){
                $uploadData = $this->upload->data();
                $profile_video = $uploadData['file_name'];
            }else{
                $profile_video = '';
            }
        }else{
            $profile_video = 'empty';
        }
        //$update_id = $this->input->post('bird_id');
        $where_cond_b['video_bos'] = $profile_video;


        $shell_result = $this->cbmodel->data_add('ckb_healthcare_shell',$where_cond_b);

       // $id = $this->db->insert_id();
        
        if($shell_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Healthcare/view_shell"
            );
            echo json_encode($result);
    
        }
    }
    public function add_mort_register(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_mort');
        if($get_cur_auto_id == "false"){
           $auto_id="MT001";
        }
       else{
       $auto_id = "MT".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }
       $where_cond_b['auto_id'] = $auto_id;
       $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['mort_date'] = $this->input->post('mort_date');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['bird_species'] = $this->input->post('bird_species');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
        $where_cond_b['division'] = $this->input->post('division');
        $where_cond_b['age'] = $this->input->post('age');
        $where_cond_b['sex'] = $this->input->post('sex');
        $where_cond_b['history'] = $this->input->post('history');
        $where_cond_b['carcass_weight'] = $this->input->post('carcass_weight');
        $where_cond_b['bcs'] = $this->input->post('bcs');
        $where_cond_b['pm_lesions'] = $this->input->post('pm_lesions');
     
        $where_cond_b['tentative_diagnosis'] = $this->input->post('tentative_diagnosis');
        $where_cond_b['confirmative_diagnosis'] = $this->input->post('confirmative_diagnosis');
        $where_cond_b['cause_categorization'] = $this->input->post('cause_categorization');
      
        if(!empty($_FILES['video_mort']['name'])){
            $config['upload_path'] = 'uploads/video/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['file_name'] = $_FILES['video_mort']['name'];
            
            //Load upload library and initialize here configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('video_mort')){
                $uploadData = $this->upload->data();
                $profile_video = $uploadData['file_name'];
            }else{
                $profile_video = '';
            }
        }else{
            $profile_video = 'empty';
        }
        //$update_id = $this->input->post('bird_id');
        $where_cond_b['video_mort'] = $profile_video;

        $mort_result = $this->cbmodel->data_add('ckb_healthcare_mort',$where_cond_b);
      // echo $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthcare_treatment');
     //echo $id = $this->db->insert_id();
        
        if($mort_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Healthcare/view_mort"
            );
            echo json_encode($result);
    
        }
    }

    public function add_samples(){
		$this->form_validation->set_rules('samples_name', 'Sampples Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			//$pay = $this->masters_model->get_table('tbl_payroll');
			//$data['pay'] = $pay;
			//$this->load->view('admin/add_activity' , $data);
			 
		}else{
            $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthsetting_sample');
        if($get_cur_auto_id == "false"){
           $auto_id="SM001";
        }
       else{
       $auto_id = "SM".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }
			$data['auto_id']   		= $auto_id;
			$data['samples_name']   	= $this->input->post('samples_name', TRUE);
			$data['samples_date']   	= $this->input->post('samples_date', TRUE);
			$data['test_for']   	= $this->input->post('test_for', TRUE);
			$data['inference']   	= $this->input->post('inference', TRUE);
			$data['result']   	= $this->input->post('result', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
            $data['branch_id'] = $this->session->userdata('branch_id');
			$data['status']  		= 1;

			$this->masters_model->insert_data('ckb_healthsetting_sample', $data);
			$this->session->set_flashdata('message', ('Samples has been Added!'));
			redirect(base_url('index.php/Masters/samples_collected'));

	}

    }

    public function edit_healthcare_samples($param){
		
		if ($param == "update") { //u[date link]
			$update_id =  $this->input->post('a_id');
			$avi_info = $this->masters_model->get_table_row('ckb_healthsetting_sample', 'id', $update_id);
			
			//get the form values
			$data['samples_name']   	= $this->input->post('samples_name', TRUE);
			$data['test_for']   	= $this->input->post('test_for', TRUE);
			$data['inference']   	= $this->input->post('inference', TRUE);
			$data['result']   	= $this->input->post('result', TRUE);
            $data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_healthsetting_sample', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Samples List has been Updated!'));


			redirect(base_url('index.php/Masters/samples_collected'));
		}
        //Edit link
        $data['avi_info'] = $this->masters_model->get_table_row('ckb_healthsetting_sample', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
        $this->load->view('Masters/edit_healthcare_samples' , $data);

    }
    public function inactive_samples(){
		$avi_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_healthsetting_sample', $data, 'id', $avi_id);
		$this->session->set_flashdata('error', ('The Samples collected Inactive successfully !'));
		
		}
		
		
		public function active_samples(){
		$avi_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_healthsetting_sample', $data, 'id', $avi_id);
		$this->session->set_flashdata('message', ('The Samples collected Active successfully !'));
		//redirect(base_url('employee/employee_list'));
		
		}

        public function add_lab_diag(){
            $this->form_validation->set_rules('diag_name', 'lab Diagnostics Name', 'required');
            
            if ($this->form_validation->run() == FALSE){
                //$pay = $this->masters_model->get_table('tbl_payroll');
                //$data['pay'] = $pay;
                //$this->load->view('admin/add_activity' , $data);
                 
            }else{
                $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_healthsetting_sample');
                if($get_cur_auto_id == "false"){
                   $auto_id="LB001";
                }
               else{
               $auto_id = "LB".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
               }
                $data['auto_id']   		=  $auto_id;
                $data['diag_name']   	= $this->input->post('diag_name', TRUE);
                $data['created_by']   	= $this->input->post('created_by', TRUE);
                $data['branch_id'] = $this->session->userdata('branch_id');
                $data['status']  		= 1;
    
                $this->masters_model->insert_data('ckb_healthsetting_lab', $data);
                $this->session->set_flashdata('message', ('lab Diagnostics has been Added!'));
                redirect(base_url('index.php/Masters/lab_diag'));
    
        }
    
        }
        public function edit_healthcare_lab($param){
		
            if ($param == "update") { //u[date link]
                $update_id =  $this->input->post('a_id');
                $avi_info = $this->masters_model->get_table_row('ckb_healthsetting_lab', 'id', $update_id);
                
                //get the form values
                $data['diag_name']   	= $this->input->post('diag_name', TRUE);
                $data['branch_id'] = $this->session->userdata('branch_id');
                //$data['status']  		= 1;
                
                $this->masters_model->updates('ckb_healthsetting_lab', $data, 'id', $update_id);
                
                $this->session->set_flashdata('message', ('Samples List has been Updated!'));
    
    
                redirect(base_url('index.php/Masters/lab_diag'));
            }
            //Edit link
            $data['avi_info'] = $this->masters_model->get_table_row('ckb_healthsetting_lab', 'id', $param);
            //echo "<pre>";print_r($data['avi_info']);exit;
            $this->load->view('Masters/edit_healthcare_lab', $data);
        }

        public function inactive_lab(){
            $avi_id  =   $this->input->post('inactive_id');
            $data['status'] = 0;
            $this->masters_model->updates('ckb_healthsetting_lab', $data, 'id', $avi_id);
            $this->session->set_flashdata('error', ('The Lab Diagnostics Inactive successfully !'));
            
            }
            
            
            public function active_lab(){
            $avi_id  =   $this->input->post('active_id');
            $data['status'] = 1;
            $this->masters_model->updates('ckb_healthsetting_lab', $data, 'id', $avi_id);
            $this->session->set_flashdata('message', ('The Diagnostics collected Active successfully !'));
            //redirect(base_url('employee/employee_list'));
            
            }
            public function update_delete_status(){
                $id  =   $this->input->post('id');
                $table = $this->input->post('table');
                $where_con['static_status'] = 0;
                $br_ch_result = $this->cbmodel->updates($table, $where_con, 'id', $id);
                if($br_ch_result){
                    $result = array(
                        "logstatus" => "success",
                    );
                    echo json_encode($result);
            
                }
            }
}//end class
?>
