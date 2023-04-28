<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bird extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('CommonBird_model', 'cbmodel');
        if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
    }

    public function bird_manage(){
		$this->load->view('bird_manage');	
    }

    public function add_bird(){
		$this->load->view('add_bird');	
    }
	public function bird_history(){
		$date=$this->input->post('date');
        $to_date=$this->input->post('to_date');
        $data['bird_history'] = $this->cbmodel->get_bird_history_dt($date,$to_date);
        $data['from_date']=$date;
        $data['to_date']=$to_date;
		$this->load->view('Bird/bird_history',$data);	
    }

	public function bird_history_view_gt(){
        $date = $this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $datawhere = $this->input->post('type');
		if($datawhere == "all"){
			$array_data= "";
		  }

		  if($datawhere == "sale"){
			$array_data['bird_status']= "Sale";
		  }
		  if($datawhere == "purchase"){
			$array_data['bird_status']= "Purchase";
		  }
		  if($datawhere == "mort"){
			$array_data['bird_status']= "Mortality";
		  }

		  if($datawhere == "semi_adult"){
			$array_data['proven']= "Semi adult";
		  }

		  if($datawhere == "proven"){
			$array_data['proven']= "Proven";
		  }

		  if($datawhere == "non_proven"){
			$array_data['proven']= "Non proven";
		  }
		 
			$postData = $this->input->post();
			 $bird_history_view_result = $this->cbmodel->get_bird_history_data($postData,$array_data,$date,$to_date);
				
			 echo json_encode($bird_history_view_result);
		
		  
			
	}
	public function other_branch(){
		$data['other_branch_result'] =$this->cbmodel->get_other_branch_birds();
		$this->load->view('Bird/other_branch_history_view',$data);	

	}
	public function bird_history_view(){
		$this->load->view('Bird/bird_history_view');	
	}
    public function edit_bird(){

       
		$this->load->view('edit_bird');	
    }

    public function check_ringno(){

        $ring_no = $this->input->post('ring_no');

        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['ring_no'] = $ring_no;

		$ring_no_count = $this->cbmodel->count_menu($where_cond_b,'ckb_bird','menu_id');

        if($ring_no_count ==0){
            
            $result = array(
                "response" => "proceed",
            );
        }
        else{
            $result = array(
                "response" => "already_exits",
            );
        }

        echo json_encode($result);

    }

    public function get_birdgroup(){
        
        $where_cond_g['status'] = 1;
        $where_cond_g['branch_id'] = $this->session->userdata('branch_id');
		$group_result = $this->cbmodel->verify_data($where_cond_g,'ckb_group');

        echo json_encode($group_result);

    }

    public function get_birdspecies(){
        
        $group_id = $this->input->post('group_id');

        $where_cond_s['group_id'] = $group_id;
      //  $where_cond_s['auto_id'] = $this->input->post('species_id');
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');
		$species_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species');

        echo json_encode($species_result);
    }
    public function get_birdspecies_fm(){
        
        $where_cond_s['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_s['cage_id'] = $this->input->post('cage_id');
        $where_cond_s['b.branch_id'] = $this->session->userdata('branch_id');

       // $where_cond_s['status'] = 1;
		$speciesfm_result = $this->cbmodel->get_birdspecies_dt($where_cond_s);

        echo json_encode($speciesfm_result);
    }
    public function get_birdfeed_fm(){
        
        $where_cond_s['auto_id'] = $this->input->post('species_id');
       // $where_cond_s['cage_id'] = $this->input->post('cage_id');
        $where_cond_s['status'] = 1;
        $where_cond_s['branch_id'] = $this->session->userdata('branch_id');

        $speciesfeed_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species');

        echo json_encode($speciesfeed_result);
    }
    public function update_status(){
           
        $auto_id = $this->input->post('p_id');
      //  $where_cond_h['auto_id'] = $auto_id;
        $where_cond_h['bird_status'] = $this->input->post('bird_status');
		$where_cond_h['health_change_date'] =$this->input->post('health_change_date');
        $bird_status_result = $this->cbmodel->updates('ckb_bird', $where_cond_h, 'auto_id', $auto_id);
            
            if($bird_status_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Bird/bird_manage"
                );
                echo json_encode($result);
        
            }
    
    }

	public function change_branch(){
           
        $ring_no = $this->input->post('ring_no');
        $where_cond_h['branch_id'] = $this->input->post('bird_branch');
		$where_cond_h['old_branch_id'] =  $this->input->post('current_branch');
		$where_cond_h['branch_moved_date'] = date('Y-m-d');
		$where_cond_h['branch_moved_by'] = $this->session->userdata('user_id');
        $bird_status_result = $this->cbmodel->updates('ckb_bird', $where_cond_h, 'ring_no', $ring_no);
            
            if($bird_status_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Bird/bird_manage"
                );
                echo json_encode($result);
        
            }
    
    }
    public function get_proven(){

        $where_cond_p['status'] = 1;
        $where_cond_p['branch_id'] = $this->session->userdata('branch_id');
       // $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

		$proven_result = $this->cbmodel->verify_data($where_cond_p,'ckb_proven');

        echo json_encode($proven_result);
    }

    public function get_cage_info(){

        $cage_id = $this->input->post('cage');
        $aviary_id = $this->input->post('aviary_id');

        $where_cond_c['cage_id'] = $cage_id;
        $where_cond_c['aviary_id'] = $aviary_id;
        $where_cond_c['b.branch_id'] = $this->session->userdata('branch_id');


        $cage_result = $this->cbmodel->verify_data_join_two(

            $where_cond_c,'ckb_bird as b',
            'ckb_group as g','b.group_id = g.auto_id',
            'ckb_species as s','b.species_id = s.auto_id',
            'b.*,g.*,s.*'
        );
            // print_r($cage_result);


        $result = array(
            "response" => $cage_result,
        );
        echo json_encode($result);

        
        
    }

    public function get_aviary(){

        // $cage_id = $this->input->post('cage_id');

        // $where_cond_a['c.auto_id'] = $cage_id;
        $where_cond_a['status'] = 1;
        $where_cond_a['branch_id'] = $this->session->userdata('branch_id');

		$aviary_result = $this->cbmodel->verify_data($where_cond_a,'ckb_aviary');

        echo json_encode($aviary_result);
    }

    public function process_bird_save(){

        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_bird');
		$auto_id = "B".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['ring_no'] = $this->input->post('ring_no');
        $where_cond_b['group_id'] = $this->input->post('bird_group');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
        $where_cond_b['gender'] = $this->input->post('gender');
        $where_cond_b['cage_id'] = $this->input->post('cage');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['proven'] = $this->input->post('proven');
        $where_cond_b['weight'] = $this->input->post('weight');
        $where_cond_b['status'] = 1;
        $where_cond_b['created_by'] = $this->session->userdata('user_id');
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
		$bird_result = $this->cbmodel->data_add('ckb_bird',$where_cond_b);

        
        if($bird_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Bird/bird_manage"
            );
            echo json_encode($result);
    
        }
        
    }

    public function get_cage_listall(){
        $aviary_id = $this->input->post('aviary_id');

        $where_cond_c['aviary_id'] = $aviary_id;
        $where_cond_c['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_c['status'] = 1;
		$cage_result = $this->cbmodel->verify_data($where_cond_c,'ckb_cage');

        echo json_encode($cage_result);
    }
	public function get_cage_birdcount(){
        $aviary_id = $this->input->post('aviary_id');

        $where_cond_c['aviary_id'] = $aviary_id;
        $where_cond_c['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_c['status'] = 1;
		$cage_result = $this->cbmodel->verify_data($where_cond_c,'ckb_cage');
		foreach ( $cage_result  as  $value){
			$cage =  $value->cage;
			$bird_count[] = $this->cbmodel->get_birdcount_avBYcage($aviary_id,$cage);
			// $bird_count[]  = count($bird_result);
			//  foreach ( $bird_result  as  $b){
			// 	$b_id = $b->species_id;	
			// 	$where_cond_c['auto_id'] =$b_id;
			// 	$sp_result = $this->cbmodel->verify_data($where_cond_c,'ckb_species');
			// 	$bs[] = $sp_result[0]->bird_species;
			// //  }
			// echo json_encode($bird_count);
			// $bs[] = $bird_result[0]->species_id;
			
		}
		
		$data['cage_result'] = $cage_result;	
		$data['count'] = $bird_count;
	//	$data['bird_result'] = $bs;

	
        echo json_encode($data);
    }

    public function get_birdmanage_list(){
        
        $postData = $this->input->post();
        // $postData_where['b.status'] = "1";
        // $postData_where='';
		$bird_result = $this->cbmodel->verify_data_bird_dt($postData);

        echo json_encode($bird_result);
    }

    public function get_bird_edit_details(){
        
        $where_cond_bed['status'] = 1;
        $where_cond_bed['auto_id'] = $this->input->post('current_birdid');
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');

		$get_bird_edit_details_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_bird');

        echo json_encode($get_bird_edit_details_result);
    }

    public function delete_bird(){

        $where_cond_bed['auto_id'] = $this->input->post('bird_row_id');
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');

        $delete_bird_result = $this->cbmodel->delete_data('ckb_bird',$where_cond_bed);

        $response = "success";
        echo json_encode($response);
    }

    public function process_bird_update(){

        $where_cond_b['auto_id'] =$this->input->post('auto_id');
        $where_cond_b['ring_no'] = $this->input->post('ring_no');
        $where_cond_b['group_id'] = $this->input->post('bird_group');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
        $where_cond_b['gender'] = $this->input->post('gender');
        $where_cond_b['cage_id'] = $this->input->post('cage');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['proven'] = $this->input->post('proven');
        $where_cond_b['weight'] = $this->input->post('weight');
        $where_cond_b['status'] = 1;
        $where_cond_b['created_by'] = $this->session->userdata('user_id');
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

        $auto_id  =   $this->input->post('auto_id');
		$bird_result = $this->cbmodel->updates('ckb_bird', $where_cond_b, 'auto_id', $auto_id);


        if($bird_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Bird/bird_manage"
            );
            echo json_encode($result);
    
        }
    }
}
