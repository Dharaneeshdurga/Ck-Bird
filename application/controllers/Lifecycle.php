<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Lifecycle extends CI_Controller {	
	
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
		
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	
        $this->load->model('CommonBird_model', 'cbmodel');
        $this->load->model('Handfeed_model', 'hmodel');
        $this->load->model('Preweaning_model', 'pwmodel');
        $this->load->model('Weaning_model', 'wmodel');
        $this->load->model('masters_model');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function lifecycle(){
		$this->load->view('Lifecycle/timeline');	
	}
    public function weaning_details(){
		$this->load->view('Weaning/weaning_details');	
	}
    public function view_weaning_details(){
		$this->load->view('Weaning/view_weaning');	
	}
    
   
  /*  public function get_birds(){
        $where_cond_a['status'] = 1;
		//$ring_result = $this->cbmodel->verify_data($where_cond_a,'ckb_bird');
        $this->db->select('*');
       $this->db->from('ckb_bird');
      $this->db->order_by('id','desc');
     $query = $this->db->get();
     $ring_result = $query->result(); 
        echo json_encode($ring_result);
    }*/

    public function get_bird_dt(){
       // $where_cond_a['status'] = 1;
        $where_cond_a =  $this->input->post('ring_no');
     //   $where_cond_a['branch_id'] = $this->session->userdata('branch_id');
       // echo $where_cond_a;
		$ring_result_one = $this->cbmodel->get_birdsjoin_dt($where_cond_a);
      if($ring_result_one){
        echo json_encode($ring_result_one);
      }
      else{
        echo "fail";
      }
      
    }
    public function get_incub_egg(){
        // $where_cond_a['status'] = 1;
         //$ring =  $this->input->post('current_ring_no');
         $ring =  $this->input->post('current_ring_no');
        // print_r($ring);
         $ring_result_one = $this->cbmodel->get_incubation_join_dt($ring);
         echo json_encode($ring_result_one);
     }
    public function get_incubation(){
        $where_cond_a['static_status'] = 1;
        $where_cond_a['branch_id'] = $this->session->userdata('branch_id');
		$egg_result = $this->cbmodel->verify_data($where_cond_a,'ckb_incubation');
        echo json_encode($egg_result);
    }
    public function get_ring_av(){
        $status= 1;
        $species_id = $this->input->post('species_id');
        $group_id = $this->input->post('group_id');
        $aviary_id = $this->input->post('aviary_id');
		$ring_result = $this->cbmodel->get_birdspecies_ring($status,$species_id,$group_id,$aviary_id);
        echo json_encode($ring_result);
    }
    public function get_group(){
        $status= 1;
        $aviary_id = $this->input->post('aviary_id');
		$group_result = $this->cbmodel->get_birdgroup_dt($status,$aviary_id);
        echo json_encode($group_result);
    }
    public function get_species(){
        $status= 1;
        $group_id = $this->input->post('group_id');
        $aviary_id = $this->input->post('aviary_id');
		$sp_result = $this->cbmodel->get_bird_species($status,$group_id,$aviary_id);
        echo json_encode($sp_result);
    }
    public function get_species_count(){
        $data['status']= 1;
        $data['group_id'] = $this->input->post('group_id');
        $data['aviary_id'] = $this->input->post('aviary_id');
        $data['species_id'] = $this->input->post('species_id');
        $data['branch_id'] = $this->session->userdata('branch_id');
		$sp_count = $this->cbmodel->count_items($data,'ckb_bird');
        echo json_encode($sp_count);
    }
    public function get_type(){
       // $status= 1;
        $group_id = $this->input->post('group_id');
        $where_cond_a['auto_id']=$group_id;
        $where_cond_a['branch_id'] = $this->session->userdata('branch_id');

        $gr_result = $this->cbmodel->verify_data($where_cond_a,'ckb_group');
        foreach($gr_result as $val) { 
            $group_name = $val->group_name;
        }
        $aviary_id = $this->input->post('aviary_id');
        $where_cond_b['auto_id']=$aviary_id;
         $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        
        $av_result = $this->cbmodel->verify_data($where_cond_b,'ckb_aviary');
        foreach($av_result as $val) { 
            $aviary_name = $val->aviary_name;
        }
        $species_id = $this->input->post('species_id');
        $where_cond_b['auto_id']=$species_id;
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

        $sp_result = $this->cbmodel->verify_data($where_cond_b,'ckb_species');
        foreach($sp_result as $val) { 
            $species_name = $val->bird_species;
        }
		$type_result = $this->cbmodel->get_material_type($aviary_name,$group_name,$species_name);
        echo json_encode($type_result);
    }
    public function get_weaning(){
        $where_cond_a['incub_id'] =  $this->input->post('incub_id');
        $where_cond_a['branch_id'] = $this->session->userdata('branch_id');
		$wean_result = $this->cbmodel->verify_data($where_cond_a,'ckb_weaning');
        echo json_encode($wean_result);
    }
    public function get_rawmat_import(){
        $postData = $this->input->post();
        $rawmat_result = $this->masters_model->verify_data_rawmat_dt($postData);
        echo json_encode($rawmat_result);
    }


}//end class
?>