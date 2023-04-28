<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class  Breeding extends CI_Controller {	
	
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

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function view_proven(){
		//$this->load->view('Breeding/proven');
		$this->load->view('Breeding/bird_proven');	
	}
    public function non_proven(){
		//$this->load->view('Breeding/non-proven');	
		$this->load->view('Breeding/bird_non-proven');	
	}
    public function add_proven(){
		$this->load->view('Breeding/add_proven');	
		
	}
    public function add_nproven(){
		$this->load->view('Breeding/add_non-proven');	
	}
    public function view_incubation(){
		$this->load->view('Breeding/view_incubation');	
	}
    public function proven_history(){
        $fdate=$this->input->post('fdate');
        $tdate=$this->input->post('tdate');
        $data['proven_history'] = $this->brmodel->get_proven_history_dt($fdate,$tdate);
		$this->load->view('Breeding/proven_history',$data);	
	}
    public function get_incubation_list(){
        $postData = $this->input->post();
        // $species_id = $this->input->post('species_id');
        // $cage_id = $this->input->post('cage');
        // $aviary_id = $this->input->post('aviary_id');
		$ring_no = $this->input->post('ring_no');
        $egg_result = $this->brmodel->verify_data_incubation_dt( $postData,$ring_no);
        echo json_encode( $egg_result);
       // print_r($data);
       // exit;
	}
    public function add_chick($id){
        $proven_id = $id;
        $proven_result_chick['pro_result'] = $this->brmodel->get_proven_byid($proven_id);
		$this->load->view('Breeding/add_chick',$proven_result_chick);	
	}
    public function add_clutch(){
		$ring_no = $this->input->post('ring_no');
        $data['clutch_result'] = $this->brmodel->get_cltuch_byring($ring_no);
		$this->load->view('Breeding/clutch_history',$data);	
	}
    public function view_weaning_details(){
		$this->load->view('Weaning/view_weaning');	
	}

    public function get_ring_av(){
        $status= 1;
        $species_id = $this->input->post('species_id');
        $cage_id = $this->input->post('cage_id');
        $aviary_id = $this->input->post('aviary_id');
		$ring_result = $this->cbmodel->get_birdspecies_ringbycage($status,$species_id,$cage_id,$aviary_id);
        echo json_encode($ring_result);
    }
    public function get_clutch_no(){
       // $status= 1;
        $species_id = $this->input->post('species_id');
        $cage_id = $this->input->post('cage_id');
        $aviary_id = $this->input->post('aviary_id');
		$chick_result = $this->brmodel->get_birdspecies_clutchbycage($species_id,$cage_id,$aviary_id);
        echo json_encode($chick_result);
    }
   
    public function get_proven_all(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
      // $date = date($date);
      // echo $date;
      // exit;
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $clutch= $this->input->post('clutch');
        $sp= $this->input->post('sp');
        $getproven_result = $this->brmodel->verify_data_proven_dt($postData,$date,$to_date,$aviary_id,$cage_id,$clutch,$sp);
        echo json_encode($getproven_result);
    }
    public function get_nonproven_all(){
        $postData = $this->input->post();
        $date = $this->input->post('date');
      // $date = date($date);
      // echo $date;
      // exit;
        $to_date = $this->input->post('to_date');
        $aviary_id = $this->input->post('avairy');
        $cage_id= $this->input->post('cage');
        $ring= $this->input->post('ring');
        $sp= $this->input->post('sp');
        $getnonproven_result = $this->brmodel->verify_data_nonproven_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp);
        echo json_encode($getnonproven_result);
    }

    public function get_weaning_update(){
        $postData = $this->input->post();
       $postData1 = $this->input->post('incub_id');        
        $get_wean_update_result = $this->wmodel->get_wean_data_byone($postData,$postData1);
        echo json_encode($get_wean_update_result);
       // $this->load->view('Handfeeding/view_handfeed',$get_handfeed_update_result);	

    }
    public function get_total_eggs(){
      
          
       $data['aviary_id'] = $this->input->post('aviary_id');
       $data['cage']= $this->input->post('cage_id');
       $data['species_id']= $this->input->post('species_id');
       $data['i.branch_id'] = $this->session->userdata('branch_id');

       $get_total_eggs = $this->brmodel->get_eggs_incub($data); 
       $get_names = $this->brmodel->get_av_names($data); 
       if($get_total_eggs){
           echo json_encode($get_total_eggs);
         // echo "success";
       }
       else{
        echo json_encode($get_names);
       }
       // echo json_encode($get_total_eggs);
     

    }
    public function get_birdspecies_fm(){
        
        // $where_cond_s['aviary_id'] = $this->input->post('aviary_id');
        // $where_cond_s['cage'] = $this->input->post('cage_id');
        // $where_cond_s['i.branch_id'] = $this->session->userdata('branch_id');

       // $where_cond_s['status'] = 1;

	    $aviary_id = $this->input->post('aviary_id');
         $cage = $this->input->post('cage_id');
        $branch_id = $this->session->userdata('branch_id');
		$speciesfm_result = $this->brmodel->get_birdspecies_dt($aviary_id,$cage,$branch_id);

        echo json_encode($speciesfm_result);
    }
	public function get_birdmanage_species(){
		  $aviary_id = $this->input->post('aviary_id');
          $cage = $this->input->post('cage_id');
         $branch_id = $this->session->userdata('branch_id');
		$species_bird_result = $this->brmodel->get_birsmanage_sp($aviary_id,$cage,$branch_id);
        echo json_encode($species_bird_result);
	}
	public function get_birdmanage_species_count(){
		$aviary_id = $this->input->post('aviary_id');
		$cage = $this->input->post('cage_id');
	   $branch_id = $this->session->userdata('branch_id');
	  $species_bird_count = $this->brmodel->get_birsmanage_sp_count($aviary_id,$cage,$branch_id);
	 // $species_bird_count = $species_bird_count->num_rows();
	  echo json_encode($species_bird_count);
  }
    public function get_proven_egg(){

        
        $where_cond_bed['auto_id'] = $this->input->post('proven_id');
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');

        $get_egg_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_breeding_proven');

        echo json_encode($get_egg_result);
    }
    public function move_weaning(){
           
        $auto_id = $this->input->post('p_id');
        $where_cond_h['auto_id'] = $auto_id;
        $where_cond_h['status'] = 3;
        $where_cond_h['moved_weaning_date'] = $this->input->post('p_date');
        $where_cond_h['branch_id'] = $this->session->userdata('branch_id');
       // $where_cond_h['move_handfeed_brooder'] = $this->input->post('brooder');
        $preWeaning_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'auto_id', $auto_id);
      // $move_result = $this->cbmodel->data_add('ckb_move_brooder',$where_cond_h);
            
            if($preWeaning_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Preweaning/preweaning"
                );
                echo json_encode($result);
        
            }
    
    }


    public function add_breeding_proven(){
         $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_breeding_proven');
         if($get_cur_auto_id == "false"){
            $auto_id="BP001";
         }
        else{
        $auto_id = "BP".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
        }
 
         $where_cond_b['auto_id'] = $auto_id;
         $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
         $where_cond_b['cage_id'] = $this->input->post('cage');
         $where_cond_b['species_id'] = $this->input->post('bird_species');
         $where_cond_b['clutch_no'] = $this->input->post('clutch_no');
         $where_cond_b['total_eggs'] = $this->input->post('total_eggs');
         $where_cond_b['eggs_broken'] = $this->input->post('brn_egg');
         $where_cond_b['eggs_if'] = $this->input->post('if_egg');
         $where_cond_b['eggs_dis'] = $this->input->post('dis_egg');
         $where_cond_b['egg_hatch'] = $this->input->post('hatch_egg');
         $where_cond_b['last_date'] = $this->input->post('last_date');
         $where_cond_b['cfirst_date'] = $this->input->post('first_date');
         $where_cond_b['clutch_int'] = $this->input->post('clutch_int');
         $where_cond_b['avg_days'] = $this->input->post('avg_day');
         $where_cond_b['avg_weight'] = $this->input->post('avg_weight');
         $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

         $egg_no_incub = $this->input->post('incub[]');
         $egg_no_clutch = $this->input->post('egg_clutch[]');
         $mp_ring = $this->input->post('male_parent_ring[]');
         $fp_ring = $this->input->post('female_parent_ring[]');
        // print_r($egg_no_incub);
      $val = count($egg_no_incub);
      //echo $val;
      $branch_id = $this->session->userdata('branch_id');
  for ($i=0; $i < $val ; $i++) {
   // $where_cond_e['breed_id'] = $auto_id;
    $where_cond_e['clutch_no'] = $this->input->post('clutch_no');
    $where_cond_e['total_eggs'] = $this->input->post('total_eggs');
    $where_cond_e['eggs_broken'] = $this->input->post('brn_egg');
    $where_cond_e['eggs_if'] = $this->input->post('if_egg');
    $where_cond_e['eggs_dis'] = $this->input->post('dis_egg');
    $where_cond_e['egg_hatch'] = $this->input->post('hatch_egg');
    $where_cond_e['aviary_id'] = $this->input->post('aviary_id');
    $where_cond_e['species_id'] = $this->input->post('bird_species');
    $where_cond_e['cage_id'] =$this->input->post('cage');
    $where_cond_e['egg_no'] = $egg_no_incub[$i];
    $where_cond_e['eggno_in_clutch'] = $egg_no_clutch[$i];
    $where_cond_e['mp_ring'] = $mp_ring[$i];
    $where_cond_e['fp_ring'] = $fp_ring[$i];
    $where_cond_e['branch_id'] = $branch_id;
    $data['clutch_status']   	= "clutched";
    $update_clutched = $this->masters_model->updates('ckb_incubation', $data, 'egg_no', $egg_no_incub[$i]);
   $clutch_result = $this->cbmodel->data_add('ckb_egg_clutch',$where_cond_e);
  
  
  }

         $laid_date = $this->input->post('laid_date[]');
         $egg_weight = $this->input->post('egg_weight[]');
         $dys_bw = $this->input->post('dys_bw[]');
         $eggno_incub = $this->input->post('incub[]');
      
           $laidAr = json_encode($laid_date);
           $eggAr = json_encode($egg_weight);
           $dAr  = json_encode($dys_bw);
           $eggno_incubAr  = json_encode($eggno_incub);

            $where_cond_b['laid_date'] = str_replace('"', '', $laidAr);
            $where_cond_b['egg_weight'] = str_replace('"', '', $eggAr);
            $where_cond_b['days_bw'] = str_replace('"', '', $dAr);
            $where_cond_b['eggno_incub'] = str_replace('"', '', $eggno_incubAr);

           $eggno_broken = $this->input->post('br[]');
           $where_cond_b['eggno_broken'] = json_encode($eggno_broken);
      
            $eggno_if = $this->input->post('if[]');
            $where_cond_b['eggno_if'] = json_encode($eggno_if);
     
           $eggno_dis = $this->input->post('dis[]');
           $where_cond_b['eggno_dis'] = json_encode($eggno_dis);
       
          $eggno_hatch = $this->input->post('hatch[]');
          $where_cond_b['eggno_hatch'] = json_encode($eggno_hatch);

          
         $proven_result = $this->cbmodel->data_add('ckb_breeding_proven',$where_cond_b);

        // $id = $this->db->insert_id();
         
         if($proven_result){
             $result = array(
                 "logstatus" => "success",
                 "url" => "Breeding/view_proven"
             );
             echo json_encode($result);
     
         }
     }
     public function add_nonproven(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_breeding_nonproven');
        if($get_cur_auto_id == "false"){
           $auto_id="NP001";
        }
       else{
       $auto_id = "NP".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage_id'] = $this->input->post('cage');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
      //  $where_cond_b['clutch_no'] = $this->input->post('clutch_no');
        $where_cond_b['ring_no'] = $this->input->post('ring_no');
        $where_cond_b['gender'] = $this->input->post('gender');
        $where_cond_b['dna_sex'] = $this->input->post('dna_sex');
        $where_cond_b['pair_date'] = $this->input->post('pair_date');
        $where_cond_b['pair_type'] = $this->input->post('pair_type');
        $where_cond_b['bond'] = $this->input->post('bond');
        $where_cond_b['preening'] = $this->input->post('preening');
        $where_cond_b['fw_dom'] = $this->input->post('fw_dom');
        $where_cond_b['food_sh'] = $this->input->post('food_sh');
     
        $where_cond_b['nx_int'] = $this->input->post('nx_int');
        $where_cond_b['sb_nest'] = $this->input->post('sb_nest');
        $where_cond_b['db_nest'] = $this->input->post('db_nest');
        $where_cond_b['breed_nest'] = $this->input->post('breed_nest');
        $where_cond_b['ent_nest'] = $this->input->post('ent_nest');
        $where_cond_b['mm_perch'] = $this->input->post('mm_perch');

        $where_cond_b['bs_mat'] = $this->input->post('bs_mat');
        $where_cond_b['ew_mat'] = $this->input->post('ew_mat');
        $where_cond_b['egg_lay_mat'] = $this->input->post('egg_lay_mat');
        $where_cond_b['egg_p'] = $this->input->post('egg_p');
        $where_cond_b['fertile_type'] = $this->input->post('fertile_type');
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
       // $where_cond_b['mm_perch'] = $this->input->post('mm_perch');
      


      
        
        $nonproven_result = $this->cbmodel->data_add('ckb_breeding_nonproven',$where_cond_b);

       // $id = $this->db->insert_id();
        
        if($nonproven_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Breeding/non_proven"
            );
            echo json_encode($result);
    
        }
    }
    public function delete_breeding_proven(){
        $b_id  =   $this->input->post('id');
		$where_breed['status'] = 0;
        $br_ch_result = $this->cbmodel->updates('ckb_breeding_proven', $where_breed, 'id', $b_id);

        $egg_no  =   $this->input->post('egg_no');
     //   $egg_no = str_replace( array('[',']') , ''  , $egg_no );
        $egg_no  = json_decode($egg_no);
       // print_r($egg_no);
        $val = count($egg_no);
     // echo $val;
     // echo $egg_no[0];
    for ($i=0; $i < $val ; $i++) {
        $egg_no_incub = $egg_no[$i];
      //  print_r($egg_no_incub);
        $where_cond_i["clutch_status"] = ""; //unclutched
        $br_ch_result1 = $this->cbmodel->updates('ckb_incubation', $where_cond_i, 'egg_no', $egg_no_incub);

       // $where_cond_bed['egg_no'] =$egg_no[$i];
        $table_name  ="ckb_egg_clutch";

        $delete_result = $this->cbmodel->delete_id($table_name,'egg_no',$egg_no_incub);  //delete

    }
        if($br_ch_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Breeding/view_proven"
            );
            echo json_encode($result);
    
        }
    
    }
    public function update_delete_status(){
        $id  =   $this->input->post('id');
        $table = $this->input->post('table');
        $where_con['status'] = 0;
        $br_ch_result = $this->cbmodel->updates($table, $where_con, 'id', $id);
        if($br_ch_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Breeding/non_proven"
            );
            echo json_encode($result);
    
        }
    }
	public function get_birds_proven(){
		$postData = $this->input->post();
        $getproven_result = $this->brmodel->get_birds_proven_dt($postData);
        echo json_encode($getproven_result);
	}
	public function get_birds_nonproven(){
		$postData = $this->input->post();
        $getproven_result = $this->brmodel->get_birds_nonproven_dt($postData);
        echo json_encode($getproven_result);
	}
}//end class
?>
